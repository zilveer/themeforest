<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package metcreative
 */

get_header(); ?>

	<div class="met_content clearfix">
		<div class="row-fluid met_404">
			<div class="span4"></div>
			<div class="span6">
				<div class="met_404_box met_bgcolor3">
					<h4 class="met_color2"><?php _e('you may want to search it again','metcreative') ?></h4>

					<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="text" name="s" required="" placeholder="<?php _e('Search','metcreative') ?>">
						<button type="submit" class="met_color3"><i class="icon-search"></i></button>
					</form>
				</div>
			</div>
			<div class="span2"></div>
			<div class="span7">
				<h2 class="met_bold_one pull-right"><?php _e('404 page not found.','metcreative') ?></h2>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span"></div>
		</div>
	</div>

<?php get_footer(); ?>