<?php get_header()?>
<div class="content-container">
	<div class="container">
		<div class="row">
			<div class="col-md-12" role="main">
				<div class="main-content">
					<div class="not-found-wrapper">
						<span class="not-found-title"><?php esc_html_e('WHOOPS!', 'jakiro'); ?></span>
						<span class="not-found-subtitle"><?php esc_html_e('404', 'jakiro'); ?></span>
						<div class="widget widget_search">
							<p><?php esc_html_e('It looks like you are lost! Try searching here', 'jakiro'); ?></p>
							<div style="max-width:500px;margin:0 auto">
								<?php get_search_form()?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer()?>
