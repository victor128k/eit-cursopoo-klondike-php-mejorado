
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
  - En el movimiento entre columnas, cuando hay más de una carta boca arriba al final de la columna origen, se pregunta cuántas cartas se quieren mover al destino.




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

