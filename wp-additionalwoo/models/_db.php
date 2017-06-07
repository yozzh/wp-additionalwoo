<?php

//For PDO in future;
//На будущее предусмотрена возможность работы c PDO,
//для построения уникальной бизнес логики, а так же
//для преодоления отсутствия поддержки в WordPress'е PDO.
//Естественно в рамках данной задачи это не нужно.

function pdo_log_error($code, $message, $data = NULL){
header('Content-Type: text/html; charset=utf-8');

if (strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false){
$admin_dir = '';
}else{
$admin_dir = 'wp-admin/';
}
die (<<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WordPress &rsaquo; Error</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="{$admin_dir}install.css" type="text/css" />
</head>
<body>
<h1 id="logo"><img alt="WordPress" src="{$admin_dir}images/wordpress-logo.png" /></h1>
<h1>$code</h1>
<p>$message</p>
<p>$data</p>
</body>
</html>

HTML
);

}

if ( !extension_loaded('pdo') ){
pdo_log_error( "Invalid or missing PHP Extensions", 'Your PHP installation appears to be missing the PDO extension which is required for this version of WordPress.' );
}

if (!extension_loaded('pdo_mysql')){
pdo_log_error ('Invalid or missing PDO Driver', "Your PHP installation appears not to have the right PDO drivers loaded. These are required for this version of Wordpress and the type of database you have specified.");
}

/*
 * PDO_DEBUG set this to true to create a list of queries in your database directory that can be used to debug
 */

if(!defined('PDO_DEBUG')){
	define('PDO_DEBUG', false);
}

class WP_PDO extends PDO {
	// My additional methods

}

global $wpdb_pdo;

$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    ];

$wpdb_pdo = new WP_PDO($dsn, DB_USER, DB_PASSWORD, $opt);

global $wpdb;
$wpdb_pdo->prefix = $wpdb->prefix;


//Additional functions for $wpdb
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

?>

