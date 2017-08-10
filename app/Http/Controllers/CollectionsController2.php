<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CollectionsController2 extends 
Controller
{
	protected $items = [
		['nombre' => 'John Ham',
		'actors' => [
			'Donald Draper'
		],
		'sueldo' => 200000
		],

		['nombre' => 'Leonardo Di Caprio',
		'actors' => [
			'Jordan Belfort',
			'John Cop'
		],
		'sueldo' => 783000
		],

		['nombre' => 'Mathew McCaugney',
		'actors' => [
			'Copper',
			'Mark Hanna'
		],
		'sueldo' => 180000
		],

		['nombre' => 'Christian Bale',
		'actors' => [
			'American Psycho'
		],
		'sueldo' => 340000
		],

	];

		
    public function collections() {
    	//$collection = Collection::make($this->items);
    	//$collection = new Collection($this->items);
    	return collect($this->items);
    }

    public function metodos($metodo) {

    	$coleccion = $this->collections();
    	$valores = collect([2, 3, 5, 1, 7, 9]);
    	$texto = collect(['mail.com', 'maxi@hotmail.com', 'bromas@hotmail.com']);

    	switch ($metodo) {
    		case 'reject':
    			$resultado = $coleccion->reject(function($item) {
    				return $item['sueldo'] < 250000;
    			});
    			break;
    		case 'reduce' : 
    			$resultado = $valores->reduce(function($carry, $item) {
    				return $carry + $item;
    			}, 3);
    			break;

    		case 'reduceTexto':
    			$resultado = $texto->reduce(function($acc, $item) use ($texto) {
    				if ($texto->last() == $item)
    					return $acc . $item;
    				else
    					return $acc  . $item . ', ';
    			}, '');
    			break;
    		case 'suma':
    			$resultado = $valores->sum(); break;
    		case 'sumaArray':
    			$resultado = $coleccion->sum('sueldo');
    		
    		default:
    			# code...
    			break;
    	}

    	dd($resultado);
    	return $resultado;
    }
}
