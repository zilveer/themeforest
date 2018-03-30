<footer>
    <div class="container">
        <div class="row-fluid">
            <?php ct_footer_columns($customClass = '', $template = '<div class="%class% span%col%">', $closeTemplate = '</div>', $maxColumns = 12) ?>
        </div>
    </div>
    <h4>
	    <?php echo strtr(ct_get_option('general_footer_text', ''), array('%year%' => date('Y'), '%name%' => get_bloginfo('name', 'display')))?>
    </h4>
</footer>