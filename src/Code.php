<?php

namespace HexletPhp\src\Code;

use function Php\Immutable\Fs\Trees\trees\array_flatten;
use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isDirectory;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getMeta;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\isFile;
	  
function iter($keys, $arr) {

}

function stringify($arr)
{

	$lines = array_map(
		fn($key, $val) => "{$key}: {$iter($val, $depth + 1)}",
		array_keys($currentValue),
		$currentValue
	);



	// $result = array_map(function($items) {
	// 	if(is_array($items)) {
	// 		stringify($items);
	// 		// print(array_keys($items));
	// 		$keys =  array_keys($items);
	// 		return array_reduce($keys, function($acc, $item) use ($items) {
	// 			return array_merge($acc, [$item => $items[$item]]);
	// 			// return [$item => $items[$item]];
	// 		}, []);
	// 	} 

	// }, $arr);

	return $result;
    // $result = array_reduce($arr, function ($acc, $item) {
    //     // $key = key($item);
	// 	stringify($item);
    //     // $newValue = is_array($value) ? stringify($value) : $value;
	// 	// $acc = $acc . $item;
    //     // return key($item);
    // }, []);

    // return $result;
}


function code() {	
	$data = [
		'hello' => 'world',
		'is' => true,
		'nested' => ['count' => 5],
	];

	return stringify($data);
}
