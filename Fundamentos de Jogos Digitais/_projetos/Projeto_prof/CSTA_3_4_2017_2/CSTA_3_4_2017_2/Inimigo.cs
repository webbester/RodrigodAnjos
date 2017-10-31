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
    public class Inimigo : Microsoft.Xna.Framework.DrawableGameComponent
    {
        public enum Direcoes { Baixo, Direita, Esquerda, Cima }
        public enum Tipos { Mesa, Chave, Fdp }

        SpriteBatch spriteBatch;
        Texture2D textura;
        public Vector2 posicao;
        Vector2 velocidade;
        Vector2 tamanho;
        public Rectangle boundingBox = new Rectangle();
        public Tipos tipo;

        public Inimigo(Game game)
            : base(game)
        {
            posicao = new Vector2(300, 200);
        }

        public Inimigo(Game game, Vector2 argposicao, Tipos argtipo)
            : base(game)
        {
            posicao = argposicao;
            tipo = argtipo;
        }

        /// <summary>
        /// Allows the game component to perform any initialization it needs to before starting
        /// to run.  This is where it can query for any required services and load content.
        /// </summary>
        public override void Initialize()
        {
            velocidade = new Vector2(3, 1);

            base.Initialize();
        }

        public void LoadContent(Game arggame)
        {
            spriteBatch = new SpriteBatch(GraphicsDevice);
            textura = arggame.Content.Load<Texture2D>("mario");
            tamanho.X = textura.Width;
            tamanho.Y = textura.Height;
        }

        /// <summary>
        /// Allows the game component to update itself.
        /// </summary>
        /// <param name="gameTime">Provides a snapshot of timing values.</param>
        public override void Update(GameTime gameTime)
        {
            boundingBox = new Rectangle((int)posicao.X, (int)posicao.Y, (int)tamanho.X, (int)tamanho.Y);

            base.Update(gameTime);
        }

        public override void Draw(GameTime gameTime)
        {
            spriteBatch.Begin();
            spriteBatch.Draw(textura,
                new Rectangle((int)posicao.X, (int)posicao.Y, textura.Width, textura.Height),
                Color.White
                );
            spriteBatch.End();

            base.Draw(gameTime);
        }
        public void Mover(Direcoes argdirecao, Vector2 argvelocidade)
        {
            switch (argdirecao)
            {
                case Direcoes.Cima: posicao.Y -= argvelocidade.Y; break;
                case Direcoes.Baixo: posicao.Y += argvelocidade.Y; break;
                case Direcoes.Esquerda: posicao.X -= argvelocidade.X; break;
                case Direcoes.Direita: posicao.X += argvelocidade.X; break;
            }
        }

    }
}
