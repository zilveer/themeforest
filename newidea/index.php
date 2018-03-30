<?php
/**
 * The Index for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage newidea
 * @since newidea 4.0
 */
 
global $pages_rel, $page_id, $object_id, $default_background;

$page_id	= 'home';
$pages_rel  = newidea_get_menus();
$default_background = newidea_get_options_key('home-default-background');
$background_overlay = newidea_get_background_overlay();

get_header();

// theme config
get_template_part('template/theme-config');
?>
<!-- All content elements -->
<section id="content-elements">
<?php
	// other page as post page
	if(is_home() && !is_front_page() && intval(get_option('page_for_posts')) != 0){
		
		$post_obj = get_post(get_option('page_for_posts'));
		$page_id = strtolower($post_obj->post_title);
		$page_id = str_replace(' ','_',$page_id);
		$page_id = str_replace('&','_',$page_id);
		$bool = true;
		echo '<input id="content-elements-page" type="hidden" value="'.$page_id.'" ></input>';
		foreach($pages_rel as $page_item){
			$object_id = $page_item['object_id'];
			if($object_id == get_option('page_for_posts')){
				$bool = false;
				break;
			}
		}
		if($bool) { get_template_part('content','news'); };
	}
	
	if(is_404()){
		echo '<input id="content-elements-page" type="hidden" value="404" ></input>';
		get_template_part('content','404');
	}else{

?>
<!--News-->
<section id="<?php echo $page_id;?>" <?php post_class('contBg content-news'); ?> data-bg="<?php echo $default_background;?>"  >
	<span></span>
	<div class="news-container">
		<?php
			if(have_posts()) {
		?>
        <div class="jcarousel-news">
        	<?php
			// The Loop
			while ( have_posts() ) : the_post();
			?>
            <div <?php post_class('jcarousel-item newsList');?> >
            	<div class="item-image">
                	<?php if(has_post_thumbnail(get_the_ID()) ){?>
                		<?php echo get_the_post_thumbnail(get_the_ID(), 'post-thumbnail' ,array('alt' => get_the_title(),'title' => get_the_title())); ?>
                   <?php } ?>
                </div>
                <div class="rhtCol">
                	<div class="news-information">
                    <span class="newsDate"><?php echo get_the_date('d M Y'); ?></span><?php if(newidea_get_options_key('news-show-category') == "on") : ?>-<span class="newsCategory"><?php 	$categories = get_the_category();
							$seperator = ' , ';
							$output = '';
							if($categories){
								foreach($categories as $category) {
									$output .= $category->cat_name.$seperator;
								}
							echo trim($output, $seperator);
							}
				 ?><?php endif; ?></span>
                 	</div>
                    <h6 class="title link" data-id="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></h6>
                    <div class="scroll-pane">
                       <div>
                       <?php					
						global $more;    // Declare global $more (before the loop).
						$more = 0;       // Set (inside the loop) to display content above the more
						the_content(__('Read More &raquo;','newidea'),true); 
						?>
                       </div>
                    </div>
                 </div>
          	</div>
			<?php endwhile; ?>
         </div>
        <?php }else{
			echo __('Nothing Found.','newidea');
		?>
        <?php } ?>
      </div>

</section>
<?php } ?>
<?php 
// other pages
get_template_part('template/pages/loop');
?>
</section>
<?php get_footer(); ?>
