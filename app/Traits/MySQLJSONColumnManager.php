<?php

namespace App\Traits;

use App\Managers\MySQLJSONColumnManager as BaseManager;

/*
$user = App\User::find(1);

$user->options()->add('key', 'value');
$user->options()->add(['key1' => 'value1', 'key2' => 'value2']);
$user->options()->update('key', 'value');
$user->options()->update(['key1' => 'value1', 'key2' => 'value2']);
$user->options()->delete('key');
$user->options()->delete(['key1', 'key2']);
$user->options()->get('key');
$user->options()->key;
$user->options()->all();
*/



trait MySQLJSONColumnManager
{
    public function __call($method, $arguments)
    {
        if (
            property_exists($this, 'casts') &&
            array_key_exists($method, $this->casts) &&
            in_array($this->casts[$method], ['array', 'json'])
        ) {
            return new BaseManager($this, $method);
        }

        return parent::__call($method, $arguments);
    }
}
