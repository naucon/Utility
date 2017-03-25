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

use Naucon\Utility\ArrayPath;

/**
 * Array Merge Abstract Class
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class ArrayMergeAbstract
{
    /**
     * @var         array               default array
     */
    protected $defaultArray = array();

    /**
     * @var         array               deviation array 1
     */
    protected $deviationArray1 = array();

    /**
     * @var         array               deviation array 2
     */
    protected $deviationArray2 = array();

    /**
     * @var         array               merged array
     */
    protected $mergedArray1 = null;

    /**
     * @var         array               merged array
     */
    protected $mergedArray2 = null;

    /**
     * @var         ArrayPath           array path object
     */
    protected $arrayPathObject = null;



    /**
     * Destructor
     */
    public function __destruct()
    {
        unset($this->mergedArray1);
        unset($this->mergedArray2);
        unset($this->arrayPathObject);
    }


    /**
     * @return      array               default array
     */
    public function getDefaultArray()
    {
        return $this->defaultArray;
    }

    /**
     * @return      array               deviation array 1
     */
    public function getDeviationArray1()
    {
        return $this->deviationArray1;
    }

    /**
     * @param       array               deviation array 1
     * @return      void
     */
    protected function setDeviationArray1($array = array())
    {
        $this->deviationArray1 = $array;
    }

    /**
     * @return      array               deviation array 2
     */
    public function getDeviationArray2()
    {
        return $this->deviationArray2;
    }

    /**
     * @param       array               deviation array 2
     * @return      void
     */
    protected function setDeviationArray2($array = array())
    {
        $this->deviationArray2 = $array;
    }

    /**
     * get merged array 1
     *
     * @return      array               merged array 1
     */
    public function getMergedArray1()
    {
        if (is_null($this->mergedArray1)) {
            $this->merge();
        }
        return $this->mergedArray1;
    }

    /**
     * set merged array 1
     *
     * @param       array               merged array 1
     * @return      void
     */
    protected function setMergedArray1($value)
    {
        return $this->mergedArray1 = $value;
    }

    /**
     * get merged array 2
     *
     * @return      array               merged array 2
     */
    public function getMergedArray2()
    {
        if (is_null($this->mergedArray2)) {
            $this->merge();
        }
        return $this->mergedArray2;
    }

    /**
     * set merged array 2
     *
     * @param       array               merged array 2
     * @return      void
     */
    protected function setMergedArray2($value)
    {
        return $this->mergedArray2 = $value;
    }

    /**
     * get merged array
     *
     * @return      array               merged array
     */
    public function getMergedArray()
    {
        return $this->getMergedArray2();
    }

    /**
     * set merged array
     *
     * @param       array               merged array
     * @return      void
     */
    public function setMergedArray($value)
    {
        return $this->setMergedArray2($value);
    }

    /**
     * merge arrays
     *
     * @return      void
     */
    protected function merge()
    {
        if (is_array($this->getDeviationArray1())) {
            // if a deviation array 1 is set
            // merge default with deviation array 1
            $this->setMergedArray1($this->mergeArray($this->getDefaultArray(), $this->getDeviationArray1()));

            // check if deviation array 2 is set.
            if (is_array($this->getDeviationArray2())
                && count($this->getDeviationArray2()) > 0
            ) {
                // merge merged array with deviation array 2
                $this->setMergedArray2($this->mergeArray($this->getMergedArray1(), $this->getDeviationArray2()));
            } else {
                $this->setMergedArray2($this->getMergedArray1());
            }
        } else {
            $this->setDeviationArray1($this->getDefaultArray());

            if (is_array($this->getDeviationArray2())
                && count($this->getDeviationArray2()) > 0
            ) {
                // if no deviation array 1 is set,
                // merge default array with deviation
                // array 2
                $this->setDeviationArray2($this->mergeArray($this->getDefaultArray(), $this->getDeviationArray2()));
            } else {
                // if no deviation array 1 and
                // deviation array 2 is set, merged
                // array is default array.
                $this->setDeviationArray2($this->getDefaultArray());
            }
        }
    }

    /**
     * set deviation arrays
     *
     * @param       array               merged array
     * @return      void
     */
    protected function setDeviation($mergedArray)
    {
        if (is_array($this->getDeviationArray1())
            && count($this->getDeviationArray1()) > 0
        ) {
            $this->setDeviationArray2($this->deviationArray($this->getDeviationArray1(), $mergedArray));
        } else {
            $this->setDeviationArray1($this->deviationArray($this->getDefaultArray(), $mergedArray));
        }
    }

    /**
     * @return      ArrayPath           array path object
     */
    protected function getArrayPathObject()
    {
        if (is_null($this->arrayPathObject)) {
            $this->arrayPathObject = new ArrayPath($this->getMergedArray());
        }
        return $this->arrayPathObject;
    }

    /**
     * @param       string              array path
     * @return      mixed               get value
     */
    public function get($path = null)
    {
        return $this->getArrayPathObject()->get($path);
    }

    /**
     * @param       string              array path
     * @return      void
     */
    public function has($path)
    {
        return $this->getArrayPathObject()->has($path);
    }

    /**
     * @param       string              array path
     * @param       mixed               new value
     * @return      void
     */
    public function set($path, $value)
    {
        return $this->getArrayPathObject()->set($path, $value);
    }

    /**
     * @param       string              array path
     * @return      void
     */
    public function del($path)
    {
        return $this->getArrayPathObject()->del($path);
    }

    /**
     * @return      bool                show path TRUE or FALSE
     */
    public function getShowPath()
    {
        return $this->getArrayPathObject()->getShowPath();
    }

    /**
     * @param       bool                show path TRUE or FALSE
     * @return      void
     */
    public function setShowPath($value = false)
    {
        $this->getArrayPathObject()->setShowPath($value);
    }

    /**
     * @access      protected
     * @param        array               array 1
     * @param        array                array 2
     * @return        array                merged array
     */
    protected function mergeArray(array $array1 = array(), array $array2 = array())
    {
        foreach ($array2 as $key => $value) {
            if (isset($array1[$key])) {
                if (is_array($value)) {
                    $array1[$key] = $this->mergeArray($array1[$key], $array2[$key]);
                } else {
                    $array1[$key] = $value;
                }
            } else {
                $array1[$key] = $value;
            }
        }
        return $array1;
    }

    /**
     * @access      protected
     * @param       array               merged array
     * @param        array                default array
     * @return        array                deviation array
     */
    protected function deviationArray(array $defaultArray, array $mergedArray)
    {
        $deviationArray = array();
        if (is_array($mergedArray)
            && is_array($defaultArray)
            && count($defaultArray) > 0
        ) {
            foreach ($mergedArray as $key => $value) {
                if (is_array($value)) {
                    // when the value of the mergend array is an array
                    // we musst call the method recursive until the value
                    // is a not an array.
                    if (count($value) > 0
                        && isset($defaultArray[$key])
                        && is_array($defaultArray[$key])
                        && count($defaultArray[$key]) > 0
                    ) {
                        $deviationArrayChilds = $this->deviationArray($mergedArray[$key], $defaultArray[$key]);

                        if (count($deviationArrayChilds) > 0) {
                            $deviationArray[$key] = $deviationArrayChilds;
                        }
                    }
                } else {
                    // when the value is not a array we musst
                    // compare the value of the merged array to value
                    // of the default array. If it is different we
                    // musst the add the deviation to deviation array.
                    if (isset($defaultArray[$key])) {
                        if ($mergedArray[$key] != $defaultArray[$key]) {
                            $deviationArray[$key] = $mergedArray[$key];
                        }
                    }

                }
            }
        }
        return $deviationArray;
    }
}