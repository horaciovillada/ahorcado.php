<?php

function limpiarPantalla() {

    if (PHP_OS === "WINNT")
        system("cls");
    else
        system("clear");

}

function verificarLetras($palabra, $letra, $letrasDescubiertas) {

    $offset = 0;
    //strpos($cadena, $subcadena, $inicio);
    while ( ( $posicionLetra = strpos($palabra, $letra, $offset) ) !== false ) {

        $letrasDescubiertas[$posicionLetra] = $letra;
        $offset = $posicionLetra + 1;

    }

    return $letrasDescubiertas;
    
}

function imprimirLetraIncorrecta() {

    limpiarPantalla();
    $GLOBALS["intentos"]++;
    echo "Letra incorrecta 😾. Te quedan " . (MAX_INTENTOS - $GLOBALS["intentos"]) . " intentos.";
    sleep(2);

}

// Esta función muestra cómo se crea el hombre
function imprimirHombre() {

    global $intentos;
    
    switch ($intentos) {

        case 0:
            echo "
            +---+
            |   |
                |
                |
                |
                |
            =========
            ";
            break;
           
        case 1:
            echo "
            +---+
            |   |
            O   |
                |
                |
                |
            =========
            ";
            break;

        case 2:
            echo "
            +---+
            |   |
            O   |
            |   |
                |
                |
            =========
            ";
            break;

        case 3:
            echo "
            +---+
            |   |
            O   |
           /|   |
                |
                |
            =========
            ";
            break;

        case 4:
            echo "
            +---+
            |   |
            O   |
           /|\  |
                |
                |
            =========
            ";
            break;

        case 5:
            echo "
            +---+
            |   |
            O   |
           /|\  |
           /    |
                |
            =========
            ";
            break;

        case 6:
            echo "
            Me mataste we
            +---+
            |   |
            O   |
           /|\  |
           / \  |
                |
            =========
            ";
            break;

    }

    echo "\n\n";

}

function imprimirJuego() {

    global $longitudPalabra, $letrasDescubiertas;

    imprimirHombre();

    echo "Palabra de $longitudPalabra letras: \n\n";
    echo $letrasDescubiertas;
    echo "\n\n";

}

function finJuego() {

    global $intentos, $palabraElegida, $letrasDescubiertas;
    
    limpiarPantalla();

    if ($intentos < MAX_INTENTOS) {
        echo "¡Felicidades! Has adivinado la palabra. 😸 \n\n";
    }
    else {

        echo "Suerte para la próxima, amigo. 😿 \n\n";
        imprimirHombre();

    }

    echo "La palabra es: $palabraElegida\n";
    echo "Tú descubriste: $letrasDescubiertas";

}

$posiblesPalabras = ["Argentina", "Messi", "Diego", "Leo", "Pogramador", "Trabajo", "Curriculum", "Planta", "Agua", "Platzi"];
define("MAX_INTENTOS", 6);

echo "😼 ¡Juguemos al ahorcado! \n\n";

// Inicializamos el juego
$palabraElegida = $posiblesPalabras[ rand(0, 9) ];
$palabraElegida = strtolower($palabraElegida);
$longitudPalabra = strlen($palabraElegida);
$letrasDescubiertas = str_pad("", $longitudPalabra, "_");
$intentos = 0;

do {

    // Damos la bienvenida al jugador
    imprimirJuego();

    // Pedimos que escriba
    $letraJugador = readline("Escribe una letra: ");
    $letraJugador = strtolower($letraJugador);

    // Empezamos a validar
    if ( str_contains($palabraElegida, $letraJugador) ) {
        $letrasDescubiertas = verificarLetras($palabraElegida, $letraJugador, $letrasDescubiertas);
    }
    else {
        imprimirLetraIncorrecta();
    }

    limpiarPantalla();

} while($intentos < MAX_INTENTOS && $letrasDescubiertas != $palabraElegida);

finJuego();

echo "\n";
