<?php
function ns_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css',array( $parent_style ), wp_get_theme()->get('Version'));

	wp_register_script( 'child-script', get_stylesheet_directory_uri().'/childscript.js');
	wp_enqueue_script( 'child-script' );
}
add_action( 'wp_enqueue_scripts', 'ns_enqueue_styles' );


function ssws_add_user_data_2_rest() {
	register_rest_field( 'user',
		'_woocommerce_persistent_cart_1',
		array(
			'get_callback'  	=> 'rest_get_user_field',
			'update_callback'   => null,
			'schema'            => null,
		 )
	);
}
add_action( 'rest_api_init', 'ssws_add_user_data_2_rest' );

// Output user social media fields value in REST
// /wp-json/wp/v2/users
function rest_get_user_field( $user, $field_name, $request ) {
	// if (empty($field_name)) {
	if ($field_name = '') {
        return;
    }
	return get_user_meta( $user[ 'id' ], $field_name, true );
}