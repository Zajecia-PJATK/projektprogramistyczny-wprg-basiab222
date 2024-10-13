<?php

class Schedule{
    private int $id;
    private string $dateTime;
    private array $employees;

    public function __construct(int $id, string $dateTime, array $employees) {
        $this->id = $id;
        $this->dateTime = $dateTime;
        $this->employees = $employees;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getDateTime(): string {
        return $this->dateTime;
    }

    public function setDateTime(string $dateTime): void {
        $this->dateTime = $dateTime;
    }

    public function getEmployees(): array {
        return $this->employees;
    }

    public function setEmployees(array $employees): void {
        $this->employees = $employees;
    }


}