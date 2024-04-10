 <!-- ##### Follow Us Instagram Area Start ##### -->
 <div class="follow-us-instagram">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <h5>Follow Us Instragram</h5>
             </div>
         </div>
     </div>
     <!-- Instagram Feeds -->
     <div class="insta-feeds d-flex flex-wrap">
         <!-- Single Insta Feeds -->
         <div class="single-insta-feeds">
             <img src="img/bg-img/insta1.jpg" alt="">
             <!-- Icon -->
             <div class="insta-icon">
                 <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
             </div>
         </div>

         <!-- Single Insta Feeds -->
         <div class="single-insta-feeds">
             <img src="img/bg-img/insta2.jpg" alt="">
             <!-- Icon -->
             <div class="insta-icon">
                 <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
             </div>
         </div>

         <!-- Single Insta Feeds -->
         <div class="single-insta-feeds">
             <img src="img/bg-img/insta3.jpg" alt="">
             <!-- Icon -->
             <div class="insta-icon">
                 <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
             </div>
         </div>

         <!-- Single Insta Feeds -->
         <div class="single-insta-feeds">
             <img src="img/bg-img/insta4.jpg" alt="">
             <!-- Icon -->
             <div class="insta-icon">
                 <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
             </div>
         </div>

         <!-- Single Insta Feeds -->
         <div class="single-insta-feeds">
             <img src="img/bg-img/insta5.jpg" alt="">
             <!-- Icon -->
             <div class="insta-icon">
                 <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
             </div>
         </div>

         <!-- Single Insta Feeds -->
         <div class="single-insta-feeds">
             <img src="img/bg-img/insta6.jpg" alt="">
             <!-- Icon -->
             <div class="insta-icon">
                 <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
             </div>
         </div>

         <!-- Single Insta Feeds -->
         <div class="single-insta-feeds">
             <img src="img/bg-img/insta7.jpg" alt="">
             <!-- Icon -->
             <div class="insta-icon">
                 <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
             </div>
         </div>
     </div>
 </div>
 <!-- ##### Follow Us Instagram Area End ##### -->

 <!-- ##### Footer Area Start ##### -->
 <footer class="footer-area">
     <div class="container h-100">
         <div class="row h-100">
             <div class="col-12 h-100 d-flex flex-wrap align-items-center justify-content-between">
                 <!-- Footer Social Info -->
                 <div class="footer-social-info text-right">
                     <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                     <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                     <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                     <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                     <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                     <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                 </div>
                 <!-- Footer Logo -->
                 <div class="footer-logo"> 
                     <a href="index.php"><img src="img/core-img/favicon.ico" alt=""></a>
                 </div>
                 <!-- Copywrite -->
                 <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                     Copyright &copy;<script>
                         document.write(new Date().getFullYear());
                     </script> All rights reserved | This site is made with <i class="fa fa-heart-o" aria-hidden="true"></i>
                     <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
             </div>
         </div>
     </div>
 </footer>
 <!-- ##### Footer Area Start ##### -->

 <!-- ##### All Javascript Files ##### -->
 <!-- jQuery-2.2.4 js -->
 <!-- <script src="js/jquery/jquery-2.2.4.min.js"></script> -->
 <!-- Popper js -->
 <!-- <script src="js/bootstrap/popper.min.js"></script> -->
 <!-- Bootstrap js -->
 <!-- <script src="js/bootstrap/bootstrap.min.js"></script> -->
 <!-- All Plugins js -->
 <!-- <script src="js/plugins/plugins.js"></script> -->
 <!-- Active js -->
 <!-- <script src="js/active.js"></script> -->
 <!-- Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
 <!-- All Plugins js -->
 <script src="js/plugins/plugins.js"></script>
 <!-- Active js -->
 <script src="js/active.js"></script>

 <!-- Custom Script -->
 <script>
     $(function() {
         // Owl Carousel
         var owl = $(".owl-carousel");
         owl.owlCarousel({
             items: 1,
             margin: 10,
             loop: true,
             nav: true,
             //Autoplay
            autoplay : 1000,
            stopOnHover : false
         });
     });
     
     function fetchPopularRecipes1() {
         // Clear previous popular recipe cards
         $('#popular-recipe-containers').empty();

         // Send AJAX request to fetch most popular recipes
         $.ajax({
             url: 'backend/fetch_popular_recipes.php', // Replace with the actual URL of your server-side script
             method: 'GET',
             success: function(data) {
                 try {
                     // Attempt to parse the response as JSON
                     var popularRecipes = JSON.parse(data);

                     // Check if parsed data is an array
                     if (Array.isArray(popularRecipes)) {
                         // Loop through each popular recipe
                         popularRecipes.forEach(function(recipe) {
                             // Create HTML elements for popular recipe
                             var recipeHtml = '<div class="col-12 col-sm-6 col-lg-4">' +
                                 '<div class="single-best-receipe-area mb-30">' +
                                 '<img src="backend/uploads/' + recipe.recipe_image + '" alt="Recipe Image">' +
                                 '<div class="receipe-content">' +
                                 '<a href="receipe-post.php?id=' + recipe.recipe_id + '">' +
                                 '<h5>' + recipe.title + '</h5>' +
                                 '</a>' +
                                 '<div class="ratings">';

                             // Assuming you have a rating property in your recipe object
                             for (var i = 0; i < recipe.rating; i++) {
                                 recipeHtml += '<i class="fa fa-star" aria-hidden="true"></i>';
                             }

                             // Assuming you want to display 5 stars in total
                             for (var i = 0; i < (5 - recipe.rating); i++) {
                                 recipeHtml += '<i class="fa fa-star-o" aria-hidden="true"></i>';
                             }

                             recipeHtml += '</div>' +
                                 '</div>' +
                                 '</div>' +
                                 '</div>';

                             // Append the HTML to the container
                             $('#popular-recipe-containers').append(recipeHtml);
                         });
                     } else {
                         console.error('Response from server is not an array:', popularRecipes);
                     }
                 } catch (error) {
                     console.error('Error parsing JSON:', error);
                 }
             },
             error: function(xhr, status, error) {
                 console.error('Error fetching popular recipes:', error);
             }
         });
     }

     // Call the function to fetch and display popular recipes
     fetchPopularRecipes1();
 </script>
 <!-- Custom Script -->
 <!-- <script>
     $(document).ready(function() {
         // Function to fetch and populate locations
         function fetchLocations() {
             $.ajax({
                 url: 'backend/fetch_locations.php', // Replace with the actual URL of your backend script
                 method: 'GET',
                 success: function(data) {
                     try {
                         var locations = JSON.parse(data);
                         // Populate the location dropdown with fetched locations
                         var locationDropdown = $('#location');
                         locationDropdown.empty();
                         locationDropdown.append('<option value="">Select location</option>');
                         locations.forEach(function(location) {
                             locationDropdown.append('<option value="' + location + '">' + location + '</option>');
                         });
                     } catch (error) {
                         console.error('Error parsing JSON:', error);
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Error fetching locations:', error);
                 }
             });
         }

         // Call fetchLocations function on page load
         fetchLocations();

         // Function to fetch categories and populate the dropdown filter
         function fetchCategories() {
             $.ajax({
                 url: 'backend/fetch_categories.php', // URL of the PHP script to fetch categories
                 method: 'GET',
                 success: function(data) {
                     try {
                         var categories = JSON.parse(data);
                         var categorySelect = $('#category');

                         // Clear existing options
                         categorySelect.empty();

                         // Add default option
                         categorySelect.append($('<option>', {
                             value: '',
                             text: 'Select category'
                         }));

                         // Add categories to the dropdown
                         categories.forEach(function(category) {
                             categorySelect.append($('<option>', {
                                 value: category,
                                 text: category
                             }));
                         });
                     } catch (error) {
                         console.error('Error parsing JSON:', error);
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Error fetching categories:', error);
                 }
             });
         }

         // Fetch categories on page load
         fetchCategories();

         // Function to fetch and display most popular recipes
         function fetchPopularRecipes() {
             // Clear previous popular recipe cards
             $('#popular-recipe-containers').empty();

             // Send AJAX request to fetch most popular recipes
             $.ajax({
                 url: 'backend/fetch_popular_recipes.php', // Replace with the actual URL of your server-side script
                 method: 'GET',
                 success: function(data) {
                     try {
                         // Attempt to parse the response as JSON
                         var popularRecipes = JSON.parse(data);

                         // Check if parsed data is an array
                         if (Array.isArray(popularRecipes)) {
                             // Get the container element where we will append the popular recipe cards
                             var popularRecipeContainer = document.getElementById('popular-recipe-containers');

                             // Loop through each popular recipe
                             popularRecipes.forEach(function(recipe) {
                                 // Create elements for popular recipe card
                                 var cardDiv = document.createElement('div');
                                 cardDiv.classList.add('col-md-4');

                                 var cardInnerDiv = document.createElement('div');
                                 cardInnerDiv.classList.add('card', 'mb-4');

                                 var cardImg = document.createElement('img');
                                 cardImg.classList.add('card-img-top');
                                 cardImg.src = 'backend/uploads/' + recipe.recipe_image; // Assuming recipe_image is the image path
                                 cardImg.alt = 'Recipe Image';

                                 var cardBodyDiv = document.createElement('div');
                                 cardBodyDiv.classList.add('card-body');

                                 var cardTitle = document.createElement('h5');
                                 cardTitle.classList.add('card-title');
                                 cardTitle.textContent = recipe.title;

                                 var cardText = document.createElement('p');
                                 cardText.classList.add('card-text');
                                 cardText.textContent = recipe.description;

                                 var viewRecipeBtn = document.createElement('a');
                                 viewRecipeBtn.classList.add('btn', 'btn-secondary');
                                 viewRecipeBtn.href = 'receipe-post.php?id=' + recipe.recipe_id; // Assuming recipe_id is the primary key
                                 viewRecipeBtn.textContent = 'View Recipe';

                                 // Append elements to build the popular recipe card
                                 cardBodyDiv.appendChild(cardTitle);
                                 cardBodyDiv.appendChild(cardText);
                                 cardBodyDiv.appendChild(viewRecipeBtn);
                                 cardInnerDiv.appendChild(cardImg);
                                 cardInnerDiv.appendChild(cardBodyDiv);
                                 cardDiv.appendChild(cardInnerDiv);

                                 // Append the card to the popular recipe container
                                 popularRecipeContainer.appendChild(cardDiv);
                             });
                         } else {
                             console.error('Response from server is not an array:', popularRecipes);
                         }
                     } catch (error) {
                         console.error('Error parsing JSON:', error);
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Error fetching popular recipes:', error);
                 }
             });
         }

         // Call the function to fetch and display popular recipes
         fetchPopularRecipes();

         // Function to fetch and display all recipes with pagination
         function fetchAllRecipes(page, location, category, popularity) {
             // Clear previous recipe cards
             $('#recipe-containers').empty();
             // Send AJAX request to fetch recipes
             $.ajax({
                 url: 'backend/fetch_recipe_data.php', // Replace with the actual URL of your server-side script
                 method: 'GET',
                 data: {
                     page: page,
                     location: location,
                     category: category,
                     popularity: popularity
                 },
                 success: function(data) {
                     // Parse the response data and update the recipe container and pagination links
                 },
                 error: function(xhr, status, error) {
                     console.error('Error fetching recipes:', error);
                 }
             });
         }

         // Function to handle pagination link clicks
         $(document).on('click', '.pagination .page-link', function(e) {
             e.preventDefault();
             var page = $(this).data('page');
             var location = $('#location').val();
             var category = $('#category').val();
             var popularity = $('#popularity').val();
             fetchAllRecipes(page, location, category, popularity); // Fetch recipes for the selected page
         });

         // Function to fetch and display recipes
         function fetchRecipes(page, location, category, popularity) {
             // Clear previous recipe cards
             $('#recipe-containers').empty();
             // Send AJAX request to fetch recipes
             $.ajax({
                 url: 'backend/fetch_recipe_data.php', // Replace with the actual URL of your server-side script
                 method: 'GET',
                 data: {
                     page: page,
                     location: location,
                     category: category,
                     popularity: popularity
                 },
                 success: function(data) {
                     // console.log('Response from server:', data); // Add this line for debugging

                     try {
                         // Attempt to parse the response as JSON
                         var recipes = JSON.parse(data);

                         // Check if parsed data is an array
                         if (Array.isArray(recipes)) {
                             // Get the container element where we will append the recipe cards
                             var recipeContainer = document.getElementById('recipe-containers');

                             // Clear the existing content of the container
                             recipeContainer.innerHTML = '';

                             // Loop through each recipe
                             recipes.forEach(function(recipe) {
                                 // Create elements for recipe card
                                 var cardDiv = document.createElement('div');
                                 cardDiv.classList.add('col-md-4');

                                 var cardInnerDiv = document.createElement('div');
                                 cardInnerDiv.classList.add('card', 'mb-4');

                                 var cardImg = document.createElement('img');
                                 cardImg.classList.add('card-img-top');
                                 cardImg.src = 'backend/uploads/' + recipe.recipe_image; // Assuming recipe_image is the image path
                                 cardImg.alt = 'Recipe Image';

                                 var cardBodyDiv = document.createElement('div');
                                 cardBodyDiv.classList.add('card-body');

                                 var cardTitle = document.createElement('h5');
                                 cardTitle.classList.add('card-title');
                                 cardTitle.textContent = recipe.title;

                                 var cardText = document.createElement('p');
                                 cardText.classList.add('card-text');
                                 cardText.textContent = recipe.description;

                                 var viewRecipeBtn = document.createElement('a');
                                 viewRecipeBtn.classList.add('btn', 'btn-secondary');
                                 viewRecipeBtn.href = 'receipe-post.php?id=' + recipe.recipe_id; // Assuming recipe_id is the primary key
                                 viewRecipeBtn.textContent = 'View Recipe';

                                 // Append elements to build the card
                                 cardBodyDiv.appendChild(cardTitle);
                                 cardBodyDiv.appendChild(cardText);
                                 cardBodyDiv.appendChild(viewRecipeBtn);
                                 cardInnerDiv.appendChild(cardImg);
                                 cardInnerDiv.appendChild(cardBodyDiv);
                                 cardDiv.appendChild(cardInnerDiv);

                                 // Append the card to the recipe container
                                 recipeContainer.appendChild(cardDiv);
                             });
                         } else {
                             console.error('Response from server is not an array:', recipes);
                         }
                     } catch (error) {
                         console.error('Error parsing JSON:', error);
                     }
                 },

                 error: function(xhr, status, error) {
                     console.error('Error fetching recipes:', error);
                 }
             });
         }

         // Event listener for location input
         $('#location').on('input', function() {
             var location = $(this).val();
             var category = $('#category').val();
             var popularity = $('#popularity').val();
             fetchRecipes(1, location, category, popularity); // Fetch recipes for the first page
         });

         // Event listener for category select
         $('#category').on('change', function() {
             var location = $('#location').val();
             var category = $(this).val();
             var popularity = $('#popularity').val();
             fetchRecipes(1, location, category, popularity); // Fetch recipes for the first page
         });

         // Event listener for popularity select
         $('#popularity').on('change', function() {
             var location = $('#location').val();
             var category = $('#category').val();
             var popularity = $(this).val();
             fetchRecipes(1, location, category, popularity); // Fetch recipes for the first page
         });

         // Event listener for pagination links
         $(document).on('click', '.pagination .page-link', function(e) {
             e.preventDefault();
             var page = $(this).data('page');
             var location = $('#location').val();
             var category = $('#category').val();
             var popularity = $('#popularity').val();
             fetchRecipes(page, location, category, popularity); // Fetch recipes for the selected page
         });

         // Initial fetch recipes on page load
         fetchRecipes(1, '', '', '');
     });
 </script> -->
 <script>
     $(document).ready(function() {
         // Function to fetch and populate locations
         function fetchLocations() {
             $.ajax({
                 url: 'backend/fetch_locations.php', // Replace with the actual URL of your backend script
                 method: 'GET',
                 success: function(data) {
                     try {
                         var locations = JSON.parse(data);
                         // Populate the location dropdown with fetched locations
                         var locationDropdown = $('#location');
                         locationDropdown.empty();
                         locationDropdown.append('<option value="">Select location</option>');
                         locations.forEach(function(location) {
                             locationDropdown.append('<option value="' + location + '">' + location + '</option>');
                         });
                     } catch (error) {
                         console.error('Error parsing JSON:', error);
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Error fetching locations:', error);
                 }
             });
         }

         // Call fetchLocations function on page load
         fetchLocations();

         // Function to fetch categories and populate the dropdown filter
         function fetchCategories() {
             $.ajax({
                 url: 'backend/fetch_categories.php', // URL of the PHP script to fetch categories
                 method: 'GET',
                 success: function(data) {
                     try {
                         var categories = JSON.parse(data);
                         var categorySelect = $('#category');

                         // Clear existing options
                         categorySelect.empty();

                         // Add default option
                         categorySelect.append($('<option>', {
                             value: '',
                             text: 'Select category'
                         }));

                         // Add categories to the dropdown
                         categories.forEach(function(category) {
                             categorySelect.append($('<option>', {
                                 value: category,
                                 text: category
                             }));
                         });
                     } catch (error) {
                         console.error('Error parsing JSON:', error);
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Error fetching categories:', error);
                 }
             });
         }

         // Fetch categories on page load
         fetchCategories();

         // Function to fetch and display most popular recipes
         function fetchPopularRecipes() {
             // Clear previous popular recipe cards
             $('#popular-recipe-container').empty();

             // Send AJAX request to fetch most popular recipes
             $.ajax({
                 url: 'backend/fetch_popular_recipes.php', // Replace with the actual URL of your server-side script
                 method: 'GET',
                 success: function(data) {
                     try {
                         // Attempt to parse the response as JSON
                         var popularRecipes = JSON.parse(data);

                         // Check if parsed data is an array
                         if (Array.isArray(popularRecipes)) {
                             // Get the container element where we will append the popular recipe cards
                             var popularRecipeContainer = document.getElementById('popular-recipe-container');

                             // Loop through each popular recipe
                             popularRecipes.forEach(function(recipe) {
                                 // Create elements for popular recipe card
                                 var cardDiv = document.createElement('div');
                                 cardDiv.classList.add('col-md-4');

                                 var cardInnerDiv = document.createElement('div');
                                 cardInnerDiv.classList.add('card', 'mb-4');

                                 var cardImg = document.createElement('img');
                                 cardImg.classList.add('card-img-top');
                                 cardImg.src = 'backend/uploads/' + recipe.recipe_image; // Assuming recipe_image is the image path
                                 cardImg.alt = 'Recipe Image';

                                 var cardBodyDiv = document.createElement('div');
                                 cardBodyDiv.classList.add('card-body');

                                 var cardTitle = document.createElement('h5');
                                 cardTitle.classList.add('card-title');
                                 cardTitle.textContent = recipe.title;

                                 var cardText = document.createElement('p');
                                 cardText.classList.add('card-text');
                                 cardText.textContent = recipe.description;

                                 var viewRecipeBtn = document.createElement('a');
                                 viewRecipeBtn.classList.add('btn', 'btn-secondary');
                                 viewRecipeBtn.href = 'receipe-post.php?id=' + recipe.recipe_id; // Assuming recipe_id is the primary key
                                 viewRecipeBtn.textContent = 'View Recipe';

                                 // Append elements to build the popular recipe card
                                 cardBodyDiv.appendChild(cardTitle);
                                 cardBodyDiv.appendChild(cardText);
                                 cardBodyDiv.appendChild(viewRecipeBtn);
                                 cardInnerDiv.appendChild(cardImg);
                                 cardInnerDiv.appendChild(cardBodyDiv);
                                 cardDiv.appendChild(cardInnerDiv);

                                 // Append the card to the popular recipe container
                                 popularRecipeContainer.appendChild(cardDiv);
                             });
                         } else {
                             console.error('Response from server is not an array:', popularRecipes);
                         }
                     } catch (error) {
                         console.error('Error parsing JSON:', error);
                     }
                 },
                 error: function(xhr, status, error) {
                     console.error('Error fetching popular recipes:', error);
                 }
             });
         }

         // Call the function to fetch and display popular recipes
         fetchPopularRecipes();

        //  // Function to fetch and display all recipes with pagination
        //  function fetchAllRecipes(page, location, category, popularity) {
        //      // Clear previous recipe cards
        //      $('#recipe-container').empty();
        //      // Send AJAX request to fetch recipes
        //      $.ajax({
        //          url: 'backend/fetch_recipe_data.php', // Replace with the actual URL of your server-side script
        //          method: 'GET',
        //          data: {
        //              page: page,
        //              location: location,
        //              category: category,
        //              popularity: popularity
        //          },
        //          success: function(data) {
        //              // Parse the response data and update the recipe container and pagination links
        //          },
        //          error: function(xhr, status, error) {
        //              console.error('Error fetching recipes:', error);
        //          }
        //      });
        //  }

         // Function to handle pagination link clicks
         $(document).on('click', '.pagination .page-link', function(e) {
             e.preventDefault();
             var page = $(this).data('page');
             var location = $('#location').val();
             var category = $('#category').val();
             var popularity = $('#popularity').val();
             fetchAllRecipes(page, location, category, popularity); // Fetch recipes for the selected page
         });

         // Function to fetch and display recipes
            function fetchRecipes(page, location, category, popularity) {
                // Clear previous recipe cards
                $('#recipe-container').empty();
                // Send AJAX request to fetch recipes
                $.ajax({
                    url: 'backend/fetch_recipe_data.php', // Replace with the actual URL of your server-side script
                    method: 'GET',
                    data: {
                        page: page,
                        location: location,
                        category: category,
                        popularity: popularity
                    },
                    success: function(data) {
                        console.log('Response from server:', data); // Add this line for debugging

                        try {
                            // Attempt to parse the response as JSON
                            var recipes = JSON.parse(data);

                            // Check if parsed data is an array
                            if (Array.isArray(recipes)) {
                                // Get the container element where we will append the recipe cards
                                var recipeContainer = document.getElementById('recipe-container');

                                // Clear the existing content of the container
                                recipeContainer.innerHTML = '';

                                // Loop through each recipe
                                recipes.forEach(function(recipe) {
                                    // Create elements for recipe card
                                    var cardDiv = document.createElement('div');
                                    cardDiv.classList.add('col-md-4');

                                    var cardInnerDiv = document.createElement('div');
                                    cardInnerDiv.classList.add('card', 'mb-4');

                                    var cardImg = document.createElement('img');
                                    cardImg.classList.add('card-img-top');
                                    cardImg.src = 'backend/uploads/' + recipe.recipe_image; // Assuming recipe_image is the image path
                                    cardImg.alt = 'Recipe Image';

                                    var cardBodyDiv = document.createElement('div');
                                    cardBodyDiv.classList.add('card-body');

                                    var cardTitle = document.createElement('h5');
                                    cardTitle.classList.add('card-title');
                                    cardTitle.textContent = recipe.title;

                                    var cardText = document.createElement('p');
                                    cardText.classList.add('card-text');
                                    cardText.textContent = recipe.description;

                                    var viewRecipeBtn = document.createElement('a');
                                    viewRecipeBtn.classList.add('btn', 'btn-secondary');
                                    viewRecipeBtn.href = 'receipe-post.php?id=' + recipe.recipe_id; // Assuming recipe_id is the primary key
                                    viewRecipeBtn.textContent = 'View Recipe';

                                    // Append elements to build the card
                                    cardBodyDiv.appendChild(cardTitle);
                                    cardBodyDiv.appendChild(cardText);
                                    cardBodyDiv.appendChild(viewRecipeBtn);
                                    cardInnerDiv.appendChild(cardImg);
                                    cardInnerDiv.appendChild(cardBodyDiv);
                                    cardDiv.appendChild(cardInnerDiv);

                                    // Append the card to the recipe container
                                    recipeContainer.appendChild(cardDiv);
                                });
                            } else {
                                console.error('Response from server is not an array:', recipes);
                            }
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                        }
                    },


                    error: function(xhr, status, error) {
                        console.error('Error fetching recipes:', error);
                    }
                });
            }

            // Event listener for location input
            $('#location').on('input', function() {
                var location = $(this).val();
                var category = $('#category').val();
                var popularity = $('#popularity').val();
                fetchRecipes(1, location, category, popularity); // Fetch recipes for the first page
            });

            // Event listener for category select
            $('#category').on('change', function() {
                var location = $('#location').val();
                var category = $(this).val();
                var popularity = $('#popularity').val();
                fetchRecipes(1, location, category, popularity); // Fetch recipes for the first page
            });

            // Event listener for popularity select
            $('#popularity').on('change', function() {
                var location = $('#location').val();
                var category = $('#category').val();
                var popularity = $(this).val();
                fetchRecipes(1, location, category, popularity); // Fetch recipes for the first page
            });

            // Event listener for pagination links
            $(document).on('click', '.pagination .page-link', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                var location = $('#location').val();
                var category = $('#category').val();
                var popularity = $('#popularity').val();
                fetchRecipes(page, location, category, popularity); // Fetch recipes for the selected page
            });

            // Initial fetch recipes on page load
            fetchRecipes(1, '', '', '');
        });
 </script>
 <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: 'backend/login.php',
                    data: formData,
                    success: function(response) {
                        if (response === 'admin') {
                            window.location.href = 'admin_dashboard.php';
                        } else if (response === 'cook') {
                            window.location.href = 'cook_dashboard.php';
                        } else if (response === 'user') {
                            window.location.href = 'user_dashboard.php';
                        } else {
                            $('#errorMessage').html('<div class="alert alert-danger" role="alert">Incorrect username or password.</div>');
                        }
                    }
                });
            });
        });
    </script>
    <script>
        // $(document).ready(function() {
        //     $('#signupForm').submit(function(event) {
        //         event.preventDefault();
        //         var formData = $(this).serialize();

        //         $.ajax({
        //             type: 'POST',
        //             url: 'backend/signup.php',
        //             data: formData,
        //             success: function(response) {
        //                 if (response === 'success') {
        //                     window.location.href = 'login.php';
        //                 } else {
        //                     $('#errorMessage').html('<div class="alert alert-danger" role="alert">Signup failed. Please try again later.</div>');
        //                 }
        //             }
        //         });
        //     });
        // });
        $(document).ready(function() {
            $('#signupForm').submit(function(event) {
                // Prevent the default form submission behavior
                event.preventDefault();
        
                // Serialize the form data
                var formData = $(this).serialize();
        
                // Send an AJAX request to the backend signup script
                $.ajax({
                    type: 'POST',
                    url: 'backend/signup.php',
                    data: formData,
                    success: function(response) {
                        // Check the response from the server
                        if (response === 'success') {
                            // Redirect to the login page if signup was successful
                            window.location.href = 'login.php';
                        } else {
                            // Display an error message if signup failed
                            $('#errorMessage').html('<div class="alert alert-danger" role="alert">Signup failed. Please try again later.</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX errors, if any
                        console.error('Error:', error);
                        $('#errorMessage').html('<div class="alert alert-danger" role="alert">Signup failed due to an unexpected error. Please try again later.</div>');
                    }
                });
            });
        });
    </script>
    <!-- <script>
        $(document).ready(function() {
            // Function to initialize autocomplete
            function initAutocomplete(selector) {
                $(selector).autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "https://nominatim.openstreetmap.org/search",
                            dataType: "json",
                            data: {
                                q: request.term,
                                format: "json",
                                limit: 5 // Limit number of results
                            },
                            success: function(data) {
                                response($.map(data, function(item) {
                                    return {
                                        label: item.display_name,
                                        value: item.display_name
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 2, // Minimum characters before autocomplete starts
                    appendTo: $(selector).closest('.modal-body') // Append dropdown to modal's content area
                }).autocomplete("widget").addClass("fixed-height");
            }

            // Initialize autocomplete for location fields
            initAutocomplete("#location");
            initAutocomplete("#edit_location");

            // Function to fetch categories and populate the dropdown filter
            function fetchCategories() {
                $.ajax({
                    url: 'backend/fetch_categories.php',
                    method: 'GET',
                    success: function(data) {
                        try {
                            var categories = JSON.parse(data);
                            var categorySelect = $('#category, #edit_category');

                            categorySelect.empty();
                            categorySelect.append($('<option>', {
                                value: '',
                                text: 'Select category'
                            }));

                            categories.forEach(function(category) {
                                categorySelect.append($('<option>', {
                                    value: category,
                                    text: category
                                }));
                            });
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching categories:', error);
                    }
                });
            }

            // Fetch categories on page load
            fetchCategories();

            // Function to fetch recipe details and populate the edit modal
            function populateEditModal(recipeId) {
                $.ajax({
                    url: 'backend/fetch_recipe_details.php',
                    method: 'POST',
                    data: {
                        recipe_id: recipeId
                    },
                    success: function(data) {
                        try {
                            var recipeDetails = JSON.parse(data);

                            $('#edit_recipe_id').val(recipeDetails.recipe_id);
                            $('#edit_title').val(recipeDetails.title);
                            $('#edit_description').val(recipeDetails.description);
                            $('#edit_instruction').val(recipeDetails.instruction);
                            $('#edit_category').val(recipeDetails.category);
                            $('#edit_location').val(recipeDetails.location);

                            // Set image sources
                            $('#edit_recipe_image_preview').attr('src', 'backend/uploads/' + recipeDetails.recipe_image);
                            $('#edit_recipe_thumbnail_preview').attr('src', 'backend/uploads/' + recipeDetails.recipe_thumbnail);

                            // Set file link
                            $('#edit_recipe_file_link').attr('href', 'backend/uploads/' + recipeDetails.recipe_file);

                            // Check file extension to determine if it's an image or a video
                            var fileExtension = recipeDetails.recipe_file.split('.').pop().toLowerCase();
                            if (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png' || fileExtension === 'gif') {
                                // It's an image
                                $('#edit_recipe_file_link').text('View Recipe Image');
                            } else if (fileExtension === 'mp4' || fileExtension === 'avi' || fileExtension === 'mov' || fileExtension === 'wmv') {
                                // It's a video
                                $('#edit_recipe_file_link').text('View Recipe Video');
                            } else {
                                // It's neither an image nor a video
                                $('#edit_recipe_file_link').text('View Recipe File');
                            }

                            // Populate other fields as needed
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching recipe details:', error);
                    }
                });
            }

            // Call the function when the edit modal is shown
            $('#editRecipeModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var recipeId = button.data('recipeid');

                populateEditModal(recipeId);
            });

            // Destroy autocomplete when modal is closed to avoid multiple initializations
            $('#addRecipeModal, #editRecipeModal').on('hidden.bs.modal', function() {
                $("#location, #edit_location").autocomplete("destroy");
            });
        });
    </script> -->
    <script>
        $(document).ready(function() {
            // Function to initialize autocomplete
            function initAutocomplete(selector) {
                $(selector).autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "https://nominatim.openstreetmap.org/search",
                            dataType: "json",
                            data: {
                                q: request.term,
                                format: "json",
                                limit: 5 // Limit number of results
                            },
                            success: function(data) {
                                response($.map(data, function(item) {
                                    return {
                                        label: item.display_name,
                                        value: item.display_name
                                    };
                                }));
                            }
                        });
                    },
                    minLength: 2, // Minimum characters before autocomplete starts
                    appendTo: $(selector).closest('.modal-body') // Append dropdown to modal's content area
                }).autocomplete("widget").addClass("fixed-height");
            }

            // Initialize autocomplete for location fields
            initAutocomplete("#location");
            initAutocomplete("#edit_location");

            // Function to fetch categories and populate the dropdown filter
            function fetchCategories() {
                $.ajax({
                    url: 'backend/fetch_categories.php',
                    method: 'GET',
                    success: function(data) {
                        try {
                            var categories = JSON.parse(data);
                            var categorySelect = $('#category, #edit_category');

                            categorySelect.empty();
                            categorySelect.append($('<option>', {
                                value: '',
                                text: 'Select category'
                            }));

                            categories.forEach(function(category) {
                                categorySelect.append($('<option>', {
                                    value: category,
                                    text: category
                                }));
                            });
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching categories:', error);
                    }
                });
            }

            // Fetch categories on page load
            fetchCategories();

            // Function to fetch recipe details and populate the edit modal
            function populateEditModal(recipeId) {
                $.ajax({
                    url: 'backend/fetch_recipe_details.php',
                    method: 'POST',
                    data: {
                        recipe_id: recipeId
                    },
                    success: function(data) {
                        try {
                            var recipeDetails = JSON.parse(data);

                            $('#edit_recipe_id').val(recipeDetails.recipe_id);
                            $('#edit_title').val(recipeDetails.title);
                            $('#edit_description').val(recipeDetails.description);
                            $('#edit_instruction').val(recipeDetails.instruction);
                            $('#edit_category').val(recipeDetails.category);
                            $('#edit_location').val(recipeDetails.location);

                            // Set image sources
                            $('#edit_recipe_image_preview').attr('src', 'backend/uploads/' + recipeDetails.recipe_image);
                            $('#edit_recipe_thumbnail_preview').attr('src', 'backend/uploads/' + recipeDetails.recipe_thumbnail);

                            // Set file link
                            $('#edit_recipe_file_link').attr('href', 'backend/uploads/' + recipeDetails.recipe_file);

                            // Check file extension to determine if it's an image or a video
                            var fileExtension = recipeDetails.recipe_file.split('.').pop().toLowerCase();
                            if (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png' || fileExtension === 'gif') {
                                // It's an image
                                $('#edit_recipe_file_link').text('View Recipe Image');
                            } else if (fileExtension === 'mp4' || fileExtension === 'avi' || fileExtension === 'mov' || fileExtension === 'wmv') {
                                // It's a video
                                $('#edit_recipe_file_link').text('View Recipe Video');
                            } else {
                                // It's neither an image nor a video
                                $('#edit_recipe_file_link').text('View Recipe File');
                            }

                            // Populate other fields as needed
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching recipe details:', error);
                    }
                });
            }

            // Call the function when the edit modal is shown
            $('#editRecipeModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var recipeId = button.data('recipeid');

                populateEditModal(recipeId);
            });

            // Destroy autocomplete when modal is closed to avoid multiple initializations
            $('#addRecipeModal, #editRecipeModal').on('hidden.bs.modal', function() {
                $("#location, #edit_location").autocomplete("destroy");
            });
        });
    </script>

 </body>

 </html>