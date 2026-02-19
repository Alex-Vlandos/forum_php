<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
require("functions/database_functions.php");
require("functions/user_functions.php");
require("functions/generic_functions.php");
require('alertModal.php');
startSession();
// var_dump($_POST['post_id']);
if (isset($_POST['post_id'])) {
      $postId = $_POST['post_id'];
}
else{
  exit();
}
      if(!isset($replies)){
        $replies=[];
      }
      $sqlReplies="SELECT users.user_name, threads.content, threads.created_at, threads.thread_id
      FROM threads
      INNER JOIN users ON threads.user_id = users.user_id
      WHERE threads.post_id='$postId'";      
        $data=selectFromDb($sqlReplies);
        // var_dump(($replies));
        if(empty($data)){
            // echo "
            // <script>
            // myAlert('There is no thread created yet!');
            // </script>";
            exit();
        }
        foreach($data as $array){
            foreach($array as $value){
              $replies[]=$value;
            }  
        }
        // var_dump($replies);
  $i=0;
  while(isset($replies[$i+3])): ?>
      <div class="row post" id="wholeThread-<?php echo $replies[$i+3];?>">
          <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
              <form action="delete_thread.php" method="POST">
              <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                  <p id="threadContent-<?php echo $replies[$i+3]; ?>"><?php echo $replies[$i+1]; ?></p>
                  <p>by <?php echo $replies[$i]; ?></p>
                          <?php if(isAdmin($_SESSION['role'])):?>
                          <button id="threadButton-<?php echo $replies[$i+3]; ?>" type="submit" class="btn btn-primary deleteButtons">Delete</button>
                          <input type="hidden" name="thread_id" value="<?php echo $replies[$i+3]; ?>">
                          <?php endif;?>
                          
              </form>
          </div>
          <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
              <p><?php echo $replies[$i+2]; ?></p>
          </div>
          <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
              <h1 id="reply-<?php echo $replies[$i+3]; ?>">REPLIES</h1>
          </div>
          <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2 lastColumn">
              <h1 id="view-<?php echo $replies[$i+3]; ?>">VIEWS</h1>
          </div>
      </div>
  <?php 
    // var_dump($replies[$i+3]);
      $i+=4; 
  endwhile;
  ?>
<script>
    document.addEventListener("click", function(event) {
    // Ελέγχουμε αν το click έγινε σε κουμπί
    let button = event.target.closest("button");

    // Αν δεν είναι κουμπί, σταματάμε εδώ
    if (!button) return;

    // Ελέγχουμε αν το κουμπί έχει ID που ξεκινά με "threadButton-"
    if (button.id.startsWith("threadButton-")) {
        console.log("Το κουμπί διαγραφής thread πατήθηκε:", button.id);
        // Βρίσκουμε το κοντινότερο div με ID που ξεκινά από "wholeThread-"
        let closestThread = button.closest("div[id^='wholeThread']");
        
        // Αν το βρήκαμε, το διαγράφουμε
        if (closestThread) {
            console.log("Διαγράφω το thread:", closestThread.id);
            // closestThread.remove();
        } else {
            console.warn("Δεν βρέθηκε το σχετικό thread!");
        }
        // Εδώ βάλε τη λογική που θες να εκτελείται όταν πατιέται το κουμπί
    }
});

</script>

