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

use Naucon\Utility\ArrayMergeAbstract;

/**
 * Array Merge Class
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
class ArrayMerge extends ArrayMergeAbstract
{
    /**
     * Constructor
     *
     * @param       array               default array
     * @param       array               deviation array 1
     * @param       array               deviation array 2
     */
    public function __construct($defaultArray=array(), $deviationArray1=array(), $deviationArray2=array())
    {
        $this->defaultArray = $defaultArray;
        $this->deviationArray1 = $deviationArray1;
        $this->deviationArray2 = $deviationArray2;
    }
}