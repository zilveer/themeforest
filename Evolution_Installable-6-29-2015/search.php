<?php /** The template for displaying Archive pages. **/
get_header();
$alc_options = get_option('alc_general_settings');
$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
$titles = $alc_options['alc_show_page_titles'];

$id = get_page_ID_by_page_template('blog-template.php'); 
$custom =  get_post_custom($id);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$name = get_page_name_by_ID($id); 
$promo = get_post_meta($id, "_promo", $single = false);
?>
<?php if(!empty($promo[0]) ):?>
    <div class="row content_top promo-block">
        <div class="twelve columns">
            <h2><?php echo do_shortcode($promo[0]);?></h2>
	</div>
    </div>
<?php endif ?>
<?php $headline = get_post_meta($id, "_headline", $single = false);?>
<div class="row">
    <div class="large-12 columns main-content-top">
        <div class="row">
            <div class="large-6 columns">
                <h2><?php printf( __( 'Search Results for: %s', 'Evolution' ), '<mark>' . get_search_query() . '</mark>' ); ?></h2>
            </div>        
            <div class="large-6 columns">            
                <?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
            </div>
        </div>
    </div>
</div>
<div class="shadow"></div>
<div class="row main-content">	
    <div class="large-12 columns">
        <div class="row">
        <?php if ($layout == '3'):?>
            <aside class="large-3 columns sidebar-left" id="sidebar"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?></aside>
	<?php endif?>
	<div class="<?php echo $layout == '1' ? 'large-12' : 'large-9'?> columns"> 
            <?php if ( have_posts() ) : ?>
                <?php get_template_part( 'loop', 'search' );?>
            <?php else : ?>
                <div id="post-0" class="post no-results not-found">
                    <h4><?php _e( 'Nothing Found', 'Evolution' ); ?></h4>
                    <div class="entry-content">
                        <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'Evolution' ); ?></p>
                     </div><!-- .entry-content -->
		</div><!-- #post-0 -->
            <?php endif; ?>
	</div>
	<?php if ($layout == '2'):?>
            <aside class="large-3 columns sidebar-right" id="sidebar"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?></aside>
	<?php endif?>
	<div class="clear"></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>