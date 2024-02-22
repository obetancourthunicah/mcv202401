<?php

namespace Controllers;

use Dao\Pulseras\Pulsera;
use Views\Renderer;

class Home extends PublicController
{

    public function run(): void
    {
        $viewData = [
            "nombre" => "Fulanito de Tal",
            "mensaje" => "Este es un bello dia para Estudiar.",
            "pulseras" => Pulsera::getAllPulseras()
        ];

        Renderer::render('home', $viewData);
    }
}
