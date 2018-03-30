<?php $path = get_template_directory_uri();
if(!isset($_REQUEST['error']))  $error_code = '404';
else  $error_code = $_REQUEST['error'];
?>
<?php ob_start(); ?>

<?php get_header(); ?>

<!-- Start of page wrap -->
<div class="page_wrap">

    <?php if ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ) : ?>

    <?php $blogbgrnd = ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ); ?>

    <?php else : $blogbgrnd =  esc_url_raw( get_stylesheet_directory_uri() . '/img/default_image.jpg' ); ?>
            
    <?php endif; ?>

    <!-- Start of main image -->
    <div class="main_image" style="background: url('<?php echo $blogbgrnd; ?>') no-repeat scroll center center transparent; background-size:cover; height:684px; position:relative; z-index:1;">
        
        <!-- Start of button holder -->
        <div class="button_holder">
        <?php $topurl = ( get_theme_mod( 'cr3ativ_conference_url' ) ); ?>
        <?php $topurltext = ( get_theme_mod( 'cr3ativ_conference_url_text' ) ); ?>

        <?php if ($topurl != ('')){ ?>           

            <!-- Start of top of page button -->
            <div class="top_of_page_button">

            <a href="<?php echo ($topurl); ?>"><?php echo ($topurltext); ?></a>

            </div>
            <!-- End of top of page button -->

        <?php } ?>
        </div>
        <!-- End of button holder -->

        <!-- Start of main content title -->
        <div class="main_content_title">

            <h1 class="title"><?php _e( 'Not Found', 'cr3_attend_theme' ); ?></h1>

        </div>
        <!-- End of main content title -->

    </div>
    <!-- End of main image -->

    <!-- Start of main content -->
    <div class="main_content">

        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('error_page')) : ?>
        <?php endif; ?>

    </div>
    <!-- End of main content -->

    <div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>