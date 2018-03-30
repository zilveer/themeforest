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
 * @package 	proStore/author.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>
			
	<?php do_action('before_main_content'); ?>
		
		<h1 class="page-title">
			<?php 
				$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
				$google_profile = get_the_author_meta( 'google_profile', $curauth->ID );
			?>
			<?php echo get_avatar( $curauth->ID, "40" ); ?> 
			<span><?php _e("Author", "prostore-theme"); ?> :</span> 
			<!-- google+ rel=me function -->
			<?php
				if ( $google_profile ) {
					echo '<a href="' . esc_url( $google_profile ) . '" rel="me">' . $curauth->display_name . '</a>'; ?></a>
			<?php } else { ?>
				<?php echo $curauth->display_name; ?>
			<?php } ?>
		</h1>
		
		<?php
			global $wp_query;
			$post_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '" . $curauth->ID . "' AND post_type = 'post' AND post_status = 'publish'");		
			
			global $wpdb;
			$user_id = $curauth->ID;  //change this if not in a std post loop
			$where = 'WHERE comment_approved = 1 AND user_id = ' . $user_id ;
			$comment_count = $wpdb->get_var(
			    "SELECT COUNT( * ) AS total
					FROM {$wpdb->comments}
					{$where}
				"); 
		?>
		
		<div class="author-stats text-center">
	
			<span class="label stat-posts primary-bg"><?php echo $post_count; ?></span> <h5 class="stat-posts primary-color">Posts</h5> 
			<span class="label stat-comments alert-bg"><?php echo $comment_count; ?></span> <h5 class="stat-comments alert-color">Comments</h5>
		
		</div>
			
		<?php 
			$author_id = $user_id;
			$social = array('facebook'=>'d','twitter'=>'e','pinterest'=>'f','linkedin'=>'g','dribbble'=>'h','stumbleupon'=>'i','behance'=>'j','reddit'=>'k','googleplus'=>'l','youtube'=>'m','vimeo'=>'n','flickr'=>'o','picasa'=>'q','skype'=>'r','instagram'=>'t', 'delicious'=>'v','tumblr'=>'y','facetime'=>'z');
			
			$count_social = 0;
			foreach ($social as $service=>$icon) {
				if(get_the_author_meta($service,$author_id)) { 
					$count_social ++;
				}
			}

							
	//array('facebook','twitter','pinterest','linkedin','dribbble','stumbleupon','behance','reddit','googleplus','youtube','vimeo','flickr','picasa','skype','instagram', 'delicious','tumblr','facetime');	
			if($curauth->description !="" || $count_social >0) { 
			
		?>			
				<div class="panel">
					<?php if($curauth->description !="") { ?>
						<h4>About</h4>						
						<span class="sep horizontal thin"></span>
						<p><?php echo $curauth->description; ?></p>
						<span class="sep clear"></span>
					<?php } ?>
				
					<!--<div class="text-center panel">
						<?php 							
							
							foreach ($social as $service=>$icon) {
								if(get_the_author_meta($service,$author_id)) { 
									echo '<a href="'.get_the_author_meta($service,$author_id).'"><em class="icon- '.$service.'">'.$icon.'</em></a> ';
								}
							}
						?>				
					</div>	-->
				</div>
		
		<?php } ?>
		
		<h4 class="section-title">Latest posts</h4>	
		
		<?php if (have_posts()) : ?>
		
			<section class="blog-mini">
				<?php while (have_posts()) : the_post(); ?>
					<?php 
						$masonry = "mini";
						get_template_part( 'library/loop/archive');					
					?>
				<?php endwhile; ?>	
			</section>
			
			<?php get_template_part( 'library/loop/pagination'); ?>	
							
		<?php else : ?>
			
			<?php article_not_found(); ?>
		
		<?php endif; ?>
			
	<?php do_action('after_main_content'); ?>

<?php get_footer(); ?>