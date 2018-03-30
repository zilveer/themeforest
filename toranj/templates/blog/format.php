<?php 
/**
 * format.php
 *
 * The default template for post contents.
 */

?>

<?php if ($blog_options['blog_index_layout']=='grid'): ?>


<!-- post Item -->		
<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	<div class="post-wrapper">
		
		
		<?php if ( get_post_format() != 'quote') :?>
			
			<?php if( locate_template(OWLAB_TEMPLATES . '/blog/format-'.get_post_format().'.php') ) : ?>
				<?php include(locate_template(OWLAB_TEMPLATES . '/blog/format-'.get_post_format().'.php')); ?>
			<?php endif; ?>

			<?php if (get_post_format() == false): ?>
				<?php include(locate_template(OWLAB_TEMPLATES . '/blog/format-standard.php')); ?>
			<?php endif; ?>

			<div class="post-content-wrapper">
				<!-- post title -->
				<h3 class="post-header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
				<!-- post meta -->
				<div class="post-meta">                 
	                <?php 
						// Display the meta information
						owlab_post_meta();
					?>
				</div>

				<!-- post content -->
				<div class="post-main-content">
					<?php the_excerpt(); ?>
					<?php if (ot_get_option('blog_read_more_button')=='on'): ?>
					<div class="post-read-more">
						<a href="<?php the_permalink(); ?>" class="btn <?php echo ot_get_option('blog_read_more_button_style','btn-toranj'); ?> <?php echo ot_get_option('blog_read_more_button_size',''); ?>"><?php _e('Read More','toranj') ?></a>
					</div>
					<?php endif; ?>
				</div>

			</div>
		<?php else: //so this is a quote format ?>

			<div class="post-format-quote">
				<div class="quote-wrapper set-bg rev-blur">
					<?php if ( has_post_thumbnail() ): ?>
						<?php the_post_thumbnail('blog-thumb',array(
							'class' => 'rev-blur',
							'style' => 'display:none;'
						)); ?>
					<?php else: ?>
					<img src="<?php echo OWLAB_IMAGES.'/default-blog-quote.jpg'; ?>" alt="image" class="rev-blur" style="display: none;">
					<?php endif; ?>
				</div>
				<div class="quote">
					<?php if(get_post_meta(get_the_ID() , 'quote' , true) != '') : ?>
					<p><?php echo get_post_meta(get_the_ID() , 'quote' , true); ?></p>
					<div class="author">~ <?php echo get_post_meta(get_the_ID() , 'quote-author' , true); ?></div>
					<?php endif; ?>	
				</div>
			</div>

		<?php endif; ?>



	</div>
</div>
<!--/ post Item -->




<?php elseif($blog_options['blog_index_layout']=='simple_list' OR $blog_options['blog_index_layout']=='list_with_sidebar'): ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
	
	<?php if (get_post_format() != 'quote') :?>

		<?php if( locate_template(OWLAB_TEMPLATES . '/blog/format-'.get_post_format().'.php') ) : ?>
			<?php include(locate_template(OWLAB_TEMPLATES . '/blog/format-'.get_post_format().'.php')); ?>
		<?php endif; ?>
		<?php if (get_post_format() == false): ?>
			<?php include(locate_template(OWLAB_TEMPLATES . '/blog/format-standard.php')); ?>
		<?php endif; ?>
		<div class="post-content">
			<div class="post-content-wrapper">
				
				<h2 class="post-header lined">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<div class="post-meta">                 
	                <?php 
						// Display the meta information
						owlab_post_meta();
					?>
				</div>

				<div class="post-main-content">
					<?php the_excerpt(); ?>

					<?php if (ot_get_option('blog_read_more_button')=='on'): ?>
					<div class="post-read-more">
						<a href="<?php the_permalink(); ?>" class="btn <?php echo ot_get_option('blog_read_more_button_style','btn-toranj'); ?> <?php echo ot_get_option('blog_read_more_button_size',''); ?>"><?php _e('Read More','toranj') ?></a>
					</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	<?php else: //so this is a quote format ?>

			<div class="post-format-quote">
				<div class="quote-wrapper set-bg rev-blur">
					<?php if ( has_post_thumbnail() ): ?>
						<?php the_post_thumbnail('blog-thumb',array(
							'class' => 'rev-blur',
							'style' => 'display:none;'
						)); ?>
					<?php else: ?>
					<img src="<?php echo OWLAB_IMAGES.'/default-blog-quote.jpg'; ?>" alt="image" class="rev-blur" style="display: none;">
					<?php endif; ?>
				</div>
				<div class="quote">
					<?php if(get_post_meta(get_the_ID() , 'quote' , true) != '') : ?>
					<p><?php echo get_post_meta(get_the_ID() , 'quote' , true); ?></p>
					<div class="author">~ <?php echo get_post_meta(get_the_ID() , 'quote-author' , true); ?></div>
					<?php endif; ?>	
				</div>
			</div>

		<?php endif; ?>
	
</div>
<?php elseif($blog_options['blog_index_layout']=='minimal'): ?>
	
<?php else: ?>
	
<?php endif; ?>


