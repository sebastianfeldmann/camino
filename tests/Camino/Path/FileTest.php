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

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Class FileTest
 *
 * @package SebastianFeldmann\Camino
 */
class FileTest extends TestCase
{
    /**
     * Tests File::__construct
     */
    public function testRelativePathFail(): void
    {
        $this->expectException(Exception::class);

        $file = new File('bar.txt');
        $this->assertFalse(empty($file));
    }

    /**
     * Tests File::isInDirectory
     */
    public function testIsChildWithDifferentRoots(): void
    {
        $file = new File('C:\\foo\\bar.txt');
        $this->assertFalse($file->isInDirectory(new Directory('D:\\foo')));
    }

    /**
     * Tests File::getSegments
     */
    public function testGetSegments(): void
    {
        $this->assertCount(3, (new File('/foo/bar/baz.txt'))->getSegments());
        $this->assertCount(2, (new File('/foo/bar.txt'))->getSegments());
        $this->assertCount(1, (new File('/foo.txt'))->getSegments());
    }

    /**
     * Tests File::getPath
     */
    public function testGetDirectory(): void
    {
        $file = new File('/foo/bar/baz.txt');
        $this->assertEquals('/foo/bar', $file->getDirectory()->getPath());
    }

    /**
     * Tests File::getPath
     */
    public function testPathWindows(): void
    {
        $file = new File('c:\\foo\\bar\\baz');
        $this->assertEquals('c:\\foo\\bar\\baz', $file->getPath());
        $this->assertEquals(3, $file->getDepth());
    }

    /**
     * Tests File::isInDirectory
     */
    public function testIsInDirectory(): void
    {
        $file = new File('/foo/bar/baz.txt');
        $this->assertTrue($file->isInDirectory(new Directory('/foo')));
        $this->assertTrue($file->isInDirectory(new Directory('/foo/bar')));
        $this->assertFalse($file->isInDirectory(new Directory('/fiz')));
        $this->assertFalse($file->isInDirectory(new Directory('/foo/bar/buz')));
    }
}
