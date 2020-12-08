<?php

/**
 * This file is part of camino.
 *
 * (c) Sebastian Feldmann <sf@sebastian-feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianFeldmann\Camino;

use PHPUnit\Framework\TestCase;

/**
 * Class CheckTest
 *
 * @package SebastianFeldmann\Camino
 */
class CheckTest extends TestCase
{
    /**
     * Tests Check::isAbsolutePath
     */
    public function testIsAbsolutePathTrue()
    {
        $this->assertTrue(Check::isAbsolutePath('/foo/bar'));
    }

    /**
     * Tests Check::isAbsolutePath
     */
    public function testIsRelativePathNotBeingAbsolute()
    {
        $this->assertFalse(Check::isAbsolutePath('../foo/bar'));
    }

    /**
     * Tests Check::isAbsolutePath
     */
    public function testIsAbsolutePathStream()
    {
        $this->assertTrue(Check::isAbsolutePath('php://foo/bar'));
    }

    /**
     * Tests Check::isAbsolutePathWindows
     *
     * @dataProvider providerWindowsPaths
     *
     * @param string  $path
     * @param boolean $expected
     */
    public function testIsAbsolutePathWindows($path, $expected)
    {
        $this->assertEquals($expected, Check::isAbsolutePath($path));
    }

    /**
     * Data provider testIsAbsolutePathWindows.
     *
     * @return array
     */
    public function providerWindowsPaths()
    {
        return [
            ['C:\foo', true],
            ['\\foo\\bar', true],
            ['..\\foo', false],
        ];
    }
}
