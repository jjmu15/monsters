<?php

namespace App;

use Illuminate\Support\Arr;

class City
{
    protected $name,
              $destroyed,
              $neighbours = array();

    public function setName($name)
    {
      $this->name = $name;
    }

    public function getName()
    {
      return $this->name;
    }

    public function setNeighbours(array $neighbours)
    {
      $this->neighbours = $neighbours;
    }

    public function getRandomNeighbour()
    {
      return Arr::random($this->neighbours, 1);
    }

    public function removeNeighbour($direction)
    {
      unset($this->neighbours[$direction]);
    }

    public function setDestroyed($destroyed)
    {
      $this->destroyed = $destroyed;
    }

    public function isDestroyed()
    {
      return $this->destroyed;
    }

    public function destroyCity()
    {
      $this->destroyed = true;
    }

}
