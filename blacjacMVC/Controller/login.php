<?php
session_start();

// Database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=project_s', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;    
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, $hashedPassword]);
    }

    public function validatePassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }
}

$userModel = new UserModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $user = $userModel->getUserByUsername($username);
        if ($user && $userModel->validatePassword($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            header('Location: ../View/index.php');
            exit;
        } else {
            echo "Invalid username or password!";
        }
    }
    elseif ($action === 'register') {
        $user = $userModel->getUserByUsername($username);
        if ($user) {
            echo "Username already exists!";
        } else {
            if ($userModel->createUser($username, $password)) {
                echo "Registration successful!";
                header('Location: ../View/loginview.php');
                exit;
            } else {
                echo "Registration failed!";
            }
        }
    }
}

include '../View/loginview.php';
?>
