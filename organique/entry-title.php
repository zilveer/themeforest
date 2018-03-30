<?php
/**
 * Titles for the blogpost with metadata
 *
 * @package Organique
 */
?>

<header class="entry-title">
	<h2><a href="<?php the_permalink(); ?>"><?php echo lighted_title( get_the_title() ); ?></a></h2>
	<div class="metadata">
		<time datetime="<?php the_time( 'Y-m-d' ); ?>" class="metadata__date  semibold"><?php the_time( get_option( 'date_format' ) ); ?></time>

		<?php
			if ( comments_open() ) :
		?>
			&nbsp; / &nbsp;
			<a href="<?php comments_link(); ?>" class="metadata__comments  semibold"><?php
				printf(
					_n( 'One Comment', '%s Comments', get_comments_number(), 'organique_wp' ),
					number_format_i18n( get_comments_number() )
				);
			?></a>
		<?php
			endif;
		?>

		<?php
			if ( has_category() ) :
		?>
			&nbsp; / &nbsp;
			<span class="metadata__categories  semibold"><?php _e( 'Posted in:' , 'organique_wp' ); ?> <?php the_category(', '); ?></span>
		<?php
			endif;
		?>

		<?php
			if ( has_tag() ) :
		?>
			&nbsp; / &nbsp;
			<span class="metadata__tags  semibold"><?php _e( 'Tagged:', 'organique_wp' ); ?> <?php the_tags( '', ', ' );?></span>
		<?php
			endif;
		?>
	</div>
</header>