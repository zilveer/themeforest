<script type="text/template" data-tpl="thb-modal">
	<div class="thb-modal thb">
		<div class="thb-modal-content">
			<header>
				<h1 id="thb-modal-title">{{ title }}</h1>
				<a href="#" class="thb-modal-close">&times;</a>
			</header>

			<div class="thb-modal-content-inner">
				<form action="">
					{{ content }}
				</form>
			</div>

			<footer>
				<a href="#" class="thb-btn thb-btn-save"><?php _e( 'OK', 'thb_text_domain' ); ?></a>
			</footer>
		</div>
	</div>
</script>