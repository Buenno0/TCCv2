<?php
require_once("config.php");
require_once("get_user_by_id.php");


$user_id = 2;
$user = get_user_by_id($user_id);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Account</title>
</head>
<body>
    <h1>Edit Account</h1>
    <form method="POST" action="edit_user.php">
        <label for="name">Username:</label>
        <input type="text" name="name" value="<?= $user['name']; ?>" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" value="<?= $user['password']; ?>" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= $user['email']; ?>" required><br><br>
        
        <input type="submit" value="Edit Account">
    </form>
</body>
</html>
