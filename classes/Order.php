<?php

class Order{
    static int $counter = 0;
    private int $id;
    private DateTime $dateTime;
    private float $value;
    private PaymentType $paymentType;
    private array $menuItems;
    private int $customerId;
    private string $status;
    private string $review;

    public function __construct(int $id, DateTime $dateTime, float $value, PaymentType $paymentType, array $menuItems, int $customerId, string $status, string $review) {
        $this->id = $id;
        $this->dateTime = $dateTime;
        $this->value = $value;
        $this->paymentType = $paymentType;
        $this->menuItems = $menuItems;
        $this->customerId = $customerId;
        $this->status = $status;
        $this->review = $review;
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

    public function getValue(): float {
        return $this->value;
    }

    public function setValue(float $value): void {
        $this->value = $value;
    }

    public function getPaymentType(): PaymentType {
        return $this->paymentType;
    }

    public function setPaymentType(PaymentType $paymentType): void {
        $this->paymentType = $paymentType;
    }

    public function getMenuItems(): array {
        return $this->menuItems;
    }

    public function setMenuItems(array $menuItems): void {
        $this->menuItems = $menuItems;
    }

    public function getCustomerId(): int {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void {
        $this->customerId = $customerId;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function getReview(): string {
        return $this->review;
    }

    public function setReview(string $review): void {
        $this->review = $review;
    }


}