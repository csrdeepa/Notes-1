<?php
//**  Post Gridview  **/
// [postgridview post_type="post" initial_posts="3" grid_posts="3"]

add_shortcode('postgridview','ajaxgridblogdemo');
function ajaxgridblogdemo($atts, $content = null){
	ob_start();
	$atts = shortcode_atts(
				array(
				'post_type' => 'post',
				'initial_posts' => '6',
				'grid_posts' => '6',
				), $atts, $tag
			);
		$additonalArr = array();
		?>
		<div class="gridPostsWrapper"> 
			<div class="gridWrapper">
				<?php dcsGetGridPostsFtn($atts, $additonalArr); ?>
			</div>
		</div>
		<?php
    return ob_get_clean();
}

function dcsGetGridPostsFtn($atts, $additonalArr=array()){ 
	$args = array(
		'post_type' => $atts['post_type'],
		'posts_per_page' => $atts['initial_posts'],
	);
	$the_query = new WP_Query( $args );
	$havePosts = true;
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post(); ?>
			<div class="gridRepeat">
				<div class="innergridWrap">
					<div class="thumbnail-img"><?php echo the_post_thumbnail();?></div>
					<div class="gridcontent">
						<h3 class="card-title"><?=get_the_title()?></h3>
						<p class="card-text"><?php the_excerpt(); ?></p>
					</div>
					<div class="gridlink">
						<a href="<?php the_permalink(); ?>">Learnmore</a>
					</div>
				</div>
			</div>
			<?php
		}
	} else {
		$havePosts = false; 
	}
	wp_reset_postdata();
 
 }
 
add_action("wp_head", "viepostgridcss");
function viepostgridcss()
{	?>
	<style>
	 	/* Post grid styles styles */
		.gridWrapper {
			display: flex;
			flex-wrap: wrap;
		}
		.gridWrapper .gridRepeat {
			width:calc(100% /3);
			padding: 10px;
		}
		.gridWrapper .gridRepeat .innergridWrap {
		/* background: #fff; */
			padding: 15px;
		}
		.gridRepeat:nth-child(5n+1) {
			background-color: #EBEBEB;
		}
		.gridRepeat:nth-child(-2n+4) {
			background-color: #D9D9D9;
		}
		.gridRepeat:nth-child(odd):nth-child(n + 3){
			background-color: #CBCBCB;
		}
		.gridlink {
			display: flex;
		}
		.gridlink a {
			background-color: #22295E;
			border: 2px solid #22295E !important;
			color: #fff;
			border-radius: 4px;
			padding: 6px 20px;
			font-family: 'Viscf-Demibold',Helvetica,Arial,Lucida,sans-serif;
		}
		.gridlink a:hover {
			background-color: transparent;
			color: #22295E;
		}
		.gridWrapper .innergridWrap p {
			font-family: 'Visbycf-Medium',Helvetica,Arial,Lucida,sans-serif;
			font-size: 16px;
			color: #22295E;
		}
		.gridPostsWrapper h3.card-title {
			font-family: 'VisbyCF-Bold',Helvetica,Arial,Lucida,sans-serif;
			font-size: 25px;
			color: #22295E;
		}
		.gridPostsWrapper .gridcontent {
			padding-top: 15px;
		}
		@media only screen  and (max-width: 976px) {
			.gridWrapper .gridRepeat {
				width: calc(100% /2);
			}
		}	
		@media only screen  and (max-width: 648px) {
			.gridWrapper .gridRepeat {
				width: 100%;
			}
		}	
	</style>
 
	<?php
}
/********* */
// [ajaxloadmoreblogdemo post_type="post" initial_posts="3" loadmore_posts="3"]

add_shortcode('ajaxloadmoreblogdemo','ajaxloadmoreblogdemo');
function ajaxloadmoreblogdemo($atts, $content = null){
	ob_start();
	$atts = shortcode_atts(
				array(
				'post_type' => 'post',
				'initial_posts' => '3',
				'loadmore_posts' => '3',
				), $atts, $tag
			);
		$additonalArr = array();
		$additonalArr['appendBtn'] = true;
		$additonalArr["offset"] = 0; ?>
		<div class="dcsAllPostsWrapper"> 
			<input type="hidden" name="dcsPostType" value="<?=$atts['post_type']?>">
				<input type="hidden" name="offset" value="0">
				<input type="hidden" name="dcsloadMorePosts" value="<?=$atts['loadmore_posts']?>">
				<div class="dcsDemoWrapper">
					<?php dcsGetPostsFtn($atts, $additonalArr); ?>
				</div>
			</div>
		<?php
    return ob_get_clean();
}

