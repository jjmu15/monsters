<?php

namespace App;

class Monster
{
    protected $id,
              $currentCity,
              $active = true;

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

    public function getCurrentCity()
    {
      return $this->currentCity;
    }

    public function isActive()
    {
      return $this->active;
    }

    public function setInactive()
    {
      $this->active = false;
    }
    


}
