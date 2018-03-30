<?php 
/**
 * Add new field for contact customize panel.
 *
 * Page for adding new field to contact module.
 *
 * @package Wordpress
 * @subpackage Kassyopea
 * @since 1.1
 */                             

if ( !defined( 'IFRAME_REQUEST' ) )
	define( 'IFRAME_REQUEST' , true );  

require_once( dirname(__FILE__) . '/../mtx-safe-wp-load.php' );

if ( isset( $_POST['ajax'] ) && $_POST['ajax'] ) {
    yiw_fields_shortcode( $_POST['shortcode_id'] );
    die;
}

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset')); 

?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
<head>                   
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<title>Add shortcodes</title>
<?php        
	wp_admin_css( 'global', true );
	wp_admin_css( 'wp-admin', true );
	//wp_print_styles( 'colors' ); 
	wp_enqueue_style( 'colors-admin', admin_url( 'css/colors-fresh.css' ) );  
	wp_enqueue_style( 'yiw-tinymce-insert-tool', YIW_FRAMEWORK_URL.'tinymce/css/toggle.css' );  
	wp_print_styles( 'colors-admin' );  
	wp_print_styles( 'yiw-tinymce-insert-tool' ); 
	//wp_admin_css( 'media', true );  
	wp_print_scripts( 'jquery' );
	wp_print_scripts( 'thickbox' );      
?>
<style type="text/css">
html, body { min-height:100%; height:inherit; }
body { padding:10px; }
</style>
</head>
<body id="media-upload">
	        
	<div id="media-upload-header"></div>
	
	<div id="css-mce-form" class="wrap">
	    <div class="fieldset">
			<label class="css-mce-label"><?php _e( 'Choose shortcode', 'yiw' ) ?></label>
			<div class="css-mce-input">
				<?php yiw_dropdown_shortcodes(); ?>	
                <img alt="" id="ajax-loading" class="ajax-loading" src="<?php echo admin_url( 'images/wpspin_light.gif' ); ?>" style="visibility: hidden;">		
            </div>
			<div class="clearer"></div>
		</div>  
	    
	    <div id="fields">
    	    <!--<input type="hidden" value="sws_2_columns_last" class="mce-item mce-scopentag" />
    	    <div class="fieldset">
    			<label class="css-mce-label">Content</label>
    			<div class="css-mce-input">
    				<textarea rel="" class="mce-item mce-content" name="sws_content" id="mce-textarea-1"> </textarea>			
                </div>
    			<div class="clearer"></div>
    		</div>                    
    		<input type="hidden" value="sws_2_columns_last" class="mce-item mce-scclosetag" />
    		<input type="hidden" value="sws_2_columns_last" name="sc_shortcode" id="sc_shortcode" />
    		<div class="fieldset-buttons">
                <input type="button" value="Insert shortcode" class="button-primary" onclick="javascript:insert_csshortcode();">
            </div>-->
        </div>
	</div>
	
	<script type="text/javascript">
	jQuery(document).ready(function($){
	   $('#choose-shortcode-trigger').change(function(){
            var val = $(this).val();
            $('#ajax-loading').css('visibility', 'visible');
            
            $.post( '<?php echo $_SERVER['REQUEST_URI'] ?>', { shortcode_id:val, ajax:1 }, function(html) {
                $('#fields').html(html);                                                     
                $('#ajax-loading').css('visibility', 'hidden');
            } );
       });
	});
	
	function insert_csshortcode(){
    	jQuery(document).ready(function($){
        	var win = window.dialogArguments || opener || parent || top;
        	var str = '';
    		if($('.mce-item').length>0){
    			$('.mce-item').each(function(){
    				var _val = $(this).val();
    				if( $(this).hasClass('mce-escape') ){
    					_val = escape(_val);
    				}
    				
    				if( $(this).hasClass('parse-with-rel') ){
    					try {
    						if(''!=$(this).attr('rel')){
    							eval($(this).attr('rel'));
    						}
    					}catch(e){
    						console.log(e.description);
    					}
    				}
    				
    				if( $(this).hasClass('mce-scopentag') ){
    					str += '[' + _val;
    				}
    				
    				if( $(this).hasClass('mce-property') ){
    					if( $(this).hasClass('mce-skip-blank') && ''==_val){
    					
    					}else{
    						str += ' ' + $(this).attr('name').replace('sws_','') + '=' + '"' + _val +'"';
    					}
    				}
    				
    				if( $(this).hasClass('mce-scclose') ){
    					str += ']';
    				}
    			
    				if( $(this).hasClass('mce-content') ){
    					str += ']' + _val;
    				}				
    				
    				if( $(this).hasClass('mce-scclosetag') ){
    					str += ' [/' + _val + '] ';
    				}
    			});
    		}
    		
    		win.send_to_editor(str);
    		var ed;
    		if ( typeof tinyMCE != 'undefined' && ( ed = tinyMCE.activeEditor ) && !ed.isHidden() ) {
    			ed.setContent(ed.getContent());
    		}
    			
    		tb_remove();
    	});
    }
	</script>
	
</body>
</html>