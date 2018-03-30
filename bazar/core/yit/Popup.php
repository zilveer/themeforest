<?php

/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Popup
 * 
 * Class that manage the popup feature
 * 
 * 
 * @since 1.0.0
 */
class YIT_Popup {
	
	/**
	 * Flag cookie "no more view"
	 * true  = no more view checked 	 
	 * 
	 * @since 1.0       
	 * @access private
	 * @var bool	 
	 */
	protected $no_popup_cookie;	
	
	/**
	 * Flag cookie first access (session cookie)
	 * true  = not show again in the same session
	 * 
	 * @since 1.0       
	 * @access private
	 * @var bool	 
	 */
	protected $access_cookie;
	
	protected $site_name;	
	
	/**
	 * Constructor
	 * 
	 * @since 1.0	 	
	 * @access public
	 */
	public function __construct() {}
	
	public function init() {
		$mobile = yit_get_model( 'mobile' );              

		add_action('wp_enqueue_scripts', array(&$this, 'add_popup_css'));
		
		if(!yit_get_option('popup') || $mobile->isMobile())
			return;
			
		$this->title = yit_get_option('popup_title');
		$this->message = yit_get_option('popupmessage');
		$this->image = yit_get_option('popup_image');
		$this->newsletter = yit_get_option('popup_news_url');               
		
		if(!$this->title && !$this->message && !$this->image && !$this->newsletter)
			return;

		$this->site_name = sanitize_title(get_bloginfo( 'name' ));
	    $this->cookie_name = 'yit-popup-'.$this->site_name;
	    $this->cookie_access = 'yit-popup-access-'.$this->site_name;

		add_action('wp_enqueue_scripts', array(&$this, 'add_popup_js'));
	       
		$this->access_cookie 	= !isset( $_COOKIE[ $this->cookie_access ] ) ? false : $_COOKIE[ $this->cookie_access ];
		$this->no_popup_cookie 	= !isset( $_COOKIE[ $this->cookie_name ] ) ? false : $_COOKIE[ $this->cookie_name ];
		
		/** action for append popup html **/
		if ( !$this->access_cookie && !$this->no_popup_cookie )
			add_action('yit_after_wrapper', array( &$this, 'get_html' ));
	}
	
	public function add_popup_js() {
	    wp_enqueue_script( 'jquery-cookie', YIT_CORE_ASSETS_URL . '/js/jq-cookie.js', array('jquery') );
		
		add_action( 'wp_footer', array( &$this, 'footer_script' ) );
	 }
	
	public function add_popup_css() {
	    yit_wp_enqueue_style(1200,'popup_css', YIT_CORE_ASSETS_URL . '/css/popup.css');
	  	$url = get_template_directory_uri() . '/theme/assets/css/popup.css';
	    yit_wp_enqueue_style(1200,'popup_theme_css', $url);
	 }
	
