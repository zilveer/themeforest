<?php


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if( isset( $form ) && $form == true ): ?>
</div>

<div class="submit_footer">
    <span class="submit">
        <input type="submit" value="<?php echo __('Save options', 'yit') ?>" class="button-secondary" />
    </span>       
    <?php yit_nonce_field( 'yit_panel' ); ?>
    <input type="hidden" value="<?php echo esc_attr( $tab_slug ) ?>" name="yit-subpage" />
    <input id="yit-panel-action" type="hidden" value="yit-panel-save" name="action" />
</div>
</form>
<?php endif ?>

</div>
</div>
</div>
