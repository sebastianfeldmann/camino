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
 * Class DirectoryTest
 *
 * @package SebastianFeldmann\Camino
 */
class DirectoryTest extends TestCase
{
    /**
     * Tests Directory::getPath
     */
    public function testPathUnix(): void
    {
        $directory = new Directory('/foo/bar/baz');
        $this->assertEquals('/foo/bar/baz', $directory->getPath());
        $this->assertEquals(3, $directory->getDepth());
    }

    /**
     * Tests Directory::getPath
     */
    public function testPathWindows(): void
    {
        $directory = new Directory('c:\\foo\\bar\\baz');
        $this->assertEquals('c:\\foo\\bar\\baz', $directory->getPath());
        $this->assertEquals(3, $directory->getDepth());
    }

    /**
     * Tests Directory::getPath
     */
    public function testPathStream(): void
    {
        $directory = new Directory('stream://foo/bar/baz');
        $this->assertEquals('stream://foo/bar/baz', $directory->getPath());
        $this->assertEquals(3, $directory->getDepth());
    }

    /**
     * Tests Directory::getSegments
     */
    public function testGetSegments(): void
    {
        $this->assertCount(3, (new Directory('/foo/bar/baz'))->getSegments());
        $this->assertCount(2, (new Directory('/foo/bar'))->getSegments());
        $this->assertCount(1, (new Directory('/foo'))->getSegments());
        $this->assertCount(0, (new Directory('/'))->getSegments());
    }

    /**
     * Tests Directory::isSubDirectory
     */
    public function testIsSubdirectoryPositive(): void
    {
        $dir     = new Directory('/foo/bar/baz');
        $this->assertTrue($dir->isSubDirectoryOf(new Directory('/foo/bar')));
        $this->assertTrue($dir->isSubDirectoryOf(new Directory('/foo')));
        $this->assertTrue($dir->isSubDirectoryOf(new Directory('/')));
    }

    /**
     * Tests Directory::isSubDirectory
     */
    public function testIsSubdirectoryNegative(): void
    {
        $dir    = new Directory('/foo/bar');
        $this->assertFalse($dir->isSubDirectoryOf(new Directory('/foo/bar/baz')));
        $this->assertFalse($dir->isSubDirectoryOf(new Directory('/fiz')));
        $this->assertFalse($dir->isSubDirectoryOf(new Directory('/fiz/baz')));
    }

    /**
     * Tests Directory::getPathRelativeFrom
     */
    public function testGetPathRelativeFrom(): void
    {
        $dir    = new Directory('/foo/bar/baz');
        $parent = new Directory('/foo');
        $this->assertEquals('bar/baz', $dir->getRelativePathFrom($parent));
    }

    /**
     * Tests Directory::getPathRelativeFrom
     */
    public function testGetPathRelativeFromNoChild(): void
    {
        $this->expectException(Exception::class);
        $dir = new Directory('/foo/bar/baz');
        $dir->getRelativePathFrom(new Directory('/fiz'));
    }

    /**
     * Tests Directory::__toString
     */
    public function testToString(): void
    {
        $dir = new Directory('/foo/bar/baz');
        $this->assertEquals('/foo/bar/baz', (string) $dir);
    }

    /**
     * Tests Directory::create
     */
    public function testFactoryExists(): void
    {
        $dir = Directory::create(__DIR__);
        $this->assertEquals(__DIR__, $dir->getPath());
    }

    /**
     * Tests Directory::create
     */
    public function testFactoryDoesNotExists(): void
    {
        $this->expectException(\Exception::class);

        $dir = Directory::create('./foo');
        $this->assertEquals('should-not-be-tested', $dir->getPath());
    }


    /**
     * Tests Directory::create
     */
    public function testFactoryIsFile(): void
    {
        $this->expectException(\Exception::class);

        $dir = Directory::create(__FILE__);
        $this->assertEquals('should-not-be-tested', $dir->getPath());
    }
}
