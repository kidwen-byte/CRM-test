<?php

namespace app\models\entities;

use app\models\Entity;

class Clients extends Entity
{
    protected $id;
    protected $name;
    protected $email;
    protected $tel;

    protected $props = [
        'name' => false,
        'email' => false,
        'tel' => false
    ];

    public function __construct($name = null, $email = null, $tel = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->tel = $tel;
    }
}
