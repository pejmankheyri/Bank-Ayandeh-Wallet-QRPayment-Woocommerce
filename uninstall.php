<?php

/**
 * Plugins uninstall file
 * 
 * PHP version 8.0
 * 
 * @category  PLugins
 * @package   Wordpress
 * @author    Pejman Kheyri <pejmankheyri@gmail.com>
 * @copyright 2021 All rights reserved.
 */

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
$option_name = 'woocommerce_QRPayment_settings';
 
delete_option($option_name);
 
// for site options in Multisite
delete_site_option($option_name);
 
