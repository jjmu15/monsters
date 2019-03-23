<?php

namespace App;

class Monster
{
    protected $id,
              $name,
              $currentCity,
              $active,
              $lifespan;

    /*
     * @param ID $id
     */
    public function setId($id)
    {
      $this->id = $id;
    }

    public function getId()
    {
      return $this->id;
    }

    public function setName($name)
    {
      return $this->name = $name;
    }

    public function getName()
    {
      return $this->name;
    }

    public function setLifespan($lifespan)
    {
      $this->lifespan = $lifespan;
    }

    public function getCurrentCity()
    {
      return $this->currentCity;
    }

    public function isActive()
    {
      return $this->active;
    }

    public function setActive()
    {
      $this->active = true;
    }

    public function setInactive()
    {
      $this->active = false;
    }



}
