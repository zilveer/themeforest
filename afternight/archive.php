<?php get_header(); ?>
<?php
    $template = 'archive';
?>
<section id="main">
    
    <?php echo get_my_search_form(); ?>

    <div class="main-container">    
        <div class="row">
            <div class="twelve columns cat-title">
                <?php
                    if( have_posts () ){
                        ?>
                        <h2><span>
                            <?php
                                if(is_tax( 'portfolio' )){
                                    echo __( 'Portfolio archives' , 'cosmotheme' );
                                }else if ( is_day() ) {
                                    echo __( 'Daily archives' , 'cosmotheme' ) . ':' . get_the_date();
                                }else if ( is_month() ) {
                                    echo __( 'Monthly archives' , 'cosmotheme' ) . ':' . get_the_date( 'F Y' );
                                }else if ( is_year() ) {
                                    echo __( 'Yearly archives' , 'cosmotheme' ) . ':' . get_the_date( 'Y' );
                                }else if (is_tax( 'post_format' )){
                                    $format = get_post_format();
                                    switch ($format) {
                                        case 'gallery':
                                            $f = __('Gallery', 'cosmotheme');
                                            break;
                                        case 'video':
                                            $f = __('Video', 'cosmotheme');
                                            break;
                                        case 'audio':
                                            $f = __('Audio', 'cosmotheme');
                                            break;
                                        case 'image':
                                            $f = __('Image', 'cosmotheme');
                                            break;
                                        case 'quote':
                                            $f = __('Quote', 'cosmotheme');
                                            break;

                                        default:
                                            $f = $format;
                                            break;
                                    }
                                    echo __( 'Post format archives' , 'cosmotheme' ) . ':' . $f;
                                }else if (get_post_type() == 'event'){
                                    echo __( 'Event archives' , 'cosmotheme' ); 
                                }else if(is_post_type_archive()){    
                                    echo sprintf(__( '%s archives' , 'cosmotheme' ), post_type_archive_title());
                                }else {
                                    echo __( 'Blog archives' , 'cosmotheme' );
                                }
                            ?>

                        </span></h2><?php
                    }else{
                        ?><h2 ><?php _e( 'Sorry, no posts found' , 'cosmotheme' ); ?></h2><?php

                    }
                ?>
            </div>
        </div>
        <?php
            add_filter( 'pre_get_posts', 'namespace_add_custom_types' ); /*add folter that will show all post types on archive pages*/
            if (is_tax( 'post_format' )){
                $layout = new LBSidebarResizer( 'archive_format' ); /*for post format archive*/   
            }else if(is_post_type_archive()){                
                $layout = new LBSidebarResizer( 'archive_post_type' ); /*for post type 'Portfolio' archive*/   
            }else{
                $layout = new LBSidebarResizer( 'archive' );    
            }
            
            $layout -> render_frontend();

            remove_filter( 'pre_get_posts', 'namespace_add_custom_types' ); /*remove folter that will show all post types on archive pages*/

        ?>
    </div>
</section>
<?php get_footer(); ?>