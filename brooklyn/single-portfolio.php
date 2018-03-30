<?php
/**
 * The template for displaying single portfolio pages.
 *
 * @package unitedthemes
 */

global $post;

$ut_display_section_header = get_post_meta( get_the_ID() , 'ut_display_section_header' , true );

/* check if page header has been activated */
if( $ut_display_section_header != 'hide' ) {
    
    $ut_page_slogan             = get_post_meta( get_the_ID() , 'ut_section_slogan' , true );
    
    $ut_page_header_style       = get_post_meta( get_the_ID() , 'ut_section_header_style' , true ); 
    $ut_page_header_style       = ( !empty($ut_page_header_style) && $ut_page_header_style != 'global' ) ? $ut_page_header_style : ot_get_option('ut_global_page_headline_style');
    
    /* header width */
    $ut_page_header_width       = get_post_meta( get_the_ID() , 'ut_section_header_width' , true );
    if( !$ut_page_header_width || $ut_page_header_width == 'global' ) {
        $ut_page_header_width = ot_get_option( 'ut_global_page_headline_width', 'seven' );    
    }    
    $ut_page_header_width       = ( $ut_page_header_width == 'ten' ) ? 'grid-100' : 'grid-70 prefix-15';
    
    /* header align */
    $ut_page_header_text_align  = get_post_meta( get_the_ID() , 'ut_section_header_text_align' , true);
    if( !$ut_page_header_text_align || $ut_page_header_text_align == 'global' ) {
        $ut_page_header_text_align = ot_get_option( 'ut_global_page_headline_align', 'center' );
    }
    $ut_page_header_text_align = 'header-' . $ut_page_header_text_align; 
        
}

/* glow effect for header */
$ut_page_title_glow      = get_post_meta( $post->ID , 'ut_section_title_glow' , true) == 'on' ? 'ut-glow' : ''; 

/* post format */
$post_format             = get_post_format();

/* portfolio details */
$ut_portfolio_details    = get_post_meta( $post->ID , 'ut_portfolio_details', true ); 

/* needed variables */
$content = $the_content  = NULL; 
$pageslogan              = get_post_meta( $post->ID , 'ut_page_slogan' , true ); 
$socialshare             = get_option('portfolio_social_setting');
$socialshare_border      = get_option('portfolio_social_border');
$socialshare_border      = empty($socialshare_border) ? 'on' : $socialshare_border; 

/* color and css */
$ut_page_skin            = get_post_meta( $post->ID , 'ut_section_skin' , true);
$ut_page_class           = get_post_meta( $post->ID , 'ut_section_class' , true); ?>

