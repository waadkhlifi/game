
#include "background.h"
#include <SDL/SDL_mixer.h>
#include <SDL/SDL_ttf.h> 


void initialiser_imageBACK(image *imge)
{

   imge->Background=IMG_Load("bg.jpg");

   imge->pos1.x=0;
   imge->pos1.y=0;
   imge->pos2.x=0;
   imge->pos2.y=0;
   imge->pos2.w=1000;
   imge->pos2.h=700;
    if (imge->Background == NULL)
    {
        printf("erreur img background %s\n", SDL_GetError());
        return ;
    }
   
}
// added
void initialiser_imageScore(image *imge)
{

   imge->Background=IMG_Load("score.jpg");

   imge->pos1.x=550;
   imge->pos1.y=0;
   imge->pos2.x=0;
   imge->pos2.y=0;
   imge->pos2.w=1000;
   imge->pos2.h=700;
    if (imge->Background == NULL)
    {
        printf("erreur img background %s\n", SDL_GetError());
        return ;
    }
   
}

void initialiser_Person(image *imge)
{

   imge->Background=IMG_Load("person.png");

   imge->pos1.x=0;
   imge->pos1.y=360;
   imge->pos2.x=0;
   imge->pos2.y=0;
   imge->pos2.w=145;
   imge->pos2.h=199;
    if (imge->Background == NULL)
    {
        printf("erreur img background %s\n", SDL_GetError());
        return ;
    }
   
}

void afficher_imageBACK(SDL_Surface *screen,image imge)
{
    SDL_BlitSurface(imge.Background, &imge.pos2, screen, &imge.pos1 );
}

void afficher_Person(SDL_Surface *screen,image p)
{
	SDL_BlitSurface(p.Background,&p.pos2,screen,&p.pos1);

}

  //added

void initText(Text *A)
{
       //printf(" ffffffffffff \n");
	A->position.x=300;
	A->position.y=50;
	// couleur jaune
	A->textColor.r=255;
	A->textColor.g=255;
	A->textColor.b=0;
	A->font = TTF_OpenFont ( "arial.ttf", 70 );
       /* if (A->font)
           printf(" NON NULL \n");
        else
           printf(" NULL \n");*/
            
        //printf(" rrrrrrrrrrrrrrr \n");
}


void freeText(Text A)
{
  SDL_FreeSurface (A.surfaceTexte);
}

void displayText (Text t, SDL_Surface *screen)
{
  //printf(" cccccccccc \n");
  // crash openfont arial  
  //t.surfaceTexte = TTF_RenderText_Solid(t.font,"Neymar",t.textColor );
  //printf(" pppppppppp \n");
 // SDL_BlitSurface(t.surfaceTexte, NULL, screen, &t.position);
 //printf(" ddddddddddd \n");
}


void Scrolling(SDL_Rect *b,int direction)
{
if((b->x >=0)&&(b->x<=5050)){
if(direction==1)
{
b->x=b->x + 10;
}
if(direction==2)
{

b->x=b->x - 10;
if((b->x)<=0){
b->x=0;
}
if((b->x)>=5000){
b->x=5000;
}
}

}

}



