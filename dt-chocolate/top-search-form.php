<form method="get" class="c_search" action="<?php echo home_url('/'); ?>" >
   <input name="s" type="text" value="<?php the_search_query(); ?>" placeholder="<?php esc_attr_e('Search...', LANGUAGE_ZONE); ?>" />
   <a href="#go-search" onClick="jQuery('.c_search').submit(); return false;"></a>
</form>
