<?php global $unf_options;?>
<div class="article clearfix">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php
		if( $unf_options['featured'] == '1'){
		get_template_part( 'library/unf/featured', 'image' );
		}
		?>

		<div class="titlewrap clearfix singletitlewrap">
		<h1 class="post-title"><?php the_title();?></h1>
			<?php get_template_part('library/unf/postmeta');?>
		</div>
		<div class="entry-content">
			<?php if ( has_post_format( 'link' )) {?>
				<h2><a href="<?php echo $post->post_content; ?>" class="icon icon-link-4 the-link" target="_blank"> <?php the_title(); ?></a></h2>
			<?php } else {
				 the_content();
			} ?>
			<?php $d = wp_link_pages( array( 'before' => '<nav class="unf-pagination"><ul class="page-numbers">', 'after' => '</ul></nav>', 'link_before' => '<li><span>', 'link_after' => '</span></li>', 'echo' => 0) );
				       $d = preg_replace('#(<a[^>]*>)<li><span>#','<li>$1',$d);
				       $d = preg_replace('#</span></li></a>#','</a></li>',$d);
				       echo $d;
				       ?>
		</div>
    <?php endwhile;
    endif; ?>

	<?php get_template_part( '/library/unf/sharethis' ); ?>
	<?php if ( $unf_options['unf_showtags'] == '1' ) { ?>
	<div class="tags"><?php the_tags( '', ' ', '' ); ?></div>
	<?php } // End showtags ?>
	<?php get_template_part( '/library/unf/authorinfo' ); ?>
	<?php comments_template(); ?>

	<?php if ( is_single() ) {?>
	  <div id="single-post-nav">
	    <ul class="pager">

	      <?php $trunc_limit = 30; ?>

	      <?php if( '' != get_previous_post() ) { ?>
	        <li class="previous">
	          <?php previous_post_link( '<span class="previous-page">%link</span>', __( '<i class="icon icon-left-bold-1"></i>', 'toddlers' ) . '&nbsp;' . brew_truncate_text( get_previous_post()->post_title, $trunc_limit ) ); ?>
	        </li>
	      <?php } // end if ?>

	      <?php if( '' != get_next_post() ) { ?>
	        <li class="next">
	          <?php next_post_link( '<span class="no-previous-page-link next-page">%link</span>', '&nbsp;' . brew_truncate_text( get_next_post()->post_title, $trunc_limit ) . '&nbsp;' . __( '<i class="icon icon-right-bold-1"></i>', 'toddlers' ) ); ?>
	        </li>
	      <?php } // end if ?>

	    </ul>
	  </div><!-- /#single-post-nav -->
	<?php } ?>
</div>