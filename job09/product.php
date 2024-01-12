<?php
declare(strict_types=1);

/**
 * Objet Product
 */
class Product
{
    // Propriétés
    private int $id;
    private string $name;
    private array $photos;
    private int $price;
    private string $description;
    private int $quantity;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $category_id;

    // Constructor
    public function __construct(int $id, string $name, array $photos, int $price, string $description, int $quantity, DateTime $createdAt, DateTime $updatedAt, int $category_id) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->category_id = $category_id;
    }
    public function findOneById(PDO $pdo, int $id): bool {
        $stmt = $pdo->prepare('SELECT * FROM product WHERE id = ?');
        $stmt->execute([$id]);
        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($productData) {
            // Hydratation de l'instance courante avec les données récupérées
            $this->id = $productData['id'];
            $this->name = $productData['name'];
            $this->photos = json_decode($productData['photos'], true);
            $this->price = $productData['price'];
            $this->description = $productData['description'];
            $this->quantity = $productData['quantity'];
            $this->createdAt = new DateTime($productData['createdAt']);
            $this->updatedAt = new DateTime($productData['updatedAt']);
            $this->category_id = $productData['category_id'];

            return true;
        } else {
            return false;
        }
    }
    public static function findAll(PDO $pdo): array {
        $stmt = $pdo->query('SELECT * FROM product');
        $products = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new self(
                $row['id'],
                $row['name'],
                json_decode($row['photos'], true),
                $row['price'],
                $row['description'],
                $row['quantity'],
                new DateTime($row['createdAt']),
                new DateTime($row['updatedAt']),
                $row['category_id']
            );
        }

        return $products;
    }
    public function create(PDO $pdo): ?Product {
        $stmt = $pdo->prepare('INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $photosJson = json_encode($this->photos); // Convertir le tableau de photos en JSON

        $success = $stmt->execute([
            $this->name,
            $photosJson,
            $this->price,
            $this->description,
            $this->quantity,
            $this->createdAt->format('Y-m-d H:i:s'),
            $this->updatedAt->format('Y-m-d H:i:s'),
            $this->category_id
        ]);

        if ($success) {
            $this->id = (int) $pdo->lastInsertId();
            return $this;
        } else {
            return false;
        }
    }
    public function update(PDO $pdo): bool {
        if ($this->id <= 0) {
            return false; // ID invalide ou non défini
        }

        $stmt = $pdo->prepare('UPDATE product SET name = ?, photos = ?, price = ?, description = ?, quantity = ?, createdAt = ?, updatedAt = ?, category_id = ? WHERE id = ?');
        $photosJson = json_encode($this->photos); // Convertir le tableau de photos en JSON

        $success = $stmt->execute([
            $this->name,
            $photosJson,
            $this->price,
            $this->description,
            $this->quantity,
            $this->createdAt->format('Y-m-d H:i:s'),
            $this->updatedAt->format('Y-m-d H:i:s'),
            $this->category_id,
            $this->id
        ]);

        return $success;
    }
    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPhotos(): array {
        return $this->photos;
    }

    public function getPrice(): int {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    public function getCategoryId(): int {
        return $this->category_id;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setPhotos(array $photos): void {
        $this->photos = $photos;
    }

    public function setPrice(int $price): void {
        $this->price = $price;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    public function setCreatedAt(DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }

    public function setCategoryId(int $category_id): void {
        $this->category_id = $category_id;
    }
}
?>


