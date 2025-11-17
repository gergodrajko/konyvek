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
    
                if (in_array($key, ['author_id', 'publisher_id', 'category_id', 'ratings', 'id'])) {
                    $this->$key = $value !== '' ? (int)$value : null;
    
                } elseif ($key === 'price') {
                    $this->$key = (float)$value;
    
                } else {
                    $this->$key = $value;
                }
            }
        }
    }
    
}
