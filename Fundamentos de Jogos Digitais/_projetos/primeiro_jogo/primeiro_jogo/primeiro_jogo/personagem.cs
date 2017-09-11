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


namespace primeiro_jogo
{
    /// <summary>
    /// This is a game component that implements IUpdateable.
    /// </summary>
    public class personagem : Microsoft.Xna.Framework.DrawableGameComponent
    {
        public enum Direcoes { Cima, Baixo, Esquerda, Direita}

        SpriteBatch spriteBath;
        Texture2D textura;
        Vector2 posicao;
        Direcoes direcao;
        Vector2 velocidade;

        public personagem(Game game)
            : base(game)
        {
            // TODO: Construct any child components here
        }

        public personagem(Game game, Vector2 argpocicao)
            : base(game)

        {

        }

        /// <summary>
        /// Allows the game component to perform any initialization it needs to before starting
        /// to run.  This is where it can query for any required services and load content.
        /// </summary>
        public override void Initialize()
        {
            // TODO: Add your initialization code here

            posicao = new Vector2(300, 200);
            direcao = Direcoes.Direita;
            velocidade = new Vector2(3,1);
            base.Initialize();
        }

        public void LoadContent(Game arggame)
        {

        }

        /// <summary>
        /// Allows the game component to update itself.
        /// </summary>
        /// <param name="gameTime">Provides a snapshot of timing values.</param>
        public override void Update(GameTime gameTime)
        {
            // TODO: Add your update code here
            //Gravidade
            //  posicao.Y += 5; 

            base.Update(gameTime);
        }

        public void Mover(Direcoes argdirecao)
        {
            switch(argdirecao)
            {
                case Direcoes.Cima: posicao.Y -= velocidade.Y; break;
                case Direcoes.Baixo: posicao.Y += velocidade.Y; break;
                case Direcoes.Esquerda: posicao.X -= velocidade.X; break;
                case Direcoes.Direita: posicao.X += velocidade.X; break;
            }
        }
    }
}
