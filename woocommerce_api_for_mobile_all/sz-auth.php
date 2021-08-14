<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name:       SZ Authentication for WP-API
 * Plugin URI:        https://example.co
 * Description:       Extends the WP REST API using JSON Web Tokens Authentication as an authentication method.
 * Version:           1.2.6
 * Author:            test
 * Author URI:        https://example.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sz-auth
 * Domain Path:       /languages
 */

 /*


http://192.168.170.200:8034/wp-json/wc/v3/products/<product_id>/variations/<id>
http://192.168.170.200:8034/wp-json/wc/v3/products/<product_id>/variations
http://192.168.170.200:8034/wp-json/wc/v3/products/attributes
http://192.168.170.200:8034/wp-json/wc/v3/products/attributes/<attribute_id>/terms
http://192.168.170.200:8034/wp-json/wc/v3/products/categories
http://192.168.170.200:8034/wp-json/wc/v3/products/tags
http://192.168.170.200:8034/wp-json/wc/v3/products/reviews

http://192.168.170.200:8034/wp-json/wc/v3/coupons
http://192.168.170.200:8034/wp-json/wc/v3/customers

http://192.168.170.200:8034/wp-json/wc/v3/orders
http://192.168.170.200:8034/wp-json/wc/v3/orders/<id>

*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
defined( 'WC_ABSPATH' );

require plugin_dir_path(__FILE__) . 'includes/class-sz-auth.php';

function run_sz_auth()
{
    $plugin = new Sz_Auth();
    $plugin->run();
}
run_sz_auth();


//USER LOGIN
//http://192.168.170.200:8034/wp-json/sz-auth/v1/user_login?username=admin&password=admin@123
add_action('rest_api_init', function () {
    register_rest_route('sz-auth/v1', 'user_login', array(
        'methods' => 'GET',
        'callback' => 'checkuser',
        'permission_callback' => function (WP_REST_Request $request) {
            return true;
        }      
    ));
});
function checkuser($request)
{
    // http://devdomain:8034/wp-json/sz-auth/v1/user_login?username=admin&password=admin@123

    // $identifier = get_query_var( 'identifier' );
    // return $identifier;

    // $username = $request->get_param( 'username' );
    // $user = get_user_by( 'login', $username );
    // if ( $user ) {
    //     $user_id = $user->ID;
    // } else {
    //     $user_id = false;
    // }
 
    $data = array();
    $data['user_login'] = $request["username"];
    $data['user_password'] =  $request["password"];
    $data['remember'] = true;
    $user = wp_signon( $data, false );

    // return $data;
    $result = array();
    if ( !is_wp_error($user) ){
        $result['userdata'] = $user;
        $result['success'] =true;
        $result['status']=200;
    }
    else
    {
        $result['status']=201;
        $result['success'] =false;
        $result['message'] ="Incorrect Username or Password !!";
    }
        // $result = array(
        //     'success' => true,
        //     'request' => $parameters,
        //     'count' => count($posts),
        //     'posts' => $posts,
        // );

        return new WP_REST_Response($result, 200);
}

//USER REGISTERATION
/* http://192.168.170.200:8034/wp-json/sz-auth/v1/register?
    oauth_consumer_key=ck_6e5c3923235ecc74b5e5e3c3400a4741bc07b34c&
    oauth_nonce=E6SaakKwKl9&
    oauth_signature=8FTfonLVGQk411BZq14Joiy9WPOMAZT2T4QQRTLrREE%3D&
    oauth_signature_method=HMAC-SHA256&
    oauth_timestamp=1627102899&
    oauth_version=1.0&
    newusername=admin&
    newpassword=admin@123&
    newemail=deepa.r@osoftz.com&
    firstname=deepa&
    lastname=ramakrishnan&
    city=salem&
    gender=female */

add_action('rest_api_init', function () {
    register_rest_route('sz-auth/v1', 'register', array(
        'methods' => 'GET',
        'callback' => 'reguser',
        'permission_callback' => function (WP_REST_Request $request) {
            return true;
        }      
    ));
});

