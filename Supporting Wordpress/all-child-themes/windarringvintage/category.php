<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
    $prod_categories = get_terms( 'product_cat', array(
        // 'orderby'       => 'name',
        // 'order'         => 'ASC',
        'parent'        => 0,
        'hide_empty'    => false
    ));
    
        echo '<div class="procat_carousel">';   
        if ( $prod_categories && ! is_wp_error( $prod_categories ) ) {
        
            echo '<div class="owl-carousel">';
            foreach( $prod_categories as $prod_cat ) :
                if($prod_cat->name != 'Uncategorized'){
                    
                    $cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
                    $shop_catalog_img = wp_get_attachment_image_src( $cat_thumb_id);
                    $term_link = get_term_link( $prod_cat, 'product_cat' );
                    ?>

                    <div class="citem">
                        <img src="<?php echo $shop_catalog_img[0]; ?>" alt="<?php echo $prod_cat->name; ?>" />
                        <h3><?php echo $prod_cat->name; ?></h3>
                        <a class="btn_carousel" href="<?php echo $term_link; ?>">View all</a>
                    </div>

            <?php }
            endforeach; 
            echo '</div>';
        }
        echo '</div>';    
?>
 

<?php wp_reset_query(); ?>
<style>
      .owl-item > div:after {
        font-family: sans-serif;
        font-size: 24px;
        font-weight: bold;
      }
      
/*     .owl-theme .owl-controls .owl-nav [class*='owl-']{
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
	.procat_carousel .owl-carousel .owl-prev {
		margin-left: -50px !important;
	}
	.procat_carousel .owl-carousel .owl-next {
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
	.procat_carousel .owl-carousel .owl-prev {
		margin-left: -40px !important;
	}
	.procat_carousel .owl-carousel .owl-next {
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
                600:{
                    items:3
                },            
                960:{
                    items:5
                },
                1200:{
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
