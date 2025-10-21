<?php
require_once __DIR__ . '/../config/database.php';

class Gallery {
  private $db;

  public function __construct() {
    $this->db = (new Database())->getConnection();
  }

  public function all($filters = []) {
    $sql = "SELECT * FROM gallery WHERE 1=1";
    $params = [];

    if (!empty($filters['status'])) {
      $sql .= " AND status = :status";
      $params[':status'] = $filters['status'];
    }
    if (!empty($filters['category'])) {
    $sql .= " AND LOWER(category) = :category";
    $params[':category'] = strtolower($filters['category']);
    }
    if (!empty($filters['q'])) {
      $sql .= " AND (title LIKE :q OR description LIKE :q)";
      $params[':q'] = '%' . $filters['q'] . '%';
    }

    $sql .= " ORDER BY created_at DESC";
    $stmt = $this->db->prepare($sql);
    foreach ($params as $k => $v) $stmt->bindValue($k, $v);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function find($id) {
    $stmt = $this->db->prepare("SELECT * FROM gallery WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($data) {
    $sql = "INSERT INTO gallery (title, description, image_path, category, status, created_by) 
            VALUES (:title, :description, :image_path, :category, :status, :created_by)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':title', $data['title']);
    $stmt->bindValue(':description', $data['description']);
    $stmt->bindValue(':image_path', $data['image_path']);
    $stmt->bindValue(':category', $data['category']);
    $stmt->bindValue(':status', $data['status']);
    $stmt->bindValue(':created_by', $data['created_by'], PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function update($id, $data) {
    $sql = "UPDATE gallery SET title=:title, description=:description, category=:category, status=:status";
    if (!empty($data['image_path'])) {
      $sql .= ", image_path=:image_path";
    }
    $sql .= " WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':title', $data['title']);
    $stmt->bindValue(':description', $data['description']);
    $stmt->bindValue(':category', $data['category']);
    $stmt->bindValue(':status', $data['status']);
    if (!empty($data['image_path'])) $stmt->bindValue(':image_path', $data['image_path']);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function delete($id) {
    $stmt = $this->db->prepare("DELETE FROM gallery WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
