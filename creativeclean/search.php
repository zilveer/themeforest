<?php
get_header(); 
?>
		<div id="content">
			<div id="maincontent" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignright\""; endif; ?>>
				<h1 id="titlesearch">Search Result:</h1>
				<ul id="listnews">
					<?php

					if ( have_posts() ) : 
					while ( have_posts() ) : the_post();
					?>
					<li>
						<div class="titlenews search">
							<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
						<?php
						if ( has_post_thumbnail() ) : ?>
							<div class="imgnews"><?php the_post_thumbnail('posts-thumb1'); ?></div>
						<?php endif; ?>
						<?php the_excerpt(65); ?>
						<div class="clear"></div>
					</li>
					<?php endwhile;?>
						<?php else : ?>
							<li><p>No Result found</p></li>
						<?php endif;?>
					
				</ul>
				<?php 
				if (function_exists('wp_pagenavi')) :
					wp_pagenavi();
				else : ?>
				<div class="navigation">
					<div class="butnext"><strong><?php next_posts_link('Next Entries &#187;') ?></strong></div>
					<div class="butprev"><strong><?php previous_posts_link('&#171; Previous Entries') ?></strong></div>
					<div class="clear"></div>
				</div>
				<?php endif;?>
				<?php wp_reset_query(); ?>
			</div>
			<div id="nav" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignleft\""; endif; ?>>
				<?php get_sidebar(); ?>
			</div>
			<div class="clear"></div>
		</div>	
	</div>		

			
<?php get_footer(); ?>
