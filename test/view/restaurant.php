<!-- ~/php/tp1/view/city.php -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
</head>
<title>One restaurant</title>
<body>
<h1>Restaurant <?= $params['restaurant']->getNom(); ?></h1>
<p>
    Name of the restaurant: <?= $params['restaurant']->getNom(); ?>
</p>
<p>
    Reputation: <?= $params['restaurant']->getReputation(); ?>
</p>

<a href="/test/restaurants.php">
    Back to list of restaurants
</a>
<p>
    <a href="/test/updateRestaurant.php">Update</a>
</p>
<p>
    <a href="/test/deleteRestaurants.php">Delete</a>
</p>
</body>
</html>