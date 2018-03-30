<?php
/*
Template Name: FAQ
*/
get_header(); 
?>
				<div id="content">
					<div id="maincontent" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignright\""; endif; ?>>
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
							<script type="text/javascript">
							jQuery(document).ready(function($){
								<?php
								$loop = new WP_Query(array('post_type' => 'faq', 'posts_per_page' => '-1', 'order' => 'ASC')); 
								while ( $loop->have_posts() ) : $loop->the_post(); ?>
								<?php
								?>
								$(".linkslide<?php the_ID() ?>").click(function(){
									$("#slide<?php the_ID() ?>").slideToggle("slow");
									$(this).toggleClass("active"); return false;
								});
								<?php endwhile;?>
							});
							</script>
							<ul id="listfaq">
								<?php
								$loop = new WP_Query(array('post_type' => 'faq', 'posts_per_page' => '-1', 'order' => 'ASC')); 
								while ( $loop->have_posts() ) : $loop->the_post(); ?>
									<li><a href="#" class="linkslide<?php the_ID() ?> linkfaq"><?php the_title() ?></a>
										<div id="slide<?php the_ID() ?>">
											<?php the_content() ?>
										</div>
									</li>
								<?php endwhile;?>
							</ul>
						<?php endwhile; ?>
					</div>
					<div id="nav" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignleft\""; endif; ?>>
						<?php get_sidebar(); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>			
			
<?php get_footer(); ?>
