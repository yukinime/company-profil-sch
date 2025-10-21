<?php
require_once __DIR__ . '/../config/database.php';

class Kegiatan {
  private $db;
  public function __construct() { $this->db = (new Database())->getConnection(); }

  public function all($filters = []) {
    $sql = "SELECT * FROM kegiatan WHERE 1=1";
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
      $sql .= " AND (title LIKE :q OR excerpt LIKE :q OR content LIKE :q)";
      $params[':q'] = '%' . $filters['q'] . '%';
    }

    $sql .= " ORDER BY created_at DESC";
    $stmt = $this->db->prepare($sql);
    foreach ($params as $k=>$v) $stmt->bindValue($k, $v);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findById($id) {
    $stmt = $this->db->prepare("SELECT * FROM kegiatan WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function findBySlug($slug) {
    $stmt = $this->db->prepare("SELECT * FROM kegiatan WHERE slug = :slug LIMIT 1");
    $stmt->bindValue(':slug', $slug);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($data) {
    $sql = "INSERT INTO kegiatan (title, slug, excerpt, content, image_path, category, status, author_id) 
            VALUES (:title, :slug, :excerpt, :content, :image_path, :category, :status, :author_id)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':title', $data['title']);
    $stmt->bindValue(':slug', $data['slug']);
    $stmt->bindValue(':excerpt', $data['excerpt']);
    $stmt->bindValue(':content', $data['content']);
    $stmt->bindValue(':image_path', $data['image_path']);
    $stmt->bindValue(':category', $data['category']);
    $stmt->bindValue(':status', $data['status']);
    $stmt->bindValue(':author_id', $data['author_id'], PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function update($id, $data) {
    $sql = "UPDATE kegiatan SET title=:title, slug=:slug, excerpt=:excerpt, content=:content, category=:category, status=:status";
    if (!empty($data['image_path'])) $sql .= ", image_path=:image_path";
    $sql .= " WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':title', $data['title']);
    $stmt->bindValue(':slug', $data['slug']);
    $stmt->bindValue(':excerpt', $data['excerpt']);
    $stmt->bindValue(':content', $data['content']);
    $stmt->bindValue(':category', $data['category']);
    $stmt->bindValue(':status', $data['status']);
    if (!empty($data['image_path'])) $stmt->bindValue(':image_path', $data['image_path']);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function delete($id) {
    $stmt = $this->db->prepare("DELETE FROM kegiatan WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
