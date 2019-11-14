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
 * Class Directory
 *
 * @package SebastianFeldmann\Camino
 */
final class Directory extends Base
{
    /**
     * Checks if the directory is a sub directory of a given directory
     *
     * @param  \SebastianFeldmann\Camino\Path\Directory $parent
     * @return bool
     */
    public function isSubDirectoryOf(Directory $parent): bool
    {
        return $this->isChildOf($parent);
    }
}
