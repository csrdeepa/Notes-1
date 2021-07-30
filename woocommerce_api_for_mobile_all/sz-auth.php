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
    // Make sure that you set these before running the file.
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


/* View cart product api */
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

function viewcart($request)
{
    // var_dump($request);
    global $woocommerce,$wpdb;
    wp_set_current_user($request['user_id']);
    wp_set_auth_cookie($request['user_id']);
    $user = wp_get_current_user();
 
    $usermeta=get_user_meta($request['user_id'],'_woocommerce_persistent_cart_1',true);

    $carttot=0;
    foreach($usermeta["cart"] as $key => $val) {
        // var_dump($val);
        foreach($val as $k => $v) {
            if ($k=="quantity"){
                $carttot += $v;
            }
        }
      }

    $result = array();
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
    // return  $carttot ;
    return new WP_REST_Response($result, 200);

 
}

/* Add to cart */
/* Add to cart product api */
add_action( 'rest_api_init', function () {
    register_rest_route( 'sz-auth/v1', 'add_to_cart_product1', array(
        'methods' => array('GET','POST'),
        'callback' => 'add_to_cart_product1',
    ) );
} );
 

function add_to_cart_product1($request)
{
    global $woocommerce,$wpdb;

    /* Required Parameters
    $_POST['user_id']
    $_POST['product_id'] */

    // $pid=79;
    // $qty=33;
    // $user=3;   

    $pid=$request['product_id'];
    $qty=$request['quantity'];
    $user=$request['user_id'];  

    wp_set_current_user($pid);
    wp_set_auth_cookie($user);

 
    $array = $wpdb->get_results("select meta_value from ".$wpdb->prefix."usermeta where meta_key='_woocommerce_persistent_cart_1' and user_id = ".$user);
    $data =$array[0]->meta_value;
    $cart_data=unserialize($data);

    $flag = 0;
    foreach($cart_data['cart'] as $key => $val) {
        //$_product = $val['data'];
        if($val['product_id'] != $pid){
            $flag = 1;
        }
        elseif($val['product_id'] == $pid) {
            $flag = 2;

        }
    }
    if($flag == 2){
        // $cart_data['cart'][$key]['quantity']++;
        $cart_data['cart'][$key]['quantity']=$qty;
        echo "Already exists";
    }
    else{
        echo "New Products";
        // $string = $woocommerce->cart->generate_cart_id( $pid, 0, array(), $cart_data['cart'] );
         $string = 'vccvcxvcxvcxvcxvxcvcxvcxvcxdfdsf4234234';
        $product = wc_get_product( $pid);
        $cart_data['cart'][$string] = array(
            'key' => $string,
            'product_id' => $pid,
            'variation_id' => 0,
            'variation' => array(),
            'quantity' => $qty,
            'line_tax_data' => array(
                'subtotal' => array(),
                'total' => array()
            ),
            'line_subtotal' => $product->get_price(),
            'line_subtotal_tax' => 0,
            'line_total' => $product->get_price(),
            'line_tax' => 0,
        );



    //echo "<pre>";
    //print_r($cart_data);
    //exit;
    //$serialize_data = serialize($cart_data);
    //$woocommerce->cart->add_to_cart( $pid );
    update_user_meta($user,'_woocommerce_persistent_cart_1',$cart_data);
    // return cart_items(); // API response whatever you want

    }
 
    $carttot="";
    // $carttot=count(WC()->cart->get_cart());
    return $carttot;

}

/************************************  ######TEST######  ********************** */
function my_awesome_func($data)
{
    // $identifier = get_query_var( 'identifier' );
    // return $identifier;
    return "Deepa $$$$$$!";
}

add_action('rest_api_init', function () {
    register_rest_route('sz-auth/v1', 'test', array(
        'methods' => 'GET',
        'callback' => 'my_awesome_func',
        // 'permission_callback' => function ($request) {
        //         if (current_user_can('edit_others_posts'))
        //         return true;
        //     }        
    ));
});


function addtocarttocustomer($data)
{
    // $identifier = get_query_var( 'identifier' );
    // return $identifier;

    $pid=195;
    $qty=25;

    return "Deepa $$$$$$!";
}

add_action('rest_api_init', function () {
    register_rest_route('sz-auth/v1', 'addtocart', array(
        'methods' => 'GET',
        'callback' => 'addtocarttocustomer',
        // 'permission_callback' => function ($request) {
        //         if (current_user_can('edit_others_posts'))
        //         return true;
        //     }        
    ));
});


// add_action('rest_api_init', function () {
//     register_rest_route('sz-auth/v1', 'foruser', array(
//         'methods' => 'GET',
//         'callback' => 'addtocart',
//     ));
// });

// function addtocart() {
//     defined( 'WC_ABSPATH' ) || exit;

//     // Load cart functions which are loaded only on the front-end.
//     include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
//     include_once WC_ABSPATH . 'includes/class-wc-cart.php';

//     if ( is_null( WC()->cart ) ) {
//         wc_load_cart();
//     }

//     // I'm simply returning the cart item key. But you can return anything you want...
//     return WC()->cart->add_to_cart(15);
   
// }


/* Add to cart product api */
add_action( 'rest_api_init', function () {
    register_rest_route( 'sz-auth/v1', 'add_to_cart_product', array( //wp/v2
        'methods' => array('GET','POST'),
        'callback' => 'add_to_cart_product',
    ) );
} );

