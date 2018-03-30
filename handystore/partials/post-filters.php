<?php // Isotope filters for posts
$filters = array();

if ( handy_get_option('blog_isotope_filters') == 'cats' ) : $filters = get_categories(); $prefix = 'category'; endif;
if ( handy_get_option('blog_isotope_filters') == 'tags' ) : $filters = get_tags(); $prefix = 'tag'; endif;

if (!empty($filters)) { ?>
	<div class="portfolio-filters-wrapper">
		<label for="pt-filters"><?php _e('Filter blog posts by:', 'plumtree'); ?></label>
		<select id="pt-filters" name="pt-filters" class="filters-group" data-isotope=filters data-filter-group="<?php echo esc_attr($prefix); ?>">
			<option value=""><?php _e('All', 'plumtree'); ?></option>
			<?php foreach($filters as $filter) : ?>
				<option value="<?php echo esc_attr($prefix).'-'.esc_attr($filter->slug); ?>"><?php echo esc_attr($filter->name); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
<?php }
