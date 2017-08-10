<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clases\GitHubScore;
use Carbon\Carbon;

class ApisController extends Controller
{
	protected $url_github = 'https://api.github.com/users/{user}/events';

	protected $githubEventValues = [
		'PushEvent' => 5,
		'CreateEvent' => 4,
		'IssuesEvent' => 3,
		'CommitCommentEvent' => 2,
		'otherEvent' => 1,
	];


	 //'https://api.github.com/users/{your-username}/events'
    public function github($user = null) {

    	if (!$user)
    		return 'sin usuario';

    	$url = str_replace('{user}', $user, $this->url_github);

    	$context = $this->buildUrlContext();

    	$events = file_get_contents($url, false, $context);

    	$events = json_decode($events);

    	$events = collect($events)->map(function($item) {
    		$item->create_at = Carbon::parse($item->created_at)->format('d-m-Y');
    		return $item;
    	})->pluck('type');

    	dd($events);
    	return 'con usuario';
    }

    public function eventosGitHub($user) {

    	if (!$user)
    		return false;

    	$url = str_replace('{user}', $user, $this->url_github);

    	$context = $this->buildUrlContext();

    	$events = file_get_contents($url, false, $context);

    	return json_decode($events);

    }

    public function puntuacionTotal($user) {

    	return GitHubScore::forUser($user);

    	$eventos = $this->eventosGitHub($user);

    	if (!$eventos)
    		return 'No ha enviado usuario';
    	return collect($eventos)
    					->pluck('type')
    					->map(function($item) {

    						$eventScores = [
    							'PushEvent' => 5,
    							'CreateEvent' => 4,
    							'IssuesEvent' => 3,
    							'CommitCommentEvent' => 2
    						];
    						/*
    						if (!isset($eventScores[$item]))
    							return 1;
    						return $eventScores[$item]; */

    						//Solución más elegante
    						return collect($eventScores)->get($item, 1);
    						/**
    						* el metodo get, tiene dos parámetros
    						* item -> que es la key buscada
    						* el segundo es un valor por defecto que incluso puede ser una función de callback
    						*/
    					})->sum();
    }

    private function buildUrlContext() {
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

    public function formatter() {
    	$comments = [
    		'Opening brace must be the last content on the line',
    		'Closing brace must be on a line by itself',
    		'Each PHP statement must be on a line by itself',
    	];

    	return collect($comments)->map(function($item) {
    		return "- {$item}\n";
    	})->implode(' ');
    }

    public function funContains() {
    	$names = collect([
    			'Manolo',
    			'Estefania',
    			'Paolo',
    			'Nick',
    		]);

    	return (
    		$names->contains(function($name, $i) {
    			var_dump($i);
    			return strlen($i) > 2;
    		})

    	)? 'contiene' : 'no contiene';
    }

    public function getName() {
    	return $name = collect([
    		'Manolo',
    		'Alberto',
    		'Jeremias',
    		'Japon',
    		'Lu',
    	])->first(function($name) {
    		return strlen($name) < 2;
    	}, function() {
    		throw new \Exception("No hay nombre");
    	});
    }

    public function firstContains() {
    	$name = $this->getName();

    	return $name;
    }
}
