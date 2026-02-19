<?php require 'config.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <h2>Σύνδεση</h2>
    <form method="POST">
        <input class="form-control mb-2" name="username" placeholder="Όνομα Χρήστη">
        <input class="form-control mb-2" type="password" name="password" placeholder="Κωδικός">
        <button class="btn btn-success" type="submit">Σύνδεση</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$_POST['username']]);
  $user = $stmt->fetch();

  if ($user && password_verify($_POST['password'], password_hash($user['password'], PASSWORD_DEFAULT))) {
    $_SESSION['user'] = $user;
    header("Location: index.php");
  } else {
    echo "<div class='alert alert-danger'>Λάθος στοιχεία!</div>";
  }
}
?>

<?php include 'includes/footer.php'; ?>