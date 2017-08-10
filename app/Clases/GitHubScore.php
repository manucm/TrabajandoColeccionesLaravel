<?php 

namespace App\Clases;

class GitHubScore
{
	protected $user;

	public function __construct($user) {
		$this->user = $user;
	}
	public static function forUser($user) {
		return (new self($user))->score();
	}

	public function score() {
		return $this->fetchEvents($this->user)
    					->pluck('type')
    					->map(function($typeEvent) {
    						return self::lookupScore($typeEvent);
    					})->sum();

    	
	}

	private function lookupScore($typeEvent) {
		return collect($eventScores = [
    							'PushEvent' => 5,
    							'CreateEvent' => 4,
    							'IssuesEvent' => 3,
    							'CommitCommentEvent' => 2
    						])->get($typeEvent, 1);
	}

	private function fetchEvents() {
		$url = "https://api.github.com/users/{$this->user}/events";

    	$context = $this->buildUrlContext();

    	$events = file_get_contents($url, false, $context);

    	return collect(json_decode($events));
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
}