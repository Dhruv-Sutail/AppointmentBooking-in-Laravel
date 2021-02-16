<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Milon\Barcode\DNS2D;

class Barcode extends Model
{

    public static function generateBarcode($civil_id)
    {
        return DNS2D::getBarcodePNG($civil_id, "PDF417");
    }
}
