<?php

namespace HexletPhp\src\Code;
	  

function makeDictionary($tree, $dict, $parent) {
	$node = $tree[0];
	$children = $tree[1] ?? null;

	if (!$children) {
        $dict[$node] = [$parent];
        return $dict;
    }

	$neighbors = array_map(fn($child) => $child[0], $children);
	$neighbors[] = $parent;

    $newAcc = array_merge($dict, [$node => $neighbors]);

	return array_reduce($children, fn($iAcc, $child) => makeDictionary($child, $iAcc, $node), $newAcc);




}
function make_list($tree) {
	$joins = makeDictionary($tree, [], '');
	print_r($joins);
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
