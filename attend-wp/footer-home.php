<?php if ( get_theme_mod( 'cr3ativ_conference_analytics' ) ) : ?>
<?php $analytics = ( get_theme_mod( 'cr3ativ_conference_analytics' ) ); ?> 
<script><?php echo esc_html($analytics); ?></script>
<?php else : ?>
<?php endif; ?>


<script type="text/javascript">
    jQuery(document).ready(function() {
        
'use strict';
    jQuery('.nav2').navgoco();
    jQuery(".nav2 li").removeClass("open");
    jQuery(".nav2 ul").removeAttr("style") 
    
        
    });
</script>

<?php wp_footer(); ?>

</body>

</html>