function dcsGetPostsFtn($atts, $additonalArr=array()){ 
	$args = array(
		'post_type' => $atts['post_type'],
		'posts_per_page' => $atts['initial_posts'],
		'offset' => $additonalArr["offset"]
	);
	$the_query = new WP_Query( $args );
	$havePosts = true;
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post(); ?>
			<div class="loadMoreRepeat">
				<div class="innerWrap">
					<h2 class="card-title"><?=get_the_title()?></h2>
					<p class="card-text"><?php the_excerpt(); ?></p>
				</div>
			</div>
			<?php
		}
	} else {
		$havePosts = false; 
	}
	wp_reset_postdata();
	if($havePosts && $additonalArr['appendBtn'] ){ ?>
		<div class="btnLoadmoreWrapper">
			<a href="javascript:void(0);" class="btn btn-primary dcsLoadMorePostsbtn">Load More</a>
		</div>
		
		<!-- loader for ajax -->
		<div class="dcsLoaderImg" style="display: none;">
			<svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve" style="
				color: #ff7361;">
				<path fill="#ff7361" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
					<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform>
				</path>
			</svg>
		</div>
	
		<p class="noMorePostsFound" style="display: none;">No More Posts Found</p>
		<?php
	}
 }

function dcsEnqueue_scripts() {
	// wp_enqueue_style( 'load-style', get_stylesheet_directory_uri().'/style.css'  );
	wp_enqueue_script( 'dcsLoadMorePostsScript', get_stylesheet_directory_uri() . '/loadmoreposts.js', array( 'jquery' ), '20131205', true );
	wp_localize_script( 'dcsLoadMorePostsScript', 'dcs_frontend_ajax_object',	array( 	'ajaxurl' => admin_url( 'admin-ajax.php' )	)	);
}
add_action( 'wp_enqueue_scripts', 'dcsEnqueue_scripts' );

add_action("wp_ajax_dcsAjaxLoadMorePostsAjaxReq","dcsAjaxLoadMorePostsAjaxReq");
add_action("wp_ajax_nopriv_dcsAjaxLoadMorePostsAjaxReq","dcsAjaxLoadMorePostsAjaxReq");
function dcsAjaxLoadMorePostsAjaxReq(){
	extract($_POST);
	$additonalArr = array();
	$additonalArr['appendBtn'] = false;
	$additonalArr["offset"] = $offset;
	$atts["initial_posts"] = $dcsloadMorePosts;
	$atts["post_type"] = $postType;
	dcsGetPostsFtn($atts, $additonalArr);
	die();
}

add_action("wp_head", "loadmorepostgridcss");
function loadmorepostgridcss(){
	?>
	<style>
	 /* load more posts demo styles */
		.dcsDemoWrapper {
			display: flex;
			flex-wrap: wrap;
		}
		.dcsDemoWrapper .loadMoreRepeat {
			/* width: 50%; */
			width:calc(100% /3);
			padding: 10px;
		}
		.dcsDemoWrapper .loadMoreRepeat .innerWrap {
			background: #fff;
			padding: 15px;
		}
		.btnLoadmoreWrapper {
			text-align: center;
			margin-top: 10px;
			width: 100%;
		}
		p.noMorePostsFound {
			text-align: center;
			width: 100%;
			margin-top: 20px;
			color: red;
			font-size: 18px;
		}
		svg {
		width: 100px;
		height: 100px;
		margin: 20px;
		display: inline-block;
		}
		.dcsLoaderImg {width: 100%;text-align: center;}
	</style>
	<script>
		 jQuery(document).ready(function(){
		jQuery(document).on('click','.dcsLoadMorePostsbtn',function(){
			var ajaxurl = dcs_frontend_ajax_object.ajaxurl;
			var dcsPostType = jQuery('input[name="dcsPostType"]').val();
			var offset = parseInt(jQuery('input[name="offset"]').val() );
			var dcsloadMorePosts = parseInt(jQuery('input[name="dcsloadMorePosts"]').val() );
			var newOffset = offset+dcsloadMorePosts;

			jQuery('.btnLoadmoreWrapper').hide();
			jQuery.ajax({
				type: "POST",
				url: ajaxurl,
				data: ({
					action: "dcsAjaxLoadMorePostsAjaxReq",
					offset: newOffset,
					dcsloadMorePosts: dcsloadMorePosts,
					postType: dcsPostType,
				}),
				success: function(response){
					if (!jQuery.trim(response)){ 
						// blank output
						jQuery('.noMorePostsFound').show();
					}else{
						// append to last div
						jQuery(response).insertAfter(jQuery('.loadMoreRepeat').last());
						jQuery('input[name="offset"]').val(newOffset);
						jQuery('.btnLoadmoreWrapper').show();
					}
				},
				beforeSend: function() {
					jQuery('.dcsLoaderImg').show();
				},
				complete: function(){
					jQuery('.dcsLoaderImg').hide();
				},
			});
		});
	});
	</script>
	<?php
}


