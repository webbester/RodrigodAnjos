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

        SpriteBatch spriteBatch;
        Texture2D textura;
        Vector2 posicao;
        Vector2 velocidade;

        public Inimigo(Game game)
            : base(game)
        {
            posicao = new Vector2(300, 200);
        }

        public Inimigo(Game game, Vector2 argposicao)
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
            velocidade = new Vector2(3, 1);

            base.Initialize();
        }

        public void LoadContent(Game arggame)
        {
            spriteBatch = new SpriteBatch(GraphicsDevice);
            textura = arggame.Content.Load<Texture2D>("mario");
        }

        /// <summary>
        /// Allows the game component to update itself.
        /// </summary>
        /// <param name="gameTime">Provides a snapshot of timing values.</param>
        public override void Update(GameTime gameTime)
        {
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
    }
}
