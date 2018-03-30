<?php
/**
 *
 * @subpackage newidea
 * @since newidea 1.0
 *
 */
 
//Don't remove it,it's important
$root = '../../../';
if(file_exists($root.'wp-load.php')){
	require_once($root.'wp-load.php');
}else if(file_exists($root.'wp-config.php')){
	require_once( $root.'wp-config.php' );
}

$title = isset($_REQUEST['post_title']) ? $_REQUEST['post_title'] : "";
$post_id = isset($_REQUEST['post_id']) ? $_REQUEST['post_id'] : "1";
$href = isset($_REQUEST['href']) ? $_REQUEST['href'] : "";

$args=array(
		  'post_type' => 'post',
		  'p' => $post_id,
		  'posts_per_page' => 1
		  );
		  
query_posts($args);
?>
<!--Single-->
<section id="single-post-just-view" class="contBg content-news" data-title="<?php echo $title; ?>" data-bg=""  >
	<span></span>
	<div class="news-container">
		<?php
			if(have_posts()) {
		?>
        <div class="single-post-content">
        	<div class="news-back"><a href="<?php echo $href; ?>"><?php echo __('Back','newidea'); ?></a></div>
        	<?php
			// The Loop
			while ( have_posts() ) : the_post();
			?>
            <div <?php post_class('newsList');?> >
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
                    <h6 class="title"><?php echo get_the_title(); ?></h6>
                    <div class="scroll-pane">
                       <?php global $more;$more = 100;the_content(); ?>
                    </div>
                 </div>
			</div>
			<?php endwhile; ?>
		</div>
        <?php }else{
			echo __('Please open admin backend\'s <strong><em>Posts -&gt; Add New</em></strong> add your posts/news items.','newidea');
		?>
        <?php } ?>
	</div>
</section>
