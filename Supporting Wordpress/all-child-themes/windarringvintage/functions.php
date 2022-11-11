<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 wp_enqueue_style( 'child-style', get_template_directory_uri().'/style.css'  );
	
	wp_register_script( 'child-script', get_stylesheet_directory_uri().'/childscript.js');
	wp_enqueue_script( 'child-script' );
}
 
/*@Child Theme*/
  
function child_enqueue_styles() {
	wp_enqueue_style('owl-carousel','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css', '', '','all');
   	wp_enqueue_style('owl-carousel-2.1.6','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.css', '', '','all');
   	wp_enqueue_script('owl-js','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2//2.0.0-beta.2.4/owl.carousel.min.js',array('jquery'),'1.12.4', false);
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );
 

function category_carousel(){
    ob_start();
      get_template_part('category');
    return ob_get_clean();
}
add_shortcode('category_carousel','category_carousel');

add_action( 'init', 'woocommerce_redesign' );
function woocommerce_redesign() {
   /*remove_action( 'storefront_header', 'storefront_primary_navigation', 30 );
   add_action( 'storefront_header', 'storefront_primary_navigation', 20 );
    remove_action( 'storefront_header', 'storefront_product_search', 	40 );
    add_action( 'storefront_header', 'storefront_product_search', 	50 );*/
	
// 	remove_action( 'storefront_header', 'storefront_product_search', 	40 );
//  add_action( 'storefront_header', 'storefront_product_search', 	50 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 ); // Category, Tag metas
	
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 ); // remove Product description 
	add_action( 'woocommerce_share', 'woocommerce_output_product_data_tabs', 1 ); // show product description in another location
	
	add_action( 'woocommerce_share', 'product_deliverydetails', 2 ); // show product description in another location
	
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 ); // remove related products
	add_action( 'woocommerce_share', 'woocommerce_output_related_products', 3 ); // show related products into another location
	
	add_filter( 'woocommerce_product_description_heading', '__return_null' ); // remove product description title
// 	add_filter( 'woocommerce_is_sold_individually', '__return_true' ); // remove quantity in product page
	
	add_filter('woocommerce_product_related_products_heading',function(){
	   return 'You may also like';
	});	

// 	remove_action( 'woocommerce_cart_actions', 'action_woocommerce_cart_actions', 10, 0 ); 	// remove the cart action UPDATE TO CART
// 	remove_action( 'woocommerce_cart_actions',  array( 'Points_Rewards_For_WooCommerce_Public', 'mwb_wpr_woocommerce_cart_coupon' ), 10 );
 
}

add_filter( 'woocommerce_product_tabs', 'remove_info_tab', 9999 ); // remove tabs in summary
function remove_info_tab( $tabs ) {
	// unset( $tabs['additional_information'] );
	// unset( $tabs['description'] );
    unset( $tabs['reviews'] );
	
	/* if ( has_term( 'tables', 'product_cat' ) ) {
		   unset( $tabs['reviews'] ); // remove reviews for tables
	   } */

	return $tabs;
}

function product_deliverydetails(){
	echo "<div class='deliverydetails'>
		<div class='deliverytitle'>Delivery & Returns <img src='/wp-content/uploads/2021/11/delivery-icon.svg' alt='delivery' class='delivery-icon' /></div>
		<div><p>Find out more about our delivery options and how to exchange or return</p></div>
		<div><a class='findmore' href='#'>find out more</a></div>
	</div>";
}

// add_filter( 'woocommerce_product_single_add_to_cart_text', 'bbloomer_add_symbol_add_cart_button_single' );
function bbloomer_add_symbol_add_cart_button_single( $button ) {
	//print '<img src="/wp-content/uploads/2021/11/cart-header-icon.svg" alt="cart" class="my_image" />';
   $button_new = $button . '» ';
   return $button_new;
}

add_filter( 'woocommerce_proceed_to_checkout', 'updatecart', 0 ); // Move Update cart button
function updatecart(){
	echo "<div class='btnupdatecart' style='margin-bottom: 20px;'>
		 
	</div>";
}

add_filter( 'woocommerce_cart_collaterals', 'shippingcalculate', 0 ); // Move calculate shipping
function shippingcalculate(){
	echo "<div class='shippingcalculate' style='margin-bottom: 20px; padding-right: 5%;'>
		 <table>
		 <tr>
		 
		 </tr>
		 </table>
	</div>";
}
  

add_action( 'woocommerce_before_quantity_input_field', 'display_quantity_plus', 10, 4 );
// add_action( 'woocommerce_before_add_to_cart_quantity', 'display_quantity_plus' );
function display_quantity_plus() {
     echo '<button type="button" class="plus" >+</button>';
}

add_action( 'woocommerce_after_quantity_input_field', 'display_quantity_minus', 10, 4 );
// add_action( 'woocommerce_after_add_to_cart_quantity', 'display_quantity_minus' );
function display_quantity_minus() {
     echo '<button type="button" class="minus" >-</button>';
}
 
