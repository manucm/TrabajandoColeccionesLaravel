<?php 

namespace App\Clases;

class Collection implements \Countable
{
	protected $items;

	public function __construct($items) {
		$this->items = $items;
	}

	public function map($callback) { 
		return new static(array_map($callback, $this->items));
	}

	public function filter($callback) {
		return new static(array_filter($this->items, $callback));
	}

	public function toArray($callback) {
		return $this->items;
	}

	public function count() {
		return count($this->items);
	}
}