<?php
global $theretailer_theme_options;
?>
<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package theretailer
 * @since theretailer 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
		<?php if (!is_front_page()) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif ?>        
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail(array(620,99999)); ?>
        </div>
    <?php } ?>
    
    <div class="entry-content">
		<div class="content_wrapper">
			<?php the_content(); ?>
            <div class="clr"></div>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'theretailer' ), 'after' => '</div>' ) ); ?>
            <?php //edit_post_link( __( 'Edit', 'theretailer' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
	</div><!-- .entry-content -->
    
</article><!-- #post-<?php the_ID(); ?> -->

<?php if ( ($theretailer_theme_options['page_comments']) && ($theretailer_theme_options['page_comments'] == 1) ) { ?>

<?php
	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || '0' != get_comments_number() )
		comments_template( '', true );
?>

<?php } ?>

<div class="clr"></div>
