<?php

// Blog grid

function th_blog_grid($atts, $content = null) {
    extract(shortcode_atts(array(
		"display_style" => "style1",
        "number" => "3",
        "categories" => "",
        "number_text" => "30",
        "order" => "asc",
        "orderby" => "none"

    ), $atts));

    global $post;


    if(!function_exists('st_excerpt_content'))
    {
        function st_excerpt_content($number_text){
            $excerpt = explode(' ', get_the_excerpt(), $number_text);
            if(count($excerpt)>= $number_text){
                array_pop($excerpt);
                $excerpt = implode(" ",$excerpt).'...';
            }else{
                $excerpt=implode(" ", $excerpt);
            }
            $excerpt =preg_replace('`[[^]]*]`','',$excerpt);
            return $excerpt;
        }
    }

    if(!function_exists('th_comments')) {
        function th_comments()
        {
            $com_number = get_comments_number();
            if ($com_number == 0) {
                $th_comments = 'Leave a comment';
            }
            if ($com_number == 1) {
                $th_comments = '1 Comment';
            }
            if ($com_number > 1) {
                $th_comments = $com_number . ' Comments';
            }

            return _x($th_comments, 'comments', 'larx');
        }
    }

    $output = '';
    $blog_array_cats = get_terms('category', array('hide_empty' => false));
    if(empty($categories)) {
        foreach($blog_array_cats as $blog__array_cat) {
            $categories .= $blog__array_cat->slug .', ';
        }
    }

    $args = array(
        'orderby'=> $orderby,
        'order' => $order,
        'post_type' => 'post',
        'category_name' => $categories,
        'posts_per_page' => $number
    );

    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {

        $output .= '<div class="blog">';
		$output2 = '';

        while ($my_query->have_posts()) : $my_query->the_post();
            $time = get_the_time(get_option('date_format'));
           $id = get_the_ID();
	
			if($display_style == 'style2'){
				$output2 .= '<div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <div class="i-blog-inner">
                                    <a href="'. get_permalink($id).'">'. get_the_post_thumbnail($id, 'blog-thumb').'
                                        <div class="i-blog-caption">                                            
                                            <div class="i-blog-holder">   
                                                <div class="i-blog-details">                                             
                                                    <h3>View post</h3>            
                                                </div>                                                                        
                                            </div>
                                        </div>
                                    </a>                                
                                </div>
								
									

								<div class="col-sm-2 pull-left blog_small_desc">									
									<div class="blog-date-small">
										<span class="blog_small_day">'.get_the_time('d').'</span>
										<span class="blog_small_month">'.get_the_time('M').'</span>
									</div></div>
								<div class="col-sm-10 pull-right small_content">
									<div class="blog-title">
										<a href="'.get_permalink($id).'"><h3>'.get_the_title().'</h3></a>
									</div>
									<p class="text-left">'.st_excerpt_content($number_text).'</p>
								</div>									
                            </div>
                        </div>';
			}
			else{
				$output2 .= '<div class="col-sm-6 col-md-4">
								<div class="thumbnail">
									<div class="i-blog-inner">
										<a href="'. get_permalink($id).'">'. get_the_post_thumbnail($id, 'blog-thumb').'
											<div class="i-blog-caption">                                            
												<div class="i-blog-holder">   
													<div class="i-blog-details">                                             
														<h3>View post</h3>            
													</div>                                                                        
												</div>
											</div>
										</a>                                
									</div>
									<div class="blog-title">
										<a href="'.get_permalink($id).'"><h3>'.get_the_title().'</h3></a>
									</div>	
									<div class="blog-date">
										<p>'.$time.'<span>|<a href="'. get_permalink($id).'/#respond">'.th_comments().'</a></span></p>
									</div>
									<p class="text-left">'.st_excerpt_content($number_text).'</p>                                
								</div>
							</div>';
			}
            

        endwhile;
        $output .= $output2;
        $output .= '</div>';
    }
    wp_reset_query();
    return $output;
}

remove_shortcode('blog-grid');
add_shortcode("blog-grid", "th_blog_grid");