	public function get_html() { ?>
		<div class="popupOverlay"></div>
		<div id="popupWrap" class="popupWrap span6">
				<div class="popup">
					<?php if($this->title) : ?>
						<h3 class="title"><?php echo $this->title ?></h3>
					<?php endif ?>
					<?php if( $this->image || $this->message || $this->newsletter) : ?>
						<div class="row">
							<?php if($this->image) : ?>
							<div class="popup_img <?php echo ($this->message || $this->newsletter) ? "span2" : "span6" ?>"><img alt="popup-image" src="<?php echo $this->image ?>" /></div>
							<?php endif ?>
							<div class="popup_message <?php echo ($this->image) ? 'offset2' : 'span6 no-image' ?> ">
								<?php echo do_shortcode( $this->message ); ?>
								<?php if(yit_get_option('popup_news_url')) :
									$action = yit_get_option('popup_news_url');
									$email = yit_get_option('popup_news_email');
									$email_label = yit_get_option('popup_news_email_label');
									$email_icon = yit_get_option('popup_email_icon');
									$hidden_fields =yit_get_option('popup_hidden_fields');
									$submit =yit_get_option('popup_submit_text');
									$method = yit_get_option('popup_method');
								?>

								    <div class="popup-newsletter-section group">
								        <form method="<?php echo $method ?>" action="<?php echo $action ?>">
								            <fieldset class="row">
								                <ul class="group">
								                    <li class="span4 <?php if(!$this->image) : ?>offset2<?php endif ?>">
								                    	<input type="text" name="<?php echo $email ?>" id="<?php echo $email ?>" class="email-field text-field autoclear" placeholder="<?php echo $email_label ?>" />
								                    </li>
								                    <li class="span4 <?php if(!$this->image) : ?>offset2<?php endif ?>">
								                    <?php // hidden fileds
								                    	if ( $hidden_fields != '' ) {
								                        	$hidden_fields = explode( '&', $hidden_fields );
									                        foreach ( $hidden_fields as $field ) {
									                            list( $id_field, $value_field ) = explode( '=', $field );
									                            echo '<input type="hidden" name="' . $id_field . '" value="' . $value_field . '" />';
									                    	}
								                    	}
                                                        
                                                        echo wp_nonce_field( 'mc_submit_signup_form', '_mc_submit_signup_form_nonce', false, false );
													?>
														<div class="input-prepend">
															<span class="add-on"><i class="<?php echo $email_icon["icon"] ?>"></i></span>
										                    <input type="submit" value="<?php echo $submit ?>" class="submit-field" />
														</div>
								                    </li>
								                </ul>
								            </fieldset>
								        </form>
								    </div>
								<?php endif ?>
							</div>
						</div>
					<?php endif ?>
					<div class="row">
						<div class="box-no-view span3">
			                <label for="no-view"><input type="checkbox" name="no-view" class="no-view" /><?php echo __('Do not show again', 'yit') ?></label>
			            </div>
					</div>
				</div>
				<div class="close-popup"></div>
			</div>
		</div>
	<?php }
	
	/**
	 * javascript for open/close popup
	 * 
	 * @since 1.0	 	
	 * @access public 
	 */
	public function footer_script() {
		?>
		
		<script type="text/javascript">
			jQuery(document).ready(function($){
				
				/** Center popup on the screen **/
				jQuery.fn.center = function () {
				    this.css("position","absolute");
					    this.css("top", Math.max(0, (($(window).height() - this.outerHeight()) / 2) ) + "px");
					    this.css("left", Math.max(0, (($(window).width() - this.outerWidth()) / 2) ) + "px");
					    return this;
				}
				
				/** Check Cookie */
				var access_cookie = ( $.cookie('<?php echo $this->cookie_access ?>') == null ) ? false : $.cookie('<?php echo $this->cookie_access ?>'); 
				var noview_cookie = ( $.cookie('<?php echo $this->cookie_name ?>') == null ) ? false : $.cookie('<?php echo $this->cookie_name ?>');
				if ( !access_cookie && !noview_cookie ) {
					$('.popupWrap').center();
					$('.popupOverlay').css( { display: 'block', opacity:0 } ).animate( { opacity:0.7 }, 500 );
					$('.popupWrap').css( { display: 'block', opacity:0 } ).animate( { opacity:1 }, 500 );
					
					/** Close popup function **/
					var close_popup = function() {
						if ( $('.no-view').is(':checked') ) {
							$.cookie( '<?php echo $this->cookie_name ?>', 1, { expires: 365, path: '/' } );
						}
						                
						$.cookie( '<?php echo $this->cookie_access ?>', 1, { path: '/' } );
						
						$('.popupOverlay').animate( {opacity:0}, 200);
						$('.popupOverlay').remove();
						$('.popupWrap').animate( {opacity:0}, 200);
						$('.popupWrap').remove();
					}
					
					/** 
					*	Close popup on:
					*	- 'X button' click
					*   - wrapper click
					*   - esc key pressed
					**/
					$('.close-popup').click(function(){
						close_popup();
					});
					
					$(document).bind('keydown', function(e) { 
					   	if (e.which == 27) {
							if($('.popupOverlay')) {
								close_popup();
							}
						}
					});
					
					$('.popupOverlay').click(function(){
						close_popup();
					});                  
					
					$('.submit-field').parents('form').on( 'submit', function(){
                        $.cookie( '<?php echo $this->cookie_name ?>', 1, { expires: 365, path: '/' } );    
                    });
					
					/** Center popup on windows resize **/
					$(window).resize(function(){
						$('#popupWrap').center();
					});
				}
			});
		</script>
		
		<?php
	} 	
}