/******** */
//https://stackoverflow.com/questions/25517289/wp-query-pagination-on-shortcode 
// https://wp-qa.com/wp-query-pagination-on-shortcode

if ( ! function_exists('vpsa_posts_shortcode') ) {
	function vpsa_posts_shortcode( $atts ){

		$atts = shortcode_atts( array(
						'per_page'  =>      2,  
						'order'     =>  'DESC',
						'orderby'   =>  'date'
				), $atts );

		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

		$args = array(
			'post_type'         =>  'post',
			'posts_per_page'    =>  $atts["per_page"], 
			'order'             =>  $atts["order"],
			'orderby'           =>  $atts["orderby"],
			'paged'             =>  $paged
		);

		$query = new WP_Query($args);
				if($query->have_posts()) : $output;

					while ($query->have_posts()) : $query->the_post();

						$output .= '<article id="post-' . get_the_ID() . '" class="' . implode(' ', get_post_class()) . '">';

							$output .= '<h4 class="post-title"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h4>';

							$output .= '<div class="row">';

								$output .= '<div class="col-md-3">'; 

									$output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';

										if ( has_post_thumbnail() ) {

											$output .= get_the_post_thumbnail( get_the_id(), 'featured', array('class' => 'img-responsive aligncenter'));

										} else {

										   $output .= '<img class="img-responsive aligncenter" src="' . get_template_directory_uri() . '/images/not-available.png" alt="Not Available" height="150" width="200" />';                                           

										}

									$output .= '</a>';

								$output .= '</div>';

								$output .= '<div class="col-md-9">';

									$output .= get_the_excerpt();

									$output .= '<span class="post-permalink"><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">Read More</a></span>';

								$output .= '</div>';

							$output .= '</div>';

							$output .= '<div class="post-info">';

								$output .= '<ul>';

									$output .= '<li>Posted: ' . get_the_time("F j, Y") . '</li>';

									$output .= '<li>By: ' . get_the_author() . '</li>';

									$output .= '<li>Categories: ' . get_the_category_list(", ") . '</li>';

								$output .= '</ul>';

							$output .= '</div>';

						$output .= '</article>';

					endwhile;global $wp_query;
$args_pagi = array(
		'base' => add_query_arg( 'paged', '%#%' ),
		'total' => $query->max_num_pages,
		'current' => $paged
		);
					$output .= '<div class="post-nav">';
						$output .= paginate_links( $args_pagi);

					//    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

					$output .= '</div>';

				else:

					$output .= '<p>Sorry, there are no posts to display</p>';

				endif;

			wp_reset_postdata();

			return $output;
	}
}

add_shortcode('vpsa_posts', 'vpsa_posts_shortcode');







/********* */
  
/**
 * AJAC filter posts by taxonomy term
 */
