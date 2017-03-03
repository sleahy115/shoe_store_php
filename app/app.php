<?php
    date_default_timezone_set ("America/Los_Angeles");

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app['debug'] = true;

     use Symfony\Component\HttpFoundation\Request;
     Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig',array('stores'=>Store::getAll()));
    });

    $app->post("/", function() use ($app) {
        $store_name = $_POST['store_name'];
        $new_store = new Store($store_name);
        $new_store->save();
        return $app['twig']->render('index.html.twig', array('stores'=>Store::getAll()));
    });

    $app->get("/delete_all_stores", function() use ($app) {
        Store::deleteAll();
        Brand::deleteAll();
        return $app['twig']->render('index.html.twig', array('stores'=>Store::getAll()));
    });

    $app->get("/update_store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('update_store.html.twig', array('store'=>$store));
    });

    $app->patch("/update_store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $new_name = $_POST['new_name'];
        $store->updateStore($new_name);
        return $app['twig']->render('index.html.twig', array('stores'=>Store::getAll()));
    });

    $app->delete("/delete_store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->deleteStore();
        return $app['twig']->render('index.html.twig', array('stores'=>Store::getAll(), 'store'=>$store));
    });

    $app->get("/add_brand/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('add_brand.html.twig', array('store'=>$store));
    });

    $app->post("/add_brand/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brand_name = $_POST['brand_name'];
        $new_brand = new Brand($brand_name);
        $new_brand->save();
        return $app['twig']->render('add_brand.html.twig', array('store'=>$store, 'brands'=>Brand::getAll()));
    });

    $app->get("/delete_all_brands/{id}", function($id) use ($app) {
        Store::find($id);
        Brand::deleteAll();
        return $app->redirect("/add_brand/".$id);
    });



return $app;
