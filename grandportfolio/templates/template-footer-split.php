<?php
    //Display copyright text
    $tg_footer_copyright_text = kirki_get_option('tg_footer_copyright_text');

    if(!empty($tg_footer_copyright_text))
    {
    	echo '<div id="copyright">'.wp_kses_post(htmlspecialchars_decode($tg_footer_copyright_text)).'</div>';
    }
?>

<?php
    //Check if display to top button
    $tg_footer_copyright_totop = kirki_get_option('tg_footer_copyright_totop');
    
    if(!empty($tg_footer_copyright_totop))
    {
?>
    <a id="toTop"><i class="fa fa-angle-up"></i></a>
<?php
    }
?>