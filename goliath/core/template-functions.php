<?php

/*************** Thumbnails ***************/

if(!function_exists('plsh_get_thumbnail'))
{
    function plsh_get_thumbnail( $size, $return_url = false, $placeholder = true ) {
        global $post;
        $image_sizes = plsh_gs('image_sizes');
        if(!empty($image_sizes[$size]))
        {
            if ( has_post_thumbnail() )
            {
                if($return_url)
                {
                    $src_parts = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
                    return $src_parts[0];
                }
                else
                {
                    $src_parts = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size);
                    return '<img src="' . $src_parts[0] . '" alt=""/>';
                    //return get_the_post_thumbnail($post->ID, $size);
                }
            }
            else
            {
                if($placeholder)
                {
                    if($return_url)
                    {
                        return PLSH_IMG_URL . 'no-image.png';
                    }
                    else
                    {
                        return '<img src="'. PLSH_IMG_URL .'no-image.jpg" alt="Placeholder" width="' . $image_sizes[$size][0] . '" height="' . $image_sizes[$size][1] . '" />';
                    }
                }
                else
                {
                    return false;
                }
            }
        }
    }
}

if(!function_exists('plsh_add_image_sizes'))
{
    function plsh_add_image_sizes()
    {    
        $image_sizes = plsh_gs('image_sizes');
        if(!empty($image_sizes))
        {
            foreach($image_sizes as $key => $size)
            {
                add_image_size($key, $size[0], $size[1], $size[2]);
            }
        }
    }
}

/*************** PAGINATION ***************/

if(!function_exists('plsh_pagination_exists'))
{
    function plsh_pagination_exists()
    {
        global $wp_query;
        if ( $wp_query->max_num_pages > 1 )  return true;	
        return false;
    }
}

if(!function_exists('plsh_get_pagination'))
{
    function plsh_get_pagination()
    {
        $total = plsh_get_max_pages();

        if ( $total > 1 )  
        {
            $current_page = plsh_get_current_page_num();  		
            $append = '';
            $base = get_pagenum_link(1);
            $permalinks_set =  get_option('permalink_structure'); // structure of "format" depends on whether we're using pretty permalinks
            if(empty( $permalinks_set )) 
            {
                $format = '&paged=%#%';
            }
            else
            {
                $format =  'page/%#%/';

                if(strpos($base, '?') !== false)
                {
                    $pos = strpos($base, '?');
                    $append = substr($base, $pos);
                    $base = substr($base, 0, $pos);
                }
            }

            return paginate_links(array(
              'base' => $base . '%_%' . $append,
              'format' => $format,
              'current' => $current_page,
              'total' => $total,
              'mid_size' => 2,
              'type' => 'array',
              'prev_next' => false,
            ));	
        }

        return array();
    }
}

if(!function_exists('plsh_get_max_pages'))
{
    function plsh_get_max_pages()
    {
        global $wp_query;
        return $wp_query->max_num_pages;
    }
}

if(!function_exists('plsh_get_current_page_num'))
{
    function plsh_get_current_page_num()
    {
        return max(1, get_query_var('paged'));
    }
}    

if(!function_exists('plsh_get_next_page_link'))
{
    function plsh_get_next_page_link()
    {
        $max = plsh_get_max_pages();
        $current = plsh_get_current_page_num();

        if($max > $current) { $page_num = $current + 1; }
        else { $page_num = $max; }

        return get_pagenum_link($page_num);
    }
}

if(!function_exists('plsh_get_prev_page_link'))
{
    function plsh_get_prev_page_link()
    {
        $current = plsh_get_current_page_num();

        if( $current > 1) { $page_num = $current - 1; }
        else { $page_num = $current; }

        return get_pagenum_link($page_num);
    }
}

/*************** Breadcrumbs ***************/

