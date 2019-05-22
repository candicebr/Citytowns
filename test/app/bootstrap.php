<?php

namespace app;

use app\src\App;
use app\src\ServiceContainer\ServiceContainer;
use Database\Database;
use model\finder\CityFinder;
use model\finder\RestaurantFinder;
use app\src\Response\Response;

$container = new ServiceContainer();

$app = new App($container);


$app->setService('database', new Database(
    "127.0.0.1",
    "citytowns",
    "root",
    "",
    "3306"
));

$app->setService('cityFinder', new CityFinder($app));

$app->setService('restaurantFinder', new RestaurantFinder($app));

$app->setService('render', function (String $template, Array $params = []) {
    ob_start();
    include __DIR__ . '/../view/' . $template . '.php';
    $content = ob_get_contents();
    ob_end_clean(); //Does not send the content of the buffer to the user

    if ($template === '404') {
        $response = new Response($content, 404, ["HTTP/1.0 404 Not Found"]);
        return $response;
    }

    return $content;
});

$routing = new Routing($app);
$routing->setup();


return $app;
