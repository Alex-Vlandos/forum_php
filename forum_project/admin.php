<?php
require 'config.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  die("Μόνο για διαχειριστές.");
}
include 'includes/header.php';
?>

<div class="container mt-4">
  <h2>Admin Panel</h2>

  <h4>Δημιουργία Χρήστη ή Διαχειριστή</h4>
  <form method="POST">
    <input class="form-control mb-2" name="username" placeholder="Όνομα Χρήστη">
    <input class="form-control mb-2" type="password" name="password" placeholder="Κωδικός">
    <select class="form-control mb-2" name="role">
      <option value="user">Χρήστης</option>
      <option value="admin">Διαχειριστής</option>
    </select>
    <button class="btn btn-secondary">Δημιουργία</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([
      $_POST['username'],
      password_hash($_POST['password'], PASSWORD_BCRYPT),
      $_POST['role']
    ]);
    echo "<div class='alert alert-success mt-2'>Ο χρήστης δημιουργήθηκε!</div>";
  }
  ?>
</div>

<?php include 'includes/footer.php'; ?>