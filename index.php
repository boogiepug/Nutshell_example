<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nushell Apps example project</title> 
	<link href="Nutshell.css" rel="stylesheet">
    <script src="index.js"></script>
</head> 
<body class="background">
    
    <div style="display: flex;">
        <div class="recipe-list-container">
            <form action="" class="recipe-list-filter">
                <input type="text" size="30" placeholder="Search for title, tags or ingredients">
                <input type="button" value="Search">
            </form>
            <ul>
                <li class="recipe-list-item" id="XD">
                    $name
                    <div class="recipe-list-tags">
                    $tags, $servings servings
                    </div>
                </li>
                <?php
                    require_once('recipes.php');
                    getRecipesShort();
                ?>
            </ul>
        </div>
        <div>
            <header>
                <h1 class="title">
                    Welcome to All Recipes 2.0!
                </h1>
                <h2 class="title">
                    This is an example application for Nutshell Apps
                </h2>
            </header>
            <div class="recipe-full-container" id="recipe_full">
                <h2 class="recipe-full-title" id="title">
                    Click on any recipe
                </h2>
                <div class="recipe-full-subtitle" id="subtitle">
                    All the details will be shown here
                </div>
                <div class="recipe-full-directions" id="directions"> 
                    And all the directions, here!
                </div>
            </div>
            <div class="recipe-scroll-container">
                <h1 class="title">
                    Try now!!
                </h1>
                <div class="recipe-scroll">
                    <div class="track">
                        <?php
                            require_once('recipes.php');
                            $recipes = json_decode(getRecipesForTrack());   
                            for($i = 0; $i < 4; $i++) {
                                addItemOnTrack($recipes[$i]->title, $recipes[$i]->image, $recipes[$i]->recipe_id);
                            } 
                            //images are repeated for smooth transition between animation
                            for($i = 0; $i < 4; $i++) {
                                addItemOnTrack($recipes[$i]->title, $recipes[$i]->image, $recipes[$i]->recipe_id);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>