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

use Naucon\Utility\DelegatorInterface;
use Naucon\Utility\Exception\DelegateException;

/**
 * Delegator Class
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * @example    DelegateExample.php
 */
class Delegator implements DelegatorInterface
{
    /**
     * @access      protected
     * @var         array           delegation objects
     */
    protected $delegationObjects = array();


    /**
     * @abstract
     * @param       DelegateInterface
     * @return      void
     */
    public function register(DelegateInterface $delegateObject)
    {
        $this->delegationObjects[] = $delegateObject;
    }

    /**
     * @param       mixed           arg 1
     * @param       mixed           arg 2
     * @param       mixed           ...
     * @param       mixed           arg n
     * @return      void
     */
    public function delegate()
    {
        // gets all construtor arguments / parameters
        $args = func_get_args();

        if (count($args) > 0) {
            // delegate with args
            foreach ($this->delegationObjects as $delegationObject) {
                $delegationObject->invokeWithArgs($args);
            }
        } else {
            // delegate without args
            foreach ($this->delegationObjects as $delegationObject) {
                $delegationObject->invoke();
            }
        }
    }
}