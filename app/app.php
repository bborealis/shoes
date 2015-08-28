<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();

    $app['debug']=true;

    $server = 'mysql:host=localhost;dbname=shoestore';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores'=>Store::getAll()));
    });

    $app->post("/stores", function() use ($app) {
        $store = new Store($_POST['name']);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores'=>Store::getAll()));
    });

    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brands = $store->getBrands();
        return $app['twig']->render('store.html.twig', array('store'=>$store, 'brands'=>$brands, 'all_brands' => Brand::getAll()));
    });

    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands'=>Brand::getAll()));
    });

    $app->post("/brands", function() use ($app) {
        $brand = new Brand($_POST['name']);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands'=>Brand::getAll()));
    });

    $app->post("/add_brand", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $store->addBrand($brand);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'stores' => Store::getAll(), 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->get("/store/{id}/edit", function($id) use($app) {
        $store = store::find($id);
        return $app['twig']->render('store_edit.html.twig', array('store' => $store));
    });

    $app->patch("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brands = $store->getBrands();
        $store->update($_POST['name']);
        return $app['twig']->render('store_edit.html.twig', array('store'=> $store, 'brands' => $store->getBrands()));
    });

    $app->delete("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render("stores.html.twig", array('stores'=> Store::getAll()));
    });

    $app->post("/delete_stores", function() use ($app) {
        $GLOBALS['DB']->exec("DELETE FROM stores_brands;");
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig', array('stores'=> Store::getAll()));
    });

    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $stores = $brand->getStores();
        return $app['twig']->render('brand.html.twig', array('stores'=>$stores, 'brand'=>$brand, 'all_stores' => Store::getAll()));
    });

    $app->post("/add_store", function() use ($app) {
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $brand->addStore($store);
        return $app['twig']->render('brand.html.twig', array('brand'=> $brand, 'stores' => Store::getAll(), 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });



    return $app;
?>
