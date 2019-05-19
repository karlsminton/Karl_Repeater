<?php

namespace Karl\Repeater\Api\Data;

interface BlockInterface
{

    public function getId();

    public function getIdentifier();

    public function getName();

    public function getItems();

    public function setId($id);

    public function setIdentifier($identifier);

    public function setName($name);

    public function setItems($items);
}
