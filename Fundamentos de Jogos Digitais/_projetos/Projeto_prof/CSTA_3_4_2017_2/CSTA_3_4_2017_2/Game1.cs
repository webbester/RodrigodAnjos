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
        Texture2D cenario;

        public Game1()
        {
            graphics = new GraphicsDeviceManager(this);
            Content.RootDirectory = "Content";

            personagem = new Personagem(this);

            Random r = new Random();
            for (int i = 0; i < 1; i++)
                inimigos.Add(
                    //Add randomicamente os 3 tipos de "inimigos"
                    //new Inimigo(this, new Vector2(r.Next(700), r.Next(400)), (Inimigo.Tipos)r.Next(3))
                    //Add somente o inimigo escolhido (no caso, fdp)
                    new Inimigo(this, new Vector2(r.Next(692), r.Next(358)), Inimigo.Tipos.Fdp)
                );

            for (int i = 0; i < 1; i++)
                inimigos.Add(
                    new Inimigo(this, new Vector2(r.Next(692), r.Next(358)), Inimigo.Tipos.Mesa)
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

            // Altera o vídeo para 800 pixels de largura
            graphics.PreferredBackBufferWidth = 800;
            // Altera o vídeo para 600 pixels de altura
            graphics.PreferredBackBufferHeight = 600;
            // Desabilita o modo tela cheia
            graphics.IsFullScreen = false;
            // Desabilita a visibilidade do mouse dento do jogo
            IsMouseVisible = false;
            // Aplica as mudanças
            graphics.ApplyChanges();
            // Define o título da janela
            Window.Title = "Run, Berg! Run!";

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

            cenario = Content.Load<Texture2D>(@"cenario");

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

            #region MudaVelocidade
            if (Keyboard.GetState().IsKeyDown(Keys.LeftShift))
                personagem.setVelocidade(new Vector2(6, 6));
            else
                personagem.setVelocidade(new Vector2(3, 3));
            #endregion


            #region GanhaPontos
            for (int i = 0; i < inimigos.Count; i++)
            {
                if (personagem.boundingBox.Intersects(inimigos[i].boundingBox))
                {
                    if(inimigos[i].tipo == Inimigo.Tipos.Chave)
                        inimigos.Remove(inimigos[i]);
                    else if(inimigos[i].tipo == Inimigo.Tipos.Mesa)
                        inimigos[i].Mover((Inimigo.Direcoes)personagem.direcao, personagem.velocidade);
                    personagem.Ganha();
                    somHit.Play();
                }
            }
            #endregion

            for (int i = 0; i < inimigos.Count; i++)
            {
                if(inimigos[i].tipo == Inimigo.Tipos.Fdp)
                {
                    // Vector2 velPersegue = new Vector2(personagem.velocidade.X + 1, personagem.velocidade.Y + 1);
                    Vector2 velPersegue = new Vector2(1, 1);
                    if (inimigos[i].posicao.X - personagem.posicao.X > 0)
                        inimigos[i].Mover(Inimigo.Direcoes.Esquerda, velPersegue);
                    else
                        inimigos[i].Mover(Inimigo.Direcoes.Direita, velPersegue);

                    if (inimigos[i].posicao.Y - personagem.posicao.Y > 0)
                        inimigos[i].Mover(Inimigo.Direcoes.Cima, velPersegue);
                    else
                        inimigos[i].Mover(Inimigo.Direcoes.Baixo, velPersegue);
                }
            }



                personagem.Update(gameTime);
            for (int i = 0; i < inimigos.Count; i++)
                inimigos[i].Update(gameTime);
            base.Update(gameTime);

            #region Colisão personagem

            if(personagem.posicao.X > graphics.PreferredBackBufferWidth - personagem.tamanho.X)
                personagem.posicao.X -= personagem.velocidade.X;
            if(personagem.posicao.Y > graphics.PreferredBackBufferHeight - personagem.tamanho.Y)
                personagem.posicao.Y -= personagem.velocidade.Y;
            if (personagem.posicao.X < 25)
                personagem.posicao.X = 25;
            if (personagem.posicao.Y < 50)
                personagem.posicao.Y = 50;

            #endregion

            #region Colisão mesa

            for (int i = 0; i < inimigos.Count; i++)
            {
                if (inimigos[i].tipo == Inimigo.Tipos.Mesa)
                {
                    
                    if (inimigos[i].posicao.X > graphics.PreferredBackBufferWidth - inimigos[i].tamanho.X)
                        inimigos[i].posicao.X -= inimigos[i].velocidade.X;
                    if (inimigos[i].posicao.Y > graphics.PreferredBackBufferHeight - inimigos[i].tamanho.Y)
                        inimigos[i].posicao.Y -= inimigos[i].velocidade.Y;
                    if (inimigos[i].posicao.X < 25)
                        inimigos[i].posicao.X = 25;
                    if (inimigos[i].posicao.Y < 90)
                        inimigos[i].posicao.Y = 90;
                }
            }
            #endregion

        }

        /// <summary>
        /// This is called when the game should draw itself.
        /// </summary>
        /// <param name="gameTime">Provides a snapshot of timing values.</param>
        protected override void Draw(GameTime gameTime)
        {
            //GraphicsDevice.Clear(Color.CornflowerBlue);
            // Inicializa o bloco de desenho do objeto do tipo SpriteBatch
            spriteBatch.Begin();
            // Desenha o cenario na posição 0, 0 aplicando um filtro onde todas as cores passam
            spriteBatch.Draw(cenario, new Vector2(0.0f, 0.0f), Color.White);
            // Finaliza o bloco de desenho do objeto do tipo SpriteBatch    
            spriteBatch.End();
            base.Draw(gameTime);

            personagem.Draw(gameTime);

            for (int i = 0; i < inimigos.Count; i++)
                inimigos[i].Draw(gameTime);

            base.Draw(gameTime);
        }
    }
}
