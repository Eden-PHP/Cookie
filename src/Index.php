<?php //-->
/**
 * This file is part of the Eden PHP Library.
 * (c) 2014-2016 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Eden\Cookie;

/**
 * General available methods for common cookie procedures.
 *
 * @vendor   Eden
 * @package  Cookie
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class Index extends Base implements \ArrayAccess, \Iterator
{
    /**
     * @const int INSTANCE Flag that designates singleton when using ::i()
     */
    const INSTANCE = 1;

    /**
     * Removes all cookies.
     *
     * @return Eden\Cookie\Index
     */
    public function clear()
    {
        foreach ($_COOKIE as $key => $value) {
            $this->remove($key);
        }

        return $this;
    }

    /**
     * Returns the current item
     * For Iterator interface
     *
     * @return void
     */
    public function current()
    {
        return current($_COOKIE);
    }

    /**
     * Returns data
     *
     * @param string|null $key The key to retreive
     *
     * @return mixed
     */
    public function get($key = null)
    {
        //argument 1 must be a string or null
        Argument::i()->test(1, 'string', 'null');

        if (is_null($key)) {
            return $_COOKIE;
        }

        if (isset($_COOKIE[$key])) {
            return $_COOKIE[$key];
        }

        return null;
    }

    /**
     * Returns th current position
     * For Iterator interface
     *
     * @return void
     */
    public function key()
    {
        return key($_COOKIE);
    }

    /**
     * Increases the position
     * For Iterator interface
     *
     * @return void
     */
    public function next()
    {
        next($_COOKIE);
    }

    /**
     * isset using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to test if exists
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        return isset($_COOKIE[$offset]);
    }

    /**
     * returns data using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to get
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        return isset($_COOKIE[$offset]) ? $_COOKIE[$offset] : null;
    }

    /**
     * Sets data using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to set
     * @param mixed             $value  The value the key should be set to
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        $this->set($offset, $value, strtotime('+10 years'));
    }

    /**
     * unsets using the ArrayAccess interface
     *
     * @param *scalar|null|bool $offset The key to unset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        //argument 1 must be scalar, null or bool
        Argument::i()->test(1, 'scalar', 'null', 'bool');

        $this->remove($offset);
    }

    /**
     * Removes a cookie.
     *
     * @param *string $name The cookie name
     *
     * @return Eden\Cookie\Index
     */
    public function remove($name)
    {
        //argument 1 must be a string
        Argument::i()->test(1, 'string');

        $this->set($name, null, time() - 3600);

        unset($_COOKIE[$name]);

        return $this;
    }

    /**
     * Rewinds the position
     * For Iterator interface
     *
     * @return void
     */
    public function rewind()
    {
        reset($_COOKIE);
    }

    /**
     * Sets a cookie.
     *
     * @param *string     $key      Cookie name
     * @param scalar      $data     The data
     * @param int         $expires  Expiration
     * @param string      $path     Path to make the cookie available
     * @param string|null $domain   The domain
     * @param bool        $secure   Use secure cookie
     * @param bool        $httponly Make it only available on http://
     *
     * @return Eden\Cookie\Index
     */
    public function set(
        $key,
        $data = null,
        $expires = 0,
        $path = null,
        $domain = null,
        $secure = false,
        $httponly = false
    ) {
        //argument test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string,numeric or null
            ->test(2, 'string', 'numeric', 'null')
            //argument 3 must be a integer
            ->test(3, 'int')
            //argument 4 must be a string or null
            ->test(4, 'string', 'null')
            //argument 5 must be a string or null
            ->test(5, 'string', 'null')
            //argument 6 must be a boolean
            ->test(6, 'bool')
            //argument 7 must be a boolean
            ->test(7, 'bool');

        $_COOKIE[$key] = $data;

        setcookie($key, $data, $expires, $path, $domain, $secure, $httponly);

        return $this;
    }

    /**
     * Sets a set of cookies.
     *
     * @param scalar      $data     The list of cookie data
     * @param int         $expires  Expiration
     * @param string      $path     Path to make the cookie available
     * @param string|null $domain   The domain
     * @param bool        $secure   Use secure cookie
     * @param bool        $httponly Make it only available on http://
     *
     * @return Eden\Cookie\Index
     */
    public function setData(
        array $data,
        $expires = 0,
        $path = null,
        $domain = null,
        $secure = false,
        $httponly = false
    ) {
        //argment test
        Argument::i()
            //argument 2 must be a integer
            ->test(2, 'int')
            //argument 3 must be a string or null
            ->test(3, 'string', 'null')
            //argument 4 must be a string or null
            ->test(4, 'string', 'null')
            //argument 5 must be a boolean
            ->test(5, 'bool')
            //argument 6 must be a boolean
            ->test(6, 'bool');

        foreach ($data as $key => $value) {
            $this->set($key, $value, $expires, $path, $domain, $secure, $httponly);
        }

        return $this;
    }

    /**
     * Sets a secure cookie.
     *
     * @param *string     $key      Cookie name
     * @param scalar      $data     The data
     * @param int         $expires  Expiration
     * @param string      $path     Path to make the cookie available
     * @param string|null $domain   The domain
     *
     * @return Eden\Cookie\Index
     */
    public function setSecure($key, $data = null, $expires = 0, $path = null, $domain = null)
    {
        //argment test
        Argument::i()
            //argument 1 must be a string
            ->test(1, 'string')
            //argument 2 must be a string,numeric or null
            ->test(2, 'string', 'numeric', 'null')
            //argument 3 must be a integer
            ->test(3, 'int')
            //argument 4 must be a string or null
            ->test(4, 'string', 'null')
            //argument 5 must be a string or null
            ->test(5, 'string', 'null');

        return $this->set($key, $data, $expires, $path, $domain, true, false);
    }

    /**
     * Sets a set of secure cookies.
     *
     * @param scalar      $data     The list of cookie data
     * @param int         $expires  Expiration
     * @param string      $path     Path to make the cookie available
     * @param string|null $domain   The domain
     *
     * @return Eden\Cookie\Index
     */
    public function setSecureData(array $data, $expires = 0, $path = null, $domain = null)
    {
        //argment test
        Argument::i()
            //argument 2 must be a integer
            ->test(2, 'int')
            //argument 3 must be a string or null
            ->test(3, 'string', 'null')
            //argument 4 must be a string or null
            ->test(4, 'string', 'null');

        $this->setData($data, $expires, $path, $domain, true, false);
        return $this;
    }

    /**
     * Validates whether if the index is set
     * For Iterator interface
     *
     * @return bool
     */
    public function valid()
    {
        return isset($_COOKIE[$this->key()]);
    }
}
