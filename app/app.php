<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Inventory.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=to_do';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/lists", function() use ($app) {
        return $app['twig']->render('items.html.twig', array('lists' => Inventory::getAll()));
    });

        $app->post("/lists", function() use ($app) {
        $inventory = new Inventory($_POST['item']);
        $inventory->save();
        return $app['twig']->render('inventory.html.twig', array('lists' => Inventory::getAll()));
      });

      $app->post("/delete_lists", function() use ($app) {
          Task::deleteAll();
          return $app['twig']->render('index.html.twig');
      });

      return $app;


?>
