
<?php
 //https://stackoverflow.com/questions/25517289/wp-query-pagination-on-shortcode
/**************/
[vpsa_posts post_type="post"] 
if ( ! function_exists('vpsa_posts_shortcode') ) {
        function vpsa_posts_shortcode( $atts ){

            $atts = shortcode_atts( array(
							'post_type' =>   'post',
                            'per_page'  =>   2,  
                            'order'     =>  'DESC',
                            'orderby'   =>  'date'
                    ), $atts );

            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

            $args = array(
                'post_type'         =>  $atts["post_type"],
                'posts_per_page'    =>  $atts["per_page"], 
                'order'             =>  $atts["order"],
                'orderby'           =>  $atts["orderby"],
                'paged'             =>  $paged
            );

            $query = new WP_Query($args);
                    if($query->have_posts()) : $output;
					$output .='<div class='.$atts["post_type"].'>';
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

                        endwhile;
					$output .= '</div>';
			global $wp_query;
    	$args_pagi = array(
            'base' => add_query_arg( 'paged', '%#%' ),
            'total' => $query->max_num_pages,
//             'current' => $paged
            );
                        $output .= '<div class="post-nav">';
                            $output .= paginate_links( $args_pagi);
                        //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';
                        $output .= '</div>';
                    else:
                        $output .= '<p>No Data found</p>';
                    endif;
                wp_reset_postdata();
                return $output;
        }
    }

    add_shortcode('vpsa_posts', 'vpsa_posts_shortcode');
