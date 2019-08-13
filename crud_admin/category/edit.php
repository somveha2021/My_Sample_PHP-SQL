<h3>Edit Category</h3>
<form action="/action_page.php" class="needs-validation" novalidate>
    <div class="form-group">
        <label for="cname">Category Name:</label>
        <input type="text" class="form-control" id="cname" placeholder="Enter Category Name" name="cname" required>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
        <label for="cicon">Category Icon:</label>
        <input type="text" class="form-control" id="cicon" placeholder="Enter fa fa-users" name="cicon" required>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
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