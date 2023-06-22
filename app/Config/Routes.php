<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

//Language Settings
$routes->get('/language/setting', 'SettingController::index');
// $routes->get('/language/create', 'SettingController::create');
// $routes->post('/language/create', 'SettingController::create');
$routes->match(['get', 'post'], 'language/create', 'SettingController::create');
$routes->get('/langauge/edit/(:any)', 'SettingController::edit/$1');
$routes->get('/edit/(:any)', 'SettingController::edit/$1');
$routes->post('/language/update', 'SettingController::update');
$routes->get('/delete/(:num)', 'SettingController::delete/$1');

//For language search
$routes->post('/language/search', 'SettingController::languageSearch');

//General Settings
$routes->get('/general/create', 'GeneralController::index');
$routes->post('/general/save', 'GeneralController::create');

//Articles Settings
$routes->get('/article/create', 'ArticleController::show');
$routes->get('/article/save', 'ArticleController::create');
$routes->post('/article/update', 'ArticleController::edit');
$routes->post('/getCategories', 'ArticleController::getCategories');
$routes->get('/article/delete/(:any)', 'ArticleController::delete/$1');

//Category Settings
$routes->get('/category/create','CategoryController::index');
$routes->match(['get', 'post'],'category/save','CategoryController::create');
$routes->get('/category/edit/(:any)', 'CategoryController::edit/$1');
$routes->get('delete/(:any)', 'CategoryController::delete/$1');

// For category search
$routes->post('/category/search', 'CategoryController::search');

// Auto Populate Route
$routes->get('populate/code', 'SettingController::fetchData');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
