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

require_once( dirname(__FILE__) . '/../../mtx-safe-wp-load.php' );

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset')); 

$action = $_GET['action'];            
    
$current_tab = 'general';
if( isset( $_GET['tab'] ) )
	$current_tab = $_GET['tab'];

$types = array(
	'text' => 'Text Input',
	'checkbox' => 'Checkbox',      
	'select' => 'Select',
	'textarea' => 'Text Area',
	'radio' => 'Radio Input',
	'password' => 'Password Field',
	'file' => 'File Upload'
);

function yiw_get_name_contact_field( $field )
{
	return yiw_option_name( $_GET['id'], false ) . "[{$field}]";         
}

function yiw_name_contact_field( $field )
{
	echo yiw_get_name_contact_field( $field );         
}

function yiw_get_id_contact_field( $field )
{
	return yiw_option_id( $_GET['id'], false ) . "_{$field}";      
}                     

function yiw_id_contact_field( $field )
{
	echo yiw_get_id_contact_field( $field );         
}            

$attrs = array(
	'title' => '',
	'data_name' => '',
	'description' => '',
	'type' => '',
	'option' => '',
	'option_selected' => '',
	'already_checked' => '',
	'label_checkbox' => '',
	'msg_error' => '',
	'required' => '',
	'email_validate' => '',
	'reply_to' => '',
	'class' => ''
);

switch( $action )
{
	case 'new-field' :
		$title = __( 'Add New Field', 'yiw' );
		$subtitle = __( 'Add new field for your contact module.', 'yiw' );
		$action_submit = 'save';            
		                                                                 
		$fields = null;
		$c_field = null;
	break;
	
	case 'edit-field' :
		$title = __( 'Edit Field', 'yiw' );         
		$subtitle = __( 'Edit the attributes of field.', 'yiw' );  
		$action_submit = 'update-array';
		                                                                 
		$fields = stripslashes_deep( maybe_unserialize( yiw_get_option( $_GET['id'] ) ) );
		$c_field = intval( $_GET['c'] );                               

		//echo '<pre>', print_r($fields), '</pre>';
		
		$attrs = wp_parse_args( $fields[$c_field], $attrs );
// 		foreach( $attrs as $id => $value )
// 		{
// 			$attrs[$id] = $fields[$c_field][$id]; 
// 		}
	break;
	
	default:
		$title = '';
		$subtitle = '';
	break;
}

$parent_file = 'themes.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
<head>                   
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<title><?php echo $title; ?></title>
<?php        
	wp_admin_css( 'global', true );
	wp_admin_css( 'wp-admin', true );
	//wp_print_styles( 'colors' ); 
	wp_enqueue_style( 'colors-admin', site_url() . '/wp-admin/css/colors-fresh.css' );  
	wp_print_styles( 'colors-admin' ); 
	wp_admin_css( 'media', true );  
	wp_print_scripts( 'jquery' );
	wp_print_scripts( 'thickbox' );      
