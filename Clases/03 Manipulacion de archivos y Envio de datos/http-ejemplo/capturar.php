<?php

// ABRIR EL POSTMAN Y HACER POST PUT DELETE GET
// PROBAR TODOS LOS VERBOS HTTP

// NOTA: 000WEBHOSTING NO MANEJA, EN SU VERSION FREE ACCOUNT,
// LOS VERBOS PUT Y DELETE. (SI LA VERSION PREMIUM).

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    echo "esto viene por POST";
}
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    echo "esto viene por GET";
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    echo "esto viene por PUT";
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
    echo "esto viene por DELETE";
}

?>