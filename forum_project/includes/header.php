<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <title>Forum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.tiny.cloud/1/slwf1qfb1vteq6w38arpo5aszs272vkddf3ifefyqibjfelf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({ selector: 'textarea' });</script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Forum</a>
    <div>
      <?php if (isset($_SESSION['user'])): ?>
        <span class="text-white me-2"><?= $_SESSION['user']['username'] ?> (<?= $_SESSION['user']['role'] ?>)</span>
        <a class="btn btn-outline-light btn-sm" href="logout.php">Αποσύνδεση</a>
      <?php else: ?>
        <a class="btn btn-outline-light btn-sm me-2" href="login.php">Σύνδεση</a>
        <a class="btn btn-outline-light btn-sm" href="register.php">Εγγραφή</a>
      <?php endif; ?>
    </div>
  </div>
</nav>