prog:main.o background.o
	gcc main.o background.o -o prog -lSDL -lSDL_ttf -g -lSDL_image -lSDL_mixer

main.o:main.c
	gcc -c main.c -g
background.o:background.c
	gcc -c background.c -g
