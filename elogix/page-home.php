<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

	<div id="home-slider" class="flexslider">
		<div class="shadow-top"></div>
	    <ul class="slides">
	    	
	    	<?php if ( of_get_option('slide1_upload') ) { ?>
	    	<li>
	    		<?php if ( of_get_option('slide1_url') ) { ?><a href="<?php echo of_get_option('slide1_url'); ?>"><?php } ?>
            	<img src="<?php echo of_get_option('slide1_upload'); ?>" />
            	<?php if ( of_get_option('slide1_url') ) { ?></a><?php } ?>
	    		<?php if ( of_get_option('slide1_caption') ) { ?><p class="flex-caption"><?php echo of_get_option('slide1_caption', 'no entry'); ?></p><?php } ?>
	    	</li>
	    	<?php } ?>
	    	
	    	<?php if ( of_get_option('slide2_upload') ) { ?>
	    	<li>
	    		<?php if ( of_get_option('slide2_url') ) { ?><a href="<?php echo of_get_option('slide2_url'); ?>"><?php } ?>
            	<img src="<?php echo of_get_option('slide2_upload'); ?>" />
            	<?php if ( of_get_option('slide2_url') ) { ?></a><?php } ?>
	    		<?php if ( of_get_option('slide2_caption') ) { ?><p class="flex-caption"><?php echo of_get_option('slide2_caption', 'no entry'); ?></p><?php } ?>
	    	</li>
	    	<?php } ?>
	    	
	    	<?php if ( of_get_option('slide3_upload') ) { ?>
	    	<li>
	    		<?php if ( of_get_option('slide3_url') ) { ?><a href="<?php echo of_get_option('slide3_url'); ?>"><?php } ?>
            	<img src="<?php echo of_get_option('slide3_upload'); ?>" />
            	<?php if ( of_get_option('slide3_url') ) { ?></a><?php } ?>
	    		<?php if ( of_get_option('slide3_caption') ) { ?><p class="flex-caption"><?php echo of_get_option('slide3_caption', 'no entry'); ?></p><?php } ?>
	    	</li>
	    	<?php } ?>
	    	
	    	<?php if ( of_get_option('slide4_upload') ) { ?>
	    	<li>
	    		<?php if ( of_get_option('slide4_url') ) { ?><a href="<?php echo of_get_option('slide4_url'); ?>"><?php } ?>
            	<img src="<?php echo of_get_option('slide4_upload'); ?>" />
            	<?php if ( of_get_option('slide4_url') ) { ?></a><?php } ?>
	    		<?php if ( of_get_option('slide4_caption') ) { ?><p class="flex-caption"><?php echo of_get_option('slide4_caption', 'no entry'); ?></p><?php } ?>
	    	</li>
	    	<?php } ?>
	    	
	    	<?php if ( of_get_option('slide5_upload') ) { ?>
	    	<li>
	    		<?php if ( of_get_option('slide5_url') ) { ?><a href="<?php echo of_get_option('slide5_url'); ?>"><?php } ?>
            	<img src="<?php echo of_get_option('slide5_upload'); ?>" />
            	<?php if ( of_get_option('slide5_url') ) { ?></a><?php } ?>
	    		<?php if ( of_get_option('slide5_caption') ) { ?><p class="flex-caption"><?php echo of_get_option('slide5_caption', 'no entry'); ?></p><?php } ?>
	    	</li>
	    	<?php } ?>
	    	
	    	<?php if ( of_get_option('slide6_upload') ) { ?>
	    	<li>
	    		<?php if ( of_get_option('slide6_url') ) { ?><a href="<?php echo of_get_option('slide6_url'); ?>"><?php } ?>
            	<img src="<?php echo of_get_option('slide6_upload'); ?>" />
            	<?php if ( of_get_option('slide6_url') ) { ?></a><?php } ?>
	    		<?php if ( of_get_option('slide6_caption') ) { ?><p class="flex-caption"><?php echo of_get_option('slide6_caption', 'no entry'); ?></p><?php } ?>
	    	</li>
	    	<?php } ?>
	    	
	    </ul>
	</div>
	<div class="clear"></div>
	
	<div id="page" class="clearfix">
		
		<!-- Content -->
		
		<div id="content">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" class="post clearfix">
					<?php the_content(); ?>
				</div>
		<?php endwhile; ?>
		</div>
		
		
		<?php if(of_get_option('latestwork_checkbox') == true ) { ?>
		
		<!-- Latest Portfolio Items -->
		
		<div class="hr3"></div>
		
		<div id="latestwork" class="clearfix">
	
			<div class="teasertext">
				<h3><?php _e('Latest Work', 'framework'); ?></h3>
				<?php echo of_get_option('latestwork_text'); ?>
				<a href="#" class="work-carousel-prev" onclick="return false;"><<</a>
				<a href="#" class="work-carousel-next" onclick="return false;">>></a>
			</div> 
			
			
			<div class="work-carousel">
			<ul>
			<?php 
				
				$query = new WP_Query();
                $query->query('post_type=work&posts_per_page=10');
                if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                
                $site= get_post_custom_values('project_Link');
                $shortDesc = get_post_custom_values('project_Desc');
                $project_image1 = get_post_custom_values('project_image1');
			?>
			<li>
				<div class="entry">
					<?php if ( has_post_thumbnail()) { ?> 
				
					<?php if( get_post_meta( get_the_ID(), 'minti_lightbox', true ) == "yes" AND  get_post_meta( get_the_ID(), 'minti_embed', true ) != "") { ?>

						<?php if ( get_post_meta( get_the_ID(), 'minti_source', true ) == 'youtube' ) {  ?>
						
								<a href="http://www.youtube.com/watch?v=<?php echo get_post_meta( get_the_ID(), 'minti_embed', true ); ?> " class="prettyPhoto" title="<?php the_title(); ?>">
									<?php the_post_thumbnail('work-thumb'); ?>
								</a>
	    				
	    				<?php } else if ( get_post_meta( get_the_ID(), 'minti_source', true ) == 'vimeo' ) { ?>
	    				
	    						<a href="http://vimeo.com/<?php echo get_post_meta( get_the_ID(), 'minti_embed', true ); ?> " class="prettyPhoto" title="<?php the_title(); ?>">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    						</a>
	
	    				<?php } else if ( get_post_meta( get_the_ID(), 'minti_source', true ) == 'own' ) {?>
	
	
	    						<a href="#embedd-video" class="prettyPhoto" title="<?php the_title(); ?>">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    						</a>
	    						
	    						<div id="embedd-video">
									<p><?php echo get_post_meta( get_the_ID(), 'minti_embed', true ); ?></p>
								</div>
								
						<?php } ?>
					
				<?php } else if ( get_post_meta( get_the_ID(), 'minti_lightbox', true ) == "yes" AND  get_post_meta( get_the_ID(), 'minti_embed', true ) == "") { ?>
				
						<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="prettyPhoto" title="<?php the_title(); ?>">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    				</a>
				
				<?php } else if ( get_post_meta( get_the_ID(), 'minti_lightbox', true ) == "no" AND  get_post_meta( get_the_ID(), 'minti_embed', true ) == "") { ?>
				
						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="pic">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    				</a>
				
				<?php } else if ( get_post_meta( get_the_ID(), 'minti_lightbox', true ) == "no" AND  get_post_meta( get_the_ID(), 'minti_embed', true ) != "") { ?>
				
						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="video">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    				</a>
				
				<?php } else { ?>
					
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="pic">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    				</a>
				
				<?php } ?>
				
				<?php } ?>
					<div class="work-description">
						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						<span><?php echo get_post_meta( get_the_ID(), 'minti_description', true ); ?></span>
					</div>
				</div>
			</li>
			<?php endwhile; endif; ?>
			</ul>
			</div>
			
			<div class="clear"></div>
		</div>
		
		<?php } ?>
		
		
		<?php if(of_get_option('latestposts_checkbox') == true ) { ?>
		
		<!-- Latest Posts -->
		
		<div class="hr3"></div>
		
		<div id="latestposts" class="clearfix">
		
			<div class="teasertext">
				<h3><?php _e('Recent Updates', 'framework'); ?></h3>
				<?php echo of_get_option('latestposts_text'); ?>
			</div> 
			
			<?php 
			$args = array( 'numberposts' => 3, 'order'=> 'DESC', 'orderby' => 'date' );
			$postslist = get_posts( $args );
			foreach ($postslist as $post) :  setup_postdata($post); ?> 
				<div class="entry">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<div class="date"><?php the_time('m/d/Y'); ?></div>
					<div class="content"><?php the_excerpt(); ?></div>
				</div>
			<?php endforeach; ?>
		
		</div>
		
		<?php } ?>
		<?php if( of_get_option('latestposts_checkbox') == false AND of_get_option('latestwork_checkbox') == true
				OR of_get_option('latestposts_checkbox') == false AND of_get_option('latestwork_checkbox') == false ) { ?>
			<div class="spacer"></div>
		<?php } ?>
		
	
	</div>
	

<?php get_footer(); ?>