<?php
/**
 * Begins page layout according to page settings (fullwidth / sidebar)
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $layout =& $t->layout; ?>

<?php if ($layout->content != "fullwidth"): // boxed ?>
<?php if ($layout->sidebar === "right"): // sidebar ?>
</section>
<?php get_sidebar(); ?>
</div><!-- row-fluid -->
<?php endif; // end sidebar ?>
</div><!-- pe-container -->
<?php endif; // end boxed ?>

</div><!-- side-body -->