add_action( 'wp_footer', 'add_cart_quantity_plus_minus' );
function add_cart_quantity_plus_minus() {
	if ( is_product() ){ ?>
		<script>
		 jQuery(document).ready(function($){   
			 $('form.cart').on( 'click', 'button.plus, button.minus', function() {

				// Get current quantity values
				var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
				var val   = parseFloat(qty.val());
				var max = parseFloat(qty.attr( 'max' ));
				var min = parseFloat(qty.attr( 'min' ));
				var step = parseFloat(qty.attr( 'step' ));

				// Change the value if plus or minus
				if ( $( this ).is( '.plus' ) ) {
				   if ( max && ( max <= val ) ) {
					  qty.val( max );
				   } else {
					  qty.val( val + step );
				   }
				} else {
				   if ( min && ( min >= val ) ) {
					  qty.val( min );
				   } else if ( val > 1 ) {
					  qty.val( val - step );
				   }
				}

			 });


		  });
		</script>		
		<?php
	}else if ( is_cart() ) {?>
		<script>
			  jQuery( function( $ ) {
				if ( ! String.prototype.getDecimals ) {
					String.prototype.getDecimals = function() {
						var num = this,
							match = ('' + num).match(/(?:.(d+))?(?:[eE]([+-]?d+))?$/);
						if ( ! match ) {
							return 0;
						}
						return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
					}
				}
				// Quantity "plus" and "minus" buttons
				$( document.body ).on( 'click', '.plus, .minus', function() {
					var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
						currentVal  = parseFloat( $qty.val() ),
						max         = parseFloat( $qty.attr( 'max' ) ),
						min         = parseFloat( $qty.attr( 'min' ) ),
						step        = $qty.attr( 'step' );

					// Format values
					if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
					if ( max === '' || max === 'NaN' ) max = '';
					if ( min === '' || min === 'NaN' ) min = 0;
					if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

					// Change the value
					if ( $( this ).is( '.plus' ) ) {
						if ( max && ( currentVal >= max ) ) {
							$qty.val( max );
						} else {
							$qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
						}
					} else {
						if ( min && ( currentVal <= min ) ) {
							$qty.val( min );
						} else if ( currentVal > 0 ) {
							$qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
						}
					}

					// Trigger change event
					$qty.trigger( 'change' );
				});
			});
		</script>
		<?php
	}
}

 // ******************
  
// Change Add to cart label after Add to cart item
// add_filter( 'woocommerce_product_add_to_cart_text', 'customizing_add_to_cart_button_text', 10, 2 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'customizing_add_to_cart_button_text', 10, 2 );
function customizing_add_to_cart_button_text( $button_text, $product )
{
    $is_in_cart = false;

    foreach ( WC()->cart->get_cart() as $cart_item )
       if ( $cart_item['product_id'] == $product->get_id() ) {
           $is_in_cart = true;
           break;
       }

    if( $is_in_cart ) { 
		$button_text = __( 'In cart', 'woocommerce' );
		add_action( 'woocommerce_after_add_to_cart_button', 'action_woocommerce_after_add_to_cart_button', 10, 0 );
 		add_action('wp_footer', 'cartbuttonstyle');
	}else{
		remove_action('wp_footer','cartbuttonstyle');
	}

    return $button_text;
}
function cartbuttonstyle(){
	?>
		<style>
		.woocommerce div.product form.cart .single_add_to_cart_button {
			background-color: #D91C5C !important;
			border: none;
    		margin-left: 10px;
		}
		</style>
	<?php
}

// Show VIEW CART button after Add to cart item
function action_woocommerce_after_add_to_cart_button() {
	if ( ! WC()->cart->is_empty() ) {// Check if the cart isn't empty.
		echo '<div><a href="/cart/" class="button singleview-cart">Go To Cart</a> </div>';
	} 
};
 
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
add_shortcode ('woo_cart_but', 'woo_cart_but' ); //[woo_cart_but iconurl="/wp-content/uploads/2021/11/cart-footer-icon.svg"]
function woo_cart_but( $atts) {
	ob_start();
 $imgurl= $atts['iconurl'];
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
        <div class="cart-menu-icon">
			<a class="menu-item cart-contents test" href="<?php echo $cart_url; ?>" title="View Cart">
			<?php
			if ( $cart_count > 0 ) { ?>
				<img src="<?php echo  $imgurl; ?>" />
				<span class="cart-contents-count"><?php echo $cart_count; ?></span>
			<?php } ?>
			</a>
		</div>
        <?php
	        
    return ob_get_clean();
}
 
add_shortcode('menu_search','add_search_box_to_menu') ;
// add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
 
//         return $items."<div class='menu-header-search deep'>".get_search_form(false)."</div>";
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
			<div style="border: 2px solid #bcc8c9; display: inline-flex; border-radius: 25px; overflow: hidden;">
				<input style="border: none; height: 40px; padding-left: 15px;background-color: transparent;" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="search" />
				<button style="border: none; background-color: transparent;" type="submit" id="searchsubmit" />
					<span class="icon" style=" color: #bcc8c9; font-size: 17px; padding-right: 10px;">
						<i class="fa fa-search"></i>
					</span>   
				</button>
			</div>
			</form>';
 
    return $form;
 
}



// Avada child shortcodes

add_action( 'avada_after_main_container', 'mustache_custom_footer' );
function mustache_custom_footer() {
    echo do_shortcode ('[fusion_global id="2774"]');
}