function add_to_cart_product(){
    global $woocommerce,$wpdb;

    wp_set_current_user($_POST['user_id']);
    wp_set_auth_cookie($_POST['user_id']);

    /* Required Parameters
    $_POST['user_id']
    $_POST['product_id'] */
    $pid=221;
    $qty=33;
    $user=3;   


    // $array = $wpdb->get_results("select meta_value from ".$wpdb->prefix."usermeta where meta_key='_woocommerce_persistent_cart_1' and user_id = ".$_POST['user_id']);
    $array = $wpdb->get_results("select meta_value from ".$wpdb->prefix."usermeta where meta_key='_woocommerce_persistent_cart_1' and user_id = ".$user );   
    $data =$array[0]->meta_value;
    $cart_data=unserialize($data);

    $flag = 0;
    foreach($cart_data['cart'] as $key => $val) {
        //$_product = $val['data'];
        if($val['product_id'] != $pid){
            $flag = 0;
        }
        elseif($val['product_id'] == $pid) {
            $flag = 2;

        }
    }
    if($flag == 2){
        $cart_data['cart'][$key]['quantity']++;
        $cart_data['cart'][$key]['quantity']++;
    }
    else{


        $string = $woocommerce->cart->generate_cart_id( $pid, 0, array(), $cart_data['cart'] );
        $product = wc_get_product( $pid );
        $cart_data['cart'][$string] = array(
            'key' => $string,
            'product_id' =>$pid,
            'variation_id' => 0,
            'variation' => array(),
            'quantity' => $qty,
            'line_tax_data' => array(
                'subtotal' => array(),
                'total' => array()
            ),
            // 'line_subtotal' => $product->get_price(),
            // 'line_subtotal_tax' => 0,
            // 'line_total' => $product->get_price(),
            // 'line_tax' => 0,
        );
    }

    //echo "<pre>";
    //print_r($cart_data);
    //exit;
    //$serialize_data = serialize($cart_data);
    $woocommerce->cart->add_to_cart( $pid );

    update_user_meta($user,'_woocommerce_persistent_cart_1',$cart_data);


    return wc()->cart->get_cart(); // API response whatever you want
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'sz-auth/v1', 'logintest', array( //wp/v2
        'methods' => array('GET','POST'),
        'callback' => function(WP_REST_Request $request) {
            $nonce = wp_create_nonce("wp_rest");
            $user = wp_signon(array(
                'user_login' => $request['username'],
                'user_password' => $request['password'],
                "rememberme" => true),false);
            if (is_wp_error($user)) {
                return $request;
            }
            else{

                return "$%$%$%$";
            }
            // //do_action( 'wp_login', "capad" );
            // //$user['isloggedin'] = is_user_logged_in();
            // return array('user' => $user, 'nonce' => $nonce);
        }
    ));
});

/* View cart product api */
add_action( 'rest_api_init', function () {
    register_rest_route( 'sz-auth/v1', 'woocomm_add_to_cart', array( //wp/v2
        'methods' => array('GET','POST'),
        'callback' => 'woocomm_add_to_cart',
    ) );
} );

function woocomm_add_to_cart($param) {

    global $woocommerce,$wpdb;
    $user_id = $param['user_id'];
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
 
    $user = wp_get_current_user();
    echo "User ID ##: ", $user;

    $objProduct = new WC_Session_Handler();

    $wc_session_data = $objProduct->get_session($user_id);

    $full_user_meta = get_user_meta($user_id,'_woocommerce_persistent_cart_1',true);    // Get the persistent cart may be _woocommerce_persistent_cart can be in your case check in user_meta table
    // print_r($full_user_meta);

    $cartObj = new WC_Cart();    // create new Cart Object
    
    // Add old cart data to newly created cart object
    if($full_user_meta['cart']) {
        foreach($full_user_meta['cart'] as $sinle_user_meta) {
            $cartObj->add_to_cart( $sinle_user_meta['product_id'], $sinle_user_meta['quantity']  );
        }
    }

    // Add product and quantities coming in request to the new cart object
    if($param['products']){
        foreach($param['products'] as $prod) {
            $cartObj->add_to_cart( $prod['product_id'], $prod['quantity']  );
            var_dump($prod);
        }
    }

    $updatedCart = [];
    foreach($cartObj->cart_contents as $key => $val) {
        unset($val['data']);
        $updatedCart[$key] = $val;
    }
    
    // If there is a current session cart, overwrite it with the new cart
    if($wc_session_data) {
        $wc_session_data['cart'] = serialize($updatedCart);
        $serializedObj = maybe_serialize($wc_session_data);
    
    
        $table_name = 'wp_woocommerce_sessions';
    
        // Update the wp_session table with updated cart data
        $sql ="UPDATE $table_name SET 'session_value'= '".$serializedObj."', WHERE  'session_key' = '".$user_id."'";
    
        // Execute the query
        $rez = $wpdb->query($sql);
    }
    
    // Overwrite the persistent cart with the new cart data
    $full_user_meta['cart'] = $updatedCart;
    update_user_meta($user_id, '_woocommerce_persistent_cart_1', $full_user_meta);
    
    $response = [
        // 'carttotal' => viewcart($user_id),
        'status' => true,
        'message' => 'Products successfully added to cart'
    ];
    
    return rest_ensure_response($response);
    
    
    }


/*************** */
 
