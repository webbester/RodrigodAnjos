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

        public enum Direcoes { Cima, Baixo, Esquerda, Direita }
        public enum Estados { Idle, Andando }

        SpriteBatch spriteBatch;
        Texture2D textura;
        Vector2 posicao;
        Direcoes direcao;
        Vector2 velocidade;
        Vector2 frame;
        Vector2 tamanho;
        Estados estado;

        public Personagem(Game game)
            : base(game)
        {
            posicao = new Vector2(300, 200);
            direcao = Direcoes.Direita;
            frame = new Vector2(0, 0);
            tamanho = new Vector2(35, 35);
            estado = Estados.Idle;
        }

        public Personagem(Game game, Vector2 argposicao)
            : base(game)
        {
            posicao = argposicao;
            direcao = Direcoes.Direita;
            frame = new Vector2(0, 0);
            tamanho = new Vector2(35, 35);
            estado = Estados.Idle;
        }

        /// <summary>
        /// Allows the game component to perform any initialization it needs to before starting
        /// to run.  This is where it can query for any required services and load content.
        /// </summary>
        public override void Initialize()
        {
            velocidade = new Vector2(3,1);

            base.Initialize();
        }

        public void LoadContent(Game arggame)
        {
            spriteBatch = new SpriteBatch(GraphicsDevice);
            textura = arggame.Content.Load<Texture2D>("megaman");
        }

        /// <summary>
        /// Allows the game component to update itself.
        /// </summary>
        /// <param name="gameTime">Provides a snapshot of timing values.</param>
        public override void Update(GameTime gameTime)
        {
            // gravidade
            // posicao.Y += 5;

            frame.X++;
            if (estado == Estados.Idle)
            {
                if (frame.X > 2)
                    frame.X = 0;
                frame.Y = 0;
            }
            else if (estado == Estados.Andando)
            {
                if (frame.X > 9)
                    frame.X = 0;
                frame.Y = 1;
            }

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

            spriteBatch.End();

            base.Draw(gameTime);
        }


        public void Mover(Direcoes argdirecao)
        {
            switch(argdirecao)
            {
                case Direcoes.Cima: posicao.Y-=velocidade.Y; break;
                case Direcoes.Baixo: posicao.Y+= velocidade.Y; break;
                case Direcoes.Esquerda: posicao.X-= velocidade.X; break;
                case Direcoes.Direita: posicao.X+= velocidade.X; break;
            }
        }

    }
}
