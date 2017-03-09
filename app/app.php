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
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/store_list", function() use ($app) {
        return $app['twig']->render('store_list.html.twig', array('stores'=>Store::getAll()));
    });

    $app->post("/store_list", function() use ($app) {
        $store_name = $_POST['store_name'];
        $new_store = new Store($store_name);
        $new_store->save();
        return $app['twig']->render('store_list.html.twig', array('stores'=>Store::getAll()));
    });

    $app->get("/brand_list", function() use ($app) {
        return $app['twig']->render('brand_list.html.twig', array('brands'=>Brand::getAll()));
    });

    $app->post("/brand_list", function() use ($app) {
        $brand_name = $_POST['brand_name'];
        $new_brand = new Brand($brand_name);
        $new_brand->save();
        return $app['twig']->render('brand_list.html.twig', array( 'brands'=>Brand::getAll()));
    });

    $app->get("/delete_all_stores", function() use ($app) {
        Store::deleteAll();
        Brand::deleteAll();
        return $app->redirect("/");
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

    $app->get("/add_brand_to_store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brands_by_store = $store->getBrands();
        return $app['twig']->render('add_brand.html.twig', array('store'=>$store, 'brands'=>Brand::getAll(), 'brands_by_store'=>$brands_by_store));
    });

    $app->post("/add_brand_to_store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brand_id =$_POST['brand_id'];
        $brand = Brand::find($brand_id);
        $store->addBrands($brand);
        $brands_by_store = $store->getBrands();
        return $app['twig']->render('add_brand.html.twig', array('store'=>$store, 'brands'=> Brand::getAll(), 'brands_by_store'=> $brands_by_store));
    });

    $app->get("/add_store_by_brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $stores_by_brand = $brand->getStores();
        return $app['twig']->render('add_store.html.twig', array('brand'=>$brand, 'stores'=>Store::getAll(), 'stores_by_brand'=>$stores_by_brand));
    });

    $app->post("/add_store_by_brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $store_id =$_POST['store_id'];
        $store = Store::find($store_id);
        $brand->addStore($store);
        $stores_by_brand = $brand->getStores();
        return $app['twig']->render('add_store.html.twig', array('brand'=>$brand, 'stores'=> Store::getAll(), 'stores_by_brand'=> $stores_by_brand));
    });

    $app->get("/delete_all_brands", function() use ($app) {;
        Brand::deleteAll();
        return $app->redirect("/");
    });
    $app->get("/delete_all_stores/{id}", function($id) use ($app) {;
        $store = Store::find($id);
        Store::DeleteStoreByBrand($store);
        return $app->redirect("/");
    });
    $app->delete("/delete_all_stores/{id}", function($id) use ($app) {;
        $store = Store::find($id);
        Store::DeleteStoreByBrand($store);
        return $app->redirect("/");
    });


return $app;