<?php get_header(); ?>
    
    <?php if ( have_posts() ) : ?>
                
        <?php while ( have_posts() ) : the_post(); 
            
            /* assign content - depending on the post format we might need to modify it */
            $content = get_the_content();                  
            
            /* standard post format or audio format */
            if ( empty( $post_format ) || $post_format == 'audio' ) :        

                $the_content = apply_filters( 'the_content' , $content ); 
                
            /* video post format */    
            elseif( $post_format == 'video' ) :               
                 
                /* try to catch video url */
                $video_url = ut_get_portfolio_format_video_content( $content );
                
                if( !empty($video_url) ) : 
                    
                    /* cut out the video url from content and format it */
                    $the_content = str_replace( $video_url , "" , $content);
                    $the_content = apply_filters( 'the_content' , $the_content );
                    
                endif; 
            
            /* gallery post format */
            elseif( $post_format == 'gallery' ) : 
            
                /* assign content */
                $content = preg_replace( '/(.?)\[(gallery)\b(.*?)(?:(\/))?\](?:(.+?)\[\/\2\])?(.?)/s', '$1$6', $content );
                $the_content = apply_filters( 'the_content' , $content );               
                
            endif; ?>    
            
            <div class="grid-container">
                
                <div id="primary" class="grid-parent grid-100 tablet-grid-100 mobile-grid-100 <?php echo $ut_page_skin; ?> <?php echo $ut_page_class; ?>">
                            
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            
                            <?php if( $ut_display_section_header != 'hide' ) : ?>
                            
                            <div class="<?php echo $ut_page_header_width; ?> mobile-grid-100 tablet-grid-100">                                
                                <header class="page-header <?php echo $ut_page_header_style;?> <?php echo $ut_page_header_text_align; ?> page-primary-header">
                                        
                                        <h1 class="page-title <?php echo $ut_page_title_glow; ?>"><span><?php the_title(); ?></span></h1> 
                                        
                                        <?php if( !empty($pageslogan) ) : ?>
                                            <div class="lead"><?php echo wpautop($pageslogan); ?></div>
                                        <?php endif; ?>
                         
                                </header><!-- .page-header -->                             
                             </div>
                             
                             <?php endif; ?>
                             
                             <?php if( is_array( $ut_portfolio_details ) && !empty( $ut_portfolio_details ) ) : ?>
                                
                                <div class="grid-75 tablet-grid-75 mobile-grid-100">
                                
                                    <div class="entry-content clearfix">	
                                        
                                        <?php echo $the_content ?>
                                        
                                        <?php if( $socialshare == 'on' ) : ?>
                                
                                        <div class="clear"></div>
                                                    
                                        <ul class="ut-project-sc clearfix <?php echo $socialshare_border == 'off' ? 'no-border' : '' ?>">
                                            <li><?php esc_html_e('Share:' , 'unitedthemes'); ?></li>
                                            <li><a class="ut-share-link sc-twitter" data-social="utsharetwitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="ut-share-link sc-facebook" data-social="utsharefacebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="ut-share-link sc-google" data-social="utsharegoogle"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a class="ut-share-link sc-linkedin" data-social="utsharelinkedin"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a class="ut-share-link sc-pinterest" data-social="utsharepinterest"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a class="ut-share-link sc-xing" data-social="utsharexing"><i class="fa fa-xing"></i></a></li>
                                        </ul>                                            
                                        
                                        <?php endif; ?>
                                                                      
                                    </div><!-- .entry-content -->
                                      
                                </div>
                                
                                <div class="grid-25 tablet-grid-25 mobile-grid-100">
                                    
                                    <div class="ut-portfolio-info clearfix">
                                    
                                    <?php foreach( $ut_portfolio_details as $portfolio_detail ) {
                                        
                                        if( !empty($portfolio_detail['title']) && !empty($portfolio_detail['value']) ) {                                        
                                            echo "<p>" . $portfolio_detail['title'] . ":<br><span>" . $portfolio_detail['value'] . "</span></p>";
                                        }
                                        
                                    } ?>
                                    
                                    </div>
                                
                                </div>
                             
                             <?php else : ?>
                                
                                <div class="grid-100 mobile-grid-100 tablet-grid-100">
                                  
                                      <div class="entry-content clearfix">	
                                          
                                        <?php echo $the_content; ?>
                                      
                                        <?php if( $socialshare == 'on' ) : ?>
                                
                                        <div class="clear"></div>
                                                    
                                        <ul class="ut-project-sc clearfix <?php echo $socialshare_border == 'off' ? 'no-border' : '' ?>">
                                            <li><?php esc_html_e('Share:' , 'unitedthemes'); ?></li>
                                            <li><a class="ut-share-link sc-twitter" data-social="utsharetwitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a class="ut-share-link sc-facebook" data-social="utsharefacebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a class="ut-share-link sc-google" data-social="utsharegoogle"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a class="ut-share-link sc-linkedin" data-social="utsharelinkedin"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a class="ut-share-link sc-pinterest" data-social="utsharepinterest"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a class="ut-share-link sc-xing" data-social="utsharexing"><i class="fa fa-xing"></i></a></li>
                                        </ul>                                            
                                        
                                        <?php endif; ?>
                                        
                                        <?php edit_post_link( __( 'Edit Portfolio', 'unitedthemes' ), '<span class="edit-link">', '</span>' ); ?>
                                                                          
                                      </div><!-- .entry-content -->
                                      
                                </div>
                                
                            <?php endif; ?> 
                                
                        </div><!-- #post -->
                                                                                
                        <?php if ( comments_open() || '0' != get_comments_number() )  {
                                comments_template();
                        } ?>
                
                </div><!-- close #primary -->
                                
            </div><!-- close grid-container -->
            
            <?php if( ot_get_option( 'ut_single_portfolio_navigation', 'off' ) == 'on' ) : ?>
            
                <section id="ut-portfolio-navigation-wrap">
                    
                    <div class="grid-container">
                        
                        <div class="grid-33 tablet-grid-33 mobile-grid-33">
                            
                            <div class="ut-prev-portfolio">
                                
                                <?php 
                                
                                    if( get_adjacent_post(false, '', false) ) { 
                                    
                                        next_post_link( '%link', '<i class="fa fa-angle-left" aria-hidden="true"></i>' ); 
                                    
                                    } else {
                                        
                                        $args = array(
                                            'post_type'         => 'portfolio',
                                            'posts_per_page'    => 1,
                                            'order'             => 'ASC',
                                            'suppress_filters'  => true,
                                        );
                                        
                                        $last = new WP_Query( $args ); $last->the_post();
                                        echo '<a href="' . get_permalink() . '" rel="next"><i class="fa fa-angle-left" aria-hidden="true"></i></a>';
                                        wp_reset_postdata();
                                    
                                    }
                                
                                ?>
                                    
                            </div>                        
                            
                        </div>
                        
                        <div class="grid-33 tablet-grid-33 mobile-grid-33">
                            
                            <div class="ut-main-portfolio-link">
                                
                                <?php 
                                
                                if( ot_get_option( 'ut_single_portfolio_navigation_main_portfolio_page' ) ) {
                                    
                                    $link = get_permalink( ot_get_option( 'ut_single_portfolio_navigation_main_portfolio_page' ) );
                                    
                                } else {
                                    
                                    $link = '#';
                                
                                }
                                
                                ?>
                                                                
                                <a href="<?php echo esc_url( $link ); ?>">
                                    <i class="fa fa-th-large" aria-hidden="true"></i>
                                </a>
                                
                            </div>
                            
                        </div>                    
                        
                        <div class="grid-33 tablet-grid-33 mobile-grid-33">
                            
                            <div class="ut-next-portfolio">
                                
                                <?php 
                                    
                                    if( get_adjacent_post(false, '', true) ) { 
                                
                                        previous_post_link( '%link', '<i class="fa fa-angle-right" aria-hidden="true"></i>' ); 
                                    
                                    } else {
                                        
                                        $args = array(
                                            'post_type'         => 'portfolio',
                                            'posts_per_page'    => 1,
                                            'order'             => 'DESC',
                                            'suppress_filters'  => true,
                                        );
                                        
                                        $last = new WP_Query( $args ); $last->the_post();
                                        echo '<a href="' . get_permalink() . '" rel="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>';
                                        wp_reset_postdata();
                                        
                                    }
                                
                                ?>
                            </div>
                            
                        </div>                
                    </div>
                
                </section>
            
            <?php endif; ?>
            
        <?php endwhile; // end of the loop. ?>
    			
    <?php endif; ?>
    
<?php get_footer(); ?>