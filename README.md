[![Latest Stable Version](https://poser.pugx.org/sebastianfeldmann/camino/v/stable.svg?v=1)](https://packagist.org/packages/sebastianfeldmann/camino)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg)](https://php.net/)
[![Downloads](https://img.shields.io/packagist/dt/sebastianfeldmann/camino.svg?v1)](https://packagist.org/packages/sebastianfeldmann/camino)
[![License](https://poser.pugx.org/sebastianfeldmann/camino/license.svg?v=1)](https://packagist.org/packages/sebastianfeldmann/camino)
[![Build Status](https://github.com/sebastianfeldmann/camino/workflows/Continuous%20Integration/badge.svg)](https://github.com/sebastianfeldmann/camino/actions)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sebastianfeldmann/camino/badges/quality-score.png?b=master&v=1)](https://scrutinizer-ci.com/g/sebastianfeldmann/camino/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/sebastianfeldmann/camino/badges/coverage.png?b=master&v=1)](https://scrutinizer-ci.com/g/sebastianfeldmann/camino/?branch=master)


# Camino
File system path handling the OO way

## Installation

    composer install sebastianfeldmann/camino

## Usage

```php
<?php

use SebastianFeldmann\Camino;

$file = Camino\Path\File::create(__FILE__);
$dir  = Camino\Path\Directory::create(__DIR__);

if ($file->isInDirectory($dir)) {
    echo 'file is located inside the directory';
}

```
