<?php global $pmc_data; ?>
	
	<div class="entry">
		<div class = "meta">		
			<div class="blogContent">
				<div class="blogcontent"><?php the_content(__('<div class="pmc-read-more">Continue reading</div>','pmc-themes')) ?></div>
			</div>
			
			<?php if($pmc_data['display_post_meta'] || $pmc_data['display_socials'] != 0) { ?>
			
			<div class="bottomBlog">
				
			<?php if(isset($pmc_data['display_post_meta'])) { ?>
			<div class = "post-meta">
				<?php 
				$day = get_the_time('d');
				$month= get_the_time('m');
				$year= get_the_time('Y');
				?>
				<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_time(get_option('date_format')) ?></a><a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php _e('by ','pmc-themes'); echo get_the_author(); ?></a>		
			</div>
			<?php } ?> <!-- end of post meta -->
			
			<?php if(isset($pmc_data['display_socials'])) { ?>
			<div class="blog_social"> <?php pmc_socialLinkSingle(get_the_permalink(),get_the_title())  ?></div>
			<?php } ?>
			</div> <!-- end of socials -->
		
		<?php } ?> <!-- end of bottom blog -->
		
</div>		
	</div>
