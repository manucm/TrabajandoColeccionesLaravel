<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
	protected $products = [

    		[
    			'nombre' => 'nombre1',
    			'product_type' => 'Wallet',
    			'variants' => [
    			['title' => 'Blue',
    				'price' => 20.0
    				],
    				['title' => 'Yellow',
    				'price' => 35.23
    				],

    				
    			]
    		],
    		[
    			'nombre' => 'nombre2',
    			'product_type' => 'Lamp',
    			'variants' => [
    			[
    			'title' => 'Red',
    				'price' => 20.0
    			],
    			[
    			'title' => 'the first one',
    			'price' => 2.0
    			]
    				
    			]
    		],
    		[
    			'nombre' => 'nombre3',
    			'product_type' => 'Wallet',
    			'variants' => [
    			[
    			'title' => 'Red',
    				'price' => 20.0
    			]
    			]
    		],
    		[
    			'nombre' => 'nombre4',
    			'product_type' => 'Rubp',
    			'variants' => [
    				[
    			'title' => 'Red',
    				'price' => 20.0
    			]
    			]
    		],
    		[
    			'nombre' => 'nombre5',
    			'product_type' => 'Lamp',
    			'variants' => [
    				[
    			'title' => 'Red',
    				'price' => 20.0
    			]
    			]
    		],
    		[
    			'nombre' => 'nombre1',
    			'product_type' => 'Wallet',
    			'variants' => [
    				[
    			'title' => 'Red',
    				'price' => 20.0
    			]
    			]
    		],
    	];

	public function example() {

		$coleccion = collect($this->products);

		$total = $coleccion->filter(function($product) {
			return collect(['Wallet', 'Lamp'])->contains($product['product_type']);
		})->flatMap(function($product) {
			return $product['variants'];
		})->sum('price');

		dd($total);

		$total = $coleccion->filter(function($product) {
			return collect(['Wallet', 'Lamp'])->contains($product['product_type']);
		})->flatMap(function($product) {
			return $product['variants'];
		})->pluck('price')->sum();

		dd($total);

		$total = $coleccion->filter(function($product) {
			return collect(['Wallet', 'Lamp'])->contains($product['product_type']);
		})->flatMap(function($product) {
			return $product['variants'];
		})->map(function($variant) {
			return $variant['price'];
		})->sum();

		dd($total);

		dd($this->products);
		return 'asdf';
    }


    public function example2() {
    	$shifts = [
    		'Shipping_Steve_A7',
    		'Sales_B9',
    		'Support_Tara_K11',
    		'J15',
    		'Warehose_B2',
    		'Shipping_Dave_A6'
    	];


    	$shiftIds = collect($shifts)->map(function($shift) {
    		$parts = explode('_', $shift);
    		return collect($parts)->last();
    	});

    	dd($shiftIds);
    }

    public function binaryToDecimal() {
    	$binary = '11010';

    	$coleccion = collect(str_split($binary))
    						->reverse()
    						->values()
    						->map(function($column, $exponent) {
    							return $column * (2 ** $exponent);
    						})->sum();

    	dd($coleccion);
    }

    public function github() {
    	$url = 'https://api.github.com/users/manuelprg/events';
    	$events = json_decode(file_get_contents($url), true);
    	dd($events);
    }
}
