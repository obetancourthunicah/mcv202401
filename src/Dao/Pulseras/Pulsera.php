<?php

namespace Dao\Pulseras;

use Dao\Table;

class Pulsera extends Table
{
    public static function getAllPulseras()
    {
        $sqlstr = "SELECT * from pulseras;";

        return self::obtenerRegistros($sqlstr, []);
    }
    public static function createPulsera($sku, $nombre, $color, $precio)
    {
        $inssql = "INSERT INTO pulseras(sku, nombre, precio, colorDominante) 
        VALUES (:sku, :nombre, :precio, :colorDominante);";
        $params = [
            "sku" => $sku,
            "nombre" => $nombre,
            "precio" => $precio,
            "colorDominante" => $color
        ];
        return self::executeNonQuery($inssql, $params);
    }
}
