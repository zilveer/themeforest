<?php /** The main template file **/

get_header();
$catid = get_query_var('cat');
$cat = get_category($catid);

$alc_options = get_option('alc_general_settings');
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';

?>

<div class="shadow"></div>
<div class="row main-content">        
    <div class="large-12 columns">
        <div class="row">
            <?php if ($layout == '3'):?><aside class="large-3 columns sidebar-left"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?></aside><?php endif?>
                <div class="<?php echo $layout == '1' ? 'large-12' : 'large-9'?> columns">
                    <?php 
                        $temp = $wp_query;
                        $wp_query= null;
                        $wp_query = new WP_Query();
                        $pp = get_option('posts_per_page');
                        $wp_query->query('posts_per_page='.$pp.'&paged='.$paged);			
                        get_template_part( 'loop', 'index' );
						wp_link_pages();
                    ?>
                </div>
            <?php if ($layout == '2'):?><aside class="large-3 columns sidebar-right"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?></aside><?php endif?>	
        <div class="clear"></div>
        </div>
    </div>
</div>

<?php get_footer();?>