<?php
/*
	Template Name: Welcome Page
*/

/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

define("LAB_HEADERLESS", true);
define("LAB_FOOTERLESS", true);

get_header();

$sub_title  = get_field('welcome_sub_title');
$colums     = get_field('colums_count');
$links_list = get_field('links_list');

$columns_class = array(
	2 => 'col-sm-2 col-xs-6',
	3 => 'col-sm-3 col-xs-6',
	4 => 'col-sm-4 col-xs-6',
	5 => 'col-sm-5 col-xs-6',
	6 => 'col-sm-6 col-xs-6',
);

$column_size = $columns_class["{$colums}"];

?>
<div class="welcome-page-container">

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<header>
				<?php get_template_part('tpls/header-logo'); ?>

				<?php if($sub_title): ?>
				<div class="welcome-title">
					<h2><?php echo $sub_title; ?></h2>
				</div>
				<?php endif; ?>
				</header>
			</div>
		</div>

		<?php if ( is_array( $links_list ) ) : ?>
		<section class="links-list">
			<div class="row">
			<?php
			foreach($links_list as $entry):


				?>
				<div class="<?php echo $column_size; ?>">
					<h4><?php echo $entry['list_title']; ?></h4>

					<ul class="list-unstyled">
					<?php
					foreach($entry['links'] as $link):

						?>
						<li>
							<a href="<?php echo $link['link_url']; ?>" target="<?php echo $link['target_blank'] ? '_blank' : '_self'; ?>"><?php echo $link['link_title']; ?></a>
						</li>
						<?php

					endforeach;
					?>
					</ul>
				</div>
				<?php

			endforeach;
			?>
			</div>
		</section>
		<?php endif; ?>
	</div>

</div>
<?php

get_footer();