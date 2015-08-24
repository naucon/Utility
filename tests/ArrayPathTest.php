<?php
/*
 * Copyright 2015 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Utility\Tests;

use Naucon\Utility\ArrayPath;

class ArrayPathTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return      ArrayPath
     */
    public function testGet()
    {
        $array = array();
        $array['setting']['database']['name'] = 'tipp';
        $array['setting']['database']['user'] = 'user';
        $array['setting']['database']['pass'] = 'pw';
        $array['setting']['template']['file'] = 'framework.html';

        $arrayPathObject = new ArrayPath($array);

        $this->assertInternalType('array', $arrayPathObject->get());
        $this->assertEquals(1, count($arrayPathObject->get()));

        $this->assertInternalType('array', $arrayPathObject->get('setting.database'));
        $this->assertEquals(3, count($arrayPathObject->get('setting.database')));

        $this->assertInternalType('array', $arrayPathObject->get('setting.template'));
        $this->assertEquals(1, count($arrayPathObject->get('setting.template')));

        $this->assertEquals('pw', $arrayPathObject->get('setting.database.pass'));
        $this->assertEquals('framework.html', $arrayPathObject->get('setting.template.file'));

        return $arrayPathObject;
    }

    /**
     * @return      ArrayPath
     */
    public function testHas()
    {
        $array = array();
        $array['setting']['database']['name'] = 'tipp';
        $array['setting']['database']['user'] = 'user';
        $array['setting']['database']['pass'] = 'pw';
        $array['setting']['template']['file'] = 'framework.html';

        $arrayPathObject = new ArrayPath($array);

        $this->assertTrue($arrayPathObject->has('setting.database'));
        $this->assertTrue($arrayPathObject->has('setting.template'));
        $this->assertTrue($arrayPathObject->has('setting.database.pass'));
        $this->assertTrue($arrayPathObject->has('setting.template.file'));
        $this->assertFalse($arrayPathObject->has('setting.template.driver'));

        return $arrayPathObject;
    }

    /**
     * @depends     testGet
     * @param       ArrayPath
     * @return      void
     */
    public function testSet(ArrayPath $arrayPathObject)
    {
        $arrayPathObject->set('setting.template.title', 'Titel');
        $arrayPathObject->set('setting.database.pass', 'Kennwort');

        $this->assertEquals('Kennwort', $arrayPathObject->get('setting.database.pass'));
        $this->assertEquals('framework.html', $arrayPathObject->get('setting.template.file'));
        $this->assertEquals('Titel', $arrayPathObject->get('setting.template.title'));

        $this->assertInternalType('array', $arrayPathObject->get('setting.database'));
        $this->assertEquals(3, count($arrayPathObject->get('setting.database')));

        $this->assertInternalType('array', $arrayPathObject->get('setting.template'));
        $this->assertEquals(2, count($arrayPathObject->get('setting.template')));
    }
}