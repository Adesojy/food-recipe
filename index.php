<?php include "header.php"; ?>
<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb1.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcumb-text text-center">
                    <h2>Popular Receipies</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Best Receipe Area Start ##### -->
<section class="best-receipe-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <!-- <h3>The best Receipies</h3> -->
                </div>
            </div>
        </div>

        <div class="row" id="popular-recipe-containers">
            <!-- Single Best Receipe Area -->
            <!-- Popular recipe cards will be dynamically added here -->
        </div>
    </div>
</section>
<!-- ##### Best Receipe Area End ##### -->


<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb1.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="breadcumb-text text-center">
                    <h2>All Recipes</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### All Receipe Area Start ##### -->
<section class="best-receipe-area">
    <div class="container">
        <!-- <h2>All Recipes</h2> -->
        <br>
        <br>
        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="location">Location:</label>
                <select class="form-control" id="location">
                    <option value="">Select location</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="category">Category:</label>
                <select class="form-control" id="category">
                    <option value="">Select category</option>
                    <!-- Categories will be dynamically added here -->
                </select>
            </div>
            <div class="col-md-4">
                <label for="popularity">Popularity:</label>
                <select class="form-control" id="popularity">
                    <option value="">Select popularity</option>
                    <option value="most_popular">Most Popular</option>
                    <option value="least_popular">Least Popular</option>
                </select>
            </div>
        </div>
        <!-- Recipe Cards -->
        <div class="row" id="recipe-container">
            <!-- Recipe cards will be dynamically added here -->
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Pagination links will be dynamically added here -->
            </ul>
        </nav>
    </div>
</section>
<!-- ##### All Receipe Area End ##### -->

<!-- ##### Quote Subscribe Area Start ##### -->
<section class="quote-subscribe-adds">
    <div class="container">
        <div class="row align-items-end">
            <!-- Quote -->
            <div class="col-12 col-lg-4">
                <div class="quote-area text-center">
                    <span>"</span>
                    <h4>Nothing is better than going home to family and eating good food and relaxing</h4>
                    <p>John Smith</p>
                    <div class="date-comments d-flex justify-content-between">
                        <div class="date">January 04, 2018</div>
                        <div class="comments">2 Comments</div>
                    </div>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-12 col-lg-4">
                <div class="newsletter-area">
                    <h4>Subscribe to our newsletter</h4>
                    <!-- Form -->
                    <div class="newsletter-form bg-img bg-overlay" style="background-image: url(img/bg-img/bg1.jpg);">
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="Subscribe to newsletter">
                            <button type="submit" class="btn delicious-btn w-100">Subscribe</button>
                        </form>
                        <!--<p>Fusce nec ante vitae lacus aliquet vulputate. Donec sceleri sque accumsan molestie. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.</p>-->
                    </div>
                </div>
            </div>

            <!-- Adds -->
            <div class="col-12 col-lg-4">
                <div class="delicious-add">
                    <img src="img/bg-img/add.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Quote Subscribe Area End ##### -->

<?php include "footer.php"; ?>