<?php

namespace App;

class City
{
    protected $name,
              $destroyed = false,
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

    }

    public function removeNeighbour($direction)
    {
      unset($this->neighbours[$direction]);
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
