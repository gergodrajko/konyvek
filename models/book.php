<?php
declare(strict_types=1);

class Book {
    public ?int $id = null;
    public string $title;
    public string $isbn;
    public float $price;
    public string $description;
    public ?string $cover_url = null;
    public ?int $ratings = null;
    public int $author_id;
    public int $publisher_id;
    public int $category_id;

    public function __construct(array $data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                // Ha az érték numerikus, próbáljuk meg integerre konvertálni
                if ($key === 'author_id' || $key === 'publisher_id' || $key === 'category_id') {
                    $this->$key = (int)$value; // Az összes integer típusú mezőt konvertáljuk
                } elseif ($key === 'price') {
                    $this->$key = (float)$value; // A price float típusú, konvertáljuk
                } else {
                    $this->$key = $value;
                }
            }
        }
    }
}
