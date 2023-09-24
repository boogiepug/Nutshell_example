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
            addItemInList($item->title, getTags($item->recipe_id), $item->servings);
        }
	}
	catch (Exception $e) {
		throw new Exception("problem: " . $e);
	}
}

function getTags($recipe_id) {
    $database = getConnection();

    $sql = "select distinct tags.tag_id, tag
    from tags
    join tags_in_recipe on tags_in_recipe.tag_id = tags.tag_id
    join recipes_full on recipes_full.recipe_id = tags_in_recipe.recipe_id
    where tags_in_recipe.recipe_id = $recipe_id";
    
    $result = $database->query($sql);
    $response = "";
    while ($record = $result->fetchObject()) {
        $response .= "#".$record->tag . " ";
    }
    return $response;
}

function getRecipes() {
    $database = getConnection();
	try {
	    //$sql = "select toyID, toyName, catDesc, toyPrice from NTL_special_offers inner join NTL_category on NTL_special_offers.catID = NTL_category.catID order by rand() limit 1";
        $sql = "select * from ingridients";
        $result = $database->query($sql);
	    $recipes = $result->fetchObject();
	    return json_encode($recipes);
	}
	catch (Exception $e) {
		throw new Exception("problem: " . $e->getMessage());
	}
}

function addItemInList ($name, $tags, $servings) {
    echo <<<PRODUCTLIST
<li class="recipe-list-item">
    $name
    <div class="recipe-list-tags">
       $tags, $servings servings
    </div>
</li>
PRODUCTLIST;

}