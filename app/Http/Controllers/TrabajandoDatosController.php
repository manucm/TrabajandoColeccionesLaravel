<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrabajandoDatosController extends Controller
{
    public function macros() {
    	$coleccion = collect([
    		'perro'
    	]);

    	$result = $coleccion->ifAny(function($collection) {
    		$collection->map(function($item) {
    			return ucwords($item);
    		});
    	})->ifEmpty(function($collection) {
    		return 'coleccion vacia';
    	});
    	dd($result);
    }

    public function comparandoColecciones() {
    	$lastYear = [
    		3976.5,
    		2788.84,
    		2353.92,
    		3365.36
    	];

    	$thisYear = [
    		3461.77,
    		3665.17,
    		3210.53,
    		3529.07,
    	];

    	$diff = collect($thisYear)->zip(collect($lastYear))
    			 ->map(function($year) {
    			 	return $year[0] - $year[1];
    			 });

    	dd($diff);
    }

    public function lookupTable() {
    	$employees = [
    		[
    			'name' => 'John',
    			'department' => 'Sales',
    			'email' => 'john@example.com',
    			],
    			[
    			'name' => 'Jane',
    			'department' => 'Marketing',
    			'email' => 'jane@example.com',
    			],
    			[
    			'name' => 'Dave',
    			'department' => 'Marketing',
    			'email' => 'dave@example.com',
    			]
    		];

    		/*
		dd(collect([
			['john@example.com', 'John'],
			['dave@example.com', 'Dave'],
			['jane@example.com', 'Jane'],
			])->toAssoc()); 

    	$emailLookup = collect($employees)->reduce(function($emailLookup, $employee) {
    		 $emailLookup[$employee['email']] = $employee['name'];
    		 return $emailLookup;
    	}, []);*/

    	/*
    	$result = collect($employees)->map(function($item) {
    		return [
    			$item['email'], $item['name'],
    		];
    	})->toAssoc();*/
    	$result = collect($employees)->mapToAssoc(function($item) {
    		return [$item['email'], $item['name']];
    	});

    	dd($result);
    }

    public function contactos() {
    	$contacts = [
    	'names' => [
    		'Manuel',
    		'Estefania',
    		'Marian',
    	],
    	'ocupations' => [
    		'Developper',
    		'Doctor',
    		'Doctor'
    	],
    	'emails' => [
    		'manuel@example.com',
    		'estefania@example.com',
    		'marian@example.com',
    	],];

    	$arr = [
    		[1, 2, 3, 4],
    		[5, 6, 7, 8],
    		[9, 10, 11, 12],
    	];

    	dd(array_map(function(...$item) {
    		return $item;
    	}, ...$arr));

    	dd(collect($contacts)->transpose2()->map(function($contactData) {
    		return [
    			'name' => $contactData[0],
    			'ocupations' => $contactData[1],
    			'email' => $contactData[2],
    		];
    	}));
    }

    public function rangking() {
    	$scores = collect([
		    ['score' => 76, 'team' => 'A'],
		    ['score' => 62, 'team' => 'B'],
		    ['score' => 82, 'team' => 'C'],
		    ['score' => 86, 'team' => 'D'],
		    ['score' => 91, 'team' => 'E'],
		    ['score' => 67, 'team' => 'F'],
		    ['score' => 67, 'team' => 'G'],
		    ['score' => 82, 'team' => 'H'],
		]);

		$result = $scores->sortByDesc('score')
						 ->values()
						 ->zip(collect(range(1,$scores->count())))
						 ->map(function($item) {
						 	list($score, $rank) = $item;
						 	return array_merge($score, ['rank' => $rank]);
						})->groupBy('score')->map(function($item) {
							$lowRank = $item->pluck('rank')->min();
							$item = $item->map(function($rankScore) use ($lowRank) {
								return array_merge($rankScore, [
									'rank' => $lowRank,
								]);
							});
							return $item;
						})->collapse();



		dd($result);
    }
}
