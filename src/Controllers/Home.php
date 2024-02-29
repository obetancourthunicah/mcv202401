<?php

namespace Controllers;

use Dao\Pulseras\Pulsera;
use Views\Renderer;

class Home extends PublicController
{

    public function run(): void
    {
        Pulsera::createPulsera('PSR004', "Pulsera de Ojo de Venado", "cafe", 325.50);
        $viewData = [
            "nombre" => "Fulanito de Tal",
            "mensaje" => "Este es un bello dia para Estudiar.",
            "pulseras" => Pulsera::getAllPulseras()
        ];

        Renderer::render('home', $viewData);
    }
}
