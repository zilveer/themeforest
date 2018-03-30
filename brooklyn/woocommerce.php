<?php

$ut_page_skin = get_post_meta( $post->ID , 'ut_section_skin' , true);
$ut_page_class = get_post_meta( $post->ID , 'ut_section_class' , true);

$ut_display_section_header = get_post_meta( get_the_ID() , 'ut_display_section_header' , true );

/* check if page header has been activated */
if( $ut_display_section_header == 'show' ) {
    
    $ut_page_slogan             = get_post_meta( get_the_ID() , 'ut_section_slogan' , true );
    
    $ut_page_header_style       = get_post_meta( get_the_ID() , 'ut_section_header_style' , true ); 
    $ut_page_header_style       = ( !empty($ut_page_header_style) && $ut_page_header_style != 'global' ) ? $ut_page_header_style : ot_get_option('ut_global_headline_style');
    
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

?>

<?php get_header(); ?>
    
    <div class="grid-container">
    
        <?php $grid = ( is_active_sidebar('shop-widget-area') && ( is_shop() || is_product_category() || is_product_tag() ) ) ? 'grid-75 tablet-grid-75 mobile-grid-100' : 'grid-100 tablet-grid-100 mobile-grid-100'; ?>
        
        <div id="primary" class="grid-parent <?php echo $grid; ?> <?php echo $ut_page_skin; ?> <?php echo $ut_page_class; ?>">
            
            <?php if( $ut_display_section_header == 'show' ) : ?>
    
            <div class="<?php echo $ut_page_header_width; ?> mobile-grid-100 tablet-grid-100">
                <header class="page-header <?php echo $ut_page_header_style;?> <?php echo $ut_page_header_text_align; ?>">
                    <h1 class="page-title"><span><?php the_title(); ?></span></h1> 
                    <?php if( !empty($ut_page_slogan) ) : ?>
                        <p class="lead"><?php echo $ut_page_slogan; ?></p>
                    <?php endif; ?>
                        
                    <div class="entry-meta">
                        <?php edit_post_link( esc_html__( 'Edit Page', 'unitedthemes' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>                                  
                </header><!-- .page-header -->
            </div>
            
            <?php endif; ?>            
                
            <?php woocommerce_content(); ?>
            
        </div>
        
        <?php if( is_shop() || is_product_category() || is_product_tag() ) : ?>
        
            <?php get_sidebar('shop'); ?>
        
        <?php endif; ?>
        
    </div><!-- close grid-container -->

<?php get_footer(); ?>