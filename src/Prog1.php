<?php

namespace HexletPhp\src\Code;

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isDirectory;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getMeta;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\isFile;


function getCountFile($tree)
{
  if (isFile($tree)) {
		return 1;
  };
  $children = getChildren($tree);
  return array_reduce($children, fn($acc, $child) => $acc + getCountFile($child));
}

function getCountDir($tree) {
	$children = getChildren($tree);
	$countDir = array_filter($children, fn($child) => isDirectory($child));

	$countFile = array_map(fn($items) => [getName($items), getCountFile($items)], $countDir);

	return $countFile;
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

	return getCountDir($tree);
}
