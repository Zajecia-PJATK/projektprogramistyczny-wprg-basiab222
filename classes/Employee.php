<?php
include_once "User.php";
class Employee extends User {
    private String $position;

    public function __construct(int $id, string $name, string $surname, string $email, string $password,string $position){
        parent::__construct($id, $name,$surname,$email,$password);
        $this->position = $position;
    }

    public function getPosition(): string
    {
        return $this->position;
    }
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

}