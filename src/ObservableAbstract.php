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

use Naucon\Utility\Set;
use Naucon\Utility\ObservableInterface;
use Naucon\Utility\ObserverInterface;
use Naucon\Utility\Exception\ObservableException;

/**
 * Observable Abstract Class
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
abstract class ObservableAbstract implements ObservableInterface
{
    /**
     * @access      protected
     * @var         bool            subject has changed
     */
    protected $_changed = false;

    /**
     * @access      protected
     * @var         Set             set of obeserver
     */
    protected $_observerSetObject = null;


    /**
     * Destructor
     */
    public function __destruct()
    {
        unset($this->_observerSetObject);
    }


    /**
     * return set of observer
     *
     * @access      protected
     * @return      Set
     */
    protected function getObserverSetObject()
    {
        if (is_null($this->_observerSetObject)) {
            $this->_observerSetObject = new Set();
        }
        return $this->_observerSetObject;
    }

    /**
     * add a observer to the observable
     *
     * @param       ObserverInterface           observer object
     * @return      void
     */
    public function addObserver(ObserverInterface $observerObject)
    {
        if (is_null($observerObject)) {
            throw new ObservableException('Given observer is null.', E_WARNING);
        } else {
            $this->getObserverSetObject()->add($observerObject);
        }
    }

    /**
     * return the amount of observer of the observable
     *
     * @return      int                         amount of observer
     */
    public function countObservers()
    {
        return $this->getObserverSetObject()->count();
    }

    /**
     * remove the specified observer from the observable
     *
     * @param       ObserverInterface           observer object
     * @return      void
     */
    public function removeObserver(ObserverInterface $observerObject)
    {
        $this->getObserverSetObject()->remove($observerObject);
    }

    /**
     * remove all observer form the observable
     *
     * @return      void
     */
    public function clearObservers()
    {
        $this->getObserverSetObject()->clear();
    }

    /**
     * notify all observer
     *
     * @param       mixed                       optional argument
     * @return      void
     */
    public function notifyObservers($arg=null)
    {
        if ($this->hasChanged()) {
            foreach ($this->getObserverSetObject() as $observerObject) {
                $observerObject->update($this, $arg);
            }
            $this->clearChanged();
        }
    }

    /**
     * set observable as changed
     *
     * @return      void
     */
    public function setChanged()
    {
        $this->_changed = true;
    }

    /**
     * has observable changed
     *
     * @access      protected
     * @return      bool                        observable has changed
     */
    public function hasChanged()
    {
        return $this->_changed;
    }

    /**
     * set observable as not changed
     *
     * @return      void
     */
    public function clearChanged()
    {
        $this->_changed = false;
    }
}