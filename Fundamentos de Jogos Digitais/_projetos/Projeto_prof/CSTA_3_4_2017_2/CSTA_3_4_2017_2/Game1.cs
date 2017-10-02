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
    /// This is the main type for your game
    /// </summary>
    public class Game1 : Microsoft.Xna.Framework.Game
    {
        GraphicsDeviceManager graphics;
        SpriteBatch spriteBatch;
        Personagem personagem;
        List<Inimigo> inimigos = new List<Inimigo>();
        SoundEffect somHit;
        SoundEffectInstance somHitInstance;

        public Game1()
        {
            graphics = new GraphicsDeviceManager(this);
            Content.RootDirectory = "Content";

            personagem = new Personagem(this);

            Random r = new Random();
            for (int i = 0; i < 15; i++)
                inimigos.Add(
                    new Inimigo(this, new Vector2(r.Next(700), r.Next(400)))
                );

        }

        /// <summary>
        /// Allows the game to perform any initialization it needs to before starting to run.
        /// This is where it can query for any required services and load any non-graphic
        /// related content.  Calling base.Initialize will enumerate through any components
        /// and initialize them as well.
        /// </summary>
        protected override void Initialize()
        {
            // TODO: Add your initialization logic here

            personagem.Initialize();

            for (int i = 0; i < inimigos.Count; i++)
                inimigos[i].Initialize();

            base.Initialize();
        }

        /// <summary>
        /// LoadContent will be called once per game and is the place to load
        /// all of your content.
        /// </summary>
        protected override void LoadContent()
        {
            // Create a new SpriteBatch, which can be used to draw textures.
            spriteBatch = new SpriteBatch(GraphicsDevice);

            somHit = Content.Load<SoundEffect>("somHit");
            somHitInstance = somHit.CreateInstance();

            personagem.LoadContent(this);

            for (int i = 0; i < inimigos.Count; i++)
                inimigos[i].LoadContent(this);

        }

        /// <summary>
        /// UnloadContent will be called once per game and is the place to unload
        /// all content.
        /// </summary>
        protected override void UnloadContent()
        {
            // TODO: Unload any non ContentManager content here
        }

        /// <summary>
        /// Allows the game to run logic such as updating the world,
        /// checking for collisions, gathering input, and playing audio.
        /// </summary>
        /// <param name="gameTime">Provides a snapshot of timing values.</param>
        protected override void Update(GameTime gameTime)
        {
            // Allows the game to exit
            if (Keyboard.GetState().IsKeyDown(Keys.Escape))
                Exit();

            #region MovimentaPersonagem
            if (Keyboard.GetState().IsKeyDown(Keys.Up))
                personagem.Mover(Personagem.Direcoes.Cima);
            else if (Keyboard.GetState().IsKeyDown(Keys.Down))
                personagem.Mover(Personagem.Direcoes.Baixo);
            else if (Keyboard.GetState().IsKeyDown(Keys.Right))
                personagem.Mover(Personagem.Direcoes.Direita);
            else if (Keyboard.GetState().IsKeyDown(Keys.Left))
                personagem.Mover(Personagem.Direcoes.Esquerda);
            else
                personagem.Parar();
            #endregion

            #region GanhaPontos
            for (int i = 0; i < inimigos.Count; i++)
            {
                if (personagem.boundingBox.Intersects(inimigos[i].boundingBox))
                {
                    inimigos.Remove(inimigos[i]);
                    personagem.Ganha();
                    somHit.Play();
                }
            }
            #endregion

            personagem.Update(gameTime);
            for (int i = 0; i < inimigos.Count; i++)
                inimigos[i].Update(gameTime);
            base.Update(gameTime);
        }

        /// <summary>
        /// This is called when the game should draw itself.
        /// </summary>
        /// <param name="gameTime">Provides a snapshot of timing values.</param>
        protected override void Draw(GameTime gameTime)
        {
            GraphicsDevice.Clear(Color.CornflowerBlue);

            personagem.Draw(gameTime);

            for (int i = 0; i < inimigos.Count; i++)
                inimigos[i].Draw(gameTime);

            base.Draw(gameTime);
        }
    }
}
