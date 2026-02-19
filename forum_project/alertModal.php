<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="modal" tabindex="-1" id="alert_modal">
  <div class="modal-dialog">
    <div class="modal-content" id="alert_modal_style">
      <div class="modal-header">
        <h5 class="modal-title">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p  id="modal_body"></p>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="yesButton">Yes</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="noButton">No</button>
      </div> -->
    </div>
  </div>
</div>
<script>
    function myAlert(message) {
    // Βάζουμε το μήνυμα στο modal
    document.getElementById("modal_body").innerHTML = message;
    // Εμφανίζουμε το modal χρησιμοποιώντας Bootstrap JavaScript
    var myModal = new bootstrap.Modal(document.getElementById('alert_modal'));
    myModal.show();
}
</script>