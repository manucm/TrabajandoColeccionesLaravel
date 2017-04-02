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
    	$collection = collect($this->items);
    	dd($collection);
    }
}
