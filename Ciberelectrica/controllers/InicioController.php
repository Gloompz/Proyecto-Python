<?php


class InicioController
{
    // Vista de ingreso
    public function Index()
    {
        require_once __DIR__ . '/../views/ingreso.php';
    }


    // Vista menú principal
    public function MenuPrincipal()
    {
        require_once __DIR__ . '/../views/menuprincipal.php';
    }
}
