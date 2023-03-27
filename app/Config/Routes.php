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
$routes->setDefaultController('Principal');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Principal::index');//Principal Vista

$routes->post('/instrPs', 'Paises::insertar'); //Insertar y Actualizar Pais
$routes->post('/srchPs/(:num)', 'Paises::buscarPais/$1'); //Buscar Pais
$routes->get('/dltPs/(:num)/(:alpha)/(:num)', 'Paises::eliminarResLogic/$1/$2/$3'); //Eliminacion y Restauracion Logica Pais

$routes->post('/instrDpt', 'Departamentos::insertar'); //Insertar y Actualizar Departamentos
$routes->post('/srchDpt/(:num)', 'Departamentos::buscarDepartamento/$1'); //Buscar Departamentos
$routes->get('/dltDpt/(:num)/(:alpha)/(:num)', 'Departamentos::eliminarResLogic/$1/$2/$3'); //Eliminacion y Restauracion Departamentos



$routes->get('/ver-salarios/(:num)', 'Salarios::index/$1');
$routes->get('/salarios-eliminados/(:num)', 'Salarios::eliminados/$1');


$routes->get('/dptoActivos', 'Departamentos::index');
$routes->get('/dptopEliminados', 'Departamentos::eliminados');

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
