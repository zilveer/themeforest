<?php
add_action('admin_menu','add_post_options');
add_action('save_post','save_post_options');

function add_post_options()
{
	global $theme_name;

	add_meta_box('post-Options','True Settings','postOptions','post','normal','high');
}

function postOptions()
{
	global $post;
	?>
	<table>
		<tr>
			<td>Type</td>
			<td>
				<select name="sourceType" style="width:300px;">
					<option value="" <?php echo (get_post_meta( $post->ID,"sourceType",true)=='')?'selected':''; ?> >None</option>
					<option value="videolink" <?php echo (get_post_meta( $post->ID,"sourceType",true)=='videolink')?'selected':''; ?> >Video Link</option>
					<option value="youtube" <?php echo (get_post_meta( $post->ID,"sourceType",true)=='youtube')?'selected':''; ?>>Youtube</option>
					<option value="vimeo" <?php echo (get_post_meta( $post->ID,"sourceType",true)=='vimeo')?'selected':''; ?>>Vimeo</option>
					<option value="flowplayer" <?php echo (get_post_meta( $post->ID,"sourceType",true)=='flowplayer')?'selected':''; ?>>Flow Player</option>
					<option value="swf" <?php echo (get_post_meta( $post->ID,"sourceType",true)=='swf')?'selected':''; ?>>SWF</option>
				</select>
			<input  type="hidden" name="sourceType_noncename" id="sourceType_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			</td>
		</tr>
		<tr>
			<td>URL, Path or Code</td>
			<td><input name="sourceData" style="width:300px;" type="text" value="<?php echo get_post_meta( $post->ID,"sourceData",true) ?>" />
			<input  type="hidden" name="sourceData_noncename" id="sourceData_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			</td>
		</tr>
		<tr>
			<td>Show Type</td>
			<td>
				<select name="sourceOpen" style="width:300px;">
					<option value="e" <?php echo (get_post_meta( $post->ID,"sourceOpen",true)=='e')?'selected':''; ?> >Embed</option>
					<option value="m" <?php echo (get_post_meta( $post->ID,"sourceOpen",true)=='m')?'selected':''; ?>>Modal</option>
				</select>
			<input  type="hidden" name="sourceOpen_noncename" id="sourceOpen_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			</td>
		</tr>
	</table>
	<?php
}

function save_post_options($postID)
{
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

	global $post;

	$sourceType = '';
	$sourceData = '';
	$sourceOpen = '';

	if(!empty($_POST["sourceData"]))
		$sourceData = stripslashes($_POST["sourceData"]);
	if(!empty($_POST["sourceType"]))
		$sourceType = stripslashes($_POST["sourceType"]);
	if(!empty($_POST["sourceOpen"]))
		$sourceOpen = stripslashes($_POST["sourceOpen"]);
		
	
	if(get_post_meta($postID,"sourceType")=='')
		add_post_meta($postID,"sourceType",$sourceType,true);
	elseif($sourceType!=get_post_meta($postID,"sourceType", true))
		update_post_meta($postID,"sourceType",$sourceType);
	elseif($sourceType=='')
		delete_post_meta($postID,"sourceType",get_post_meta($postID,"sourceType",true));
		
	if(get_post_meta($postID,"sourceData")=='')
		add_post_meta($postID,"sourceData",$sourceData,true);
	elseif($sourceData!=get_post_meta($postID,"sourceData", true))
		update_post_meta($postID,"sourceData",$sourceData);
	elseif($sourceData=='')
		delete_post_meta($postID,"sourceData",get_post_meta($postID,"sourceData",true));
		
	if(get_post_meta($postID,"sourceOpen")=='')
		add_post_meta($postID,"sourceOpen",$sourceOpen,true);
	elseif($sourceOpen!=get_post_meta($postID,"sourceOpen", true))
		update_post_meta($postID,"sourceOpen",$sourceOpen);
	elseif($sourceOpen=='')
		delete_post_meta($postID,"sourceOpen",get_post_meta($postID,"sourceOpen",true));
}

?>