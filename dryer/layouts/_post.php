
<article id="item-<?php the_ID(); ?>" class="item" data-permalink="<?php the_permalink(); ?>">

	<header>

		<h1 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><span class="article-dash"></span></h1>
		<p class="meta clearfix"> <span class="meta_author_date">
				<?php 
                    $date = '<time datetime="'.get_the_date('Y-m-d').'" pubdate>'.get_the_date().'</time>';
                    printf(__('Written by %s on %s. Posted in %s', 'warp'), '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
                ?>
				</span> <span class="comment-link">
				<?php comments_popup_link(__('No Comments', 'warp'), __('1 Comment', 'warp'), __('% Comments', 'warp'), "", ""); ?>
				</span> </p>
				
	
		<div class="clear"></div>
		</header>

    <?php if (has_post_thumbnail()) : ?>
    <div class="post-thumbnail">
        <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>					
    </div>
    <?php endif; ?>

	<div class="content clearfix">
		<?php the_content('<span>' . __('Continue Reading', 'warp') . '</span>'); ?>
	</div>

</article>