if(!function_exists('plsh_breadcrumbs'))
{
    function plsh_breadcrumbs() {  
        $delimiter = '';
        $home = 'Home'; // text for the 'Home' link
        $blog = 'Blog';
        $before = '<a href="#">'; // tag before the current crumb
        $after = '</a>'; // tag after the current crumb

        global $post;
        $homeLink = home_url();
        echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

        if ( get_post_type() == 'post' ) {
            if( get_option( 'show_on_front' ) == 'page' )
            { 
                $posts_page_url = get_permalink( get_option('page_for_posts' ) );
            }
            else
            {
                $posts_page_url = home_url();
            }
            echo '<a href="' . $posts_page_url . '">' . $blog . '</a> ' . $delimiter . ' ';
        }

        if ( is_category() ) {
          global $wp_query;
          $cat_obj = $wp_query->get_queried_object();
          $thisCat = $cat_obj->term_id;
          $thisCat = get_category($thisCat);
          $parentCat = get_category($thisCat->parent);
          if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
          echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

        } elseif ( is_day() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
          echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
          if ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
          } else {
            $cat = get_the_category(); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
          $post_type = get_post_type_object(get_post_type());
          if(!empty($post_type))
          {
            echo $before . $post_type->labels->singular_name . $after;
          }
        } elseif ( is_attachment() ) {
          $parent = get_post($post->post_parent);
          $cat = get_the_category($parent->ID); $cat = $cat[0];
          echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
          echo $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {
          

        } elseif ( is_page() && $post->post_parent ) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
          echo $before . get_the_title() . $after;

        } elseif ( is_search() ) {
          echo $before . 'Search results for "' . get_search_query() . '"' . $after;

        } elseif ( is_tag() ) {
          echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

        } elseif ( is_author() ) {
           global $author;
          $userdata = get_userdata($author);
          echo $before . 'Articles posted by ' . $userdata->display_name . $after;

        } elseif ( is_404() ) {
          echo $before . 'Error 404' . $after;
        }

        if ( get_query_var('paged') ) {
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
          echo __('Page', 'goliath') . ' ' . get_query_var('paged');
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }  
    }
}

if(!function_exists('plsh_output_taxonomy_hierarchy_option_tree'))
{
    function plsh_output_taxonomy_hierarchy_option_tree($data, $taxonomy, $level = 0)
    {
        global $wp_query;
        $category_slug = '';
        $cat_obj = $wp_query->get_queried_object();

        if(!empty($cat_obj) && !empty($cat_obj->slug))
        {
            $category_slug = $cat_obj->slug;
        }

        $padding = '';
        for($i = 0; $i < $level; $i++)
        {
            $padding .= '&emsp;';
        }

        foreach($data as $item)
        {
            echo '<option value="' . $item->slug . '"';
            if(plsh_get($_GET, $taxonomy) == $item->slug || $category_slug == $item->slug) echo 'selected="selected"';
            echo '>' . $padding . $item->name . '</option>';
            if(!empty($item->children))
            plsh_output_taxonomy_hierarchy_option_tree($item->children, $taxonomy, ++$level);
        }
    }
}

if(!function_exists('plsh_get_sidebar_page_type'))
{
    function plsh_get_sidebar_page_type() 
    {
        $page = NULL;

        if( is_home() ) {
            $page = 'blog';
        } elseif( is_single() && get_post_type() == 'post' ) {
            $page = 'single_post';
        } elseif( is_category() ) {
            $page = 'categories';
        } elseif( is_search() ) {
            $page = 'search';
        } elseif( is_archive() ) {
            $page = 'archives';
        } elseif( is_page() ) {
            $page = 'page';
        }
        
        if(plsh_is_woocommerce_active())
        {
            if(is_shop()) {
                $page = 'shop';
            } elseif(is_product()) {
                $page = 'product';
            }
        }

        if(function_exists('is_bbpress'))
        {
            if( is_bbpress() ) 
            {
                $page = 'forum';
            }
        }
        
        return $page;
    }
}

if(!function_exists('plsh_comments'))
{
    function plsh_comments($comment, $args, $depth)
    {
        global $comment_iterator_count;
        if(empty($comment_iterator_count))
        {
            $comment_iterator_count = 1;
        }
        else
        {
            $comment_iterator_count++;
        }

        if($comment->comment_type == '') //normal comment
        {
            ?>
            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                
                <div class="item">
                    <a href="#" class="image"><?php echo get_avatar( $GLOBALS['comment'], $size='38' ); ?></a>
                    <div class="comment-inner">
                        <div class="info">
                            <h2><a href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></h2>
                            <span class="legend-default"><i class="fa fa-clock-o"></i><?php comment_date(); ?></span>
                            <?php
                                echo '<span class="nr">#' . $comment_iterator_count . '</span>';
                            ?>
                            <i class="tag-default">Author</i>
                        </div>
                        <p>
                            <?php comment_text(); ?>
                            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth,) ) ); ?>
                        </p>
                    </div>
                </div>
            <?php
        }   
    }
}

if(!function_exists('plsh_output_theme_version'))
{
    function plsh_output_theme_version()
    {
        $theme = 'Planetshine - ' . plsh_gs('theme_name') . ' - ' . plsh_gs('theme_version');
        echo '<meta name="generator" content="' . $theme . '">';
    }
}

