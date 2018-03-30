<?php
/**
 * Post Meta
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
global $sd_data;

$sd_blog_meta = $sd_data['sd_blog_post_meta'];

?>
<!-- post  meta -->
<aside class="sd-entry-meta clearfix">
	<ul>
		<?php if ( $sd_blog_meta[1] == '1' ) : ?>
			<li class="sd-meta-author">
				<i class="fa fa-calendar"></i>
				<?php the_time(get_option('date_format')); ?>
			</li>
		<?php endif; ?>
		
		<?php if ( $sd_blog_meta[2] == '1' ) : ?>
			<li class="sd-meta-author">
				<i class="fa fa-user"></i>
				<?php the_author(); ?>
			</li>
		<?php endif; ?>
		
		<?php if ( $sd_blog_meta[3] == '1' ) : ?>
			<li class="sd-meta-category">
				<i class="fa fa-folder"></i>
				<?php the_category( ', ' ); ?>
			</li>
		<?php endif; ?>
		
		<?php if ( $sd_blog_meta[4] == '1' ) : ?>
			<?php $post_tags = the_tags( '<li class="meta-tag"> <i class="fa fa-tag"></i> ', ' , ', '</li>' );
				  if ( $post_tags ) {
					$post_tags;
				  }
			?>
		<?php endif; ?>
		
		<?php if ( $sd_blog_meta[5] == '1' ) : ?>
			<li class="sd-meta-comments">
				<i class="fa fa-comment"></i>
					<?php comments_popup_link ( __( '0 comments', 'sd-framework' ), __( '1 Comment', 'sd-framework' ), __( ' % comments', 'sd-framework' ), 'comments-link', __( 'closed', 'sd-framework' ) ); ?>
			</li>
		<?php endif; ?>
	</ul>
</aside>
<!-- sd-entry-meta end --> 