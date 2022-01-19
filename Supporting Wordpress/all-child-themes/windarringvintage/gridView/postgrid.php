/******  Post Gridview  ******/
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
