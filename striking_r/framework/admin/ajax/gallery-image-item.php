<li id="image-<?php echo $image->ID;?>" class="imageItemWrap">
<div class="sort-item">
	<table width="100%">
		<tr>
			<td class="handle"><div></div></td>
			<td width="70">
				<a title="<?php echo $image->post_title;?>" class="thickbox" href="<?php echo $image->guid;?>?" style="display:block;">
					<?php echo wp_get_attachment_image($image->ID,array(60,60));?>
				</a>
			</td>
			<td width="160">
				<strong><a title="<?php echo $image->post_title;?>" class="thickbox" href="<?php echo $image->guid;?>?"><?php echo $image->post_title;?></a></strong>
				<br />
				<?php echo $date;?>
				<br />
				<?php echo $size;?>
			</td>
			<td>
				<?php if(function_exists('mb_substr')){ 
					echo mb_substr($image->post_content,0,50,get_option('blog_charset'));
				} else{
					echo substr($image->post_content,0,50);
				}

				?>
			</td>
			<td width="90" align="center">
				<div class="button-secondary edit-item" style="margin-bottom: 2px;">Edit</div>
				<div class="button-secondary delete-item">Delete</div>
			</td>

		</tr>
	</table>
</div>
</li>