<?php

class MenuItems{
    static int $counter = 0;
    private int $id;
    private string $name;
    private MenuItemType $itemType;
    private string $description;
    private float $price;
    public function __construct(int $id, string $name, MenuItemType $itemType, string $description, float $price)
    {
        $this->id = self::$counter;
        $this->name = $name;
        $this->itemType = $itemType;
        $this->description = $description;
        $this->price = $price;
        self::$counter++;
    }
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): void {
        $this->id = $id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function setName(string $name): void {
        $this->name = $name;
    }
    public function getItemType(): MenuItemType {
        return $this->itemType;
    }
    public function setItemType(MenuItemType $itemType): void {
        $this->itemType = $itemType;
    }
    public function getDescription(): string {
        return $this->description;
    }
    public function setDescription(string $description): void {
        $this->description = $description;
    }
    public function getPrice(): float {
        return $this->price;
    }
    public function setPrice(float $price): void {
        $this->price = $price;
    }

}