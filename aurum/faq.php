<?php
/*
	Template Name: FAQ Page
*/
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

the_post();

$faq_items      = get_field('faq_items');
$opened_panels  = get_field('opened_panels');

if( ! is_array($faq_items))
	$faq_items = array();

get_header();

if(get_post()->post_content):

?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php the_content(); ?>
		</div>
	</div>
</div>
<?php

endif;

?>
<section class="faq-items-list">
	<div class="container">
		<div class="panel-group panel-group-2" id="accordion">
		<?php

		foreach($faq_items as $i => $faq):

			$collapse_id = "faq{$i}";
			$opened = false;

			if($opened_panels == 'first')
				$opened = $i == 0;
			else
			if($opened_panels == 'opened')
				$opened = true;
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#<?php echo $collapse_id; ?>" class="<?php echo $opened == false ? 'collapsed' : ''; ?>" data-toggle="collapse" data-parent="#accordion">
							<?php echo $faq['title']; ?>
						</a>
					</h4>
				</div>
				<div id="<?php echo $collapse_id; ?>" class="panel-collapse collapse<?php echo $opened ? ' in' : ''; ?>">
					<div class="panel-body">
						<?php echo $faq['description']; ?>
					</div>
				</div>
			</div>
			<?php

		endforeach;
		?>
		</div>
	</div>
</section>
<?php

get_footer();