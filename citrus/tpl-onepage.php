<?php
/*
Template Name: One Page Template
*/
?>
<?php get_header(); ?>
            
    <?php
    #To get sections for one page 
    $sections = dttheme_onepage_sections();
    #Begin Section Loop
    $sections_args = array( 'posts_per_page' => -1,'post__in' => (array) $sections,'orderby' => 'post__in', 'post_type'=>array('page'));
    $sections_query = new WP_Query($sections_args);
      
    if( $sections_query->have_posts() ):
        while( $sections_query->have_posts() ):
            $sections_query->the_post();
            
            $section_name = $post->post_name;
            $section_title = $post->post_title;
			
			$template = get_post_meta( $post->ID, '_wp_page_template', true );
			$tpl_default_settings = get_post_meta( $post->ID, '_tpl_default_settings', true );
			
			$section_name_lp = str_replace(' ', '', trim($post->post_title));
            ?>
            <section id="<?php echo $section_name_lp;?>" class="content-main">
                <?php
                if ( $template == "tpl-portfolio.php"  ) :
                 
                    get_template_part( 'framework/loops/content', 'tpl-portfolio' );
                    
                    if(isset($tpl_default_settings['portfolio-bottom-section']) && $tpl_default_settings['portfolio-bottom-section'] != ''):
                        echo '<div class="dt-sc-margin70"></div>';
                        echo do_shortcode($tpl_default_settings['portfolio-bottom-section']);
                    endif;
                    
                elseif ( $template == "tpl-blog.php"  ) : 
                
                    echo '<div class="container">';
                    get_template_part( 'framework/loops/content', 'tpl-blog' );
                    echo '</div>';
                    
                    if(isset($tpl_default_settings['blog-bottom-section']) && $tpl_default_settings['blog-bottom-section'] != ''):
                        echo '<div class="dt-sc-margin70"></div>';
                        echo do_shortcode($tpl_default_settings['blog-bottom-section']);
                    endif;
                    
                elseif ( $template == "tpl-fullwidth.php"  ) : 
                
                    the_content();
                    
                else:
                
                    echo '<div class="container">';
                    the_content();
                    echo '</div>';
                    
                endif;
                wp_link_pages(array('before' => '<div class="page-link"><strong>'.__('Pages:', 'dt_themes').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number'));
                edit_post_link(__( ' Edit ','dt_themes' ),'','',$post->ID);	
                ?>
            </section>
         <?php

        endwhile;
    endif;	
    ?>
    
<?php get_footer(); ?>