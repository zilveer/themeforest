<?php
global $smof_data;
$smof_data['header_is_sticky'] = 0;
get_header();
if (have_posts()) : while(have_posts()) : the_post();
$section_bg =  '';

?>
<section id="<?php echo $post->post_name;?>" class="l-section">
	<?php the_content(); ?>
</section>
<?php endwhile; endif;
get_footer();