<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

?>

<!-- Modal Search -->
<div class="modal modal-vcenter fade modal-search" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="modal-search" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <?php get_search_form(); ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal Login -->
<?php if ( !is_user_logged_in() ) : ?>
<div class="modal fade modal-login" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-login-label"><strong><?php esc_html_e('Login', 'monarch'); ?></strong></h4>
      </div>

      <div class="modal-body">
        <?php do_action( 'bp_before_account_details_fields' ); ?>
        <?php wp_login_form(); ?>
      </div>

      <div class="modal-footer">
        <p>
          <?php login_footer_links(); ?>
        </p>
      </div>
      
    </div>
  </div>
</div>
<?php endif; ?>

</div><!-- Wrapper -->
</div><!-- Body Background -->

<?php wp_footer(); ?>
</body>
</html>
