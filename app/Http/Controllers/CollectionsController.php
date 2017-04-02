<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clases\Collection as MyCollection;

class CollectionsController extends Controller
{
	protected $arrayDatos = [
		[
			'nombre' => 'nombre1',
			'email' => 'mail1@hotmail.com'
		],

		[
			'nombre' => 'nombre2',
			'email' => 'mail2@hotmail.com'
		],

		[
			'nombre' => 'nombre3',
			'email' => 'mail3@hotmail.com'
		],
	];

	protected $productos = [
		[
			'nombre' => 'lucky stricke',
			'email' => 'mail1@hotmail.com',
			'precio' => 2.35
		],

		[
			'nombre' => 'ducados',
			'email' => 'mail2@hotmail.com',
			'precio' => 2
		],

		[
			'nombre' => 'fortuna',
			'email' => 'mail3@hotmail.com',
			'precio' => 2.4
		],
	];

	protected $carrito = [
		[
			'items' => 4,
			'precio' => 4.25,
		],

		[
			'items' => 2,
			'precio' => 2.55,
		],
		[
			'items' => 1,
			'precio' => 6.0,
		],
		[
			'items' => 10,
			'precio' => 0.25,
		],
	];

	/**
	* Funciones controladoras
	*/
    public function collections1() {
    	$resultadoFinal = $this->map($this->arrayDatos, 
    		function ($variable) {
    			return $variable['email'];
    		});
    	return dd($resultadoFinal);
    }

    public function collections2() {
    	$resultadoFinal = $this->filter($this->productos, function($producto) {
    		return $producto['precio'] > 2.0;
    	});

    	return dd($resultadoFinal);
    }

    public function collections3() {
    	$resultadoFinal = $this->reduce($this->carrito, function($acc, $item) {
    		return $acc + $item['precio']*$item['items'];
    	}, 0);

		return dd('El resultado final es: ' . $resultadoFinal);
    }

    public function collections4() {
    	$resultadoFinal = $this->reduce($this->productos, function($acc, $item) {
    		return $acc . $item['nombre'] . ' ';
    	}, '');

		return dd($resultadoFinal);
    }

    public function collections5() {
    	$result = array_map(function($item) {
    		return ucwords($item['nombre']);
    	}, $this->productos);

    	dd($result);
    }

    public function collections6() {
    	$coleccion = new MyCollection($this->productos);

    	$resultado = $coleccion->map(function($item) {
    		return ucwords($item['nombre']);
    	});

    	$resultado = $coleccion->filter(function ($item) {
    		return $item['nombre'] != 'ducados';
    	})->count();


    	dd($resultado);
    }

    //funcion que pasa a mayusucla la primera letra de cada palabra
    public function primeraMay($item) {
    	return ucwords($item['nombre']);
    }

    /**
    * Resto de funciones del controlador
    */
    public function map($items, $func) {
    	$results = [];

    	foreach ($items as $item) {
    		$results[] = $func($item);
    	}
    	return $results;
    }

    public function filter($items, $func) {
    	$results = [];

    	foreach ($items as $item) {
    		if ($func($item)) $results[] = $item;
    	}
    	return $results;
    }

    public function reduce($items, $callback, $initial)
    {
    	$acumulador = $initial;

    	foreach ($items as $item) {
    		$acumulador = $callback($acumulador, $item);
    	}
    	return $acumulador;
    }
    /*
    * Métodos que tenemos para colecciones
    * each: para cada item de una colección produzca una acción
    * map: transformación de una colección
    * filter: filtrar la colección
    * reduce: obtener algo más pequeño a partir de una colección (como por ejemplo un resultado)
    */
}
