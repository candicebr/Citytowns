<!-- ~/php/tp1/view/cities.php -->
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
</head>
<title>Update a restaurant</title>
<body>
<h1>Update a restaurant</h1>

<?php if(isset($params['error'])) {
    echo "
           <p style='color: red'>
            An error has occured, please retry.
           </p>
        ";
} ?>

<form action="/test/handlerUpdateRestaurant.php" method="POST">
    <p>
        <label>Name of the restaurant</label>
        <input type="text" nom="nom" value="<?php if(isset($params['restaurant'])) echo $params['restaurant']['nom']; ?>">
    </p>
    <p>
        <label>Reputation</label>
        <input type="text" reputation="reputation" value="<?php if(isset($params['restaurant'])) echo $params['restaurant']['reputation']; ?>">
    </p>


    <button type="submit">Submit</button>
</form>


</body>
</html>
