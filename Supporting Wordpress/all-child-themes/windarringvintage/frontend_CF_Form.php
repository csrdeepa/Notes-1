<?php
/**
 * Plugin Name: CF Form
 * Plugin URI: http://www.mywebsite.com/cf_form
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: Deepa
 * Author URI: http://www.mywebsite.com
 */

function cfform_add_menu() {
	add_submenu_page("options-general.php", "CF_Form", "CF_Form", "manage_options", "cf-hello-world", "cf_hello_world_page");
}
add_action("admin_menu", "cfform_add_menu");

function cf_hello_world_page(){
    echo "Hi";
}


/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Movies', 'Post Type General Name', 'twentytwenty' ),
            'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentytwenty' ),
            'menu_name'           => __( 'Movies', 'twentytwenty' ),
            'parent_item_colon'   => __( 'Parent Movie', 'twentytwenty' ),
            'all_items'           => __( 'All Movies', 'twentytwenty' ),
            'view_item'           => __( 'View Movie', 'twentytwenty' ),
            'add_new_item'        => __( 'Add New Movie', 'twentytwenty' ),
            'add_new'             => __( 'Add New', 'twentytwenty' ),
            'edit_item'           => __( 'Edit Movie', 'twentytwenty' ),
            'update_item'         => __( 'Update Movie', 'twentytwenty' ),
            'search_items'        => __( 'Search Movie', 'twentytwenty' ),
            'not_found'           => __( 'Not Found', 'twentytwenty' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'movies', 'twentytwenty' ),
            'description'         => __( 'Movie news and reviews', 'twentytwenty' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'show_in_rest' => true,
     
        );
         
        // Registering your Custom Post Type
        register_post_type( 'movies', $args );
     
    }
     
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
     
    add_action( 'init', 'custom_post_type', 0 );
 
    add_shortcode( 'themedomain_frontend_post', 'themedomain_frontend_post' );
    function themedomain_frontend_post1(){
        return "Hi";
    }

       function themedomain_frontend_post() {
        ob_start();
           themedomain_post_if_submitted(); 
           ?>
            <form id="new_post" name="new_post" method="post" enctype="multipart/form-data">
                <p><label for="title"><?php echo esc_html__('Title','theme-domain'); ?></label><br />
                    <input type="text" id="title" value="" tabindex="1" size="20" name="title" />
                </p>

                <?php wp_editor( '', 'content' ); ?>
                <p><?php wp_dropdown_categories( 'show_option_none=Category&tab_index=4&taxonomy=category' ); ?></p>
                <p><label for="post_tags"><?php echo esc_html__('Tags','theme-domain'); ?></label>
                    <input type="text" value="" tabindex="5" size="16" name="post_tags" id="post_tags" />
                </p>
                <input type="file" name="post_image" id="post_image" aria-required="true">

                <p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>
            </form>
            <?php
             return ob_get_clean();
       }
function themedomain_post_if_submitted() {
    // Stop running function if form wasn't submitted
    if ( !isset($_POST['title']) ) {
        return;
    }

    // Add the content of the form to $post as an array
    $post = array(
        'post_title'    => $_POST['title'],
        'post_content'  => $_POST['content'],
        'post_category' => array($_POST['cat']), 
        'tags_input'    => $_POST['post_tags'],
        'post_status'   => 'publish',   // Could be: publish, draft
        'post_type' 	=> 'post' // Could be: 'page' or your CPT
    );
	$post_id = wp_insert_post($post);
	
	// For Featured Image
	if( !function_exists('wp_generate_attachment_metadata')){
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	}
	if($_FILES) {
		foreach( $_FILES as $file => $array ) {
			if($_FILES[$file]['error'] !== UPLOAD_ERR_OK){
				return "upload error : " . $_FILES[$file]['error'];
			}
			$attach_id = media_handle_upload( $file, $post_id );
		}
	}
	if($attach_id > 0) {
		update_post_meta( $post_id,'_thumbnail_id', $attach_id );
	}

    echo 'Saved your post successfully! :)';
}  

  //echo do_shortcode('[themedomain_frontend_post]');  

  
