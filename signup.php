<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form action="backend/signup.php" method="post">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" oninput="validatePassword()" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" oninput="validatePassword()" required>
                <span id="password-error" style="color: red;"></span>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role">
                    <option value="recipe_seeker">Recipe Seeker</option>
                    <option value="cook">Cook/Chef</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>            
            <div>
                <p>Already have an account? <a href="login.php">Login Here</a></p>
            </div>
        </form>

    </div>
</body>

<script>
function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var errorElement = document.getElementById("password-error");
    var signupButton = document.getElementById("signup-button");

    if (password != confirmPassword) {
        errorElement.innerHTML = "Passwords do not match";
        signupButton.disabled = true;
    } else {
        errorElement.innerHTML = "";
        signupButton.disabled = false;
    }
}
</script>

</html>
