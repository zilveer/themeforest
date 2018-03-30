<?php
    
    // Class for specifying whether current page is homepage or not
    $class = '';
	$inner_class = ' large-12 ';
    if(!is_front_page()) {
        $class = 'not-homepage';
		$inner_class = ' large-9 large-centered ';
    }
    
    $is_displayed = '';
    $title = '';
    $body = '';
    
    if(is_tag() || is_date() || is_category() || is_search() || is_author()) {
        $is_displayed = 'true';
        if(is_tag()) {
            $title = __('Tag:', 'uxbarn') . ' <strong>' . single_tag_title('', false) . '</strong>';
        } else if(is_date()) {
            $title = __('Archive:', 'uxbarn') . ' <strong>' . get_the_date('F Y') . '</strong>';
        } else if(is_category()) {
            $title = '<strong>' . single_cat_title('', false) . '</strong>';
        } else if(is_search()) {
            $title = __('Search:', 'uxbarn') . ' <strong>' . $_GET['s'] . '</strong>';
        } else if(is_author()) {
            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
            $title = __('Author:', 'uxbarn') . ' <strong class="intro-title">' . $curauth->display_name . '</strong>';
        } else {
            $title = '';
        }
        
    } else if(is_tax()) {
        if(is_tax('portfolio-category')) {
            $title = __('Portfolio Category:', 'uxbarn') . ' <strong>' . single_term_title('', false) . '</strong>';
            $body = term_description();
        }
         
    } else if(is_single()) {
                
        if(have_posts()) : while(have_posts()) : the_post();
        
            if(is_singular('portfolio')) {
                $is_displayed = 'true';
                $title = uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_portfolio_single_title'), 0);
                $title = trim($title) == '' ? get_the_title() : $title;
            
            } else if(is_singular('team')) {
                $title = get_the_title($post->ID);
                $body = uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_staff_excerpt'), 0);
                
            } else if(is_singular('post')) {
                
                if(get_option('show_on_front') == 'posts') { // Set as "Your latest posts" in "Settings> Reading" 
                    
                } else { // Set as "static page"
                    // Get blog page's ID
                    $post_id = get_option('page_for_posts');
                    
                    $is_displayed = uxbarn_get_array_value(get_post_meta($post_id, 'uxbarn_page_intro_display'), 0);
                    
                    $title = uxbarn_get_array_value(get_post_meta($post_id, 'uxbarn_page_intro_title'), 0);
                    $title = trim($title) == '' ? get_the_title($post_id) : $title;
                    $body = uxbarn_get_array_value(get_post_meta($post_id, 'uxbarn_page_intro_body'), 0);
                }
                
            }
        
        endwhile; endif;
        
    } else {
        $post_id = '';
        if(is_front_page()) {
            if(is_home()) { // Case of "Your latest posts" selection
                if($post) {
                    $post_id = $post->ID;
                }
            } else { // Case of "Static page" selection
                if(get_option('show_on_front') == 'page') {
                    $post_id = get_option('page_on_front');
					
                } else {
                    $post_id = get_option('page_for_posts');
                }
            }
        } else {
            if(is_home()) {
                $post_id = get_option('page_for_posts');
                
            } else {
                if(!is_404()) {
                    // Normal Page
                    global $wp_query;
                    $post_id = $wp_query->post->ID;
					
					// If current page is a child of the page that is set as front page, use the styles as front page
					if($wp_query->post->post_parent == get_option('page_on_front')) {
						$class = '';
						$inner_class = ' large-12 ';
					}
					
                }
            }
        }
        
        $is_displayed = uxbarn_get_array_value(get_post_meta($post_id, 'uxbarn_page_intro_display'), 0);
        $title = uxbarn_get_array_value(get_post_meta($post_id, 'uxbarn_page_intro_title'), 0);
        $title = trim($title) == '' ? get_the_title($post_id) : $title;
        $body = uxbarn_get_array_value(get_post_meta($post_id, 'uxbarn_page_intro_body'), 0);
        
    }

	//echo var_dump($is_displayed);
    if ( $is_displayed == '' || $is_displayed == 'false' ) {
		$is_displayed = false;
	} else {
		$is_displayed = true;
	}
    
	
	
    $allowed_html = array(
						'span' => array(),
						'br' => array(),
						'p' => array(),
						'strong' => array(),
						'b' => array(),
						'em' => array(),
						'i' => array(),
					);
    
    $title = balanceTags( wp_kses( uxbarn_get_translated_text_from_qTranslate( $title ), $allowed_html ), true);
    $body = balanceTags( uxbarn_get_translated_text_from_qTranslate( $body ), true);

?>

<?php if($is_displayed != '' || is_tax()) : ?>
    <div id="intro" class="<?php echo $class; ?> row">
        <div class="uxb-col <?php echo $inner_class; ?> columns">
            
            <?php if(is_single()) : ?>
                <?php if(is_singular('post')) : ?>
                    <h2><?php echo $title; ?></h2>
                <?php else : ?>
                    <h1><?php echo $title; ?></h1>
                <?php endif; ?>
            <?php else : ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            
            <?php if(trim($body) != '') : ?>
                <?php if(is_front_page() || $class == '') : ?> 
                    <div id="intro-line">
                        <hr class="stick" />
                        <hr />
                    </div>
                <?php endif; ?>
            
                <p>
                    <?php echo $body; ?>
                </p>
            <?php endif; ?>
            
        </div>
    </div>
<?php endif; ?>