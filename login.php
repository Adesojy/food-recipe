<?php include "header.php"; ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb4.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcumb-text text-center">
                    <h2>Login</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- Main Content -->
<div class="container mt-4">
    <form id="loginForm">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <!-- Error Messages -->
        <div id="errorMessage"></div>
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Login</button>
        <div>
            <p>Don't have an account? <a href="signup.php">Sign Up Here</a></p>
        </div>
    </form>
</div>

<?php include "footer.php"; ?>