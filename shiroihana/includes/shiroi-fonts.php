<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/* ==========================================================================
	Font Framework Setup
============================================================================= */

if( ! function_exists( 'shiroi_font_settings' ) ):

function shiroi_font_settings() {
	return array(
		'body_font' => array(
			'default' => 'Noto+Serif:400', 
			'include_all_styles' => true, 
			'additional_weights' => array( 700 )
		), 
		'headings_font' => array(
			'default' => 'Playfair+Display:400', 
			'include_all_styles' => true,  
			'additional_weights' => array( 700 )
		), 
		'blockquote_font' => array(
			'default' => 'Playfair+Display:400'
		), 
		'menu_font' => array(
			'default' => 'Noto+Serif:400'
		), 
		'post_meta_font' => array(
			'default' => 'Inconsolata:400'
		), 
		'post_label_font' => array(
			'default' => 'Inconsolata:400'
		), 
		'slider_title_font' => array(
			'default' => 'Playfair+Display:700', 
			'inherits' => 'headings_font'
		), 
		'slider_meta_font' => array(
			'default' => 'Noto+Serif:italic'
		), 
		'slider_read_more_font' => array(
			'default' => 'Inconsolata:400'
		)
	);
}
endif;
add_filter( 'youxi_font_settings', 'shiroi_font_settings' );

function shiroi_font_options() {
	return Youxi()->option->get_all();
}
add_filter( 'youxi_font_options', 'shiroi_font_options' );

if( ! function_exists( 'shiroi_typekit_kit_id' ) ):

function shiroi_typekit_kit_id( $kit_id ) {
	return Youxi()->option->get( 'typekit_kit_id' );
}
endif;;
add_filter( 'youxi_typekit_kit_id', 'shiroi_typekit_kit_id' );

if( ! function_exists( 'shiroi_typekit_enable_cache' ) ):

function shiroi_typekit_enable_cache( $enabled ) {
	return (bool) Youxi()->option->get( 'typekit_cache' );
}
endif;
add_filter( 'youxi_typekit_enable_cache', 'shiroi_typekit_enable_cache' );

/* ==========================================================================
	Typekit JS rendering
============================================================================= */

if( ! function_exists( 'shiroi_typekit_wp_head' ) ):

function shiroi_typekit_wp_head() {

	/* Load Typekit only when it's used */
	if( Youxi_Font::has_typekit() ) : ?>
<script>
  (function(d) {
    var config = {
      kitId: '<?php echo Youxi()->option->get( 'typekit_kit_id' ) ?>',
      scriptTimeout: 3000
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='//use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
<?php endif;
}
endif;
add_action( 'wp_head', 'shiroi_typekit_wp_head', 6 );
