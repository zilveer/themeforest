<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if(get_field('fullwidth_page'))
{
	get_template_part('full-width-page');

	return;
}

the_post();

get_header();

# Analyze page content
$content = get_the_content();
$is_vc_page = preg_match("/(\[vc.*?\])/", $content);

# See if its fullwidth
$is_fullwidth = false;

if(function_exists('is_cart') && is_cart())
	$is_fullwidth = true;

if($is_fullwidth):

	the_content();

else:
?>
<div class="container page-container">

	<?php if($is_vc_page === false): ?>
		<div class="row">
			<div class="col-md-12">
				<h1 class="single-page-title"><?php echo the_title(); ?></h1>

				<div class="post-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="post-formatting"><?php the_content(); ?></div>
	<?php endif; ?>

</div>
<?php
endif;

get_footer();