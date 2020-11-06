<?php
/*
Plugin Name: Custom Translations
Description: Merges translations under my-languages on top of those installed.
*/

function my_custom_load_textdomain_hook( $domain = '', $mofile = '' ){
    $basedir = trailingslashit(WP_LANG_DIR);
    $baselen = strlen($basedir);
    // only run this if file being loaded is under WP_LANG_DIR
    if( $basedir === substr($mofile,0,$baselen) ){
        // Our custom directory is parallel to languages directory
        if( $mofile = realpath( $basedir.'../custom-languages/'.substr($mofile,$baselen) ) ){
            load_textdomain( $domain, $mofile );
        }
    }
}

add_action( 'load_textdomain', 'my_custom_load_textdomain_hook', 10, 2 );