function reguser($param) {
    // ADD NEW CUSTOMER USER TO WORDPRESS
    // ----------------------------------
    // Put this file in your Wordpress root directory and run it from your browser.
    // Delete it when you're done.
    require_once('wp-blog-header.php');
    require_once('wp-includes/registration.php');

    // ----------------------------------------------------
    // CONFIG VARIABLES
    $newusername = $param['newusername'];
    $newpassword = $param['newpassword'];
    $newemail = $param['newemail'];
    $firstname = $param['firstname'];
    $lastname = $param['lastname'];    
    $billing_city = $param['billing_city'];
    $gender = $param['gender'];      
            
    // ----------------------------------------------------
    // This is just a security precaution 
    // if ( $newpassword != 'YOURPASSWORD' && $newemail != 'YOUREMAIL@TEST.com' && $newusername !='YOURUSERNAME' )
    if ( $newemail != 'YOUREMAIL@TEST.com' && $newusername !='YOURUSERNAME' )
    {
        if ( !username_exists($newusername) && !email_exists($newemail) )            // Check that user doesn't already exist 
        {
            $user_id = wp_create_user( $newusername, $newpassword, $newemail);                // Create user and set role to administrator

            if ( is_int($user_id) )
            {
                $wp_user_object = new WP_User($user_id);
                $wp_user_object->set_role('customer');

                $usermetas = array( 
                    'nickname'      => $firstname,
                    'first_name'    => $firstname, 
                    'last_name'     => $lastname ,
                    'billing_city'  => $billing_city ,
                    'gender'        => $gender
                );

                foreach($usermetas as $key => $value) {
                    update_user_meta( $user_id, $key, $value );
                }
                // update_user_meta( $user_id, "first_name",  $param['firstname']) ;
                echo 'Successfully created new customer user. Now delete this file!';
            }
            else {
                echo 'Error with wp_insert_user. No users were created.';
            }
        }
        else {
            echo 'This user or email already exists. Nothing was done.';
        }
    }
    else {
        echo 'Whoops, looks like you did not set a password, username, or email';
        echo 'before running the script. Set these variables and try again.';
    }
}
    
//RECENT PRODUCTS
//http://devdomain:8034/wp-json/sz-auth/v1/recent_product
add_action('rest_api_init', function () {
    register_rest_route('sz-auth/v1', 'recent_product', array(
        'methods' => 'GET',
        'callback' => 'recentproduct',
        'permission_callback' => function (WP_REST_Request $request) {
            return true;
        }      
    ));
});
function recentproduct($request)
{
    $args = array(
        'post_type' => 'product',
        'stock' => 1,
        'posts_per_page' => 4,
        'orderby' =>'date',
        'order' => 'DESC' );
        $productloop = new WP_Query( $args );

        $result = array(); 
        $result['recentdata'] = $productloop;
        $result['success'] =true;
        $result['status']=200;

    // return $data;
        return new WP_REST_Response($result, 200);
}

/********************** View cart product api **********************/
/* http://192.168.170.200:8034/wp-json/sz-auth/v1/cart?
oauth_consumer_key=ck_6e&
oauth_nonce=fzi0ywUyowF&
oauth_signature=cNdMSVHc&
oauth_signature_method=HMAC-SHA256&
oauth_timestamp=1626842706&
oauth_version=1.0&
user_id=3 */

add_action( 'rest_api_init', function () {
    register_rest_route( 'sz-auth/v1', 'cart', array( //wp/v2
        'methods' => array('GET','POST'),
        'callback' => 'viewcart',
    ) );
} );

function viewcart($request){
    // var_dump($request);
    global $woocommerce,$wpdb;
    wp_set_current_user($request['user_id']);
    wp_set_auth_cookie($request['user_id']);
    $user = wp_get_current_user();
    $meta_key='_woocommerce_persistent_cart_1';
 
    $usermeta=get_user_meta($request['user_id'],$meta_key,true);
    if ( $usermeta ) {
        $result = array();
        if($usermeta){
            $carttot=0;
            foreach($usermeta["cart"] as $key => $val) {
                // var_dump($val);
                foreach($val as $k => $v) {
                    if ($k=="quantity"){
                        $carttot += $v;
                    }
                }
            }

            if ( !is_wp_error($user) ){
                $result['cartdata'] = $usermeta["cart"];
                $result['carttotal'] = $carttot;        
                $result['success'] =true;
                $result['status']=200;
            }
            else
            {
                $result['status']=201;
                $result['success'] =false;
                $result['message'] ="Incorrect Value Passed !!";
            }
        }
    }
    // return  $carttot ;
    return new WP_REST_Response($result, 200);
}


