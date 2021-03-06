<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/shop', 'Home::loadView/shop');
$routes->get('/product/(:any)', 'Home::loadView/product/$1');

// ADMIN
$routes->add('/adminPage', 'Admins\AdminController::index', ['filter' => 'authGuard']);
$routes->add('/admin', 'Admins\SigninController::index');

// ADMINEDITS
$routes->add('/adminPage/productEdit', 'Admins\AdminController::loadView/productEdit', ['filter' => 'authGuard']);
$routes->add('/adminPage/contactEdit', 'Admins\AdminController::loadView/contactEdit', ['filter' => 'authGuard']);
$routes->add('/adminPage/orderEdit', 'Admins\AdminController::loadView/orderEdit', ['filter' => 'authGuard']);
$routes->add('/adminPage/blogEdit', 'Admins\AdminController::loadView/blogEdit', ['filter' => 'authGuard']);

$routes->add('/adminPage/(:any)', 'Admins\AdminController::$1', ['filter' => 'authGuard']);
$routes->post('/admin/(:any)', 'Admins\SigninController::$1');

// CEST CONTROLLER
$routes->post('/cestController/(:any)', 'CestController::$1');
$routes->add('/cest', 'CestController::index');

// STRIPE CONTROLLER
$routes->get("pay", "PayController::stripe");
$routes->post("payment", "PayController::payment");

// CONTACT CONTROLLER
$routes->post('/contactController/(:any)', 'ContactController::$1');
$routes->get('/contact', 'ContactController::index');




/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
