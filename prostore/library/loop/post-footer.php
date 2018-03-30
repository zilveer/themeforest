<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/loop/post-footer.php
 * @file	 	1.0
 */
?>
<?php global $masonry, $data, $prefix; ?>

<?php  

	$date = 0; $category = 0; $tags = 0; $comments = 0; $likes = 0;
	
	if(get_post_type()!="page") {
		$date = $data[$prefix."meta_date"];
		if(get_post_type()=="portfolio") $date = $data[$prefix."meta_portf_date"];
		if($masonry != "mini" && get_post_type()=="post") $date = "0";
		if(get_post_type()=="portfolio" && $data[$prefix."meta_portf_date"]!="1") $date = "0";
			
		$category = $data[$prefix."meta_category"];
		if(!has_category() || get_post_type()!="post") $category = "0";
				
		$field= $data[$prefix."meta_portf_field"];
		if(get_post_type()!="portfolio" || !has_term('','field')) $field = "0";
				
		$product_cat= $data[$prefix."meta_category"];
		if(get_post_type()!="product" || !has_term('','product_cat')) $product_cat = "0";
		
		$tags = $data[$prefix."meta_tags"];
		if(get_post_type()!="post" || !has_tag()) $tags = "0";
		
		$comments = $data[$prefix."meta_comments"];
		if(!comments_open() || get_post_type()!="post" || $post->post_password!="") $comments = "0";
		
		$likes = $data[$prefix."meta_likes"];
		if(get_post_type()=="portfolio") $likes = $data[$prefix."meta_portf_likes"];
		if(!function_exists('zilla_likes')) $likes = "0";
		if(get_post_type()=="portfolio" && $data[$prefix."meta_portf_likes"]!="1") $likes = "0";
	}
	
	$class1="eight mobile-three"; $class2="four mobile-one";
	if($likes != "1" && $comments != "1") { $class1="twelve"; $class2=""; }

?>
			
<?php if(get_post_type()!="page" && ($date != "0" || $category != "0" || $tags != "0" || $comments != "0" || $likes != "0")) { ?>	
	<footer class="clearfix">
		<div class="<?php echo $class1; ?> columns mobile-three">
			<?php if($date=="1") { ?>
				<p class="meta-item">	
					<em class="icon-clock-alt"></em>
					<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>	
						<?php the_time('j-m-Y'); ?>
					</time>
				</p>
			<?php } ?>
			
			<?php if ($field=="1") { ?>		
				<p class="meta-item">
					<em class="icon-archive"></em> <?php echo get_the_term_list( get_the_ID(), 'field', "",", " ); ?>
				</p>
			<?php } ?>								
			<?php if($product_cat=="1") { ?>
				<p class="meta-item">
					<em class="icon-archive"></em> <?php echo get_the_term_list( get_the_ID(), 'product_cat', "",", " ); ?>
				</p>
			<?php } ?>
			<?php if($category=="1") { ?>
				<p class="meta-item">
					<em class="icon-archive"></em> <?php the_category(', '); ?>
				</p>
			<?php } ?>
			<?php if($tags=="1") { ?>
				<p class="meta-item">
					<em class="icon-tag"></em> <?php the_tags('', ', ', ''); ?>
				</p>
			<?php } ?>
		</div>	
		<?php if($class2!="") { ?>
			<div class="<?php echo $class2; ?> columns mobile-one text-right icons">					
				<?php if ( $comments=="1") { ?>
					<span class="comments-link"><?php comments_popup_link( __( '<em class="icon-comment-alt"></em> 0', 'prostore-theme' ), __( '<em class="icon-comment-alt"></em> 1', 'prostore-theme' ), __( '<em class="icon-comment-alt"></em> %', 'prostore-theme' ) ); ?></span>
				<?php } ?>													
				<?php if ($likes=="1") { ?>
					<?php zilla_likes(); ?>
				<?php } ?>
			</div>
		<?php } ?>
		<div class="clear"></div>			
	</footer> <!-- end article footer -->
<?php } ?>