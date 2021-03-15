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
        $array_rgb = [];

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

        array_push($array_rgb, $rAverage, $gAverage, $bAverage);

        print_r($array_rgb);
        echo "\n";
        print_r($request->input('image'));
        echo "\n";
        return 'IMAGEN RECIBIDA';
    }
}
