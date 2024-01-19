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
	  
function findEmptyDirPaths($tree, $depth, $pathDir) {
	$children = getChildren($tree);
	if(count(getChildren($tree)) === 0 && $depth <= 2) {
		return $pathDir;
	}

	$filteredDirectory = array_filter($children, fn($items) => !isFile($items));

	$emtyDirectory = array_map(function($items) use ($depth, $pathDir) {
		return findEmptyDirPaths($items, $depth + 1, $pathDir = $pathDir . "/" . getName($items));
	}, $filteredDirectory) ; 
	return array_flatten($emtyDirectory);
}
  
function code() {	 
	$tree = mkdir('/', [
		mkdir('etc', [
		  mkdir('apache'),
		  mkdir('nginx', [
			mkfile('nginx.conf'),
		  ]),
		  mkdir('consul', [
			mkfile('config.json'),
			mkdir('data'),
		  ]),
		]),
		mkdir('logs'),
		mkfile('hosts'),
	]);

	return findEmptyDirPaths($tree, 0, '');
}
