<?php global $unf_options; ?>
<?php //Link Format?>
<div <?php post_class( 'clearfix blog-posts thepost' ); ?>>
<h2><a href="<?php echo wp_trim_words( get_the_content(), $num_words = 1, $more = '' ); ?>" class="icon icon-link-4 the-link" target="_blank"> <?php the_title(); ?></a></h2>
<div class="text-center"><?php get_template_part('library/unf/postmeta');?></div>
</div>