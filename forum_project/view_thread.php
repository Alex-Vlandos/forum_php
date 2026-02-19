<?php
require 'config.php';
include 'includes/header.php';

$thread_id = $_GET['id'];
$thread = $pdo->query("SELECT * FROM threads WHERE id = $thread_id")->fetch();
$posts = $pdo->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE thread_id = $thread_id")->fetchAll();
?>

<div class="container mt-4">
  <h2><?= $thread['title'] ?></h2>

  <?php foreach ($posts as $post): ?>
    <div class="card mb-2">
      <div class="card-body">
        <strong><?= htmlspecialchars($post['username']) ?>:</strong><br>
        <?= $post['content'] ?>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if (isset($_SESSION['user'])): ?>
    <form method="POST">
      <textarea name="content" class="form-control mb-2"></textarea>
      <button class="btn btn-success">Απάντηση</button>
    </form>

    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['content'])) {
        $stmt = $pdo->prepare("INSERT INTO posts (thread_id, user_id, content) VALUES (?, ?, ?)");
        $stmt->execute([$thread_id, $_SESSION['user']['id'], $_POST['content']]);
        header("Refresh:0");
      }
    ?>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>