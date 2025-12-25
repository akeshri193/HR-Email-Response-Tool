<?php
session_start();
if (!isset($_SESSION["HR_logged_in"]) || !$_SESSION["HR_logged_in"]){
    header("Location: index.php");
    exit();
}


if(isset($_GET['logout'])) {
     header("Location: clear.php"); 
     exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Email Response Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class=" bg-gradient-to-r from-blue-500 to-purple-600 min-h-screen flex items-center justify-center">
    <nav class="navbar bg-body-primary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand"><b>HR Dashboard</b></a>
       <a href="?logout=1" class="btn btn-sm btn-outline-danger">Logout</a>
  </div>
</nav>
<div class="card shadow-lg" style="width: 25rem;">
  <div class="card-body">
    <h5 class="card-title" style="display: flex; align-items: center; gap: 10px;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
  <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
  <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
</svg>Candidate Details</h5><hr>
        <div >
            <form method="post" action="index.php">
            <div class="mb-3">
            <label for="Candidate_Name" class="form-label" ><h6>Candidate Name</h6></label>
            <input type="text" class="form-control" name="Candidate_Name" id="Candidate_Name" placeholder="Enter Candidate Name" required>
            </div>
            <div class="mb-3">
            <label for="Candidate_Email" class="form-label" ><h6>Candidate Email</h6></label>
            <input type="email" class="form-control" name="Candidate_Email" id="Candidate_Email" placeholder="Enter Candidate Email" required>
            </div>
             <label for="position" class="form-label" ><h6>Position Applied For</h6></label>
            <select class="form-select mb-3" id="position" name="position" aria-label="Default select example" required>
                <option selected>Select Position Applied For</option>
                  <option value="Software Engineer">Software Engineer</option>
                  <option value="Data Analyst">Data Analyst</option>
                  <option value="Project Manager">Project Manager</option>
            </select>
<div class="row mb-3">
    <div class="col">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="Selected" value="Selected">
            <label class="form-check-label" for="Selected">Selected</label>
        </div>
    </div>
    <div class="col">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="Rejected" value="Rejected">
            <label class="form-check-label" for="Rejected">Rejected</label>
        </div>
    </div>
</div><br>

<button type="button" class="btn btn-primary w-full" onclick="validateAndPreview()">Generate Mail</button>            </form>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Preview</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Generated message will appear here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmSend" class="btn btn-primary" data-bs-dismiss="modal">Send Mail</button>
                </div>
                </div>
            </div>
            </div>
<!-- Modal End -->
        </div>
        </div>
</div>
<div class="toast-container position-fixed bottom-0 end-0 p-3" >
  <div id="liveToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>

</body>
</html>
<script>
    const modalElement = document.getElementById('staticBackdrop');
const bootstrapModal = new bootstrap.Modal(modalElement);

function validateAndPreview() {
    const candidateName = document.getElementById('Candidate_Name').value;
    const position = document.getElementById('position').value;
    const statusElem = document.querySelector('input[name="status"]:checked');
    
    if (!candidateName || !document.getElementById('Candidate_Email').value) {
        showToast("Please fill in the candidate's name and email.");
        return;
    }

    if (position === "Select Position Applied For") {
        showToast("Please select a valid position.");
        return;
    }

    if (!statusElem) {
        showToast("Please select a status (Selected or Rejected).");
        return;
    }

    const status = statusElem.value;
    let message = "";

    if (status === 'Selected') {
        message = `Dear ${candidateName},\n\nWe are pleased to inform you that you have been selected for the position of ${position}. We will be in touch with further details.\n\nBest regards,\nHR Team`;
    } else {
        message = `Dear ${candidateName},\n\nWe appreciate your interest in the position of ${position}. After careful consideration, we regret to inform you that we will not be moving forward with your application at this time.\n\nBest regards,\nHR Team`;
    }

    modalElement.querySelector('.modal-body').innerText = message;
    bootstrapModal.show();
}

function showToast(message) {
    const toastLiveExample = document.getElementById('liveToast');
    document.querySelector('.toast-body').textContent = message;
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
    toastBootstrap.show();
}

document.getElementById('confirmSend').addEventListener('click', function() {
    const emailData = {
        email: document.getElementById('Candidate_Email').value,
        subject: "Update regarding your application: " + document.getElementById('position').value,
        message: document.querySelector('.modal-body').innerText
    };

        fetch('send_email.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(emailData)
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            showToast("Email sent successfully!");
            bootstrapModal.hide();
        } else {
            showToast("Error: " + data.error);
        }
    });
});

</script>
