<p><?php _e( 'In order to use the advanced geolocation and mapping features of Listify you need to create a Google Maps API key.', 'listify' ); ?> <a href="http://listify.astoundify.com/article/1036-how-to-create-a-google-maps-api-key-video"><?php _e( 'Read the full guide &rarr;', 'listify' ); ?></p>

<a href="https://player.vimeo.com/video/174829352?TB_iframe=true&width=639&height=400" class="thickbox button-secondary"><?php _e( 'Watch the Video', 'listify' ); ?></a> &nbsp; <a href="<?php echo esc_url_raw( admin_url( 'customize.php?autofocus[control]=map-behavior-api-key' ) ); ?>" class="button-primary" target="_blank"><?php _e( 'Add Your Google Maps API Key', 'listify' ); ?></a>

<style>
.google-maps .accordion-section-title:before {
	content: "\f230";
}

.appearance_page_listify-setup #TB_window iframe,
.toplevel_page_listify-setup #TB_window iframe {
	display: block;
	width: 100% !important;
}
</style>
