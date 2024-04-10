<?php include "header.php"; ?>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb4.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Most Popular Recipes</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- <h2>Recipes</h2> -->
        <!-- Most Popular Recipes -->
        <div class="row mb-4">
            <div class="col-md-12">
                <!-- <h2>Most Popular Recipes</h2> -->
                <!-- Recipe Cards for Most Popular Recipes -->
                <div class="row" id="popular-recipe-container">
                    <!-- Popular recipe cards will be dynamically added here -->
                </div>
            </div>
        </div>
    </div>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb4.jpg);">
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

    <!-- Main Content -->
    <div class="container mt-4">
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
        <!--<h2>All Recipes</h2>-->
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

<?php include "footer.php"; ?>