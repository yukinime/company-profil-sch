<?php
require_once __DIR__ . '/../config/database.php';

class RenderArt {
  private $db;

  public function __construct() {
    $this->db = (new Database())->getConnection();
  }

  public function all($filters = []) {
    $sql = "SELECT * FROM render_art WHERE 1=1";
    $params = [];

    if (!empty($filters['q'])) {
      $sql .= " AND (title LIKE :q OR description LIKE :q)";
      $params[':q'] = '%' . $filters['q'] . '%';
    }

    if (!empty($filters['category'])) {
      $sql .= " AND category = :category";
      $params[':category'] = $filters['category'];
    }

    if (!empty($filters['status'])) {
      $sql .= " AND status = :status";
      $params[':status'] = $filters['status'];
    }

    $sql .= " ORDER BY created_at DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function find($id) {
    $stmt = $this->db->prepare("SELECT * FROM render_art WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($data) {
    $stmt = $this->db->prepare("INSERT INTO render_art (title, description, image_path, category, status, created_by) 
      VALUES (:title, :description, :image_path, :category, :status, :created_by)");
    return $stmt->execute([
      ':title' => $data['title'],
      ':description' => $data['description'],
      ':image_path' => $data['image_path'],
      ':category' => $data['category'],
      ':status' => $data['status'],
      ':created_by' => $data['created_by']
    ]);
  }

  public function update($id, $data) {
    $fields = [];
    $params = [':id' => $id];

    foreach ($data as $k => $v) {
      if ($v !== '' && $k !== 'id') {
        $fields[] = "$k = :$k";
        $params[":$k"] = $v;
      }
    }

    if (empty($fields)) {
      return false;
    }

    $sql = "UPDATE render_art SET " . implode(', ', $fields) . " WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($params);
  }

  public function delete($id) {
    // Ambil data untuk hapus file fisik
    $item = $this->find($id);
    if ($item && !empty($item['image_path'])) {
      $filePath = __DIR__ . '/../' . $item['image_path'];
      if (is_file($filePath)) {
        @unlink($filePath);
      }
    }

    $stmt = $this->db->prepare("DELETE FROM render_art WHERE id = ?");
    return $stmt->execute([$id]);
  }
}