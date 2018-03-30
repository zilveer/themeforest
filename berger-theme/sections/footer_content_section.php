<?php
/**
 * Created by Clapat.
 * Date: 10/02/15
 * Time: 11:38 AM
 */
global $clapat_bg_theme_options;

if( $clapat_bg_theme_options['clapat_bg_footer_layout'] == 'v1' ){

    echo '<div class="container text-align-center">';
}
else{

    echo '<div class="container">';
}


if( $clapat_bg_theme_options['clapat_bg_footer_layout'] == 'v2' ){

    echo '<p class="monospace copyright-minimal">' . $clapat_bg_theme_options['clapat_bg_footer_copyright'] . '</p>';

    get_template_part('sections/footer_social_links_section');
}
else{

    get_template_part('sections/footer_social_links_section');

    echo '<p class="monospace">' . $clapat_bg_theme_options['clapat_bg_footer_copyright'] . '</p>';
}



echo '</div>';