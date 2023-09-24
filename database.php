<?php

require_once("recipes.php");

$ingridients_count = 36;
$json = '{
	"title": "Homemade Chicken Enchiladas",
	"description": "These enchiladas are great. Even my 5 year old loves them!",
	"ingredients": [
		{"qty":"1","unit":"tablespoon(s)","item":"olive oil"},
		{"qty":"2","unit":"","item":"cooked chicken breasts"},
		{"qty":"1","unit":"","item":"onion, diced"},
		{"qty":"1","unit":"","item":"green bell pepper, diced"},
		{"qty":"1 1/2","unit":"clove(s)","item":"garlic, chopped"},
		{"qty":"1","unit":"cup(s)","item":"cream cheese"},
		{"qty":"1","unit":"cup(s)","item":"shredded Monterey jack cheese"},
		{"qty":"1","unit":"(15 ounce) can(s)","item":"tomatoe sauce"},
		{"qty":"1","unit":"tablespoon(s)","item":"chilli powder"},
		{"qty":"1","unit":"tablespoon(s)","item":"dried parsley"},
		{"qty":"1","unit":"teaspoon(s)","item":"dried oregano"},
		{"qty":"1/2","unit":"teaspoon(s)","item":"salt"},
		{"qty":"1/2","unit":"teaspoon(s)","item":"ground black pepper"},
		{"qty":"8","unit":"10 inch","item":"flour tortillas"},
		{"qty":"2","unit":"cup(s)","item":"enchilada sauce"},
		{"qty":"1","unit":"cups(s)","item":"Monterey Jack cheese"}

	],
	"directions": [
		"Preheat oven to 350 degrees F (175 degrees C).",
		"Heat olive oil in a skillet over medium heat. Cook and stir chicken, onion, green bell pepper, garlic, cream cheese, and 1 cup Monterey Jack cheese in hot oil until the cheese melts, about 5 minutes. Stir tomato sauce, chili powder, parsley, oregano, salt, and black pepper into the chicken mixture.",
		"Divide mixture evenly into tortillas, roll the tortillas around the filling, and arrange in a baking dish. Cover with enchilada sauce and remaining 1 cup Monterey Jack cheese.",
		"Bake in preheated oven until cheese topping melts and begins to brown, about 15 minutes."
	],
	"prep_time_min": 15,
	"cook_time_min": 20,
	"servings": 8,
	"tags": [ "main dish" ],
	"author": {
		"name": "Mary Kate",
		"url": "http://allrecipes.com/cook/14977239/profile.aspx"
	},
	"image_url": "./images/easy-chicken-enchiladas-sq-010.jpg"
}

'
;

$json = json_decode($json);

function findIngridient($ingridient){
    try {
        $database = getConnection();
        $sql = "select ingridient_id, name from ingridients
        where name='$ingridient'";

        $result = $database->query($sql);
        $result = $result->fetchObject();
        if ($result != false)
            return "$result->ingridient_id";
        else 
            return "X ".$ingridient;
    }
    catch (Exception $e) {
        return "X ".$ingridient;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nushell Apps example project</title> 
	<link href="Nutshell.css" rel="stylesheet">
</head> 
<body class="background">
        <?php
        $database = getConnection();
        $ingridients = $json->ingredients;
        $recipe_id =11;
        // echo "<h1>id     name </h1>";
        foreach($ingridients as $i) {
            $temp = (findIngridient($i->item));
            // $sql = 'INSERT INTO "main"."ingridients_in_recipe"
            // ("recipe_id", "ingridient_id", "quantity", "units")
            // VALUES (:recipe_id, :temp, ":qty", ":unit");';
            // $temp2 = $database->prepare($sql);
            // $temp2->execute([':recipe_id'=>$recipe_id, ':temp'=>$temp, ':unit'=>$i->unit]);
            echo "<h2>$recipe_id, $temp, $i->qty, $i->unit</h2>";
            echo "<div> $i->item </div>";            
        }
        ?>    
</body>
</html>