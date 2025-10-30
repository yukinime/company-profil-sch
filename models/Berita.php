<?php
/**
 * Model Berita
 * Mengelola data berita di database
 */

require_once __DIR__ . '/../config/database.php';

class Berita {
  private $db;
  private $table = 'berita';

  public function __construct() {
    $database = new Database();
    $this->db = $database->getConnection();
  }

  /**
   * Ambil semua berita dengan filter
   */
  public function all($filters = []) {
    $sql = "SELECT b.*, a.full_name as author_name 
            FROM {$this->table} b
            LEFT JOIN admins a ON b.author_id = a.id
            WHERE 1=1";
    
    $params = [];
    
    // Filter pencarian
    if (!empty($filters['q'])) {
      $sql .= " AND (b.title LIKE :q OR b.content LIKE :q OR b.excerpt LIKE :q)";
      $params[':q'] = '%' . $filters['q'] . '%';
    }
    
    // Filter kategori
    if (!empty($filters['category'])) {
      $sql .= " AND b.category = :category";
      $params[':category'] = $filters['category'];
    }
    
    // Filter status
    if (!empty($filters['status'])) {
      $sql .= " AND b.status = :status";
      $params[':status'] = $filters['status'];
    }
    
    $sql .= " ORDER BY b.created_at DESC";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Ambil berita berdasarkan ID
   */
  public function findById($id) {
    $sql = "SELECT b.*, a.full_name as author_name 
            FROM {$this->table} b
            LEFT JOIN admins a ON b.author_id = a.id
            WHERE b.id = :id 
            LIMIT 1";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Ambil berita berdasarkan slug
   */
  public function findBySlug($slug) {
    $sql = "SELECT b.*, a.full_name as author_name 
            FROM {$this->table} b
            LEFT JOIN admins a ON b.author_id = a.id
            WHERE b.slug = :slug 
            LIMIT 1";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':slug' => $slug]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   * Tambah berita baru
   */
  public function create($data) {
    $sql = "INSERT INTO {$this->table} 
            (title, slug, excerpt, content, image_path, category, status, author_id, created_at) 
            VALUES 
            (:title, :slug, :excerpt, :content, :image_path, :category, :status, :author_id, NOW())";
    
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
      ':title' => $data['title'],
      ':slug' => $data['slug'],
      ':excerpt' => $data['excerpt'] ?? null,
      ':content' => $data['content'] ?? null,
      ':image_path' => $data['image_path'] ?? null,
      ':category' => $data['category'] ?? 'akademik',
      ':status' => $data['status'] ?? 'active',
      ':author_id' => $data['author_id'] ?? null
    ]);
  }

  /**
   * Update berita
   */
  public function update($id, $data) {
    $fields = [];
    $params = [':id' => $id];
    
    if (isset($data['title'])) {
      $fields[] = "title = :title";
      $params[':title'] = $data['title'];
    }
    
    if (isset($data['slug'])) {
      $fields[] = "slug = :slug";
      $params[':slug'] = $data['slug'];
    }
    
    if (isset($data['excerpt'])) {
      $fields[] = "excerpt = :excerpt";
      $params[':excerpt'] = $data['excerpt'];
    }
    
    if (isset($data['content'])) {
      $fields[] = "content = :content";
      $params[':content'] = $data['content'];
    }
    
    if (isset($data['category'])) {
      $fields[] = "category = :category";
      $params[':category'] = $data['category'];
    }
    
    if (isset($data['status'])) {
      $fields[] = "status = :status";
      $params[':status'] = $data['status'];
    }
    
    if (!empty($data['image_path'])) {
      $fields[] = "image_path = :image_path";
      $params[':image_path'] = $data['image_path'];
    }
    
    $fields[] = "updated_at = NOW()";
    
    if (empty($fields)) return false;
    
    $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute($params);
  }

  /**
   * Hapus berita
   */
  public function delete($id) {
    // Hapus foto terkait jika ada
    $item = $this->findById($id);
    if ($item && !empty($item['image_path'])) {
      $imagePath = __DIR__ . '/../' . $item['image_path'];
      if (file_exists($imagePath)) {
        @unlink($imagePath);
      }
    }
    
    // Hapus dari database
    $sql = "DELETE FROM {$this->table} WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([':id' => $id]);
  }

  /**
   * Increment views counter
   */
  public function incrementViews($id) {
    $sql = "UPDATE {$this->table} SET views = views + 1 WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([':id' => $id]);
  }

  /**
   * Ambil berita terbaru
   */
  public function getLatest($limit = 6) {
    $sql = "SELECT b.*, a.full_name as author_name 
            FROM {$this->table} b
            LEFT JOIN admins a ON b.author_id = a.id
            WHERE b.status = 'active'
            ORDER BY b.created_at DESC 
            LIMIT :limit";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Ambil berita terpopuler
   */
  public function getPopular($limit = 5) {
    $sql = "SELECT b.*, a.full_name as author_name 
            FROM {$this->table} b
            LEFT JOIN admins a ON b.author_id = a.id
            WHERE b.status = 'active'
            ORDER BY b.views DESC, b.created_at DESC 
            LIMIT :limit";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Ambil foto tambahan berita
   */
  public function getPhotos($beritaId) {
    $sql = "SELECT id, image_path, created_at 
            FROM berita_foto 
            WHERE berita_id = :berita_id 
            ORDER BY id DESC";
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':berita_id' => $beritaId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * Tambah foto ke berita
   */
  public function addPhoto($beritaId, $imagePath) {
    $sql = "INSERT INTO berita_foto (berita_id, image_path, created_at) 
            VALUES (:berita_id, :image_path, NOW())";
    
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
      ':berita_id' => $beritaId,
      ':image_path' => $imagePath
    ]);
  }

  /**
   * Hapus foto berita
   */
  public function deletePhoto($photoId) {
    // Ambil path foto
    $sql = "SELECT image_path FROM berita_foto WHERE id = :id LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':id' => $photoId]);
    $photo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($photo) {
      $imagePath = __DIR__ . '/../' . $photo['image_path'];
      if (file_exists($imagePath)) {
        @unlink($imagePath);
      }
    }
    
    // Hapus dari database
    $sql = "DELETE FROM berita_foto WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([':id' => $photoId]);
  }
}