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
 * @package 	proStore/image.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>

	<?php global $data, $prefix; ?>
			
    <div class="row container clearfix"> 
    
		<div id="main" class="twelve columns clearfix" role="main">		

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
				<header>
					
					<h1 class="page-title" itemprop="headline"><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a></h1>
					<h4 class="subheader"> <?php the_title(); ?></h4>
				
				</header> <!-- end article header -->
			
				<section class="post_content clearfix" itemprop="articleBody">
					
					<!-- To display current image in the photo gallery -->
					<div class="row container attachment-img clearfix">
						<div class="nine columns image_block">
							<a href="<?php echo wp_get_attachment_url($post->ID); ?>">
															  
							<?php 
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
							   
								if ($image) : ?>
									<img src="<?php echo $image[0]; ?>" alt="" />
								<?php endif; ?>		      
							 </a>
						</div>
						<div class="three columns clearfix image_meta">
							<?php if ( !empty($post->post_excerpt) ) { ?> 
								<div class="caption panel"><?php echo get_the_excerpt(); ?></div>
							<?php } ?>
											
							<!-- Using WordPress functions to retrieve the extracted EXIF information from database -->
							<h3>Image metadata</h3>
			
						   <?php
							  $imgmeta = wp_get_attachment_metadata( $id );
						
						// Convert the shutter speed retrieve from database to fraction
							  if($imgmeta['image_meta']['shutter_speed'] > 0){
								  if ((1 / $imgmeta['image_meta']['shutter_speed']) > 1)
								  {
									 if ((number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1)) == 1.3
									 or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.5
									 or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.6
									 or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 2.5){
										$pshutter = "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1, '.', '') . " second";
									 }
									 else{
									   $pshutter = "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 0, '.', '') . " second";
									 }
								  }
								  else{
									 $pshutter = $imgmeta['image_meta']['shutter_speed'] . " seconds";
								   }
							   }
							   else
									$pshutter = 'n/a';
			
								echo "<ul>";
						// Start to display EXIF and IPTC data of digital photograph
							   echo "<li><strong>Date Taken </strong> " . date("d-M-Y H:i:s", $imgmeta['image_meta']['created_timestamp'])."</li>";
							   echo "<li><strong>Copyright </strong> " . $imgmeta['image_meta']['copyright']."</li>";
							   echo "<li><strong>Credit </strong> " . $imgmeta['image_meta']['credit']."</li>";
							   echo "<li><strong>Title </strong> " . $imgmeta['image_meta']['title']."</li>";
							   echo "<li><strong>Caption </strong> " . $imgmeta['image_meta']['caption']."</li>";
							   echo "<li><strong>Camera </strong> " . $imgmeta['image_meta']['camera']."</li>";
							   echo "<li><strong>Focal Length </strong> " . $imgmeta['image_meta']['focal_length']."mm</li>";
							   echo "<li><strong>Aperture f/ </strong> " . $imgmeta['image_meta']['aperture']."</li>";
							   echo "<li><strong>ISO </strong> " . $imgmeta['image_meta']['iso']."</li>";
							   echo "<li><strong>Shutter Speed </strong> " . $pshutter . "</li>";
							   echo "</ul>";
						   ?>
							<div class="clear"></div>
						</div>
					</div>
					<?php 
						$images = get_children( array( 

								'post_parent' => $post->post_parent,

								'post_status' => 'inherit',

								'post_type' => 'attachment',

								'post_mime_type' => 'image',

								'order' => 'ASC',

								'orderby' => 'menu_order' )

								);

						$number = count($images);
						if($number>1) {
					?>
						<div class="related_images row container inverse-bg clearfix">
							<div class="three columns related_title text-center">
								<h4>Other images in this post</h4>
							</div>
							<div class="related_carousel nine columns">
								<?php 	
									echo efs_get_slider($post->post_parent,'false','true','false','false',array('controlNav'=>'false','linked'=>'true','link'=>'image','directionNavC'=>'true'),'','');
								?>
							</div>
							<div class="clear"></div>
						</div>
					<?php 
						} 
					?>
				</section> <!-- end article section -->
				
				<footer>
	
					<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ' ', '</p>'); ?>
					
				</footer> <!-- end article footer -->
			
			</article> <!-- end article -->
			
			<div class="single-item">
				<?php if(comments_open() || have_comments()) { ?>
					<section class="post_comments clearfix <?php if($data[$prefix."responsive_comments_single"]!="1") {echo "hide-for-small";} ?>">
						<?php comments_template(); ?>
						<div class="clear"></div>
					</section>
				<?php } ?>		
			</div>
			
			<?php endwhile; ?>			
			
			<?php else : ?>
		
				<?php article_not_found(); ?>
			
			<?php endif; ?>

		</div> <!-- end #main -->	

	</div> <!-- end .row-container -->

<?php get_footer(); ?>