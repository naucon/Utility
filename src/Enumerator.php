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

use Naucon\Utility\EnumeratorAbstract;

/**
 * Enumerator Class
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 *
 * @example    EnumeratorExample.php
 */
class Enumerator extends EnumeratorAbstract
{
    /**
     * Constructor
     *
     * @param    mixed        value 1
     * @param    mixed        value 2
     * @param    mixed ...
     * @param    mixed        value n
     */
    public function __construct()
    {
        // gets all construtor arguments / parameters
        $args = func_get_args();

        if (count($args) > 0) {
            // add each argument / parameter
            foreach ($args as $itemValue) {
                $this->set($itemValue, $itemValue);
            }
        }
    }
}