/***********************  Add to cart product api ***********************/               

// https://www.forumming.com/question/159/add-products-to-user-39-s-id-woocommerce  -   wrong
// https://stackoverflow.com/questions/61941359/rest-api-to-store-products-in-cart-based-on-the-user-id-in-woocommerce

// http://192.168.170.200:8034/wp-json/sz-auth/v1/woocomm_add_to_cart?user_id=3&products=[{product_id:26,quantity:5},{product_id:47,quantity:2}]
add_action( 'rest_api_init', function () {
    register_rest_route( 'sz-auth/v1', 'woocomm_add_to_cart', array( //wp/v2
        'methods' => array('GET','POST'),
        'callback' => 'woocomm_add_to_cart',
    ) );
} );
 
function woocomm_add_to_cart($param) {

    global $woocommerce,$wpdb;
    
    // Load cart functions which are loaded only on the front-end.
    include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
    include_once WC_ABSPATH . 'includes/class-wc-cart.php';

    if ( is_null( WC()->cart ) ) {
        wc_load_cart();
    }

    // if ( is_null( WC()->customer ) || ! WC()->customer instanceof WC_Customer ) {
    // 	$customer_id = strval( get_current_user_id() );

    // 	WC()->customer = new WC_Customer( $customer_id, true );

    // 	// Customer should be saved during shutdown.
    // 	add_action( 'shutdown', array( WC()->customer, 'save' ), 10 );
    // }

    if ( is_null( WC()->cart ) || !  WC()->instance()->cart ) {
        WC()->session = new WC_Session_Handler();
        WC()->session->init();
        WC()->customer = new WC_Customer( get_current_user_id(), true );
        WC()->cart = new WC_Cart();
    }

    $user_id = $param['user_id'];
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
 
    $user = wp_get_current_user();

    $objProduct = new WC_Session_Handler();
    $wc_session_data = $objProduct->get_session($user_id);
    $full_user_meta = get_user_meta($user_id,'_woocommerce_persistent_cart_1',true);    // Get the persistent cart may be _woocommerce_persistent_cart can be in your case check in user_meta table
    $cartObj = new WC_Cart();    // create new Cart Object
    
    // if($full_user_meta['cart']) {                           // Add old cart data to newly created cart object
    //         // echo "###0 : ";
    //         // var_dump($full_user_meta['cart']);        
    //     foreach($full_user_meta['cart'] as $sinle_user_meta) {
    //         $cartObj->add_to_cart( $sinle_user_meta['product_id'], $sinle_user_meta['quantity']  );
    //         echo "###1 : ";
    //         var_dump($sinle_user_meta);
    //     }
    // }

    $products = json_decode($param['products'], true);

    if($products){                               // Add product and quantities coming in request to the new cart object
        foreach($products as $prod) {
            $cartObj->add_to_cart( $prod['product_id'], $prod['quantity']  );
        }
    }

    $updatedCart = [];
    foreach($cartObj->cart_contents as $key => $val) {
        unset($val['data']);
        $updatedCart[$key] = $val;
    }
    
    if($wc_session_data) {                                // If there is a current session cart, overwrite it with the new cart
        $wc_session_data['cart'] = serialize($updatedCart);
        $serializedObj = maybe_serialize($wc_session_data);
    
        $table_name = 'wp_woocommerce_sessions';
        $sql ="UPDATE $table_name SET 'session_value'= '".$serializedObj."', WHERE  'session_key' = '".$user_id."'";        // Update the wp_session table with updated cart data
        $rez = $wpdb->query($sql);                  // Execute the query
    }

    $full_user_meta['cart'] = $updatedCart;             // Overwrite the persistent cart with the new cart data
    update_user_meta($user_id, '_woocommerce_persistent_cart_1', $full_user_meta);
    
    $response = [
        // 'carttotal' => viewcart($user_id),
        'status' => true,
        'message' => 'Products successfully added to cart'
    ];
    
    return rest_ensure_response($response);
}
  

