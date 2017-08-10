<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionsController3 extends Controller
{
    public function binaryToDecimal($binaryNumber) {

    	if (!$this->isBinary($binaryNumber)) 
    		return 'el numero es binario';
    	
    	$colums = collect(str_split($binaryNumber));

    	$decimalValue = $colums->reverse()
    					 ->values()
    				     ->map(function($item, $exponent) {
    						return pow(2, $exponent) * $item;
    					})->sum();

    	return $decimalValue;
    }

    private function isBinary($binaryNumber) {
    	return preg_match("/^1[01]*$|0$/", $binaryNumber);
    }
}
