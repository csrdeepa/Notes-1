/*********************** */
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
