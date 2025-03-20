<?php

// ----------------------------
// Configuración del entorno
// ----------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de base de datos para desarrollo
// ----------------------------
// Configuración de la base de datos
// ----------------------------
define('DB_HOST', 'localhost');
define('DB_NAME', 'drive_edumetrics');
define('DB_USER', 'root');
define('DB_PASSWORD', '');


// ----------------------------
// Configuración de las rutas
// ----------------------------
define('NAME_APP', 'driver-edumetrics');
define('BASE_HOME', 'http://localhost/' . NAME_APP . '/');
define('BASE_PATH', __DIR__ . '../../');
//define('BASE_HOME', 'https://tecnoescuelagaitan.com/' . NAME_APP . '/');
define('BASE_PATH_COMPONENTS', BASE_PATH . '/components');
define('BASE_STATIC', 'http://' . $_SERVER['SERVER_NAME'] . '/' . NAME_APP . '/');

// Define Rutas Absolutas de Archivos y Directorios
define('SETTINGS_BD', BASE_PATH . 'settings/settingBD.php');

define('UPLOADS_PATH', BASE_HOME . 'uploads/');

define('ACTION_LOGIN', BASE_HOME . 'functions/action_login.php');
define('ASSETS_IMG', BASE_HOME . 'assets/imgs');
define('ASSETS_CSS', BASE_HOME . 'assets/css');
define('ASSETS_JS', BASE_HOME . 'assets/js');
define('FUNCTIONS_PATH', BASE_PATH . 'functions/');
define('ACTIONS_PATH', BASE_PATH . 'actions/');
define('DOWNLOADS_FILE', BASE_HOME . 'actions/download_file.php');
define('CREATE_FOLDER', BASE_HOME . 'actions/create_folder.php');
define('ESTATUS_FOLDER', BASE_HOME . 'actions/estatus_public_folder.php');

// SETTINGS MENU
//define('LINK_ARCHIVOS_COMPARTIDOS', BASE_HOME . 'archivos-compartidos/');
//define('ARCHIVOS_PAPELERA', BASE_HOME . 'archivos-en-papelera/');
define('CLEAR_TRASH', BASE_HOME . 'actions/clean_trash.php');


// -------------------------------
// Lista de Bases Controllers ----
// -------------------------------
define('BASE_CONTROLLER_USER', BASE_PATH . 'controllers/ControllerUser.php');


// ----------------------------
// Configuración de zona horaria
// ----------------------------
date_default_timezone_set('America/Bogota');

// ----------------------------
// Otras configuraciones comunes
// ----------------------------
define('SESSION_TIMEOUT', 3600); // Tiempo de expiración de la sesión en segundos