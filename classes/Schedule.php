<?php

class Schedule{
    static int $counter = 0;
    private int $id;
    private DateTime $dateTime;
    private array $employees;

    public function __construct(int $id, DateTime $dateTime, array $employees) {
        $this->id = $id;
        $this->dateTime = $dateTime;
        $this->employees = $employees;
    }

    public static function getCounter(): int {
        return self::$counter;
    }

    public static function setCounter(int $counter): void {
        self::$counter = $counter;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getDateTime(): DateTime {
        return $this->dateTime;
    }

    public function setDateTime(DateTime $dateTime): void {
        $this->dateTime = $dateTime;
    }

    public function getEmployees(): array {
        return $this->employees;
    }

    public function setEmployees(array $employees): void {
        $this->employees = $employees;
    }


}