/*********************** Empty Cart ***********************/               

// http://192.168.170.200:8034/wp-json/sz-auth/v1/empty_cart

add_action( 'rest_api_init', function () {
    register_rest_route( 'sz-auth/v1', 'empty_cart', array(
        'methods' => array('GET','POST'),
        'callback' => 'woocommerce_clear_cart_url',
    ) );
} );

function woocommerce_clear_cart_url($request) {

    global $woocommerce, $wpdb;

    // Load cart functions which are loaded only on the front-end.
    include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
    include_once WC_ABSPATH . 'includes/class-wc-cart.php';

    if ( is_null( WC()->cart ) ) {
        wc_load_cart();
    }

    // if ( is_null( WC()->customer ) || ! WC()->customer instanceof WC_Customer ) {
    // 	$customer_id = strval( get_current_user_id() );

    // 	WC()->customer = new WC_Customer( $customer_id, true );

    // 	// Customer should be saved during shutdown.
    // 	add_action( 'shutdown', array( WC()->customer, 'save' ), 10 );
    // }

    if ( is_null( WC()->cart ) || !  WC()->instance()->cart ) {
        WC()->session = new WC_Session_Handler();
        WC()->session->init();
        WC()->customer = new WC_Customer( get_current_user_id(), true );
        WC()->cart = new WC_Cart();
    }
    
    $user=$request['user_id'];  

    wp_set_current_user($user);
    wp_set_auth_cookie($user);

        WC()->cart->empty_cart(); 

}



/************************************  ######TEST######  ********************** */
  
add_action( 'rest_api_init', function () {
    register_rest_route( 'sz-auth/v1', 'checkout', array(
        'methods' => array('GET','POST'),
        'callback' => 'create_checkout_order',
    ) );
} );

// add_action('woocommerce_checkout_process', 'create_vip_order');

function create_checkout_order($request) {

    global $woocommerce, $wpdb;

    // Load cart functions which are loaded only on the front-end.
    include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
    include_once WC_ABSPATH . 'includes/class-wc-cart.php';

    if ( is_null( WC()->cart ) ) {
        wc_load_cart();
    }

    // if ( is_null( WC()->customer ) || ! WC()->customer instanceof WC_Customer ) {
    // 	$customer_id = strval( get_current_user_id() );

    // 	WC()->customer = new WC_Customer( $customer_id, true );

    // 	// Customer should be saved during shutdown.
    // 	add_action( 'shutdown', array( WC()->customer, 'save' ), 10 );
    // }

    if ( is_null( WC()->cart ) || !  WC()->instance()->cart ) {
        WC()->session = new WC_Session_Handler();
        WC()->session->init();
        WC()->customer = new WC_Customer( get_current_user_id(), true );
        WC()->cart = new WC_Cart();
    }
    
    $user=$request['user_id'];  
    $product_id=$request['product_id'];  

    wp_set_current_user($user);
    wp_set_auth_cookie($user);

  $address = array(
      'first_name' => '111Joe',
      'last_name'  => 'Conlin',
      'company'    => 'Speed Society',
      'email'      => 'joe@testing.com',
      'phone'      => '760-555-1212',
      'address_1'  => '123 Main st.',
      'address_2'  => '104',
      'city'       => 'San Diego',
      'state'      => 'Ca',
      'postcode'   => '92121',
      'country'    => 'US'
  );

  // Now we create the order
  $order = wc_create_order();

  // The add_product() function below is located in /plugins/woocommerce/includes/abstracts/abstract_wc_order.php
  $order->add_product( get_product($product_id), 1); // This is an existing SIMPLE product
  $order->set_address( $address, 'billing' );
  //
  $order->calculate_totals();
  $order->update_status("Completed", 'Imported order', TRUE);  
}

/*************** */
  
  
