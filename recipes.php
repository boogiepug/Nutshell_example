<?php
function getConnection() {
    try {
        $connection = new PDO("sqlite:".__DIR__."/database/recipes.db");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;

    } catch (Exception $e) {
        throw new Exception ("Connection error". $e->getMessage(), 0, $e);
    }   
}


function getRecipesShort() {
    $database = getConnection();
	try {
        $sql = "select distinct recipes_full.recipe_id, title, servings
        from recipes_full";
        $result = $database->query($sql);
        
        while($item = $result->fetchObject()) {
            addItemInList($item->title, getTags($item->recipe_id), $item->servings, $item->recipe_id);
        }
	}
	catch (Exception $e) {
		throw new Exception("problem: " . $e);
	}
}

//fetching function to match all tags to requested recipe
function getTags($recipe_id) {
    $database = getConnection();
    $sql = "select distinct tags.tag_id, tag
    from tags
    join tags_in_recipe on tags_in_recipe.tag_id = tags.tag_id
    join recipes_full on recipes_full.recipe_id = tags_in_recipe.recipe_id
    where tags_in_recipe.recipe_id = ?";
    
    //Using prepared statement helps preventing malicious usage
    $result = $database->prepare($sql);
    $result->execute([$recipe_id]);
    
    $result = $result->fetchAll();
    $response = "";

    foreach ($result as $record) {
        $response .= "#".$record['tag'] . " ";
    }
    return $response;
}

//fetching function to get all relevant attributes for items on animated track
function getRecipesForTrack() {
    $database = getConnection();
    try {
        $sql = "select recipe_id, title, image from recipes_full";
        $result = $database->query($sql);
	    $recipes = $result->fetchAll();
	    return json_encode($recipes);
    }
    catch(Exception $e){
		throw new Exception("problem: " . $e->getMessage());
    }
}

//Adding products to the list of all recipes
function addItemInList ($name, $tags, $servings, $id) {
    echo <<<PRODUCTLIST
    <li class="recipe-list-item" id="$id">
        $id: $name
        <div class="recipe-list-tags">
        $tags, $servings servings
        </div>
    </li>
PRODUCTLIST;

}

//Adding products to animated track
function addItemOnTrack($title, $photo, $id) {
    echo <<<PRODUCTLIST
    <div class="recipe-scroll-item" id="$id">
        <img src="$photo" alt="$title" class="recipe-scroll-photo" draggable="false"/>
        <div>
            <b>$title</b>
        </div>
    </div>
    PRODUCTLIST;
}
