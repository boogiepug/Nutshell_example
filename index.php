<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nushell Apps example project</title> 
	<link href="Nutshell.css" rel="stylesheet">
</head> 
<body class="background">
    
    <div style="display: flex;">
        <div class="recipe-list-container">
            <form action="" class="recipe-list-filter">
                <input type="text" size="30" placeholder="Search for title, tags or ingredients">
                <input type="button" value="Search">
            </form>
            <ul>
                <?php
                    require_once('recipes.php');
                    getRecipesShort();
                ?>
            </ul>
        </div>
    <div>
        <header>
            <h1 class="title">
                Welcome to All Recipes 2.0
            </h1>
            <h2 class="title">
                This is an example application for Nutshell Apps
            </h2>
        </header>
            <div class="recipe-scroll-container">
                <h1 class="title">
                    Try now!!!
                </h1>
                <div class="recipe-scroll">
                    <div class="track">
                        <div class="recipe-scroll-item">
                            <img src="images/banana-oatmeal-cookie.jpg" alt="banana-oatmeal-cookie" class="recipe-scroll-photo"/>
                            <div>
                                <b>Banana oatmeal cookie</b>
                            </div>
                        </div>
                        <div class="recipe-scroll-item">
                            <img src="images/banana-oatmeal-cookie.jpg" alt="banana-oatmeal-cookie" class="recipe-scroll-photo"/>
                            <div>
                                <b>Banana oatmeal cookie</b>
                            </div>
                        </div>
                        <div class="recipe-scroll-item">
                            <img src="images/banana-oatmeal-cookie.jpg" alt="banana-oatmeal-cookie" class="recipe-scroll-photo"/>
                            <div>
                                <b>Banana oatmeal cookie</b>
                            </div>
                        </div>
                        <div class="recipe-scroll-item">
                            <img src="images/banana-oatmeal-cookie.jpg" alt="banana-oatmeal-cookie" class="recipe-scroll-photo"/>
                            <div>
                                <b>Banana oatmeal cookie</b>
                            </div>
                        </div>
                        <div class="recipe-scroll-item">
                            <img src="images/banana-oatmeal-cookie.jpg" alt="banana-oatmeal-cookie" class="recipe-scroll-photo"/>
                            <div>
                                <b>Banana oatmeal cookie</b>
                            </div>
                        </div>
                        <div class="recipe-scroll-item">
                            <img src="images/banana-oatmeal-cookie.jpg" alt="banana-oatmeal-cookie" class="recipe-scroll-photo"/>
                            <div>
                                <b>Banana oatmeal cookie</b>
                            </div>
                        </div>
                        <div class="recipe-scroll-item">
                            <img src="images/banana-oatmeal-cookie.jpg" alt="banana-oatmeal-cookie" class="recipe-scroll-photo"/>
                            <div>
                                <b>Banana oatmeal cookie</b>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>