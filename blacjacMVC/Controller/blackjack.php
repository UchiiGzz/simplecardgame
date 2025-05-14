<?php

require_once '../Model/BlackjackGame.php';
session_start();


// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Initialize or retrieve game
if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = new BlackjackGame();
}
$game = $_SESSION['game'];

// Handle actions
if (isset($_GET['action']) && $_GET['action'] === 'start') {
    $game->startNewGame();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['hit'])) {
        $game->playerHit();
    } elseif (isset($_POST['stand'])) {
        $game->playerStand();
    } elseif (isset($_POST['start'])) {
        $game->startNewGame();
    }
}

// Show appropriate view
if ($game->isGameOver()) {
    include '../View/result.php';
} else {
    include '../View/blackjackview.php';
}
?>
