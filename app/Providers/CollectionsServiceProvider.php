<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;

class CollectionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Collection::macro('ifEmpty', function($callback) {
            if ($this->isEmpty()) {
                $callback();
            }
            return $this;
        });

        Collection::macro('ifAny', function($callback) {
            if (!$this->isEmpty()) {
                $callback($this);
            }
            return $this;
        });

        Collection::macro('mapToAssoc', function($callback) {
            return $this->map($callback)->toAssoc();
        });

        Collection::macro('toAssoc', function() {
            return $this->reduce(function($assoc, $keyValuePair) {
                list($key, $value) = $keyValuePair;
                $assoc[$key] = $value;
                return $assoc;
            }, new static);
        });

        Collection::macro('transpose', function() {
            $items = array_map(function($item) {
                var_dump($item);
                return $item;
            }, $this->values()->toArray());
            dd($items);
            return new static($items);
        });

 
        Collection::macro('transpose2', function () {
            $items = array_map(function (...$items) {
                return $items;
            }, ...$this->values());
            return new static($items);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
