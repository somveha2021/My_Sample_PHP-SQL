<div>
<h4 class="m-0 font-weight-bold text-primary float-left">Article List</h4>
<!-- <a  class="float-right"href="">Add New</a> -->
<a href="home.php?page=article&frm=create" class="btn btn-success btn-sm btn-icon-split float-right">
    <span class="icon text-white-50">
    <i class="fas fa-plus"></i>
    </span>
    <span class="text">Add New Article</span>
</a>
</div>
<div class="table-responsive" style="margin-top: 50px;">  
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
    <!-- <table class="table table-bordered" style="margin-top: 50px;"> -->
    <?php
    include_once('config.php');
        // Attempt select query execution
        $sql = "SELECT * FROM article";
        $result = $pdo->query($sql);
        if($result){
        if($result->rowCount() > 0){
        ?>

        <thead>
            <tr>
            <th>ID</th>
            <th>Title</th>
            
            <th>Create Date</th>       
            <th>Action</th>
            </tr>
        </thead>

        <tfoot>
            <tr>
            <th>ID</th>
            <th>Title</th>
            
            <th>Create Date</th>       
            <th>Action</th>
            </tr>
        </tfoot>

        <tbody>
            <?php
            while($row = $result->fetch()){
            ?>    
                <tr class="success">
                    <td><?php echo $row['category_id']?></td>
                    <td><a href="read.php?id=<?php echo $row['id']; ?>" title='Detail <?php echo $row['title']?>' data-toggle='tooltip' ><?php echo $row['title']?></a></td>
                   
                    <td><?php echo $row['created_date']?></td>             
                    <td>
                        <a href="read.php?id=<?php echo $row['category_id']; ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-"></i> Read
                        </a>
                        
                        <a href="update.php?id=<?php echo $row['category_id']; ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-check"></i> Update
                        </a>
                        <a class='btn btn-danger btn-sm' href="delete.php?id=<?php echo $row['category_id']; ?>" title='Delete Record' data-toggle='tooltip'><i class="fas fa-trash"></i> Delete</a>
                    </td>

                </tr>
        
                <?php
            }
            }
        }
        
                            // Close connection
                            unset($pdo);
            ?>
            </tbody>
    </table>
</div>