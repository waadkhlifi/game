#include "background.h"
#include <stdio.h>
#include <stdlib.h>
#include <SDL/SDL.h>
#include <SDL/SDL_mixer.h>


int main(int argc, char *argv[])
{
    image i, p , s;
    int done = 1;
    int level = 1;
    int direction = 0;
    Text t;
    SDL_Surface *screen;
    SDL_Init(SDL_INIT_VIDEO | SDL_INIT_AUDIO);
    screen = SDL_SetVideoMode(1000, 700, 32, SDL_HWSURFACE | SDL_SRCALPHA);
    initialiser_imageBACK(&i);
    initialiser_Person(&p);
    initialiser_imageScore(&s);

    if (Mix_OpenAudio(44100, MIX_DEFAULT_FORMAT, 2, 1024) == -1) {
        fprintf(stderr, "Failed to initialize SDL_mixer: %s\n", Mix_GetError());
        return 1;
    }

    TTF_Init();
    initText(&t);

    Mix_Music *music1 = Mix_LoadMUS("level1.mp3");
    Mix_Music *music2 = Mix_LoadMUS("level2.mp3");
    Mix_Music *music3 = Mix_LoadMUS("level3.mp3");
    Mix_Music *current_music = music1;

    Mix_PlayMusic(current_music, -1);

    while (done) {
        afficher_imageBACK(screen, i);
        afficher_imageBACK(screen, s);
        afficher_Person(screen, p);
        displayText(t, screen);

        switch (level) {
        case 1:
		if(current_music != music1){
                    Mix_HaltMusic();
                    current_music = music1;
                    Mix_PlayMusic(current_music, -1);}
                    break;
        case 2:
		if(current_music != music2){
            Mix_HaltMusic();
            current_music = music2;
            Mix_PlayMusic(current_music, -1);
		}
            break;
        case 3:
		if(current_music != music3){
            Mix_HaltMusic();
            current_music = music3;
            Mix_PlayMusic(current_music, -1);
		}
            break;

        }

	SDL_Event event;
	SDL_PollEvent(&event);

  switch(event.type)
  {
	case SDL_QUIT:
	done=0;
	break;
	case SDL_KEYDOWN:

	    switch (event.key.keysym.sym) {
		case SDLK_UP:
		    p.pos1.y -= 10;
		    if (p.pos1.y < 0) {
		        p.pos1.y = 0;
		    }
		    break;
		case SDLK_DOWN:
		    p.pos1.y += 10;
		    if (p.pos1.y > screen->h - p.pos2.h) {
		        p.pos1.y = screen->h - p.pos2.h;
		    }
		    break;
		case SDLK_LEFT:
		    p.pos1.x -= 10;
		    if (p.pos1.x < 5) {
		        p.pos1.x = 5;
			direction=2;
		    }
		    if (p.pos1.x < 10) {
			direction=2;
		    }
		    break;
		case SDLK_RIGHT:
		    p.pos1.x += 10;
		    if (p.pos1.x > screen->w - p.pos2.w) {
		        p.pos1.x = screen->w - p.pos2.w;
		    }
		    if ((p.pos1.x >= 400)&&(i.pos2.x<=5000) ) {
		        p.pos1.x = 410;
			direction =1;
		    }
		    break;
		

	    }
	    break;
	}


	if((i.pos2.x>=1000) && (i.pos2.x<3000)){
		level=2;
	}
	if((i.pos2.x>=3000) && (i.pos2.x<6000)){
		level=3;
	}
	else if((i.pos2.x<=1000)){
		level=1;
	}
	Scrolling(&i.pos2,direction);
	direction=0;
	SDL_Flip(screen);
}
Mix_FreeMusic(music1);
    Mix_FreeMusic(music2);
    Mix_FreeMusic(music3);
    Mix_CloseAudio();

SDL_FreeSurface(i.Background);
SDL_FreeSurface(p.Background);
SDL_Quit();
printf ("%s:%d \n", __func__, __LINE__);
return 0;
}