function vb_filter_posts() {

    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'bobz' ) )
        die('Permission denied');

    /**
     * Default response
     */
    $response = [
        'status'  => 500,
        'message' => 'Something is wrong, please try again later ...',
        'content' => false,
        'found'   => 0
    ];

    $tax  = sanitize_text_field($_POST['params']['tax']);
    $term = sanitize_text_field($_POST['params']['term']);
    $page = intval($_POST['params']['page']);
    $qty  = intval($_POST['params']['qty']);

    /**
     * Check if term exists
     */
    if (!term_exists( $term, $tax) && $term != 'all-terms') :
        $response = [
            'status'  => 501,
            'message' => 'Term doesn\'t exist',
            'content' => 0
        ];

        die(json_encode($response));
    endif;

    if ($term == 'all-terms') : 

        $tax_qry[] = [
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
            'operator' => 'NOT IN'
        ];

    else :

        $tax_qry[] = [
            'taxonomy' => $tax,
            'field'    => 'slug',
            'terms'    => $term,
        ];

    endif;

    /**
     * Setup query
     */
    $args = [
        'paged'          => $page,
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $qty,
        'tax_query'      => $tax_qry
    ];

    $qry = new WP_Query($args);

    ob_start();
        if ($qry->have_posts()) :
            while ($qry->have_posts()) : $qry->the_post(); ?>

                <article class="loop-item">
                    <header>
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                </article>

            <?php endwhile;

            /**
             * Pagination
             */
            vb_ajax_pager($qry,$page);

            $response = [
                'status'=> 200,
                'found' => $qry->found_posts
            ];

            
        else :

            $response = [
                'status'  => 201,
                'message' => 'No posts found'
            ];

        endif;

    $response['content'] = ob_get_clean();

    die(json_encode($response));

}
add_action('wp_ajax_do_filter_posts', 'vb_filter_posts');
add_action('wp_ajax_nopriv_do_filter_posts', 'vb_filter_posts');


/**
 * Shortocde for displaying terms filter and results on page
 */
function vb_filter_posts_sc($atts) {

    $a = shortcode_atts( array(
        'tax'      => 'post_tag', // Taxonomy
        'terms'    => false, // Get specific taxonomy terms only
        'active'   => false, // Set active term by ID
        'per_page' => 12 // How many posts per page
    ), $atts );

    $result = NULL;
    $terms  = get_terms($a['tax']);

    if (count($terms)) :
        ob_start(); ?>
            <div id="container-async" data-paged="<?php echo $a['per_page']; ?>" class="sc-ajax-filter">
                <ul class="nav-filter">
                    <?php foreach ($terms as $term) : ?>
                        <li<?php if ($term->term_id == $a['active']) :?> class="active"<?php endif; ?>>
                            <a href="<?php echo get_term_link( $term, $term->taxonomy ); ?>" data-filter="<?php echo $term->taxonomy; ?>" data-term="<?php echo $term->slug; ?>" data-page="1">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="status"></div>
                <div class="content"></div>
            </div>
        
        <?php $result = ob_get_clean();
    endif;

    return $result;
}
add_shortcode( 'ajax_filter_posts', 'vb_filter_posts_sc');



/**
 * Pagination
 */
function vb_ajax_pager( $query = null, $paged = 1 ) {

    if (!$query)
        return;

    $paginate = paginate_links([
        'base'      => '%_%',
        'type'      => 'array',
        'total'     => $query->max_num_pages,
        'format'    => '#page=%#%',
        'current'   => max( 1, $paged ),
        'prev_text' => 'Prev',
        'next_text' => 'Next'
    ]);

    if ($query->max_num_pages > 1) : ?>
        <ul class="pagination">
            <?php foreach ( $paginate as $page ) :?>
                <li><?php echo $page; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif;
}

add_action('wp_footer','cdcdcd');
function cdcdcd(){
?>
<script>
	(function($) {
	$doc = $(document);

	$doc.ready( function() {

		/**
		 * Retrieve posts
		 */
		function get_posts($params) {

			$container = $('#container-async');
			$content   = $container.find('.content');
	        	$status    = $container.find('.status');

			$status.text('Loading posts ...');

			$.ajax({
	            		url: bobz.ajax_url,
	            		data: {
	            			action: 'do_filter_posts',
					nonce: bobz.nonce,
					params: $params
	            		},
	            		type: 'post',
	            		dataType: 'json',
	            		success: function(data, textStatus, XMLHttpRequest) {
	            	
			            	if (data.status === 200) {
			            		$content.html(data.content);
			            	}
			            	else if (data.status === 201) {
			            		$content.html(data.message);	
			            	}
			            	else {
			            		$status.html(data.message);
			            	}
			         },
			         error: function(MLHttpRequest, textStatus, errorThrown) {

					$status.html(textStatus);
					
					/*console.log(MLHttpRequest);
					console.log(textStatus);
					console.log(errorThrown);*/
			         },
				complete: function(data, textStatus) {
					
					msg = textStatus;

	            	if (textStatus === 'success') {
	            		msg = data.responseJSON.found;
	            	}

	            	$status.text('Posts found: ' + msg);
	            	
	            	/*console.log(data);
	            	console.log(textStatus);*/
	            }
	        });
		}

		/**
		 * Bind get_posts to tag cloud and navigation
		 */
		$('#container-async').on('click', 'a[data-filter], .pagination a', function(event) {
			if(event.preventDefault) { event.preventDefault(); }

			$this = $(this);

			/**
			 * Set filter active
			 */
			if ($this.data('filter')) {
				$this.closest('ul').find('.active').removeClass('active');
				$this.parent('li').addClass('active');
				$page = $this.data('page');
			}
			else {
				/**
				 * Pagination
				 */
				$page = parseInt($this.attr('href').replace(/\D/g,''));
				$this = $('.nav-filter .active a');
			}
			

	        $params    = {
	        	'page' : $page,
	        	'tax'  : $this.data('filter'),
	        	'term' : $this.data('term'),
	        	'qty'  : $this.closest('#container-async').data('paged'),
	        };

	        // Run query
	        get_posts($params);
		});
		
		$('a[data-term="all-terms"]').trigger('click');
	});

})(jQuery);
	</script>
<?php
};
/*****fffffff***** */
// https://developer.wordpress.org/reference/functions/register_taxonomy/
/**
 * Create two taxonomies, Brand and writers for the post type "product".
 *
 * @see register_post_type() for registering custom post types.
 */
