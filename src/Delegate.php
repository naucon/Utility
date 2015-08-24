<?php
/*
 * Copyright 2015 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Utility;

use Naucon\Utility\DelegateInterface;
use Naucon\Utility\Exception\DelegateException;

/**
 * Delegate Class
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * @example    DelegateExample.php
 */
class Delegate implements DelegateInterface
{
    /**
     * @var     object
     */
    protected $object = null;

    /**
     * @var     string                  methode name of object
     */
    protected $methodName = null;


    /**
     * Constructor
     *
     * @param       object              object
     * @param       string              methode name of object
     */
    public function __construct($object, $methodName)
    {
        if (is_object($object)) {
            $this->object = $object;

            if (is_string($methodName)) {
                if (method_exists($this->object, $methodName)) {
                    if (is_callable(array($this->object, $methodName))) {
                        $this->methodName = $methodName;
                    } else {
                        throw new DelegateException('give method "' . $methodName . '" is not accessable.', E_ERROR);
                    }
                } else {
                    throw new DelegateException('give object has no method "' . $methodName . '".', E_ERROR);
                }
            } else {
                throw new DelegateException('given arg2 is not a valid method name.', E_ERROR);
            }
        } else {
            throw new DelegateException('given arg1 is not a object.', E_ERROR);
        }
    }


    /**
     * @param       mixed           arg 1
     * @param       mixed           arg 2
     * @param       mixed           ...
     * @param       mixed           arg n
     * @return      mixed           result of delegation
     */
    public function invoke()
    {
        // gets all construtor arguments / parameters
        $args = func_get_args();

        if (count($args) > 0) {
            // callback with args
            return call_user_func_array(array($this->object, $this->methodName), $args);
        } else {
            // callback without args
            return call_user_func(array($this->object, $this->methodName));
        }
    }

    /**
     * @param       array           arguments / parameters
     * @return      mixed           result of delegation
     */
    public function invokeWithArgs($args = array())
    {
        if (is_array($args)) {
            // callback with args
            return call_user_func_array(array($this->object, $this->methodName), $args);
        } else {
            throw new DelegateException('Delegation invoke with argument expect a array as arg1.', E_ERROR);
        }
    }
}