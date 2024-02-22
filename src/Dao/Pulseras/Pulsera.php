<?php

namespace Dao\Pulseras;

class Pulsera
{
    public static function getAllPulseras()
    {
        return [
            [
                "sku" => "PLS001",
                "nombre" => "Pulsera Lenca de hilo en nudos",
                "precio" => 100.0,
                "colorDominante" => "negro",
            ],
            [
                "sku" => "PLS002",
                "nombre" => "Pulsera Pech de junco en nudos",
                "precio" => 150.0,
                "colorDominante" => "marron",
            ],
            [
                "sku" => "PLS003",
                "nombre" => "Pulsera Garifuna de palma en nudos",
                "precio" => 130.0,
                "colorDominante" => "verde",
            ],
        ];
    }
}
