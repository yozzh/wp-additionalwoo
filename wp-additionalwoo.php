<?php
/**
 * @package WP-AdditionalWoo
 */
/*
Plugin Name: WP-AdditionalWoo
Plugin URI: https://nodomain.com/
Description: Lorem Ipsum
Version: 0.01.BETA
Author: Wjatcheslav
Author URI: http://nodomain.com/
License: GPLv2 or later
Text Domain: wp-additionalwoo
*/

if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
    die('You are not allowed to call this page directly.');
}
require_once (dirname(__FILE__) . '/wp-additionalwoo.config.php');
global $additionalwoo_db_version;
$additionalwoo_db_version = "0.01";
global $additionalwoo;
$additionalwoo = new AdditionalWoo();

class AdditionalWoo
{
    var $dir, $path, $version, $upgrade_version, $upgrade, $settings, $options_page;

    /*
     * Constructor @description: @since 1.0.0 @created: 06/06/17
     */
    function __construct()
    {
        global $wpdb;

        $this->dir = plugins_url('', __FILE__);
        $this->path = plugin_dir_path(__FILE__);
        $this->version = '0.01.ALPHA';
        $this->upgrade_version = 'nope';
        $this->setup_application();
        register_activation_hook(__FILE__, 'AdditionalWoo::additionalwoo_set_options');
        register_deactivation_hook(__FILE__, 'AdditionalWoo::additionalwoo_unset_options');
    }

    /*
     * setup_controllers @description: @since 1.0.0 @created: 28/01/14
     */
    
    function additionalwoo_set_options()
    {
    /* 
        $CustomModel = new CustomModel();
        $CustomModel = new CustomModel();
        $CustomModel->construct_table();
        $CustomModel->construct_table();
    */
    }

    function additionalwoo_unset_options()
    {
    /*
        $CustomModel = new CustomModel();
        $CustomModel = new CustomModel();
        $CustomModel->destruct_table();
        $CustomModel->destruct_table();
    */
    }

    function myrequire_dir($dir)
    {
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file[0] == '_' && (filetype($dir . $file) == 'file'))
                        require_once ($dir . $file);
                }
                echo $file;
                closedir($dh);
            }
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file[0] !== '_' && $file[0] != '.' && (filetype($dir . $file) == 'file'))
                        require_once ($dir . $file);
                }
                closedir($dh);
            }
        }
    }

    function setup_application()
    {
        // Load models
        $this->myrequire_dir($this->path . 'models/');

        // Load controllers
        $this->myrequire_dir($this->path . 'controllers/');
        $this->settings = new AdditionalWooSettings($this);
    }
}

?>
