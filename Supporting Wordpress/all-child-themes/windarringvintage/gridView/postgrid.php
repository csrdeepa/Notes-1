/*********************** */
// [ajaxgridblogdemo post_type="post" initial_posts="3" grid_posts="3"]

add_shortcode('ajaxgridblogdemo','ajaxgridblogdemo');
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
		$additonalArr['appendBtn'] = true;
		$additonalArr["offset"] = 0; ?>
		<div class="dcsAllPostsWrapper"> 
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
		'offset' => $additonalArr["offset"]
	);
	$the_query = new WP_Query( $args );
	$havePosts = true;
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post(); ?>
			<div class="gridRepeat">
				<div class="innerWrap">
				<div class="thumbnail-img"><?php echo the_post_thumbnail();?></div>
				<div>
					<h2 class="card-title"><?=get_the_title()?></h2>
					<p class="card-text"><?php the_excerpt(); ?></p>
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
 
add_action("wp_head", "viewpostgridcss");
function viewpostgridcss(){
	?>
	<style>
	 /* load more posts demo styles */
		.gridWrapper {
			display: flex;
			flex-wrap: wrap;
		}
		.gridWrapper .gridRepeat {
			width:calc(100% /3);
			padding: 10px;
		}
		.gridWrapper .gridRepeat .innerWrap {
			background: #fff;
			padding: 15px;
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
