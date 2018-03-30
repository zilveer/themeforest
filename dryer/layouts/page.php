<div id="system">

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
		
		<article class="item">
		
			<header>
		
				<h1 class="title"><?php the_title(); ?><span class="article-dash"></span></h1>
            <p class="meta clearfix"> <span class="meta_author_date">
				<?php 
                    $date = '<time datetime="'.get_the_date('Y-m-d').'" pubdate>'.get_the_date().'</time>';
                    printf(__('Written by %s on %s.', 'warp'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date);
                ?>
				</span> <span class="comment-link">
				<?php comments_popup_link(__('No Comments', 'warp'), __('1 Comment', 'warp'), __('% Comments', 'warp'), "", ""); ?>
				</span> </p>

			</header>
        
            <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>				
            </div>
            <?php endif; ?>
			
			<div class="content clearfix"><?php the_content(''); ?></div>
        
            <div class="meta-bottom clearfix">
                
                <?php edit_post_link(__('Edit this post', 'warp'), '<span class="edit-entry">','</span>'); ?>
            
            </div>

	       <?php comments_template(); ?>
        
		</article>
		
		<?php endwhile; ?>
	<?php endif; ?>
	
	

</div>