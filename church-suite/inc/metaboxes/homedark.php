<?php while($metabox->have_fields('webnus_homedark_options',1)): ?>
<p>
    <?php $selected = ' selected="selected"'; ?>
    <?php $metabox->the_field('show_page_title_bar'); ?>
    <table width="100%">
     <tr>
   		<td><b>Title</b></td>
	    <td>
	   		 <input type="text" name="<?php $metabox->the_name('title'); ?>" value="<?php $metabox->the_value('title'); ?>"/>
	   		
	 	</td>
 	</tr>
    <tr>
	    <td>
	    	<b>Subtitle:</b>
	    </td>
	    <td>
	   <input type="text" name="<?php $metabox->the_name('subtitle'); ?>" value="<?php $metabox->the_value('subtitle'); ?>"/>
		</td>
	</tr>
	
   
 	<tr>
 		<td><b>Background Image:</b></td>
 		<td>
	 		<?php $mb->the_field('background_image'); ?>
			<input  type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
			
	 			
 		</td>
 	</tr>
 	
 	<tr>
 		<td><b>Logo:</b></td>
 		<td>
	 		<?php $mb->the_field('logo'); ?>
			<input  type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
						
	 			
 		</td>
 	</tr>
 	<tr>
 		<td><b>Logo Width:</b></td>
 		<td>
	 		<?php $mb->the_field('logo_width'); ?>
			<input  type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>
						
	 			
 		</td>
 	</tr>
 	
   </table>
 
   
</p>
<?php endwhile; ?>