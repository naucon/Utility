<?php
use Naucon\Utility\ObserverAbstract;
use Naucon\Utility\ObservableAbstract;
use Naucon\Utility\ObservableInterface;

class Observable extends ObservableAbstract
{
    private $state = null;

    public function getState()
    {
        return $this->state;
    }

    public function setState($value)
    {
        $this->state = $value;
        $this->setChanged();
        $this->notifyObservers();
    }
}

class ObserverFoo extends ObserverAbstract
{
    public function update(ObservableInterface $observableObject, $arg)
    {
        echo 'Foo: ' . $observableObject->getState();
        echo '<br/>';
    }
}

class ObserverBar extends ObserverAbstract
{
    public function update(ObservableInterface $observableObject, $arg)
    {
        echo 'Bar: ' . $observableObject->getState();
        echo '<br/>';
    }
}

$observableObject = new \Observable();

// hook observer
$observableObject->addObserver(new \ObserverFoo());
$observableObject->addObserver(new \ObserverBar());

// notify
$observableObject->setState('todo');