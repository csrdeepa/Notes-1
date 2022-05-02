

// Product Category Carousel

function categoryenqueue_styles() {
	wp_enqueue_style('sz_fontawesome','https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', '', '','all');
	wp_enqueue_style('owl-carousel','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css', '', '','all');
   	wp_enqueue_style('owl-carousel-2.1.6','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.css', '', '','all');
   	wp_enqueue_script('owl-js','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2//2.0.0-beta.2.4/owl.carousel.min.js',array('jquery'),'1.12.4', false);
}
add_action( 'wp_enqueue_scripts', 'categoryenqueue_styles', 15 );
 
function category_carousel($atts, $content = null){ 
    ob_start();
      get_template_part('category', '', $args);
    return ob_get_clean();
}
add_shortcode('category_carousel','category_carousel');


////// *************** POST Carousel ************/
//[post_carousel post_type='post', category="blog"]
add_shortcode('post_carousel','post_carousel');
function post_carousel($atts, $content = null){ 
    ob_start();	
	$args = shortcode_atts(
		array(
			'post_type' => 'post',
			'initial_posts' => '3',
			'loadmore_posts' => '3',
			), $atts, $tag
		);
 
		?>
			<div class="postcarouselWrapper"> 
				<div class="postcarouselDemoWrapper">
					<?php post_list($atts, $additonalArr); ?>
				</div>
			</div>
		<?php

    //   get_template_part('postgrid', '', $args);
    return ob_get_clean();
}

function post_list($atts, $additonalArr){
	$posts = get_posts(array(
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post_type' => $args['post_type'],
        'category_name'         =>  $args['category'],
 
        )
    );
	//  var_dump($posts);
	echo '<div class="post_carousel">';   
	if ( $posts && ! is_wp_error( $posts ) ) {
	
		echo '<div class="owl-carousel">';
		foreach( $posts as $post ) :
			$thumb_url = get_the_post_thumbnail_url( $post->ID, $size ); 
			$excerpt_count = 15;
			$postid = get_post($post->ID);

			if (empty($post->post_excerpt))
				$excerpt = $post->post_content;
			else
				$excerpt = $post->post_excerpt;

			// $exp = do_shortcode(force_balance_tags(html_entity_decode(wp_trim_words(htmlentities($excerpt), $excerpt_count, '…'))));			
			?>

				<div class="citem">
					<img src="<?php echo $thumb_url ?>"  alt="<?php echo $post->post_title; ?>"/>
					<h3><?php echo $post->post_title; ?></h3>
					<p style="padding-bottom:10px;"><?php echo force_balance_tags(html_entity_decode(wp_trim_words(htmlentities($excerpt), $excerpt_count, '…'))); ?></p>
					<a href="<?php the_permalink(); ?>">Readmore</a>
				</div>

		<?php
		endforeach; 
		echo '</div>';
	}
	echo '</div>'; 
}

add_action("wp_head", "postgridcss");
function postgridcss(){
	?>
	<style>
		.owl-item > div:after {
			font-family: sans-serif;
			font-size: 24px;
			font-weight: bold;
		}
		
		/* .owl-theme .owl-controls .owl-nav [class*='owl-']{
			background: #8bc34a;
			padding: 0px 8px;
		} */
		.owl-dots {
			display: none !important;
		}
		.owl-theme .owl-controls {
			position: absolute;
			top: 25%;
			z-index: 9999;
			width: 100%;
		}
		.owl-theme .owl-controls .owl-nav {
			display: flex;
			justify-content: space-between;
		}
		.owl-theme .owl-controls .owl-nav [class*='owl-'] {
			background: #ffffff00; 
			padding: 10px 17px;
			border-radius: 50%;
			border: 2px solid #000;
		}
		.owl-carousel .owl-item h3 {
			padding-top: 15px;
			padding-bottom: 10px;
			margin-bottom: 15px;
		}
		.citem {
			text-align: center;
			padding-bottom: 15px;
		}
		.owl-carousel .owl-item .citem a {
			color: #fff;
			padding: 6px 20px;
			border-radius: 20px;
		}
		.owl-carousel .owl-item:nth-child(3n+0) .citem a {
			background-color: #F05A2B;
			border: 2px solid #F05A2B !important;
		}
		.owl-carousel .owl-item:nth-child(3n+1) .citem a {
			background-color: #90278E;
			border: 2px solid #90278E !important;
		}	
		.owl-carousel .owl-item:nth-child(3n+2) .citem a {
			background-color: #D91C5C;
			border: 2px solid #D91C5C !important;
		}		
		.post_carousel .owl-carousel .owl-prev {
			margin-left: -50px !important;
		}
		.post_carousel .owl-carousel .owl-next {
			margin-right: -50px	 !important;
		}
		.owl-theme .owl-controls .fa:before {
			color: #000;
		}
		.owl-carousel .owl-item .citem a:hover {
			background-color: transparent;
		}
		.owl-carousel .owl-item:nth-child(3n+0) .citem a:hover {
			color: #F05A2B;
		}
		.owl-carousel .owl-item:nth-child(3n+1) .citem a:hover {
			color: #90278E;
		}	
		.owl-carousel .owl-item:nth-child(3n+2) .citem a:hover {
			color: #D91C5C;
		}	
		
		@media only screen  and (max-width: 400px) {
			.owl-theme .owl-controls .owl-nav [class*='owl-'] {
				background: #ffffff00;
				padding: 4px 12px;
			}
			.post_carousel .owl-carousel .owl-prev {
				margin-left: -40px !important;
			}
			.post_carousel .owl-carousel .owl-next {
				margin-right: -40px !important;
			}
		}
	</style>
	<script>
		jQuery(document).ready(function () {
			var owl = jQuery('.owl-carousel');
			owl.owlCarousel({
				loop:true,
				nav:true,
				arrows: true,
				margin:15,
				autpPlay:true,
				navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
				responsive:{
					0:{
						items:1
					},
					601:{
						items:3
					},            
					981:{
						items:5
					},
					1201:{
						items:6
					}
				}
			});
			owl.on('mousewheel', '.owl-stage', function (e) {
				if (e.deltaY>0) {
					owl.trigger('next.owl');
				} else {
					owl.trigger('prev.owl');
				}
				e.preventDefault();
			});
		});
	</script>
	<?php
}
