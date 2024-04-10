<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="cook_dashboard.php">Cook/Chef Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_id'])) { ?>
                <!-- Show logout button if user is logged in -->
                <li class="nav-item">
                    <a class="btn btn-danger ml-2" href="backend/logout.php">Logout</a>
                </li>
            <?php } else { ?>
                <!-- Show login and sign up buttons if user is not logged in -->
                <li class="nav-item">
                    <a class="btn btn-primary ml-2" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-secondary ml-2" href="signup.php">Sign Up</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>