<!-- ~/php/tp1/view/cities.php -->
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
    </head>
    <title>All Cities</title>
    <body>
    <h1>All Cities</h1>
    <?php if(isset($params['flash'])) {
        echo "
           <p style='color: green'>
            " . $params['flash'] . " 
           </p>
        ";
    } ?>
    <table>
        <?php foreach ($params['cities'] as $city) : ?>
        <tr>
            <td><a href="/test/city/<?php echo $city->getId() ?>"><?=
            $city->getName(); ?></a></td>
            <td><?= $city->getCountry(); ?></td>
            <td>Quality of life: <?= $city->getLife(); ?></td> <!--added property life-->
        </tr>
        
        <?php endforeach; ?>

    </table>
    <p>
        <a href="/test/recherche.php">Search cities by name</a>
    </p>
    <p>
        <a href="/test/create.php">Create a new city</a>
    </p>
    <p>
        <a href="/test/countries.php">Countries</a>
    </p>
    <p>
        <a href="/test/restaurants.php">Restaurants</a>
    </p>


    </body>
</html>