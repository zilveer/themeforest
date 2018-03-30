<?php
$photos = get_field('photo_albums');
$count = count($photos);
if ( ! empty($count) ) :
?>

	<div class="photo-wrap">
		<a href="<?php echo get_permalink();?>">
			<?php the_post_thumbnail('large'); ?>
			<div class="photo-album-tab">
				<div class="tab-text">
					<div class="tab-title"><?php the_title(); ?></div>
					<div class="tab-date"><?php the_time(get_option('date_format')); ?></div>
					<div class="tab-circle">
					<?php
						$albums = get_field('album_photos', $post->ID);
						echo count($albums);
					?>
					</div>
				</div>
			</div>
		</a>
	</div>

<?php endif; ?>