function wpdocs_create_product_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Brand', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Brand', 'textdomain' ),
        'all_items'         => __( 'All Brand', 'textdomain' ),
        'parent_item'       => __( 'Parent Genre', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
        'edit_item'         => __( 'Edit Genre', 'textdomain' ),
        'update_item'       => __( 'Update Genre', 'textdomain' ),
        'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
        'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
        'menu_name'         => __( 'Genre', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'genre' ),
    );
 
    register_taxonomy( 'genre', array( 'product' ), $args );
 
    unset( $args );
    unset( $labels );
 
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Writers', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Writer', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Writers', 'textdomain' ),
        'popular_items'              => __( 'Popular Writers', 'textdomain' ),
        'all_items'                  => __( 'All Writers', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Writer', 'textdomain' ),
        'update_item'                => __( 'Update Writer', 'textdomain' ),
        'add_new_item'               => __( 'Add New Writer', 'textdomain' ),
        'new_item_name'              => __( 'New Writer Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate writers with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove writers', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used writers', 'textdomain' ),
        'not_found'                  => __( 'No writers found.', 'textdomain' ),
        'menu_name'                  => __( 'Writers', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'writer' ),
    );
 
    register_taxonomy( 'writer', 'product', $args );
}
// hook into the init action and call create_product_taxonomies when it fires
add_action( 'init', 'wpdocs_create_product_taxonomies', 0 );
/*****fffffff***** */
// http://convertintowordpress.com/wordpress-multiple-taxonomy-filter-ajax/
add_shortcode('mtaxonomy','mtaxonomy');
function mtaxonomy(){
 
	$brand = array(
	  'taxonomy'=>'brand',
	  'child_of'=> 0,'parent'=> 0,
	  'orderby'=> 'name',
	  'show_count'=> 0,
	  'pad_counts'=> 0,
	  'hierarchical' => 0,
	  'title_li'=> '',
	  'hide_empty'=> 0
	);
	$brand = get_categories( $brand );
	?>
	<!--loop through the style and show it in a checkbox -->
	<?php	$html_string='';
	$html_string='<ul class="portfolio-cats">'; 
 foreach($brand as $br){  
	 $html_string .= '<span>';
		$html_string .=  '<input name="<?php echo $br->term_id; ?>" type="checkbox"><?php echo $br->cat_name; ?>' ;
		 $html_string .=  '</span>';
 } 
  $html_string .= '</ul>';
	return $html_string;
}
  
