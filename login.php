<?php
session_start(); // Start de sessie

// Verbind met de database
$db = new PDO('mysql:host=localhost;dbname=project_s', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Model voor gebruikers
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

// Initialiseer UserModel
$userModel = new UserModel($db);

// POST request afhandeling (login of register)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        $user = $userModel->getUserByUsername($username);
        if ($user && $userModel->validatePassword($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            header('Location: ../view/start.php');
            exit;
        } else {
            echo "Ongeldige gebruikersnaam of wachtwoord!";
        }
    }

    elseif ($action === 'register') {
        $user = $userModel->getUserByUsername($username);
        if ($user) {
            echo "Gebruikersnaam bestaat al!";
        } else {
            if ($userModel->createUser($username, $password)) {
                echo "Registratie succesvol!";
                header('Location: ../view/loginview.php');
                exit;
            } else {
                echo "Er is iets misgegaan bij de registratie!";
            }
        }
    }
}

// Als geen POST-verzoek → toon het formulier
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    include '../view/loginview.php';
    exit;
}
?>
