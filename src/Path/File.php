<?php
/**
 * This file is part of Camino.
 *
 * (c) Sebastian Feldmann <sf@sebastian-feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianFeldmann\Camino\Path;

/**
 * Class File
 *
 * @package SebastianFeldmann\Camino
 */
final class File extends Base
{
    /**
     * Returns a directory instance of its location
     *
     * @return \SebastianFeldmann\Camino\Path\Directory
     */
    public function getDirectory(): Directory
    {
        return new Directory(dirname($this->raw));
    }

    /**
     * Is the file located in a given directory
     *
     * @param  \SebastianFeldmann\Camino\Path\Directory $directory
     * @return bool
     */
    public function isInDirectory(Directory $directory): bool
    {
        return $this->isChildOf($directory);
    }
}
