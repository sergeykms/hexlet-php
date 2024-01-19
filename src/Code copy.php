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
	  
function findFile($tree, $subst, $pathDir) {
	if(isFile($tree)) {
		if(str_contains(getName($tree), $subst)) {
			return $pathDir;
		} 
		return null;
	}

	$children = getChildren($tree);
	$resultFile = array_map(function($items) use ($subst, $pathDir) {
		return findFile($items, $subst, $pathDir = $pathDir . "/" . getName($items));
	}, $children) ; 
	return array_flatten($resultFile);
}

function findFilesByName($tree, $subst) {
	return findFile($tree, $subst, '');
}

function code() {	 
	$tree = mkdir('/', [
		mkdir('etc', [
			mkdir('apache'),
			mkdir('nginx', [
				mkfile('nginx.conf', ['size' => 800]),
			]),
			mkdir('consul', [
				mkfile('config.json', ['size' => 1200]),
				mkfile('data', ['size' => 8200]),
				mkfile('raft', ['size' => 80]),
			]),
		]),
		mkfile('hosts', ['size' => 3500]),
		mkfile('resolve', ['size' => 1000]),
	]);

	return findFilesByName($tree, 'co');
}
