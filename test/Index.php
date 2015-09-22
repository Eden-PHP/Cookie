<?php //-->
/*
 * This file is part of the Persistent package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */
class EdenCookieIndexTest extends \PHPUnit_Framework_TestCase
{
    public function testClear() 
    {
        $key        = 'key';
        $data       = 'user';
        $expires    = time()+60;
        $path       = null;
        $domain     = 'http://openovate.com';
        $secure     = false;
        $httponly   = false;
        $class      = eden('cookie')
            ->set($key, $data, $expires, $path, $domain, $secure, $httponly);

        $this->assertInstanceOf('Eden\\Cookie\\Index', $class->clear());
        $this->assertEmpty($class->get());
    }

    public function testGet() 
    {
        $key        = 'key';
        $data       = 'user';
        $expires    = time()+60;
        $path       = null;
        $domain     = 'http://openovate.com';
        $secure     = false;
        $httponly   = false;
        $class      = eden('cookie')
            ->set($key, $data, $expires, $path, $domain, $secure, $httponly);

        $this->assertNotEmpty($class->get());
    }

    public function testRemove()
    {
        $key        = 'key';
        $data       = 'user';
        $expires    = time()+60;
        $path       = null;
        $domain     = 'http://openovate.com';
        $secure     = false;
        $httponly   = false;
        $class      = eden('cookie')
            ->set($key, $data, $expires, $path, $domain, $secure, $httponly)
            ->remove($key);

        $this->assertInstanceOf('Eden\\Cookie\\Index', $class);
        $this->assertArrayNotHasKey($key, $class->get());
    }

    public function testSet()
    {
        $key        = 'key';
        $data       = 'user';
        $expires    = time()+60;
        $path       = null;
        $domain     = 'http://openovate.com';
        $secure     = false;
        $httponly   = false;
        $class = eden('cookie')
            ->set($key, $data, $expires, $path, $domain, $secure, $httponly);

        $this->assertInstanceOf('Eden\\Cookie\\Index', $class);
        $this->assertArrayHasKey($key, $class->get());
    }

    public function testSetData()
    {
        $data       = array('name' => 'juan', 'surname' => 'dela cruz');
        $expires    = time()+60;
        $path       = null;
        $domain     = 'http://openovate.com';
        $secure     = false;
        $httponly   = false;
        $class      = eden('cookie')
            ->setData($data, $expires, $path, $domain, $secure, $httponly);

        $this->assertInstanceOf('Eden\\Cookie\\Index', $class);
        foreach ($data as $key => $value) {
            $this->assertArrayHasKey($key, $class->get());
        }
    }

    public function testSetSecure()
    {
        $key        = 'key';
        $data       = 'user';
        $expires    = time()+60;
        $path       = null;
        $domain     = 'http://openovate.com';
        $class = eden('cookie')->clear()
            ->setSecure($key, $data, $expires, $path, $domain);

        $this->assertInstanceOf('Eden\\Cookie\\Index', $class);
        $this->assertArrayHasKey($key, $class->get());
    }

    public function testSetSecureData()
    {
        $data       = array('name' => 'juan', 'surname' => 'dela cruz');
        $expires    = time()+60;
        $path       = null;
        $domain     = 'http://openovate.com';

        $class = eden('cookie')->clear()
            ->setSecureData($data, $expires, $path, $domain);

        $this->assertInstanceOf('Eden\\Cookie\\Index', $class);
        foreach ($data as $key => $value) {
            $this->assertArrayHasKey($key, $class->get());
        }
    }

    public function testArrayAccess()
    {
        $data       = array('name' => 'Juan', 'surname' => 'dela cruz');
        $expires    = time()+60;
        $path       = null;
        $domain     = 'http://openovate.com';
        $secure     = false;
        $httponly   = false;
        $class      = eden('cookie')
            ->setData($data, $expires, $path, $domain, $secure, $httponly);

        $this->assertTrue(isset($class['name']));

        $this->assertEquals('Juan', $class['name']);
    }

    public function testIterable()
    {
        $data       = array('name' => 'Juan', 'surname' => 'dela cruz');
        $expires    = time()+60;
        $path       = null;
        $domain     = 'http://openovate.com';
        $secure     = false;
        $httponly   = false;
        $class      = eden('cookie')
            ->setData($data, $expires, $path, $domain, $secure, $httponly);

        foreach($class as $key => $value) {
            $this->assertEquals($class->current(), $data[$key]);
        }
    }
}