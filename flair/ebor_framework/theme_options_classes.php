<?php 

class Ebor_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="3" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
    }
}

class Ebor_Customizer_Number_Control extends WP_Customize_Control {

	public $type = 'number';
	
	public function render_content() {
	?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" <?php $this->link(); ?> value="<?php echo intval( $this->value() ); ?>" />
		</label>
	<?php
	}
	
}

class Demo_Import_control extends WP_Customize_Control {

	public $type = 'number';
	
	public function render_content() {
	?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<style>
				.btn {
					color: #fff !important;
					background: #3f8dbf;
					margin-bottom: 10px;
					margin-right: 5px;
					padding: 11px 20px 10px 20px;
					font-weight: 800;
					font-size: 13px;
					text-shadow: none;
					border: none;
					text-transform: uppercase;
					-webkit-transition: all 200ms ease-in;
					-o-transition: all 200ms ease-in;
					-moz-transition: all 200ms ease-in;
					-webkit-border-radius: 3px;
					border-radius: 3px;
					-webkit-box-shadow: none;
					-moz-box-shadow: none;
					box-shadow: none;
					display: inline-block;
					letter-spacing: 1px;
				}
				.btn.disabled {
				  cursor: not-allowed;
				  pointer-events: none;
				  opacity: 0.65;
				  filter: alpha(opacity=65);
				  -webkit-box-shadow: none;
				  box-shadow: none;
				}
			</style>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					jQuery('#demo-import').click(function(){
						
						activate = confirm('Have you installed all required plugins? Before installing demo data be sure to do a full backup incase anything goes wrong, or data is overwritten. Proceed if you have done this.')
						if(activate == false) return false;
						
						jQuery.ajax({
							type: "POST",
							url: ajaxurl,
							data: {
								action: 'ebor_ajax_import_data'
							},
							beforeSend: function() {
								//show loader
								jQuery('.btn').addClass('disabled').text('Loading, Please Wait.');
							},
							error: function() {
								//script error occured
								jQuery('body').alert( 'Importing didnt work! <br/> You might want to try reloading the page and then try again' );
								jQuery('.btn').removeClass('disabled');
								
							},
							success: function(response) {
								if(response.match('ebor_import')) {
									alert('Demo Data Imported. Have Fun and read the documentation.');
								}
								else {
									alert('Demo Data Not Imported! ' + response);
								}
							},
							complete: function(response) {	
								jQuery('.btn').text('All Data Imported, Have Fun!');
							}
						});
								
						return false;
					});
				});
			</script>
			<p>This will import all demo data. If this is not a fresh WordPress install (existing content) please make site & database backups before importing demo content.</p>
			<p><strong>The import process will take up to 15 minutes depening on your server, start it & go grab a cup of tea!<br />Do not leave this page until you have confirmation of the import.</strong></p>
			<a href="#" id="demo-import" class="btn">Import Demo Data</a>
		</label>
	<?php
	}
	
}