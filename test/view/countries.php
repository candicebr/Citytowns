<!-- ~/php/tp1/view/cities.php -->
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
            charset=utf-8" />
    </head>
    <title>All Countries</title>
    <body>
    <h1>All Countries</h1>
    <table>
        <?php foreach ($params['countries'] as $country) : ?>
        <tr>
            <td><a href="/test/country.php/<?php echo $country->getCountry() ?>"><?=
            $country->getCountry(); ?></a></td>
        </tr>
        
        <?php endforeach; ?>
    </table>
    </body>
</html>