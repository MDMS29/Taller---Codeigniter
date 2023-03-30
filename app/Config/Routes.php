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

$routes->get('/', 'Principal::index'); //Principal Vista
$routes->get('/home', 'Principal::home'); //Principal Vista

$routes->post('/instrPs', 'Paises::insertar'); //Insertar y Actualizar Pais
$routes->post('/srchPs/(:num)', 'Paises::buscarPais/$1'); //Buscar Pais
$routes->get('/dltPs/(:num)/(:alpha)/(:num)', 'Paises::eliminarResLogic/$1/$2/$3'); //Eliminacion y Restauracion Logica Pais

$routes->post('/instrDpt', 'Departamentos::insertar'); //Insertar y Actualizar Departamentos
$routes->post('/srchDpt/(:num)', 'Departamentos::buscarDepartamento/$1'); //Buscar Departamentos
$routes->get('/dltDpt/(:num)/(:alpha)/(:num)', 'Departamentos::eliminarResLogic/$1/$2/$3'); //Eliminacion y Restauracion Departamentos

$routes->post('/instrMncp', 'Municipios::insertar'); //Insertar y Actualizar Municipios
$routes->post('/srchDptMncp/(:num)', 'Municipios::obtenerDepartamentosPais/$1'); //Buscar los Departamentos de un País 
$routes->post('/srchMncpDpt/(:num)', 'Municipios::obtenerMunicipio/$1'); //Buscar los Municipios de un Departamento
$routes->get('/dltMncp/(:num)/(:alpha)/(:num)', 'Municipios::eliminarResLogic/$1/$2/$3'); //Eliminacion y Restauracion Logica Municipios
$routes->post('/srchMncpDpto/(:num)', 'Municipios::obtenerMunicipiosDpto/$1'); //Municipio por Departamento 

$routes->post('/instrCrg', 'Cargos::insertar'); //Insertar y Actualizar Cargos
$routes->post('/srchCrg/(:num)', 'Cargos::buscarCargo/$1'); //Buscar Cargos 
$routes->get('/dltCrg/(:num)/(:alpha)/(:num)', 'Cargos::eliminarResLogic/$1/$2/$3'); //Eliminacion y Restauracion Logica Cargos

$routes->post('/instrEpl', 'Empleados::insertar'); //Insertar y Actualizar Empleados
$routes->post('/srchEpl/(:num)', 'Empleados::buscarEmpleado/$1'); //Buscar Empleado 
$routes->get('/dltEpl/(:num)/(:alpha)/(:num)', 'Empleados::eliminarResLogic/$1/$2/$3'); //Eliminacion y Restauracion Logica Empleados

$routes->post('/instrSala', 'Salarios::insertar'); //Insertar y Actualizar Salarios
$routes->post('/srchSala/(:num)/(:num)', 'Salarios::buscarSalario/$1/$2'); //Buscar Salario 
$routes->get('/dltSala/(:num)/(:num)/(:alpha)/(:num)', 'Salarios::eliminarResLogic/$1/$2/$3/$4'); //Eliminacion y Restauracion Logica Salarios
$routes->get('/ver-salarios/(:num)', 'Salarios::index/$1'); //Vista Principal de Salario - Según el Empleado
$routes->get('/salarios-eliminados/(:num)', 'Salarios::eliminados/$1'); //Vista Salarios Eliminados - Según el Empleado

$routes->post('/instrUsu', 'Usuarios::insertar'); //Insertar y Actualizar Usuarios


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
