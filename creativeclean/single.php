<?php
get_header(); 
?>
				<div id="content">
					<div id="maincontent" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignright\""; endif; ?>>
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<h1 id="titlenews"><?php the_title(); ?></h1>
						<ul class="newsinfo">
							<li class="first">Posted by <?php the_author(); ?></li>
							<li><?php the_time('d F Y');?></li>
							<li class="last"><?php the_category(', ');?></li>
						</ul>
						<div class="clear"></div>
						<?php
						if ( has_post_thumbnail() ) :
							?>
							<div class="imgnews"><?php the_post_thumbnail('posts-thumb1'); ?></div>
							<?php
						endif;?>
						<?php the_content(); ?>
						<?php
						echo get_the_tag_list('<p><strong>Tags:</strong> ',', ','</p>');
						?>
						<?php edit_post_link( __( 'Edit', 'creativeclean' ), '<span class="edit-link">', '</span>' ); ?>
						<?php endwhile; ?>
						<div class="separator"><a href="#">Top</a></div>
						<?php comments_template( '', true ); ?>
					</div><!-- #maincontent -->
					<div id="nav" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignleft\""; endif; ?>>
				<?php get_sidebar(); ?>
			</div>
			<div class="clear"></div>
		</div>	
	</div>		
			
<?php get_footer(); ?>
