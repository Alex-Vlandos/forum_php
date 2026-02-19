<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
<link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
require('functions/generic_functions.php');
require('alertModal.php');
    startSession();
    defineSessionValues();
if (isset($_SESSION['username']) && empty($_SESSION['username'])) {
    echo "<script>
            myAlert('There is no logged in user!');
            setTimeout(function() {
            window.location.href = 'index.php';
        }, 2000);
          </script>";
    exit();
}
    session_unset();
    session_destroy();
    // header("Location:index.php");
    echo "<script>
        myAlert('You have been logged out successfully!');
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 2000); // 2 δευτερόλεπτα καθυστέρηση
      </script>";
    exit();
?>