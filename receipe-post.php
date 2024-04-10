<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'includes/conn.php';

// Retrieve recipe ID from URL parameter
$recipe_id = $_GET['id'];

// Update the popularity of the recipe
$sql_popularity = "UPDATE recipes SET popularity = popularity + 1 WHERE recipe_id = ?";
$stmt_popularity = $conn->prepare($sql_popularity);
$stmt_popularity->bind_param("i", $recipe_id);
$stmt_popularity->execute();

// Retrieve recipe details including the name
$sql_recipe = "SELECT title FROM recipes WHERE recipe_id = ?";
$stmt_recipe = $conn->prepare($sql_recipe);
$stmt_recipe->bind_param("i", $recipe_id);
$stmt_recipe->execute();
$result_recipe = $stmt_recipe->get_result();

// Check if the recipe exists
if ($result_recipe->num_rows > 0) {
    $row_recipe = $result_recipe->fetch_assoc();
    // Assign the recipe name to the $recipe_name variable
    $recipe_name = $row_recipe['title'];
} else {
    // Set a default value if the recipe is not found
    $recipe_name = "Recipe Not Found";
}

include "header.php"; 

?>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Recipe: <?php echo $recipe_name; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <div class="receipe-post-area section-padding-80">

        <!-- Receipe Slider -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="receipe-slider owl-carousel">
                        <?php
                        // Retrieve recipe details from database based on recipe ID
                        $recipe_id = $_GET['id'];
                        $sql = "SELECT recipe_file, recipe_image, recipe_thumbnail FROM recipes WHERE recipe_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $recipe_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            // Output images for the slider
                            echo '<img src="backend/uploads/' . $row['recipe_file'] . '" alt="Recipe File">';
                            echo '<img src="backend/uploads/' . $row['recipe_image'] . '" alt="Recipe Image">';
                            echo '<img src="backend/uploads/' . $row['recipe_thumbnail'] . '" alt="Recipe Thumbnail">';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Receipe Content Area -->
        <div class="receipe-content-area">
            <div class="container">
                <?php
                    // Retrieve recipe details from the database based on recipe ID
                    $recipe_id = $_GET['id'];
                    $sql = "SELECT * FROM recipes WHERE recipe_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $recipe_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="row">';
                            echo '<div class="col-12 col-md-8">';
                            echo '<div class="receipe-headline my-5">';
                            echo '<span>' . $row['created_at'] . '</span>';
                            echo '<h2>' . $row['title'] . '</h2>';
                            echo '<div class="receipe-duration">';
                            echo '<h6>Description: ' . $row['description'] . '</h6>';
                            echo '<h6>Category: ' . $row['category'] . '</h6>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="col-12 col-md-4">';
                            echo '<div class="receipe-ratings text-right my-5">';
                            // echo '<a href="#" class="btn delicious-btn">For Beginners</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="row">';
                            // echo '<div class="col-12 col-lg-8">';
                            // echo '<div class="single-preparation-step d-flex">';
                            // echo '<h4>1.</h4>';
                            // echo '<p>' . $row['instruction'] . '</p>';
                            // echo '</div>';
                            // // Add more preparation steps as needed
                            // echo '</div>';
                            echo '<div class="col-12 col-lg-8">';
        
                            // Split instruction into individual steps
                            $preparation_steps = explode("\n", $row['instruction']);
                            
                            // Iterate over each step to generate HTML markup
                            $step_number = 1;
                            foreach ($preparation_steps as $step) {
                                echo '<div class="single-preparation-step d-flex">';
                                echo '<h4>' . sprintf("%02d", $step_number) . '.</h4>'; // Format the step number with leading zeros
                                echo '<p>' . $step . '</p>';
                                echo '</div>';
                                $step_number++;
                            }
                            
                            echo '</div>'; // Close col-lg-8
                    
                            // Ingredients
                            echo '<div class="col-12 col-lg-4">';
                            echo '<div class="ingredients">';
                            echo '<h4>Ingredients</h4>';
                    
                            // Split ingredients into an array and display each ingredient
                            $ingredients = explode("\n", $row['ingredients']);
                            foreach ($ingredients as $ingredient) {
                                echo '<div class="custom-control custom-checkbox">';
                                echo '<input type="checkbox" class="custom-control-input" id="customCheck' . uniqid() . '">';
                                echo '<label class="custom-control-label" for="customCheck' . uniqid() . '">' . $ingredient . '</label>';
                                echo '</div>';
                            }
                    
                            echo '</div>'; // Close ingredients div
                            echo '</div>'; // Close col-lg-4
                            echo '</div>'; // Close row
                        }
                    }
                ?>

        <div class="row">
            <div class="col-12">
                <div class="section-heading text-left">
                    <h3>Leave a comment</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="contact-form-area">
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <input type="text" class="form-control" id="name" placeholder="Name">
                            </div>
                            <div class="col-12 col-lg-6">
                                <input type="email" class="form-control" id="email" placeholder="E-mail">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" id="subject" placeholder="Subject">
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn delicious-btn mt-30" type="submit">Post Comments</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

<?php include "footer.php"; ?>