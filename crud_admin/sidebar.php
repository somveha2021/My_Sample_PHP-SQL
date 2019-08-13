<div class="col-sm-4"> 
    <ul class="nav nav-pills flex-column">
        <h4>Login : <?php echo htmlspecialchars($_SESSION["username"]); ?></h4>
        <li class="nav-item">
            <a class="nav-link active" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="home.php?page=category&frm=index">Catengory</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="home.php?page=article&frm=index">Articles</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Users</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
    </ul>
    <hr class="d-sm-none">
</div>