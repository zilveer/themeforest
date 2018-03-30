<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package unitedthemes
 */

$ut_display_section_header = get_post_meta( get_the_ID() , 'ut_display_section_header' , true );

/* check if page header has been activated */
if( $ut_display_section_header == 'show' ) {
    
    $ut_page_slogan             = get_post_meta( get_the_ID() , 'ut_section_slogan' , true );
    
    $ut_page_header_style       = get_post_meta( get_the_ID() , 'ut_section_header_style' , true ); 
    $ut_page_header_style       = ( !empty( $ut_page_header_style ) && $ut_page_header_style != 'global' ) ? $ut_page_header_style : ot_get_option('ut_global_page_headline_style','pt-style-1');
    
    
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
        
} ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php if( $ut_display_section_header == 'show' ) : ?>
    
	<div class="<?php echo $ut_page_header_width; ?> mobile-grid-100 tablet-grid-100">
		<header class="page-header <?php echo $ut_page_header_style;?> <?php echo $ut_page_header_text_align; ?> page-primary-header">
            <h1 class="page-title"><span><?php the_title(); ?></span></h1> 
            <?php if( !empty($ut_page_slogan) ) : ?>
                <div class="lead"><?php echo wpautop( $ut_page_slogan ); ?></div>
            <?php endif; ?>
		</header><!-- .page-header -->
    </div>
	
    <?php endif; ?>
    
    <div class="grid-100 mobile-grid-100 tablet-grid-100">
    <div class="entry-content clearfix">	
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'unitedthemes' ),
                'after'  => '</div>',
            ) );
        ?>
        <?php edit_post_link( esc_html__( 'Edit Page', 'unitedthemes' ), '<span class="edit-link">', '</span>' ); ?>    			         		          
    </div><!-- .entry-content -->
    </div>
</div><!-- #post -->