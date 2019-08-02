<?php

/**
* @package wp-avcst-gtm
* Plugin Name: SEO Toolkit - GTM
* Plugin URI: https://www.github.com/avanciro/wp-avcst-gtm
* Description: This plugin will allow you to add Google Tag Manager code to your WordPress website. This is one of a sister package of SEO Toolkit plugin.
* Version: 0.0.1-beta
* Author: Avanciro
* Author URI: https://www.avanciro.com
* License: GPL-3.0
*/

defined('ABSPATH') or die();

class GoogleTM {

    function register() {
        add_action('wp_head', array($this, 'add_gtm_code'));
    }

    public function add_gtm_code() {
        if ( !isset($_COOKIE['avc_seo_toolkit_dgat']) ):
            echo PHP_EOL;
            echo "\t<!-- Google Tag Manager -->".PHP_EOL;
            echo "\t<script>".PHP_EOL;
            echo "\t(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':".PHP_EOL;
            echo "\tnew Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],".PHP_EOL;
            echo "\tj=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=".PHP_EOL;
            echo "\t'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);".PHP_EOL;
            echo "\t})(window,document,'script','dataLayer','".get_option('avcst_gtm_id')."');".PHP_EOL;
            echo "\t</script>".PHP_EOL;
        endif;
    }

    function activate() {
        add_option('avcst_gtm_id');
    }

    function deactivate() {
        delete_option('avcst_gtm_id');
    }

}

$GoogleTM = new GoogleTM();
$GoogleTM->register();

// HOOKS : ( activate )
register_activation_hook(__FILE__, array($GoogleTM, 'activate'));
register_deactivation_hook(__FILE__, array($GoogleTM, 'deactivate'));

?>