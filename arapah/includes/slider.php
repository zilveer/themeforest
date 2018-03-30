<?php 
	$post_query = 'cat='.of_get_option('dslider_cat').'&posts_per_page=3&orderby=date&order=ASC';
?>

	<div id="arapah-slider" class="container">
		<div class="sixteen columns">
			<div class="gutter alpha omega">
				<ul class="ui-tabs-nav ui-tabs-selected">			
					<?php query_posts( $post_query ); ?>
					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
					<li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $post->ID; ?>">
					<a href="#fragment-<?php echo $post->ID; ?>">
						<?php the_post_thumbnail( 'thumbnail', array('class' => 'slider_thumb') ); ?>			
						<h4 class="title">
								<?php $short_title = substr(the_title('','',FALSE),0,45);
								echo $short_title; if (strlen($short_title) >44){ echo '...'; } ?>	
						</h4>			
						<span class="date"><?php the_time('l, M jS Y H:j'); ?></span>
					</a>
					</li>	
					<?php endwhile; endif;?>
					<?php wp_reset_query();?>			
				</ul>
				
				<?php query_posts( $post_query ); ?>
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
				<div id="fragment-<?php echo $post->ID; ?>" class="ui-tabs-panel ui-tabs-hide" style="">
					<?php the_post_thumbnail( 'def-slider-image' ); ?>
					 <div class="info" >
						<h2> 
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
							<?php $short_title = substr(the_title('','',FALSE),0,45);
							echo $short_title; if (strlen($short_title) >44){ echo '...'; } ?>	
							</a>
						</h2>				
						<p>
						<?php 
							$content = get_the_content();
							$content = strip_tags($content);
							echo substr($content, 0, 100). '...';
						?>				
						</p>
					 </div>
				</div>
				
					<?php endwhile; endif;?>
					<?php wp_reset_query();?>
			<div class="clear"></div>
			</div>
		</div>
	</div>