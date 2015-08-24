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

use Naucon\Utility\ObserverInterface;

/**
 * Observable Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface ObservableInterface
{
    /**
     * add a observer to the observable
     *
     * @param       ObserverInterface           observer object
     * @return      void
     */
    public function addObserver(ObserverInterface $observerObject);

    /**
     * return the amount of observer of the observable
     *
     * @return      int                         amount of observer
     */
    public function countObservers();

    /**
     * remove the specified observer from the observable
     *
     * @param       ObserverInterface           observer object
     * @return      void
     */
    public function removeObserver(ObserverInterface $observerObject);

    /**
     * remove all observer form the observable
     *
     * @return      void
     */
    public function clearObservers();

    /**
     * notify all observer
     *
     * @param       mixed                       optional argument
     * @return      void
     */
    public function notifyObservers($arg = null);

    /**
     * set observable as changed
     *
     * @return      void
     */
    public function setChanged();

    /**
     * has observable changed
     *
     * @return      bool                        observable has changed
     */
    public function hasChanged();

    /**
     * set observable as not changed
     *
     * @return      void
     */
    public function clearChanged();
}