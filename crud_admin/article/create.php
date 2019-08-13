<?php 
    // Include config file
        include_once('config.php');
        include_once ('config/session.php'); 
        date_default_timezone_set("Asia/Phnom_Penh");
        $title=$detail=$category_id=$create_id="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title=$_POST['title'];
        $detail=$_POST['detail'];
        $category_id=$_POST['category'];
        $photo="default.jpg";
        $today = date("Y-m-d h:i:s");
        $create_id= $_POST['username'];
        $status=1;
    
    // Prepare an insert statement
    $sql = "INSERT INTO article (category_id, title,detail,photo,created_by,created_date,status) 
    VALUES (:category_id, :title,:detail,:photo,:created_by,:created_date,:status)";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":category_id", $category_id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":detail", $detail);
        $stmt->bindParam(":photo", $photo);
        $stmt->bindParam(":created_by", $create_id);
        $stmt->bindParam(":created_date", $today);
        $stmt->bindParam(":status", $status);
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        // Records created successfully. Redirect to landing page
        header("location: ../home.php?page=article&frm=index");
        exit();
        // echo "Hello Success !";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        // unset($stmt);
    }
    // Close connection
    // unset($pdo);

?>


<h1 class="h3 mb-2 text-gray-800">Create Article</h1>                            
<form action="article/create.php" method="post">   
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" placeholder="Enter Title">                   
    </div>
    <div class="form-group">
      <label for="comment">Detail:</label>
      <textarea class="form-control" rows="5" id="comment" name="detail"></textarea>
    </div>
    <div class="form-group">
    <input type="file" name="fileToUpload" id="fileToUpload">
    
    </div>
    <div class="form-group">
    <label for="sel1">Category:</label>
    <?php
        // Attempt select query execution
        $sql = "SELECT * FROM category";
        $result = $pdo->query($sql);
        if($result){
        if($result->rowCount() > 0){
    ?>
    <select class="form-control" id="sel1" name="category">
        <?php
            while($row = $result->fetch()){
        ?>    
                <option value="<?php echo $row['category_id']; ?>"><?php  echo $row['name']; ?></option>  

        <?php
                    }
                }
            }
                            // Close connection
                            // unset($pdo);
        ?>

       
   
    </select>
    </div>

    <!-- <input type="submit" class="btn btn-primary" value="Save"> -->
    <input type="submit" class="btn btn-primary" value="Save">
    
    
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