<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <!-- Start Picture -->
    <div class="row">
        <div class="col-md-6">
        <h1> School to study</h1>
            <img src="img/1.jpg" alt="" width="100%" style="margin-top:20px;">
        </div>
    <!-- End Picture -->

    <!-- Start Form -->
        <div class="col-md-6">
        <center><h2>Student Information</h2></center>
                <form action="table_new.php" method="get" class="needs-validation" novalidate>
                <div class="form-group">
                    <label for="sid">Student ID</label>
                    <input type="number" class="form-control" id="sid" placeholder="Enter Student ID" name="sid" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out student field.</div>
                </div>
                <div class="form-group">
                    <label for="sname">Student Name:</label>
                    <input type="text" class="form-control" id="sname" placeholder="Enter Student Name" name="sname" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out student field.</div>
                </div>
                <div class="form-group">
                    <label for="sgender">Gender:</label>
                    <select class="form-control" id="sgender"  name="sgender">
                    <option>Male</option>
                    <option>Female</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="sdob">Date Of birth:</label>
                    <input type="date" class="form-control" id="sdob" placeholder="Enter Date of Birth" name="sdob" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out student field.</div>
                </div>
                <div class="form-group">
                    <label for="spob">Place Of birth:</label>
                    <input type="text" class="form-control" id="spob" placeholder="Enter Place Of birth" name="spob" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out student field.</div>
                </div>
                <div class="form-group form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember" required> I agree in my complate.
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Check this checkbox to continue.</div>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </div>
    <!-- End Form -->
</div>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

</body>
</html>
