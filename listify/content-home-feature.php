<?php
/**
 * Home feature
 */
?>

<div class="home-feature">
	<div class="home-feature-media">
		<img src="<?php echo $feature[ 'media' ]; ?>" alt="<?php echo $feature[ 'title' ]; ?>">
	</div>
	<div class="home-feature-title"><h2><?php echo $feature[ 'title' ]; ?></h2></div>
	<div class="home-feature-description"><?php echo $feature[ 'description' ]; ?></div>
</div>