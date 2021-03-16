<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getColor(Request $request)
    {
        $i = imagecreatefromjpeg($request->input('image'));
        $rTotal = 0;
        $gTotal = 0;
        $bTotal = 0;
        $total = 0;

        for ($x = 0; $x < imagesx($i); $x++) {
            for ($y = 0; $y < imagesy($i); $y++) {
                $rgb = imagecolorat($i, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $rTotal += $r;
                $gTotal += $g;
                $bTotal += $b;
                $total++;
            }
        }
        $rAverage = round($rTotal / $total);
        $gAverage = round($gTotal / $total);
        $bAverage = round($bTotal / $total);

        //CON ESTE 'array_rgb' SE OBTIENE EL COLOR EXACTO MÁS PREDOMINANTE
        $array_rgb = array('red' => $rAverage, 'green' => $gAverage, 'blue' => $bAverage);

        // - CON ESTE 'array_rgb' SE DEVUELVE EL COLOR MÁS PRÓXIMO A LA PALETA,
        //   PERO NO ME CONVENCE EL RESULTADO FINAL, POR LO QUE LO DEJO COMENTADO
        // $array_rgb = array($rAverage, $gAverage, $bAverage);
        // return $this->getNearestColor($array_rgb);

        return $array_rgb;
    }

    private function getNearestColor($colorRGB)
    {
        $colors = array(
            array(0, 255, 255),
            array(0, 0, 0),
            array(0, 0, 255),
            array(255, 0, 255),
            array(0, 0, 128),
            array(128, 128, 0),
            array(128, 0, 128),
            array(255, 0, 0),
            array(128, 128, 128),
            array(0, 128, 0),
            array(0, 255, 0),
            array(128, 0, 0),
            array(192, 192, 192),
            array(0, 128, 128),
            array(255, 255, 255),
            array(255, 255, 0)
        );

        $selectedColor = $colors[0];
        $deviation = PHP_INT_MAX;

        foreach ($colors as $color) {
            $curDev = $this->compareColors($colorRGB, $color);
            if ($curDev < $deviation) {
                $deviation = $curDev;
                $selectedColor = $color;
            }
        }
        return $selectedColor;
    }

    private function compareColors($colorA, $colorB)
    {
        return abs($colorA[0] - $colorB[0]) + abs($colorA[1] - $colorB[1]) + abs($colorA[2] - $colorB[2]);
    }
}