if(!function_exists('plsh_customize_register'))
{
    function plsh_customize_register( $wp_customize ) 
    {   
        $settings = Plsh_Settings :: get_visual_editor_settings();

        if(!empty($settings['head']))
        {
            foreach($settings['head'] as $section)
            {
                $wp_customize->add_section( $section['slug'] , array(
                    'title'      => __( $section['name'] , 'goliath' ),
                    'priority'   => plsh_get($section, 'priority', 20),
                ) );

                if(!empty($settings['body'][$section['slug']]))
                {
                    $body = $settings['body'][$section['slug']];
                    $priority = 1;
                    
                    foreach($body as $item)
                    {
                        $wp_customize->add_setting(
                            $item['slug'] , array(
                                'default'     => $item['default'],
                                'transport'   => 'refresh',
                                'sanitize_callback' => 'plsh_setting_sanitize_callback'
                            )
                        );

                        $params = array(
                            'label'        => __( $item['title'], 'goliath' ),
                            'section'    => $section['slug'],
                            'settings'   => $item['slug'],
                            'priority'   => $priority
                        );

                        if($item['type'] == 'color')
                        {
                            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $item['slug'], $params ));
                        }
                        elseif($item['type'] == 'background')
                        {
                            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $item['slug'], $params ));
                        }
                        else
                        {

                            if($item['type'] == 'checkbox')
                            {
                                $params['type'] = $item['type'];
                            }
                            if($item['type'] == 'select' && !empty($item['data']))
                            {
                                $params['type'] = $item['type'];
                                $params['choices'] = $item['data'];
                            }
                            if($item['type'] == 'font_select' && !empty($item['data']))
                            {
                                $params['type'] = 'select';
                                $data = $item['data'];

                                foreach($data as $key => $value)
                                {
                                    $params['choices'][$key] = $value['name'];
                                }
                            }
                            
                            $control = new WP_Customize_Control( $wp_customize, $item['slug'], $params );
                            $wp_customize->add_control( $control );
                        }
                        
                        $priority++;
                    }
                }

            }

        }

    }
}

if(!function_exists('plsh_setting_sanitize_callback'))
{
    function plsh_setting_sanitize_callback($value)
    {
        return $value;
    }
}

if(!function_exists('plsh_header_output'))
{
    function plsh_header_output() {
       
		include PLSH_THEME_PATH . 'customizer-settings.php';
		
		?>
       <!--Customizer CSS--> 
       <style type="text/css">
           <?php            
           ?>
       </style> 
       <!--/Customizer CSS -->

       <!-- User css -->
       <style type="text/css">
           <?php echo stripslashes(plsh_gs('custom_css')); ?>
       </style>
       <!--/User CSS -->

       <!-- User JS -->
       <script type="text/javascript">
           <?php echo stripslashes(plsh_gs('custom_js')); ?>
       </script>
       <!--/User JS -->


       <!-- Javascript settings -->
       <script type="text/javascript">
            var plsh_settings = new Object();
       </script>
       <!-- Javascript settings -->

       <?php
              
    }
}

if(!function_exists('plsh_get_all_google_fonts'))
{
    function plsh_get_all_google_fonts()
    {
		global $selected_google_fonts, $google_font_weights;
		
		$extra_fonts = get_option('plsh_extra_google_fonts', false);
		if($extra_fonts)
		{
			foreach($extra_fonts as $ef)
			{
				$slug = str_replace(' ', '+', $ef);
				$selected_google_fonts[$slug] = array(
					'slug'   => $slug,
					'name'   => $ef,
					'url'    => $ef . $google_font_weights,
					'status' => 'on'
				);
			}	
		}
		
		return $selected_google_fonts;
	}
}


if(!function_exists('plsh_google_fonts_url'))
{
    function plsh_google_fonts_url()
    {
        //add font stylesheets
        $fonts = plsh_get_all_google_fonts();
        $protocol = is_ssl() ? 'https' : 'http';
        $custom_fonts = plsh_gs('custom_fonts', false);
		$font_families = array();
        
        if(!empty($fonts) && !empty($custom_fonts))
        {
            foreach($custom_fonts as $cf)
            {
                $default = plsh_gs($cf);
                $font = get_theme_mod($cf, $default);
				
				if(empty($fonts[$font]))
				{
					$font = $default;
				}
				
                if(!empty($font) && !empty($fonts[$font]) && $fonts[$font]['status'] !== 'off')
                {
					$font_families[$fonts[$font]['url']] = $fonts[$font]['url'];
                }

            }
        }

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
        );
		
		$fonts_url = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );

		return esc_url_raw( $fonts_url );
    }
}


function archive_title($title = 'News')
{
    if(is_tax())
    {
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        $title = $term->name;
    }
    if(is_category())
    {
        $title = single_cat_title('', false);
    }
    if(is_tag())
    {
        $title = single_tag_title('', false);
    }
   
   return $title;
}