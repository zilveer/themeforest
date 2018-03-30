<?php $t =& peTheme(); ?>
<?php $project =& $t->project; ?>
<?php list($portfolio) = $t->template->data(); ?>

		<!-- Filters -->
		<ul class="filtering grid-full">
			<?php $project->filter('',"filter","active"); ?>
		</ul>
		
	</div>

	<!-- Ajax Section -->
	<div class="ajax-section container">
		<div class="loader"></div>
		<div class="project-navigation">
			<ul>
				<li class="nextProject"><a href="#"></a></li>
				<li class="prevProject"><a href="#"></a></li>
			</ul>
		</div>
		<div class="closeProject">
			<a href="#"><i class="icon-remove"></i></a>               
		</div>
        <div class="ajax-content clearfix"></div>
	</div>
	<!-- End Ajax Section -->

<?php $content =& $t->content; ?>
<!-- Thumbnails -->
<ul class="projectlist clearfix">
<?php while ($content->looping()): ?>

<?php $meta =& $content->meta(); ?>
<?php $class = isset( $meta->ajax->ajax ) && $meta->ajax->ajax === 'yes' ? 'doajax' : 'noajax'; ?>

<li class="project mix <?php echo $class; ?> <?php $project->filterClasses(); ?>">
	<a href="<?php echo get_permalink(); ?>" data-slug="<?php echo esc_attr(basename(get_permalink())); ?>">
		<?php $content->img(545,344); ?>
		<div class="projectinfo">
			<div class="meta">
				<h4><?php $content->title(); ?></h4>
				<h6><em><?php 

				$terms = get_the_terms( get_the_id(), 'prj-category' );
				$output = '';

				if ( $terms && ! is_wp_error( $terms ) ) :

					foreach ( $terms as $term ) {
						$output .= $term->name . ' / ';
					}

					$output = substr( $output, 0, -3 );

					echo $output;

				endif;

				?></em></h6>
			</div>
		</div>
	</a>
</li>

<?php endwhile; ?>
</ul>