/*********** */
function misha_filter_function(){   

	//brands checkboxes
	if( $brands = get_terms( array( 'taxonomy' => 'brand' ) ) ) :
	$brands_terms = array();
	
	foreach( $brands as $brand ) {
		if( isset( $POST['brand' . $brand->term_id ] ) && $POST['brand' . $brand->term_id] == 'on' )
			 $brands_terms[] = $brand->slug;
	}
	endif;
	
	//sizes checkboxes
	if( $sizes = get_terms( array( 'taxonomy' => 'sizes' ) ) ) :
	$sizes_terms = array();
	
	foreach( $sizes as $size ) {
		if( isset( $POST['size' . $size->term_id ] ) && $POST['size' . $size->term_id] == 'on' )
			 $sizes_terms[] = $size->slug;
	}
	endif;
	
	$args = array(
		'orderby' => 'date',
		'post_type' => 'product',
		'posts_per_page' => -1,
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'brand',
				'field' => 'slug',
				'terms' => $brands_terms
			),
			array(
				'taxonomy' => 'sizes',
				'field' => 'slug',
				'terms' => $sizes_terms
			)
		)
	);
	
	$query = new WP_Query( $args );
	
	if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
			echo '<h2>' . $query->post->post_title . '</h2>';
		endwhile;
		wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;
	
	die();
	}
	add_action('wp_ajax_myfilter', 'misha_filter_function'); 
	add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');

	/**** */

	function ajax_filter_get_posts( $product_item ) {

		// Verify nonce
		if( !isset( $_POST['afp_nonce'] ) || 
			!wp_verify_nonce( $_POST['afp_nonce'], 'afp_nonce' ))
		  die('Permission denied');
  
		   $product_item = $_POST['stuff'];
		   $result = json_encode(my_get_posts($product_item, true));
		   echo $result;
  
		   die();
  
	  }
  
  function my_get_posts($product_item = '', $ajax = false){
  
	  // WP Query
		$args = array(
		  'stuff' => $product_item,
		  'post_type' => 'product',
		  'posts_per_page' => -1,
		);
  
		// If taxonomy is not set, remove key from array and get all posts
		if( !$product_item ) {
		  unset( $args['stuff'] );
		}
  
		$query = new WP_Query( $args );
		$html = '';
		$items = array();
  
		if ( $query->have_posts() ) : 
			 while ( $query->have_posts() ) : 
			 $query->the_post(); 
  
			 $res = '<div class="col-lg-4">'.
						'<a href="'.get_permalink().'">'.
							'<article class="panel panel-default" id="post-'.get_the_id().'">'.
								'<div class="panel-body">'.
									get_the_post_thumbnail().
									'<div class="panel-cover">'.
										'<h3>'.get_the_title().'</h3>'.
											get_the_content().
									'</div>'.
								'</div>'.      
							'</article>'.
						'</a>' .     
					'</div>';
  
  
			 $ajax ? $items[] = $res : $html .= $res;
  
  
		 endwhile;
  
		 $result['response'] = $ajax ? $items : $html;
		 $result['status'] = 'success';
  
		 else:
			 $result['response'] = '<h2>No posts found</h2>';
			 $result['status']   = '404';
		 endif;
  wp_reset_postdata();
  return $result;
  }
/******* */

function register_custom_post_type_movie() {
    $args = array(
        "label" => __( "Movies", "" ),
        "labels" => array(
            "name" => __( "Movies", "" ),
            "singular_name" => __( "Movie", "" ),
            "featured_image" => __( "Movie Poster", "" ),
            "set_featured_image" => __( "Set Movie Poster", "" ),
            "remove_featured_image" => __( "Remove Movie Poster", "" ),
            "use_featured_image" => __( "Use Movie Poster", "" ),
        ),
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "movie", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail" ),
        "taxonomies" => array( "category" ),
    );
    register_post_type( "movie", $args );
}
add_action( 'init', 'register_custom_post_type_movie' );

