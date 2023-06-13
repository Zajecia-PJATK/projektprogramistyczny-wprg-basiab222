<?php

class Customer extends User{
    private array $orders;

    public function __construct(string $name, string $surname, string $email, string $password, array $orders){
        parent::__construct($name,$surname,$email,$password);
        $this->orders = $orders;
    }
    public function getOrders(): array
    {
        return $this->orders;
    }
    public function setOrders(array $orders): void
    {
        $this->orders = $orders;
    }

}

