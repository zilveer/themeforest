<?php if ( opt('blog_sidebar_position') == 1) { ?>

	<div class="post-detail-content">
		<div class="blog-detail-title">
			<h4><?php echo ( single_post_title( '', false ) ); ?></h4>
		</div>
		
		<div class="blog-detail-meta">
			<?php echo ( get_the_time('F') ); ?>  &nbsp;<?php echo ( get_the_time('Y') ); ?> / <?php echo ( get_the_time('j') ); ?> <span class="blog-post-meta-seperator">|</span>
			<span class="post_comments"><?php comments_popup_link( __('No Comments', TEXTDOMAIN) , __('1 Comment', TEXTDOMAIN), __('% Comments', TEXTDOMAIN) ); ?></span>
		</div>
		
		<div class="blog-detail-seperator"></div>

		<div class="row">
			<div class="blog-post-detail span9">

				<div <?php post_class(); ?> id="post_<?php the_ID(); ?>">
					<?php the_content(); ?>
					<div class="pagelink">
						<?php wp_link_pages(); ?>
					</div>
				</div>
				<br><br>
				<div class="nav_box">

					<?php echo next_post_link('%link', '<div class="text_btn previous_btn" >'. __('next',TEXTDOMAIN).'</div>'); ?> 
					<?php echo previous_post_link('%link', '<div class="text_btn next_btn" >'. __('prev',TEXTDOMAIN).'</div>'); ?> 
					
				</div>
			
			</div>
		</div>
	</div>
	

<?php } elseif ( opt('blog_sidebar_position') ==  0 ) { ?>

<div class="post-detail-content">

	<div class="blog-detail-title">
		<h4><?php echo ( single_post_title( '', false ) ); ?></h4>
	</div>
	
	<div class="blog-detail-meta">
		<?php echo ( get_the_time('j') ); ?> <?php echo ( get_the_time('F') ); ?> <?php echo( get_the_time('Y') ); ?> <?php _e('//',TEXTDOMAIN)?>
		<?php _e('AUTHOR:',TEXTDOMAIN)?> <?php the_author_posts_link();?> <?php _e('//',TEXTDOMAIN)?> 
		<?php _e('CATEGORY:',TEXTDOMAIN)?> <?php the_category(', ');?> <?php the_tags(''); ?> <?php _e('//',TEXTDOMAIN)?> 
		<?php comments_popup_link( __('No Comments',TEXTDOMAIN) , __('1 Comment',TEXTDOMAIN) , __('% Comments',TEXTDOMAIN) ); ?>
	</div>
	
	<div class="blog-detail-seperator"></div>

	<div class="row">
		<div class="blog-post-detail span12">

			<div <?php post_class(); ?> id="post_<?php the_ID(); ?>">
				<?php the_content(); ?>	
				<div class="pagelink">
					<?php wp_link_pages(); ?>
				</div>
			</div>
			<br><br>

			<div class="nav_box">
				 <?php echo next_post_link('%link', '<div class="text_btn previous_btn" >'. __('next',TEXTDOMAIN).'</div>'); ?> 
				 <?php echo previous_post_link('%link', '<div class="text_btn next_btn" >'. __('prev',TEXTDOMAIN).'</div>'); ?> 
			</div>
			
		</div>
	</div>
	
</div>
<?php } 