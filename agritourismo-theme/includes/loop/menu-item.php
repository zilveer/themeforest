<?php
	global $OTpostContent;
?>

<div class="menu-card-item">
	<div class="menu-card-photo">
		<a href="<?php echo $OTpostContent['item_permalink'];?>" class="photo-border-1">
			<img src="<?php echo $OTpostContent['item_image'];?>" alt="<?php echo $OTpostContent['item_title'];?>" />
		</a>
	</div>
	<div class="menu-card-content">
		<h3>
			<a href="<?php echo $OTpostContent['item_permalink'];?>"><?php echo $OTpostContent['item_title'];?></a>
			<?php echo $OTpostContent['item_price'];?>
		</h3>
		<p><?php echo $OTpostContent['item_excerpt'];?></p>
		<?php echo $OTpostContent['item_button'];?>
	</div>
	<div class="clear-float"></div>
</div>