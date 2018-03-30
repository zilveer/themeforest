		<div id="content" class="col-md-8 column">
			<div class="article clearfix">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'library/unf/featured', 'image' ); ?>
					<h1 class="post-title"><?php the_title();?></h1>
						<?php the_content();?>
						<?php $d = wp_link_pages( array( 'before' => '<nav class="unf-pagination"><ul class="page-numbers">', 'after' => '</ul></nav>', 'link_before' => '<li><span>', 'link_after' => '</span></li>', 'echo' => 0) );
				       $d = preg_replace('#(<a[^>]*>)<li><span>#','<li>$1',$d);
				       $d = preg_replace('#</span></li></a>#','</a></li>',$d);
				       echo $d;
				       ?>
					<?php comments_template(); ?>

			    <?php endwhile;
			    endif; ?>
			</div>
		</div>