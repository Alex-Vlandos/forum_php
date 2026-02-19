<?php require 'config.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <h2>Εγγραφή</h2>
    <form method="POST">
        <input class="form-control mb-2" name="username" placeholder="Όνομα Χρήστη" required>
        <input class="form-control mb-2" type="password" name="password" placeholder="Κωδικός" required>
        <button class="btn btn-primary" type="submit">Εγγραφή</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
  $stmt->execute([$username, $password]);
  echo "<div class='alert alert-success'>Ο χρήστης δημιουργήθηκε!</div>";
}
?>

<?php include 'includes/footer.php'; ?>