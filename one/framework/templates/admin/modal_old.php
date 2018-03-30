<script type="text/template" data-tpl="thb-modal-<?php echo $modal->getSlug(); ?>" data-title="<?php echo $modal->getTitle(); ?>" data-keys='<?php echo json_encode( $modal->serializeKeys() ); ?>'>
	<div class="thb-modal-<?php echo $modal->getSlug(); ?> thb-modal thb">
		<div class="thb-modal-content">
			<header>
				<h1 id="thb-modal-title"><?php echo $modal->getTitle(); ?></h1>
				<a href="#" class="thb-modal-close">&times;</a>
			</header>

			<div class="thb-modal-content-inner">
				<form action="">
					<?php
						foreach ( $modal->getContainers() as $container ) {
							$container->render();
						}
					?>
				</form>

				<footer>
					<a href="#" class="thb-btn thb-btn-save"><?php _e( 'OK', 'thb_text_domain' ); ?></a>
				</footer>
			</div>
		</div>
	</div>
</script>