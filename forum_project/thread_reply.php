<?php
if(!isLoggedInUser($_SESSION['username'],$_SESSION['password'])){
  echo '
  <script>
  document.addEventListener("DOMContentLoaded", function (){
  myAlert("You must be logged in,in order for you to reply!");
  });
  </script>';
}
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tinymce/tinymce.min.js"></script>
    
  <div class="container">
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <form id="replyForm" action="thread_reply_server.php" method="POST">
        <h5 class="modal-title" id="replyModalLabel">Reply to post:</h5>
        <input type="hidden" name="postTitle" id="hiddenInput1">
        <input type="hidden" name="writtenBy" id="hiddenInput2">
        <input type="hidden" name="post_id" id="hiddenInput3">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close_button"></button>
      </div>
      <div class="modal-body" id="centeredContent">
        <?php if(isLoggedInUser($_SESSION['username'],$_SESSION['password'])):?>
          <textarea id="replyContent" type="text" placeholder="Insert your answer here!" name="threadContent"></textarea>
        <?php endif; ?>
      <div id="existingReplies"></div>
      </div>
      </form>
      <div class="modal-footer">
      <?php if(isLoggedInUser($_SESSION['username'],$_SESSION['password'])):?>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitReply">Submit</button>
      <?php endif; ?>
      </div>
    </div>
  </div>
</div>
      </div>
      <script>
document.addEventListener("DOMContentLoaded", function () {
    const editorElement = document.getElementById('replyContent');
    if (editorElement) {
        tinymce.init({
            selector: '#replyContent',
            entity_encoding: 'raw',
            menubar: false,
            branding: false,
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
            //license_key: 'fvm0f1p8r67dzf24vllnjl5sfd4yaidlphlpiar85p9xx0ge',
            license_key: 'gpl',
            content_style: `
              body {
                  font-family: 'Sofia', sans-serif;
                  font-size: 16px;
                  background-image:linear-gradient(to right, rgba(171, 180, 35, 0.99), rgb(23, 168, 55));
                  font-family: "Sofia", sans-serif;
              }
`
        });
    }
});
</script>
    <script>
      let buttons=document.querySelectorAll("[id^='threadButton']");
      console.log(buttons);
      function checkEmptyFields() {
    var content = tinymce.get("replyContent").getContent()
        .replace(/&nbsp;/g, ' ')  // Αντικαθιστούμε τα &nbsp; με κενό
        .replace(/<[^>]*>/g, '')  // Αφαιρούμε όλα τα HTML tags
        .trim(); // Κόβουμε τα περιττά κενά
        console.log("Raw content from TinyMCE:", tinymce.get("replyContent").getContent());
    console.log("Processed content:", content); // Δες τι παίρνει

    if (content === "" || content.length === 0) {
        myAlert("You must insert non-empty values in text!");
        return false;
    }
    return true;
}
var reply = document.getElementById("submitReply");

if (reply) {
    reply.addEventListener("click", () => {
        if (checkEmptyFields()) {
            document.getElementById("replyForm").submit();
        }
    });
}

        // function showReplies(postId) {
        //   const xhr = new XMLHttpRequest();
        //   xhr.open("POST", "showReplies.php", true);
        //   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //   let data = "post_id=" + postId;
        //   xhr.onreadystatechange = function() {
        //       if (xhr.readyState == 4 && xhr.status == 200) {
        //           document.getElementById("existingReplies").innerHTML = xhr.responseText;
        //         }
        //       }
        //       xhr.send(data);
        //   }
        function showReplies(postId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "showReplies.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    let data = "post_id=" + postId;

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("existingReplies").innerHTML = xhr.responseText;
            const scriptTags = document.createElement('div');
            scriptTags.innerHTML = xhr.responseText;
            const scripts = scriptTags.getElementsByTagName('script');
            for (let i = 0; i < scripts.length; i++) {
                eval(scripts[i].innerText);
            }
        }
    };
    xhr.send(data);
}

     
    </script>
    
