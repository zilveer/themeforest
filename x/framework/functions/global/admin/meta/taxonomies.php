<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/META/TAXONOMIES.PHP
// -----------------------------------------------------------------------------
// Implement the meta boxes for taxonomy pages.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Add New Taxonomy Page
//   02. Edit Taxonomy Page
//   03. Save Taxonomy Meta
//   04. Taxonomy Actions
//   05. Get Taxonomy Meta
// =============================================================================

// Add New Taxonomy Page
// =============================================================================

function x_taxonomy_add_new_meta_field() {

  $stack = x_get_stack();

  $archive_title_display    = ( $stack != 'icon'      ) ? 'style="display: block;"' : 'style="display: none;"';
  $archive_subtitle_display = ( $stack == 'integrity' ) ? 'style="display: block;"' : 'style="display: none;"';
  $accent_display           = ( $stack == 'ethos' )     ? 'style="display: block;"' : 'style="display: none;"';

  ?>
  <div class="form-field" <?php echo $archive_title_display; ?>>
    <label for="term_meta[archive-title]"><?php _e( 'Archive Title', '__x__' ); ?></label>
    <input type="text" name="term_meta[archive-title]" id="term_meta[archive-title]" value="">
    <p><?php _e( 'Enter in a value to overwrite the default title of the archive page.', '__x__' ); ?></p>
  </div>
  <div class="form-field" <?php echo $archive_subtitle_display; ?>>
    <label for="term_meta[archive-subtitle]"><?php _e( 'Archive Subtitle', '__x__' ); ?></label>
    <input type="text" name="term_meta[archive-subtitle]" id="term_meta[archive-subtitle]" value="">
    <p><?php _e( 'Enter in a value to overwrite the default subtitle of the archive page.', '__x__' ); ?></p>
  </div>
  <div class="form-field" <?php echo $accent_display; ?>>
    <label for="term_meta[accent]"><?php _e( 'Accent', '__x__' ); ?></label>
    <input type="text" name="term_meta[accent]" id="term_meta[accent]" class="wp-color-picker" value="#ffffff" data-default-color="#ffffff">
    <p><?php _e( 'Choose an accent color to be used for certain design elements.', '__x__' ); ?></p>
  </div>
  <?php
}



// Edit Taxonomy Page
// =============================================================================

function x_taxonomy_edit_meta_field( $term ) {

  $stack = x_get_stack();

  $archive_title_display    = ( $stack != 'icon'      ) ? 'style="display: table-row;"' : 'style="display: none;"';
  $archive_subtitle_display = ( $stack == 'integrity' ) ? 'style="display: table-row;"' : 'style="display: none;"';
  $accent_display           = ( $stack == 'ethos' )     ? 'style="display: table-row;"' : 'style="display: none;"';

  $t_id      = $term->term_id;
  $term_meta = get_option( 'taxonomy_' . $t_id );

  ?>
  <tr class="form-field" <?php echo $archive_title_display; ?>>
    <th scope="row" valign="top">
      <label for="term_meta[archive-title]"><?php _e( 'Archive Title', '__x__' ); ?></label>
    </th>
    <td>
      <input type="text" name="term_meta[archive-title]" id="term_meta[archive-title]" value="<?php echo esc_attr( $term_meta['archive-title'] ) ? esc_attr( $term_meta['archive-title'] ) : ''; ?>">
      <p class="description"><?php _e( 'Enter in a value to overwrite the default title of the archive page.', '__x__' ); ?></p>
    </td>
  </tr>
  <tr class="form-field" <?php echo $archive_subtitle_display; ?>>
    <th scope="row" valign="top">
      <label for="term_meta[archive-subtitle]"><?php _e( 'Archive Subtitle', '__x__' ); ?></label>
    </th>
    <td>
      <input type="text" name="term_meta[archive-subtitle]" id="term_meta[archive-subtitle]" value="<?php echo esc_attr( $term_meta['archive-subtitle'] ) ? esc_attr( $term_meta['archive-subtitle'] ) : ''; ?>">
      <p class="description"><?php _e( 'Enter in a value to overwrite the default subtitle of the archive page.', '__x__' ); ?></p>
    </td>
  </tr>
  <tr class="form-field" <?php echo $accent_display; ?>>
    <th scope="row" valign="top">
      <label for="term_meta[accent]"><?php _e( 'Accent', '__x__' ); ?></label>
    </th>
    <td>
      <input type="text" name="term_meta[accent]" id="term_meta[accent]" class="wp-color-picker" value="<?php echo esc_attr( $term_meta['accent'] ) ? esc_attr( $term_meta['accent'] ) : '#ffffff'; ?>" data-default-color="#ffffff">
      <p class="description"><?php _e( 'Choose an accent color to be used for certain design elements.', '__x__' ); ?></p>
    </td>
  </tr>
  <?php
}



// Save Taxonomy Meta
// =============================================================================

function x_taxonomy_save_custom_meta( $term_id ) {
  if ( isset( $_POST['term_meta'] ) ) {
    $t_id      = $term_id;
    $term_meta = get_option( 'taxonomy_' . $t_id );
    $cat_keys  = array_keys( $_POST['term_meta'] );
    foreach ( $cat_keys as $key ) {
      if ( isset ( $_POST['term_meta'][$key] ) ) {
        $term_meta[$key] = wp_kses_post( stripslashes( $_POST['term_meta'][$key] ) );
      }
    }
    update_option( 'taxonomy_' . $t_id, $term_meta );
  }
}



// Taxonomy Actions
// =============================================================================

$taxonomies = array(
  'category',
  'post_tag',
  'portfolio-category',
  'portfolio-tag',
  'product_cat',
  'product_tag'
);

foreach ( $taxonomies as $tax ) {
  add_action( $tax . '_add_form_fields',  'x_taxonomy_add_new_meta_field', 10, 2 );
  add_action( $tax . '_edit_form_fields', 'x_taxonomy_edit_meta_field',    10, 2 );
  add_action( 'edited_' . $tax,           'x_taxonomy_save_custom_meta',   10, 2 );
  add_action( 'create_' . $tax,           'x_taxonomy_save_custom_meta',   10, 2 );
}



// Get Taxonomy Meta
// =============================================================================

function x_get_taxonomy_meta() {

  $object = get_queried_object();
  $id     = $object->term_id;
  $meta   = get_option( 'taxonomy_' . $id );

  return $meta;

}