?>
<style type="text/css">
html, body { min-height:100%; height:inherit; }
</style>
</head>
<body id="media-upload">
	        
	<div id="media-upload-header"></div>
	
	<form action="<?php echo admin_url( 'themes.php?page=' . $_GET['page'] . '&tab=' . $_GET['tab'] ) ?>" method="post" class="media-upload-form">  
		<h3 class="media-title"><?php echo $title; ?></h3>
		<p><?php echo $subtitle ?></p>
		
		<table class="describe" style="display: table;">
			
			<tbody>
				<tr>
					<th class="label" valign="top" scope="row">
						<label for="<?php yiw_id_contact_field( 'title' ) ?>"><?php _e( 'Title Field', 'yiw' ) ?></label>
					</th>
					<td class="field">
						<input type="text" name="<?php yiw_name_contact_field( 'title' ) ?>" id="<?php yiw_id_contact_field( 'title' ) ?>" value="<?php echo $attrs['title'] ?>" />
						<p class="help"><?php _e( 'Insert the title of field.', 'yiw' ) ?></p>	
					</td>
				</tr>
				
				<tr>
					<th class="label" valign="top" scope="row">
						<label for="<?php yiw_id_contact_field( 'data_name' ) ?>"><?php _e( 'Data Name', 'yiw' ) ?></label>
					</th>
					<td class="field">
						<input type="text" name="<?php yiw_name_contact_field( 'data_name' ) ?>" id="<?php yiw_id_contact_field( 'data_name' ) ?>" value="<?php echo $attrs['data_name'] ?>" />
						<p class="help"><?php _e( 'The identification name of this field, that you can insert into body email configuration.', 'yiw' ) ?></p>	
					</td>
				</tr>	
				
				<tr>
					<th class="label" valign="top" scope="row">
						<label for="<?php yiw_id_contact_field( 'description' ) ?>"><?php _e( 'Description', 'yiw' ) ?></label>
					</th>
					<td class="field">
						<input type="text" name="<?php yiw_name_contact_field( 'description' ) ?>" id="<?php yiw_id_contact_field( 'description' ) ?>" value="<?php echo $attrs['description'] ?>" />
						<p class="help"><?php _e( 'Small description, showed near name title.', 'yiw' ) ?></p>	
					</td>
				</tr>	
				
				<tr>                 
					<th class="label" valign="top" scope="row">
						<label for="<?php yiw_id_contact_field( 'type' ) ?>"><?php _e( 'Type field', 'yiw' ) ?></label>
					</th>
					<td class="field">
						<select id="type-select" name="<?php yiw_name_contact_field( 'type' ) ?>">
							<?php yiw_list_option( $types, $attrs['type'] ) ?>	
						</select>                                     
						<p class="help"><?php _e( 'Select the type of this field.', 'yiw' ) ?></p>	
					</td>
				</tr>      
				
				<tr class="options-list toggled<?php if( $attrs['type'] != 'select' AND $attrs['type'] != 'radio' ) : ?> hide-if-js<?php endif; ?>">           
					<th class="label" valign="top" scope="row">
						<label><?php _e( 'Add options', 'yiw' ) ?></label>
					</th>  
					<td class="field" colspan="2">                                        
						<a href="#" class="add-field-option button-secondary"><?php _e( 'Add option', 'yiw' ) ?></a><br />
						
						<?php 
						if( is_array( $attrs['option'] ) AND !empty( $attrs['option'] ) ) : 
							foreach( $attrs['option'] as $id => $value ) :
								$selected = '';
								if( intval( $attrs['option_selected'] ) == $id )
									$selected = ' checked=""';
						?>
						<p class="option">      
							<label><input type="radio" name="<?php yiw_name_contact_field( 'option_selected' ) ?>" value="<?php echo $id ?>"<?php echo $selected ?> /> <?php _e( 'Selected', 'yiw' ) ?></label>
							<input type="text" name="<?php yiw_name_contact_field( 'option' ) ?>[]" style="width:50%" value="<?php echo $value ?>" />
							<a href="#" class="del-field-option button-secondary"><?php _e( 'Delete option', 'yiw' ) ?></a>
						</p>
						<?php endforeach; endif; ?>
						
						<p class="option">      
