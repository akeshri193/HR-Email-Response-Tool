<?php
session_start();

$hashed_password ="$2y$10$0/1n7HpB57Vr./mowjz3T.G8JF88Vo9831cf5bgo5AkXU4nevZIM.";

if (!isset($_SESSION['HR_logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'] ?? '';
    $password = $_POST['password'] ?? '';
    if (isset($_POST['Username']) && isset($_POST['password']) ) {
        if($_POST['Username'] == 'admin@domain.com' && password_verify($_POST['password'], $hashed_password)){
        $_SESSION['HR_logged_in'] = true;
        session_regenerate_id(true);
        header("Location: dashboard.php");
        exit();
        }
         else {
        echo '<script>alert("Invalid Credentials")</script>';
        }
    }
} 
}
else {
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class=" bg-gradient-to-r from-blue-500 to-purple-600 min-h-screen flex items-center justify-center">
<div class="card shadow-lg" style="width: 20rem;">
  <div class="card-body">
    <h5 class="card-title" style="display: flex; align-items: center; gap: 10px;"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-folder-fill" viewBox="0 0 16 16">
  <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3m-8.322.12q.322-.119.684-.12h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981z"/>
</svg>HR Login</h5><hr>
        <div >
            <form method="post" action="index.php">
            <div class="mb-3">
            <label for="Username" class="form-label" ><h6>Username</h6></label>
            <input type="text" class="form-control" name="Username" id="Username" placeholder="Enter Username" required>
            </div>
            <div class="mb-3">
            <label for="password" class="form-label" ><h6>Password</h6></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
            </form>
        </div>
        </div>
</div>
</body>
</html>