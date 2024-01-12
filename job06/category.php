<?php
declare(strict_types=1);

class Category {
    private int $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(int $id, string $name, string $description, DateTime $createdAt, DateTime $updatedAt) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime {
        return $this->updatedAt;
    }

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setCreatedAt(DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
    public function getProducts(PDO $pdo): array {
        // Préparation de la requête pour récupérer les produits de cette catégorie
        $stmt = $pdo->prepare('SELECT * FROM product WHERE category_id = ?');
        $stmt->execute([$this->id]);

        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = new Product(
                $row['id'],
                $row['name'],
                json_decode($row['photos'], true), // Assurez-vous que 'photos' est un JSON valide
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
}
?>


