<?php
session_start();

// Determine base URL dynamically
$base_dir = dirname(__FILE__);
define('ROOT_DIR', $base_dir);
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$script_name = $_SERVER['SCRIPT_NAME']; // e.g. /intern_research/index.php
$base_path = rtrim(dirname($script_name), '/\\'); // e.g. /intern_research
define('BASE_URL', $protocol . "://" . $host . $base_path . '/');

// Delegate to router
require_once ROOT_DIR . '/config/database.php';
require_once ROOT_DIR . '/core/router.php';

$router = new Router();

// Public Routes
$router->get('/', 'HomeController@index');
$router->get('user/index', 'HomeController@index');
$router->get('user/research', 'UserController@research');
$router->get('user/detail', 'UserController@detail');
$router->get('user/dashboard', 'UserController@dashboard');

// Auth Routes
$router->get('login', 'AuthController@showLogin');
$router->post('login', 'AuthController@login');
$router->get('logout', 'AuthController@logout');

// Admin Routes (Protected)
$router->get('admin/research', 'AdminController@research', array('middleware' => 'admin'));
$router->post('admin/research', 'AdminController@handleCrud', array('middleware' => 'admin'));
$router->get('admin/detail', 'AdminController@detail', array('middleware' => 'admin'));
$router->get('admin/addresearch', 'AdminController@addresearch', array('middleware' => 'admin'));
$router->get('admin/dashboard', 'AdminController@dashboard', array('middleware' => 'admin'));
$router->get('admin/download', 'AdminController@download', array('middleware' => 'admin'));

// Parse URL
$url = isset($_GET['url']) ? $_GET['url'] : '/';

// Set CURRENT_ROUTE for header navbar logic
define('CURRENT_ROUTE', trim($url, '/'));

$router->dispatch($url);
