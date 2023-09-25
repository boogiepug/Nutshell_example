<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorisation');
header("Access-Control-Allow-Origin: *");

function getConnection() {
    try {
        $connection = new PDO("sqlite:".__DIR__."/recipes.db");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;

    } catch (Exception $e) {
        throw new Exception ("Connection error". $e->getMessage(), 0, $e);
    }   
}
$db = getConnection();

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$path = str_replace("/API/", "", $path);


$endpoint = "unchanged";

//If URL path has 'directions'
if(strpos($path, "directions/") !== false) {
    http_response_code(200);
    $recipe_id = str_replace("directions/", "", $path);

    //query general recipe attributes and add them to results
    $sql = "SELECT DISTINCT recipe_id, title, description, author, cook_time_min, prep_time_min, image
    FROM recipes_full
    WHERE recipe_id = :recipe_id";

    $result = $db->prepare($sql);
    $result->execute([":recipe_id"=>$recipe_id]);

    $result = $result->fetchObject();
    $response = $result;

    //query directions and add them to the results
    $sql = "SELECT directions_id, direction
    FROM directions
    WHERE directions.recipe_id = :recipe_id";

    $result = $db->prepare($sql);
    $result->execute([":recipe_id"=>$recipe_id]);

    $result = $result->fetchAll();
    $response->directions = $result;
    
    //query ingridients and add them to the results
    $sql = "SELECT name, quantity, units
    FROM ingridients_in_recipe
    JOIN ingridients ON ingridients_in_recipe.ingridient_id = ingridients.ingridient_id
    WHERE recipe_id = :recipe_id";

    $result = $db->prepare($sql);
    $result->execute([":recipe_id"=>$recipe_id]);
    $result = $result->fetchAll();
    $response->ingridients = $result;

    //set results as returning variable
    $endpoint = $response;
}


echo json_encode($endpoint);
return json_encode($endpoint);
