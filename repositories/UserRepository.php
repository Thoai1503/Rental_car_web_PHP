<?php
require_once 'BaseRepositoryInterface.php';
require_once 'models/User.php';
 class UserRepository implements BaseRepositoryInterface{
    private $pdo;
    private $table = 'users';

    public function __construct($pdo)
    {
        $this->pdo = $pdo;  
    }
    public function getAll(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $results =[];
        foreach ($users as $userData) {
            $user=new User($userData['id'], $userData['name'], $userData['phone'], $userData['email'], $userData['id_auth'], $userData['active']);
            $results[] = $user;
        }
        return $results;
    }

    public function getAllClient(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_auth=2");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $results =[];
        foreach ($users as $userData) {
            $user=new User($userData['id'], $userData['name'], $userData['phone'], $userData['email'], $userData['id_auth'], $userData['active']);
            $results[] = $user;
        }
        return $results;
    }


	public function getById(int $id) {
		$stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData) {
            return new User($userData['id'], $userData['name'], $userData['phone'], $userData['email'], $userData['id_auth'],   $userData['active']);
        }
        return null;
	}

	public function create(array $car) {
		// TODO: Implement create() method.
	}

	public function update(array $car) {
		// TODO: Implement update() method.
	}

	public function delete(int $id) {
		// TODO: Implement delete() method.
	}
 }
?>