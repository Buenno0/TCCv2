<?php
require_once("config.php");
require_once("get_user_by_id.php");
session_start();
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $user = get_user_by_id($user_id);
    echo "Welcome, " . $user["name"] . ".";
    ?>
    <a href="logout.php">deslogar</a>
    <?php
} else {
    echo "You are not logged in.";
}