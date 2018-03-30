<?php

if( !empty($showing_conditions) ) {
	echo $showing_conditions;
}

$tabs = $metabox->getTabs();
$tabs_count = $tabs->size();

?>

<div class="thb-metabox thb thb-tabs-count-<?php echo $tabs_count; ?>" id="thb-metabox-<?php echo $metabox->getSlug(); ?>" data-slug="<?php echo $metabox->getSlug(); ?>" data-post-type="<?php echo $metabox->getPostType(); ?>">
	<div class="thb-tabs" data-open="0">
		<?php if ( $tabs_count > 1 ) : ?>
			<ul class="thb-metabox-tabs-nav thb-tabs-nav">
				<?php foreach ( $tabs as $tab ) : ?>
					<li class="<?php echo $tab->getNavClass(); ?>">
						<a class="dashicons-<?php echo $tab->getIcon(); ?>" href="#thb-metabox-tab-<?php echo $tab->getSlug(); ?>">
							<?php echo $tab->getTitle(); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<div class="thb-metabox-tabs thb-tabs-contents">
			<?php
				foreach( $tabs as $tab ) {
					$tab->render();
				}
			?>
		</div>
	</div>
</div>