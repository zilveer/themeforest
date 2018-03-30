<div class="left-menu">
	<div class="inner">
		<div class="logo"></div>
		<ul class="menu">
			<?php foreach($this->tabs as $index => $tab):?>
			<li class="item-left"><a class="<?php echo $tab['slug'];?>" href="#tab-<?php echo $tab['slug'];?>"><span><?php echo $tab['name'];?></span></a></li>
			<?php endforeach;?>
		</ul>
	</div>
</div>