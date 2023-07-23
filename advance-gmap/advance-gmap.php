<?php
/**
 * Plugin Name: Advance G-Map
 * Description: This is advance google map Elementor addon that provide you all pro features in free.
 * Version:     1.0.0
 * Author:      Shyam Sahani
 * Author URI:  https://sknetking9.blogspot.com/
 * Text Domain: advanced_gmap
 * 
 */


function register_advanced_gmap( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/map-functions.php' );
	$widgets_manager->register( new \Elementor_map_functions() );

}
add_action( 'elementor/widgets/register', 'register_advanced_gmap' );


function register_google_scripts() {
	wp_register_script( 'map-script',"https://polyfill.io/v3/polyfill.min.js?features=default" );
	wp_register_script( 'map',"https://maps.googleapis.com/maps/api/js?key=".get_option("api_key")."&callback=initMap&v=weekly");
}
add_action( 'wp_enqueue_scripts', 'register_google_scripts' );
//include setting file 
require plugin_dir_path( __FILE__ ) . 'widgets/map-settings.php';

