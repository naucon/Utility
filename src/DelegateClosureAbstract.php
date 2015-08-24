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
use Naucon\Utility\Exception\DelegateClosureException;

/**
 * Abstract Delegate Closure Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class DelegateClosureAbstract implements DelegateInterface
{
    /**
     * @var     Closure
     */
    protected $closure = null;


    /**
     * @param       mixed        arg 1
     * @param       mixed        arg 2
     * @param       mixed ...
     * @param       mixed        arg n
     * @return      mixed        result of delegation
     */
    public function invoke()
    {
        if ($this->closure instanceof \Closure) {
            // gets all construtor arguments / parameters
            $args = func_get_args();

            if (count($args) > 0) {
                // callback with args
                return call_user_func_array($this->closure, $args);
            } else {
                // callback without args
                return call_user_func($this->closure);
            }
        } else {
            throw new DelegateClosureException('Given Closure is not of type Closure.', E_ERROR);
        }
    }

    /**
     * @param       array        arguments / parameters
     * @return      mixed        result of delegation
     */
    public function invokeWithArgs($args = array())
    {
        if ($this->closure instanceof \Closure) {
            if (is_array($args)) {
                // callback with args
                return call_user_func_array($this->closure, $args);
            } else {
                throw new DelegateClosureException('Delegation invoke with argument expect a array as arg1.', E_ERROR);
            }
        } else {
            throw new DelegateClosureException('Given Closure is not of type Closure.', E_ERROR);
        }
    }
}