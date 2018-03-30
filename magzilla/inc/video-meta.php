<?php
global $ft_option;

$term_list = wp_get_post_terms( get_the_ID(), 'video-categories', array("fields" => "all"));

if($term_list){
	foreach($term_list as $term) {
		$term_id = $term->term_id;
	}
}
?>

<?php if( $ft_option['site_author_name'] != 0 ) { ?>
<li class="post-author cat-author-color-<?php echo intval( $term_id ); ?> "><i class="fa fa-circle"></i> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
<!-- <li>|</li> -->
<?php } ?>

<?php if( $ft_option['site_time_diff'] != 0 ) { ?>

	<li class="post-date" datetime="<?php the_date(); ?>" itemprop="datePublished">
		<a>
        <span><i class="fa fa-clock-o"></i>
	        <?php printf( _x( '%s ago', '%s = human-readable time difference', 'magzilla' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
        </span>
		</a>
	</li>

<?php } else {

	if ( $ft_option['site_date'] != 0 || $ft_option['site_time'] != 0 ) { ?>
		<li class="post-date" datetime="<?php the_date(); ?>" itemprop="datePublished">
			<a>

				<?php if ( $ft_option['site_date'] != 0 ) { ?>
					<span><i
							class="fa fa-calendar-o"></i> <?php esc_attr( the_time( get_option( 'date_format ' ) ) ); ?></span>
				<?php } ?>
				<?php if ( $ft_option['site_time'] != 0 ) { ?>
					<span><i
							class="fa fa-clock-o"></i> <?php esc_attr( the_time( get_option( 'time_format' ) ) ); ?></span>
				<?php } ?>
			</a>
		</li>
	<?php }
}?>


<?php if( $ft_option['site_view_count'] != 0 ) { ?>
<li class="post-total-shares"><i class="fa fa-eye"></i> <?php echo number_format_i18n( fave_getViews( get_the_id() ), 0 ); ?></li>
<!-- <li>|</li> -->
<?php } ?>

<?php if( $ft_option['site_comment_count'] != 0 ) { ?>
<?php if ( comments_open() ) { ?>
<li class="post-total-comments">
	<?php comments_popup_link(__('<i class="fa fa-comment-o"></i> 0', 'magzilla'), __('<i class="fa fa-comment-o"></i> 1', 'magzilla'), __('<i class="fa fa-comment-o"></i> %', 'magzilla'), 'comments', ''); ?>
</li>
<?php } ?>
<?php } ?>