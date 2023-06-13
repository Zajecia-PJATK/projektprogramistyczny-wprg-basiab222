<?php

class MenuItemType{
    static int $counter = 0;
    private int $id;
    private string $type;

    public function __construct(int $id, string $type) {
        $this->id = self::$counter;
        $this->type = $type;
        self::$counter++;
    }
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

}