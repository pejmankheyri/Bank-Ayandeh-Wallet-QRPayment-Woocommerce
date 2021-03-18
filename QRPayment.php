<?php

/**
 * Plugins main file
 * 
 * PHP version 8.0
 * 
 * @category  PLugins
 * @package   Wordpress
 * @author    Pejman Kheyri <pejmankheyri@gmail.com>
 * @copyright 2021 All rights reserved.
 */

/*
Plugin Name: Bank Ayandeh Wallet QRPayment
Version: 1.0.6
Description: Bank Ayandeh Wallet QRPayment
Author: pejmankheyri@gmail.com
Contributors: pejmankheyri
WC requires at least: 3.0.0
WC tested up to: 5.0.0
*/

if (!defined('ABSPATH')) exit;

if (!defined('WOO_QRPayment_VERSION'))
    define('WOO_QRPayment_VERSION', '1.0.6');

if (!defined('WOO_QRPayment_PLUGIN_PATH'))
    define('WOO_QRPayment_PLUGIN_PATH', plugins_url('', __FILE__));

if (!defined('WOO_QRPayment_PLUGIN_LIB_PATH'))
    define('WOO_QRPayment_PLUGIN_LIB_PATH', dirname(__FILE__) . '/includes');

/**
 * Adding File Resources
 *
 * @return void
 */
function woocommerce_QRPayment()
{
    if (class_exists('WC_Payment_Gateway') && !class_exists('QRPayment') && !function_exists('Woocommerce_Add_QRPayment_Gateway')) {

        add_filter('woocommerce_payment_gateways', 'Woocommerce_Add_QRPayment_Gateway');
        function Woocommerce_Add_QRPayment_Gateway($methods)
        {
            $methods[] = 'QRPayment';
            return $methods;
        }

        include_once WOO_QRPayment_PLUGIN_LIB_PATH . '/qrcode/library/php_qr_code/qrlib.php';
        include_once WOO_QRPayment_PLUGIN_LIB_PATH . '/helper.php';
        include_once WOO_QRPayment_PLUGIN_LIB_PATH . '/class.gateway.php';
    }
}

add_action('plugins_loaded', 'woocommerce_QRPayment');
