using System;
using System.Collections.Generic;
using System.Linq;
using Microsoft.Xna.Framework;
using Microsoft.Xna.Framework.Audio;
using Microsoft.Xna.Framework.Content;
using Microsoft.Xna.Framework.GamerServices;
using Microsoft.Xna.Framework.Graphics;
using Microsoft.Xna.Framework.Input;
using Microsoft.Xna.Framework.Media;


namespace CSTA_3_4_2017_2
{
    /// <summary>
    /// This is a game component that implements IUpdateable.
    /// </summary>
    public class Personagem : Microsoft.Xna.Framework.DrawableGameComponent
    {

        public enum Direcoes { Baixo, Direita, Esquerda, Cima }
        public enum Estados { Idle, AndandoBaixo, AndandoDireita, AndandoEsquerda, AndandoCima }

        SpriteBatch spriteBatch;
        Texture2D textura;
        public Vector2 posicao;
        public Direcoes direcao = Direcoes.Direita;
        public Vector2 velocidade;
        Vector2 frame = new Vector2(0, 0);
        public Vector2 tamanho = new Vector2(66, 79);
        Estados estado = Estados.Idle;
        TimeSpan ultimoUpdate = TimeSpan.Zero;
        public Rectangle boundingBox = new Rectangle();
        int pontos = 0;
        SpriteFont fontePontos;
        SoundEffect somSteps;
        SoundEffectInstance somStepsInstance;


        public Personagem(Game game)
            : base(game)
        {
            posicao = new Vector2(461, 470);
        }

        public Personagem(Game game, Vector2 argposicao)
            : base(game)
        {
            posicao = argposicao;
        }

        /// <summary>
        /// Allows the game component to perform any initialization it needs to before starting
        /// to run.  This is where it can query for any required services and load content.
        /// </summary>
        public override void Initialize()
        {
            velocidade = new Vector2(3,3);

            base.Initialize();
        }

        public void LoadContent(Game arggame)
        {
            spriteBatch = new SpriteBatch(GraphicsDevice);
            textura = arggame.Content.Load<Texture2D>("berg3");
            fontePontos = arggame.Content.Load<SpriteFont>("PontosPersonagem");
            somSteps = arggame.Content.Load<SoundEffect>("somSteps");
            somStepsInstance = somSteps.CreateInstance();
        }

        /// <summary>
        /// Allows the game component to update itself.
        /// </summary>
        /// <param name="gameTime">Provides a snapshot of timing values.</param>
        public override void Update(GameTime gameTime)
        {
            // gravidade
            // posicao.Y += 5;

            boundingBox = new Rectangle((int)posicao.X, (int)posicao.Y, (int)tamanho.X, (int)tamanho.Y);

            #region AtualizaFrame
            if (gameTime.TotalGameTime > ultimoUpdate + TimeSpan.FromMilliseconds(50))
            {
                frame.X++;
                ultimoUpdate = gameTime.TotalGameTime;
            }
            if (frame.X > 3)
                frame.X = 0;
            frame.Y = (int)estado;
            #endregion

            #region SomDePassos
            if((int)estado != (int)Estados.Idle)
                somStepsInstance.Play();
            #endregion

            base.Update(gameTime);
        }

        public override void Draw(GameTime gameTime)
        {
            spriteBatch.Begin();
            spriteBatch.Draw(
               textura,
               new Rectangle(
                  (int)posicao.X, (int)posicao.Y,
                  (int)tamanho.X, (int)tamanho.Y),
               new Rectangle(
                  (int)(frame.X * tamanho.X), (int)(frame.Y * tamanho.Y),
                  (int)tamanho.X, (int)tamanho.Y),
               Color.White,
               0f,
               Vector2.Zero,
               SpriteEffects.None,
               0
            );
            spriteBatch.DrawString(
                fontePontos,
                pontos.ToString(),
                new Vector2(10, 10),
                Color.Yellow
                );

            spriteBatch.End();

            base.Draw(gameTime);
        }


        public void Mover(Direcoes argdirecao)
        {
            estado = (Estados)((int)argdirecao + 1);
            direcao = argdirecao;
            switch(argdirecao)
            {
                case Direcoes.Cima: posicao.Y-=velocidade.Y; break;
                case Direcoes.Baixo: posicao.Y+= velocidade.Y; break;
                case Direcoes.Esquerda: posicao.X-= velocidade.X; break;
                case Direcoes.Direita: posicao.X+= velocidade.X; break;
            }
        }

        public void Parar()
        {
            estado = Estados.Idle;
            if (somStepsInstance.State == SoundState.Playing)
                somStepsInstance.Stop();
        }

        public void Ganha()
        {
            pontos--;
        }

        public void setVelocidade(Vector2 argvelocidade)
        {
            velocidade = argvelocidade;
        }
        
    }
}