// Shortcode: [my_ajax_filter_search]
// Shortcode: [my_ajax_filter_search]
function my_ajax_filter_search_shortcode() {
	my_ajax_filter_search_scripts(); // Added here

    ob_start(); ?>
 
    <div id="my-ajax-filter-search">
        <form action="" method="get">
            <input type="text" name="search" id="search" value="" placeholder="Search Here..">
            <div class="column-wrap">
                <div class="column">
                    <label for="year">Year</label>
                    <input type="number" name="year" id="year">
                </div>
                <div class="column">
                    <label for="rating">IMDB Rating</label>
                    <select name="rating" id="rating">
                        <option value="">Any Rating</option>
                        <option value="9">At least 9</option>
                        <option value="8">At least 8</option>
                        <option value="7">At least 7</option>
                        <option value="6">At least 6</option>
                        <option value="5">At least 5</option>
                        <option value="4">At least 4</option>
                        <option value="3">At least 3</option>
                        <option value="2">At least 2</option>
                        <option value="1">At least 1</option>
                    </select>
                </div>
            </div>
            <div class="column-wrap">
                <div class="column">
                    <label for="language">Language</label>
                    <select name="language" id="language">
                        <option value="">Any Language</option>
                        <option value="english">English</option>
                        <option value="korean">Korean</option>
                        <option value="hindi">Hindi</option>
                        <option value="serbian">Serbian</option>
                        <option value="malayalam">Malayalam</option>
                    </select>
                </div>
                <div class="column">
                    <label for="genre">Genre</label>
                    <select name="genre" id="genre">
                        <option value="">Any Genre</option>
                        <option value="action">Action</option>
                        <option value="comedy">Comedy</option>
                        <option value="drama">Drama</option>
                        <option value="horror">Horror</option>
                        <option value="romance">Romance</option>
                    </select>
                </div>
            </div>
            <input type="submit" id="submit" name="submit" value="Search">
        </form>
        <ul id="ajax_filter_search_results"></ul>
    </div>
     
    <?php
    return ob_get_clean();
}
 
add_shortcode ('my_ajax_filter_search', 'my_ajax_filter_search_shortcode');

function my_ajax_filter_search_scripts() {
    wp_enqueue_script( 'my_ajax_filter_search', get_stylesheet_directory_uri(). '/js/search_script.js', array(), '1.0', true );
    wp_localize_script( 'my_ajax_filter_search', 'ajax_url', admin_url('admin-ajax.php') );
}


// Ajax Callback
 
add_action('wp_ajax_my_ajax_filter_search', 'my_ajax_filter_search_callback');
add_action('wp_ajax_nopriv_my_ajax_filter_search', 'my_ajax_filter_search_callback');
 
function my_ajax_filter_search_callback() {
 
    header("Content-Type: application/json"); 
 
    $meta_query = array('relation' => 'AND');
 
    if(isset($_GET['year'])) {
        $year = sanitize_text_field( $_GET['year'] );
        $meta_query[] = array(
            'key' => 'year',
            'value' => $year,
            'compare' => '='
        );
    }
 
    if(isset($_GET['rating'])) {
        $rating = sanitize_text_field( $_GET['rating'] );
        $meta_query[] = array(
            'key' => 'rating',
            'value' => $rating,
            'compare' => '>='
        );
    }
 
    if(isset($_GET['language'])) {
        $language = sanitize_text_field( $_GET['language'] );
        $meta_query[] = array(
            'key' => 'language',
            'value' => $language,
            'compare' => '='
        );
    }
 
    $tax_query = array();
 
    if(isset($_GET['genre'])) {
        $genre = sanitize_text_field( $_GET['genre'] );
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $genre
        );
    }
 
    $args = array(
        'post_type' => 'movie',
        'posts_per_page' => -1,
        'meta_query' => $meta_query,
        'tax_query' => $tax_query
    );
 
    if(isset($_GET['search'])) {
        $search = sanitize_text_field( $_GET['search'] );
        $search_query = new WP_Query( array(
            'post_type' => 'movie',
            'posts_per_page' => -1,
            'meta_query' => $meta_query,
            'tax_query' => $tax_query,
            's' => $search
        ) );
    } else {
        $search_query = new WP_Query( $args );
    }
 
    if ( $search_query->have_posts() ) {
 
        $result = array();
 
        while ( $search_query->have_posts() ) {
            $search_query->the_post();
 
            $cats = strip_tags( get_the_category_list(", ") );
            $result[] = array(
                "id" => get_the_ID(),
                "title" => get_the_title(),
                "content" => get_the_content(),
                "permalink" => get_permalink(),
                "year" => get_field('year'),
                "rating" => get_field('rating'),
                "director" => get_field('director'),
                "language" => get_field('language'),
                "genre" => $cats,
                "poster" => wp_get_attachment_url(get_post_thumbnail_id($post->ID),'full')
            );
        }
        wp_reset_query();
 
        echo json_encode($result);
 
    } else {
        // no posts found
    }
    wp_die();
}





//////////////////////////////////////////////
 
add_shortcode( 'wofilter', 'wpshout_dump_query' );
function wpshout_dump_query() {
	// Write query
	$args = array(
		'posts_per_page' => 1
	);
	$query = new WP_Query( $args );

	// // Return output
	// ob_start();
	// // var_dump( $query );
	// return ob_get_clean();
	return 'hi!';
}
