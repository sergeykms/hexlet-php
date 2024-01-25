<?php

namespace HexletPhp\src\Code;
	  

function makeList($node) {
	if(!is_array($node[0])) {
		$dict[$node[0]] = [];
		if (count($node) > 1) {
			foreach($node[1] as $items) {
				$dict[$node[0]][] = $items[0];
			}
		} 
		return $dict;
	}

}
function make_list($tree) {
	
	$temp = makeList($tree);
	print_r($temp);
	$new = array_map(function($items)
	{
		if (is_array($items)) 
		{
			return makeList($items);
		}

	}, $tree);
	// return makeList($tree);
	// print_r($temp);
	// print_r($dict);

	// return $new;
}

function code() {	
	$tree = ['Moscow', [
		['Smolensk'],
		['Yaroslavl'],
		['Voronezh', [
		  ['Liski'],
		  ['Boguchar'],
		  ['Kursk', [
			['Belgorod', [
			  ['Borisovka'],
			]],
			['Kurchatov'],
		  ]],
		]],
		['Ivanovo', [
		  ['Kostroma'], ['Kineshma'],
		]],
		['Vladimir'],
		['Tver', [
		  ['Klin'], ['Dubna'], ['Rzhev'],
		]],
	  ]];

	return make_list($tree);
}
