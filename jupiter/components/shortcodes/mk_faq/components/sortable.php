<?php if ( $view_params['sortable'] != 'true' ) return false; ?>

<header class="filter-faq <?php echo $view_params['style']; ?>-style">
      <ul>
          <?php $terms = array();
                 if ($view_params['cat'] != '') {
                      foreach (explode(',', $view_params['cat']) as $term_slug) {
                           $terms[] = get_term_by('slug', $term_slug, 'faq_category');
                      }
                 } else {
                      $terms = get_terms('faq_category', 'hide_empty=1');
                 } ?>

              <li><a class="current" data-filter="" href="#"><?php echo _e( $view_params['sortable_all_text'], 'mk_framework' ); ?></a></li>
          
          <?php foreach ( $terms as $term ) { ?>

              <li><a data-filter="<?php echo $term->slug; ?>" href="#"><?php echo $term->name; ?></a></li>

          <?php } ?>
          <div class="clearboth"></div>
      </ul>
</header>
