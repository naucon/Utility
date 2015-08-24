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

use Naucon\Utility\DelegateClosureAbstract;
use Naucon\Utility\Exception\DelegateClosureException;

/**
 * Delegate Closure Class
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
class DelegateClosure extends DelegateClosureAbstract
{
    /**
     * Constructor
     *
     * @param       Closure
     */
    public function __construct(\Closure $closure)
    {
        if ($closure instanceof \Closure) {
            $this->closure = $closure;
        } else {
            throw new DelegateClosureException('Given Closure is not of type Closure.', E_ERROR);
        }
    }
}