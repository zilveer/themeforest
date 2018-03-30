<?php
	$categories = get_the_category();
	$separator = ', ';
	$output = '';
	if($categories){
		foreach($categories as $category) {
			$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'ebor_starter' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
		}
	}
?>

<div class="post-meta">

	<ul>
		<li><?php _e('Posted','ebor_starter'); ?>: <span class="updated"><?php the_time( get_option('date_format') ); ?></span></li>
		
		<li class="vcard author"><?php _e('Author','ebor_starter'); ?>: <span class="fn"><?php the_author_posts_link(); ?></span></li>
		
		<li><?php _e('Category','ebor_starter'); ?>: <?php echo trim($output, $separator); ?></li>
		
		<?php if( comments_open() ) : ?>
			<li><?php _e('Discussion','ebor_starter'); ?>: <a href="<?php comments_link(); ?>"><?php comments_number( __('0 Comments','ebor_starter'), __('1 Comment','ebor_starter'), __('% Comments','ebor_starter') ); ?></a></li>
		<?php endif; ?>
		
		<?php if( has_tag() && !( is_single() )) : ?>
			<li><?php the_tags('#',' #',''); ?></li>
		<?php endif; ?>
		
	</ul>

</div>