#ifndef Background_H
#define Background_H
#include <SDL/SDL.h>
#include <SDL/SDL_image.h>
#include <SDL/SDL_ttf.h>

typedef struct
{
  SDL_Rect position;
  TTF_Font *font;
  SDL_Surface * surfaceTexte;
  SDL_Color textColor;
  char texte [50];
} Text;

void initText(Text *t); 
void freeText(Text A);
void displayText(Text t,SDL_Surface *screen);
typedef struct{
  SDL_Rect pos1;
  SDL_Rect pos2;
  SDL_Surface *Background;  }image;


 
void initialiser_imageBACK(image *imge);
void afficher_imageBACK(SDL_Surface *screen,image imge);
// added
void initialiser_imageScore(image *imge);
void initialiser_Person(image *imge);
void afficher_Person(SDL_Surface *screen,image p);
void Scrolling(SDL_Rect *b,int direction);
//void AnimerBack(Back *b);


#endif
