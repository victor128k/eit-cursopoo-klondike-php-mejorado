------------------------------------------------
para ir mejorando... (no desarrollado todavía)
------------------------------------------------
- separación por modelos y controladores
- separacion de vistas - crear unas clases de vistas para toda la interacción con el usuario y sacarla de los controladores
- comandos mediante analizador de códigos en lugar de menú de opciones:
Ejemplo:
d  --> Sacar de baraja a descarte
b  --> Voltear descarte en baraja
dp1 --> Mover de descarte a palo 1
dc3 --> Mover de descarte a columna 3
p2c5 --> Mover de palo 2 a columna 5
c6p1 --> Mover de columna 6 a palo 1
c7c2 --> Mover (1 carta) de columna 7 a columna 2
c73c2 --> Mover (3 cartas) de columna 7 a columna 2
c711c2 --> mover (11 cartas) de columna 7 a columna 2
c3  --> voltear última carta carta en columna 3 (si está bocaabajo)

- para nota:
Que el menú tenga una opción "cambiar a modo analizador de códigos" y haya también un código "menu"
que permita cambiar entre modo nenú de opciones y modo analizador de códigos.


------------------------------------------------
v1.1.0
------------------------------------------------
### MODIFIED:
- Modificada la forma en que se muestra el tapete y las cartas por consola para simular un tablero

------------------------------------------------
v1.0.1
------------------------------------------------
### FIXED:
+ En la versión final del curso no hay nada que impida intentar mover una carta boca abajo del final de una columna a otro sitio, salvo que lo más
  probable es que la carta no sea apilable en destino. Modificado para no permitir coger una carta boca-abajo del final de una columna.

### MODIFIED:
+ En los arrays de cartas de cada mazo, no se están borrando las cartas del array al sacarlas. solo se modifica el índice (ultima)
  No es un problema, pero en PHP es sencillo y me gusta más agregar o quitar del final del array, de modo que lo modifico.

### ADDED:
+ Agregada forma de mover una sub-columna entera de cartas bocaarriba del final de una columna al final de otra.
  + Creada nueva clase auxiliar "Mano" que hereda de "Mazo" para apilarle las cartas que vamos a mover y pasarselas de ahí a la columna destino.
  + En el movimiento entre columnas, cuando hay más de una carta boca arriba al final de la columna origen, se pregunta cuántas cartas se quieren mover al destino.


------------------------------------------------
v1.0.0
------------------------------------------------

Esta es la versión PHP del código tal cual está en la entrega en JAVA que hace al final de la última clase
del curso de programacion orientada a objetos en.
https://escuela.it/cursos/programacion-orientada-a-objetos


Solo he corregido algunos bugs que hacían que no funcionase.

Versión mínima de PHP: 7.4

He dejado varios comentarios por el código, pero no para explicar el código en sí sino para explicar el porqué de algunas diferencias
que se encontrarán entre el código original en JAVA final del ejemplo del curso y este código en PHP.

Para ejecutarlo, descargalo en una carpeta de tu equipo.
Desde línea de comandos, ejecutar:
php Klondike.class.php

