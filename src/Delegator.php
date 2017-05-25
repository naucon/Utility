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
     * @var         array|Delegate[]        delegation objects
     */
    protected $delegationObjects = array();


    /**
     * @abstract
     * @param       DelegateInterface       $delegateObject
     * @return      void
     */
    public function register(DelegateInterface $delegateObject)
    {
        $this->delegationObjects[] = $delegateObject;
    }

    /**
     * @param       mixed       ...     $args
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