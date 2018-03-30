<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

    <!--Main begin-->
<div id="main" class="round_8 clearfix row">

    <!-- Home Content begin-->
    <div id="home-content" class="large-12 columns">

        <?php
        $layout = $smof_data['homepage_blocks']['enabled'];

        if ($layout):

            foreach ($layout as $key => $value) {

                switch ($key) {
                    case 'content_mod':
                        include 'incl/mods/mod-content.php';
                        break;
                    case 'headline_mod':
                        include 'incl/mods/mod-headline.php';
                        break;
                    case 'list_mod':
                        include 'incl/mods/mod-list.php';
                        break;
                    case 'post_mod':
                        include 'incl/mods/mod-post.php';
                        break;
                    case 'testimonials_mod':
                        include 'incl/mods/mod-testimonials.php';
                        break;
                    case 'cta_mod':
                        include 'incl/mods/mod-cta.php';
                        break;
                    case 'home_widget':
                        include 'incl/mods/mod-home-widget.php';
                        break;
                    //repeat as many times necessary
                }
            }
        endif; ?>

    </div>
    <!-- Home Content end-->

<?php get_footer(); ?>