<?php
/*
 * social share icons
 */

$contexts = array(
	'post'      => __('Post', 'health-center'),
	'page'      => __('Page', 'health-center'),
	'portfolio' => __('Portfolio', 'health-center'),
	'product'   => __('Product', 'health-center'),
	'lightbox'  => __('Lightbox', 'health-center'),
	'tribe'     => __('Tribe Events', 'health-center'),
);

$networks = array(
	'twitter'    => 'https://abs.twimg.com/favicons/favicon.png',
	'facebook'   => 'https://www.facebook.com/favicon.ico',
	'googleplus' => '//ssl.gstatic.com/s2/oz/images/faviconr2.ico',
	'pinterest'  => '//passets-cdn.pinterest.com/images/favicon.png',
);

?>

<div class="wpv-config-row social clearfix">
	<div class="rtitle">
		<h4><?php echo $name?></h4>

		<?php wpv_description('social', $desc) ?>
	</div>

	<div class="rcontent">
		<table cellspacing="5px">
			<thead>
				<th>&nbsp;</th>
				<?php foreach($networks as $network=>$image): ?>
					<th><img src="<?php echo $image?>" alt="<?php echo ucfirst($network)?>" width="16" height="16"/></th>
				<?php endforeach ?>
			</thead>
			<tbody>
				<?php foreach($contexts as $context=>$context_translation): ?>
					<tr>
						<th><?php echo $context_translation ?></th>
						<?php foreach($networks as $network=>$image): ?>
							<td><input type="checkbox" name="share-<?php echo $context.'-'.$network?>" <?php checked(wpv_get_option("share-$context-$network"), true)?> value="true" class="<?php wpv_static($value)?>" /></td>
						<?php endforeach ?>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>