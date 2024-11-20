<?php
class User {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=museetopia', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function authenticate($email, $password) {
        $query = $this->db->prepare("SELECT password FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }

    public function exists($email) {
        $query = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC) !== false;
    }

    public function register($name, $email, $hashedPassword) {
        try {
            $query = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $result = $query->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword
            ]);
    
            if ($result) {
                echo "User registered successfully!";
            } else {
                print_r($query->errorInfo()); // Display SQL error information
            }
    
            return $result;
        } catch (PDOException $e) {
            die("Error during registration: " . $e->getMessage());
        }
    }
    public function getAllUsers() {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }



    public function updateUser($id, $name, $email) {
        $query = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        return $query->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email
        ]);
    }

    public function deleteUser($id) {
        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        return $query->execute(['id' => $id]);
    }

    
}
