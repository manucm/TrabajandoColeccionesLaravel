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
/*
		$url = 'http://shopicruit.myshopify.com/products.json'; dd(json_decode(file_get_contents($url), true));
		$events = $this->lFileGetContext($url);

		dd($events); */

		$coleccion = collect($this->products);        

        $coleccion = $coleccion->filter(function($item) {
            return collect(['Wallet', 'Lamp'])->contains($item['product_type']);
        })

        /*->map(function($item) {
            return $item['variants'];
        })->flatten(1)->sum('price');*/

        ->flatMap(function($item) {
            return $item['variants'];
        })->pluck('title'); //->sum('price');

dd($coleccion);




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

    private function buildUrlContext($url) {
    	$url = 'https://api.github.com/users/manuelprg/events';
    	$opts = [
        'http' => [
                'method' => 'GET',
                'header' => [
                        'User-Agent: PHP'
                ]
        	]
		];
		return stream_context_create($opts);
    }

    private function lFileGetContext($url) {
    	$context = $this->buildUrlContext($url);
    	
		return file_get_contents($url, false, $context);
    }

    public function github() {

    	$eventScores = [
		    'PushEvent' => 5,
		    'CreateEvent' => 4,
		    'IssuesEvent' => 3,
		    'CommitCommentEvent' => 2,
		];

    	$url = 'https://api.github.com/users/manuelprg/events';
    	$events = $this->lFileGetContext($url);
    	$events = collect(json_decode($events, true))
    					->pluck('type')->merge(['sorry'])
    					->map(function($type) {
    						return collect(['PushEvent' => 5,
									    'CreateEvent' => 4,
									    'IssuesEvent' => 3,
									    'CommitCommentEvent' => 2,
									    ])
									    
									->get($type, 1);
    					});
    	dd($events);
    }

    public function rememorando() {
        $shift = [
            'Shipping_Steve_A7',
            'Sales_B9',
            'Support_Tara_K11',
            'J15',
            'Warehose_B2',
            'Shipping_Dave_A6',
        ];

        $coleccion = collect($shift);

        $coleccion = $coleccion->map(function($item) {
            return collect(explode('_', $item))->last();
        });

        dd($coleccion);
    }
}
