<?php
require 'config.php';
if (!isset($_SESSION['user'])) die("Πρέπει να είστε συνδεδεμένοι");
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stmt = $pdo->prepare("INSERT INTO threads (user_id, title) VALUES (?, ?)");
  $stmt->execute([$_SESSION['user']['id'], $_POST['title']]);
  header("Location: index.php");
}
?>

<div class="container mt-4">
  <h2>Νέο Thread</h2>
  <form method="POST">
    <input class="form-control mb-2" name="title" placeholder="Τίτλος Συζήτησης" required>
    <button class="btn btn-primary" type="submit">Δημιουργία</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>