<label><input type="radio" name="<?php yiw_name_contact_field( 'option_selected' ) ?>" value="<?php echo ( (isset($id) ? $id : '' ) > 0 ) ? (isset($id) ? $id : '' ) + 1 : 0 ?>" /> <?php _e( 'Selected', 'yiw' ) ?></label>
							<input type="text" name="<?php yiw_name_contact_field( 'option' ) ?>[]" style="width:50%" />
							<a href="#" class="del-field-option button-secondary"><?php _e( 'Delete option', 'yiw' ) ?></a>
						</p>
						
					</td>
				</tr>       
				
				<tr class="if-checked toggled<?php if( $attrs['type'] != 'checkbox' ) : ?> hide-if-js<?php endif; ?>">           
					<th class="label" valign="top" scope="row">
						<label><?php _e( 'Checked', 'yiw' ) ?></label>
					</th>  
					<td class="field" colspan="2">    
						<label>
							<input type="checkbox" value="yes" name="<?php yiw_name_contact_field( 'already_checked' ) ?>" id="<?php yiw_id_contact_field( 'already_checked' ) ?>"<?php checked( $attrs['already_checked'], 'yes' ); ?> />
							<p class="help" style="display:inline;"><?php _e( 'Select this if you want this field already checked.', 'yiw' ) ?></p>
						</label>
					</td>
				</tr>      
				
				<tr class="if-checked toggled" <?php if( $attrs['type'] != 'checkbox' ) : ?> style="display:none;"<?php endif; ?>> 
					<th class="label" valign="top" scope="row">
						<label for="<?php yiw_id_contact_field( 'label_checkbox' ) ?>"><?php _e( 'Label for Checkbox', 'yiw' ) ?></label>
					</th>
					<td class="field">
						<input type="text" name="<?php yiw_name_contact_field( 'label_checkbox' ) ?>" id="<?php yiw_id_contact_field( 'label_checkbox' ) ?>" value="<?php echo $attrs['label_checkbox'] ?>" />
						<p class="help"><?php _e( 'Insert the label message for checkbox.', 'yiw' ) ?></p>	
					</td>
				</tr>      
				
				<tr>
					<th class="label" valign="top" scope="row">
						<label for="<?php yiw_id_contact_field( 'msg_error' ) ?>"><?php _e( 'Message Error', 'yiw' ) ?></label>
					</th>
					<td class="field">
						<input type="text" name="<?php yiw_name_contact_field( 'msg_error' ) ?>" id="<?php yiw_id_contact_field( 'msg_error' ) ?>" value="<?php echo $attrs['msg_error'] ?>" />
						<p class="help"><?php _e( 'Insert the error message for validation.', 'yiw' ) ?></p>	
					</td>
				</tr>	    
				
				<tr>           
					<th class="label" valign="top" scope="row">
						<label><?php _e( 'Required', 'yiw' ) ?></label>
					</th>  
					<td class="field" colspan="2">    
						<label>
							<input type="checkbox" value="yes" name="<?php yiw_name_contact_field( 'required' ) ?>" id="<?php yiw_id_contact_field( 'required' ) ?>"<?php checked( $attrs['required'], 'yes' ); ?> />
							<p class="help" style="display:inline;"><?php _e( 'Select this if it must be required.', 'yiw' ) ?></p>
						</label>
					</td>
				</tr>        
				
				<tr>           
					<th class="label" valign="top" scope="row">
						<label><?php _e( 'Email', 'yiw' ) ?></label>
					</th>  
					<td class="field" colspan="2">    
						<label>
							<input type="checkbox" value="yes" name="<?php yiw_name_contact_field( 'email_validate' ) ?>" id="<?php yiw_id_contact_field( 'email_validate' ) ?>"<?php checked( $attrs['email_validate'], 'yes' ); ?> />
							<p class="help" style="display:inline;"><?php _e( 'Select this if it must be a valid email.', 'yiw' ) ?></p>
						</label>
					</td>
				</tr>             
				
				<tr>           
					<th class="label" valign="top" scope="row">
						<label><?php _e( 'Reply To', 'yiw' ) ?></label>
					</th>  
					<td class="field" colspan="2">    
						<label>
							<input type="checkbox" value="yes" name="<?php yiw_name_contact_field( 'reply_to' ) ?>" id="<?php yiw_id_contact_field( 'reply_to' ) ?>"<?php checked( $attrs['reply_to'], 'yes' ); ?> />
							<p class="help" style="display:inline;"><?php _e( 'Select this if it\'s the email where you can reply.', 'yiw' ) ?></p>
						</label>
					</td>
				</tr>   
				
				<tr>
					<th class="label" valign="top" scope="row">
						<label for="<?php yiw_id_contact_field( 'class' ) ?>"><?php _e( 'Class', 'yiw' ) ?></label>
					</th>
					<td class="field">
						<input type="text" name="<?php yiw_name_contact_field( 'class' ) ?>" id="<?php yiw_id_contact_field( 'class' ) ?>" value="<?php echo $attrs['class'] ?>" />
						<p class="help"><?php _e( 'Insert an additional class for more personalization. (you can insert more class, separeted by space)', 'yiw' ) ?></p>	
					</td>
				</tr>	
				
				<tr>
					<td colspan="2">
						<p>                                                                                                       
							<input type="hidden" name="action" value="<?php echo $action_submit ?>" />                         
							<input type="hidden" name="c" value="<?php echo $c_field ?>" />                                             
							<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />                                         
							<input type="hidden" name="save_only" value="<?php echo $_GET['id'] ?>" />              
							<input type="submit" class="button-secondary" value="<?php _e( 'Save', 'yiw' ) ?>" />
							<input type="button" class="button-secondary" value="<?php _e( 'Reset', 'yiw' ) ?>" onclick="self.parent.tb_remove();" />
							<img class="waiting" style="display:none;" src="<?php echo admin_url( 'images/wpspin_light.gif' ); ?>" alt="" />
						</p> 
					</td>
				</tr>
			</tbody>
		
		</table>
		
	</form>
	
	<script type="text/javascript">
		jQuery(document).ready(function($){   
		
			$('.hide-if-js').hide();
		
			function disable_submit()
			{
				$('input[type="submit"]').attr("disabled", true);
				add_loading();
			}
		
			function enable_submit()
			{
				$('input[type="submit"]').removeAttr("disabled");
				remove_loading();
			}
			
			function add_loading()
			{
				$('.waiting').show();
			}
			
			function remove_loading()
			{
				$('.waiting').hide();
			}
			
			function remove_input(e)
			{
				$(e).css({backgroundColor:'#FF0000'}).animate({opacity:0}, 400, function(){
					$(e).remove();
				});	
			}
		
			$('.media-upload-form').live( 'submit', function(){			                                 
				var datastring = 'type-send=ajax&page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&';     
				
				$('.options-list p.option').each(function(e){
					if( $('input[type="text"]', this).val() == '' )
						remove_input(this);
				});              
					
				disable_submit();
				
				setTimeout( function() {
					$('input, select, textarea').each(function(){                           
						
						if( !( ( $(this).is(':checkbox') || $(this).is(':radio') ) && !$(this).is(':checked') ) )	
						{
							var val = $(this).val();
							datastring = datastring + $(this).attr('name') + "=" + val + '&';    
						}
					});              
					
					$.ajax({
						url: '<?php echo admin_url( 'themes.php?page=' . $_GET['page'] . '&tab=' . $_GET['tab'] ) ?>',
						data: datastring,
						type: 'POST',
						success: function(response){        
							//self.parent.location = '<?php echo admin_url( 'admin.php?page=' . $_GET['page'] ) ?>'; 
							self.parent.location = response; 
						
							//enable_submit();
						}     
					});
				}, 500);
					
				return false;
			});
		
			$('#type-select').live( 'change', function(){
				var val = $(this).val();
				
				if( val == 'select' || val == 'radio' )
				{
					$('.toggled').hide();
					$('.options-list').show();
				} 
				else if( val == 'checkbox' )
				{                          
					$('.toggled').hide();
					$('.if-checked').show();
				}
				else
				{
					$('.toggled').hide();
				}
			});
			
			$('input[type="reset"]').live( 'click', function(){
				$('.toggled').hide();
			});
		
			$('.add-field-option').live( 'click', function(){
				var field_container = $(this).parent();                           
				var last_val = parseInt( field_container.find('p.option:last-child input[type="radio"]').val() );
				field_container.find('p.option:last-child').clone().appendTo(field_container).children('input[type="text"]').val('');
				field_container.find('p.option:last-child input[type="radio"]').val( last_val + 1 );
				return false;	
			});
			
			$('a.del-field-option').live( 'click', function(){
				$(this).parent().remove();
				return false;
			});                          
		
		});
	</script>    
	
</body>
</html>