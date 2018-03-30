<?php
global $qode_options;

$enable_blog_navigation = false;
if (isset($qode_options['blog_single_navigation']) && $qode_options['blog_single_navigation'] == "yes"){
    $enable_blog_navigation = true;
}

$navigation_blog_through_category = false;
if (isset($qode_options['blog_navigation_through_same_category']) && $qode_options['blog_navigation_through_same_category'] == "yes")
    $navigation_blog_through_category = true;

?>
<?php if($enable_blog_navigation){ ?>
    <div class="blog_navigation">
        <div class="blog_navigation_inner">
            <?php if(get_previous_post() != ""){ ?>
                <div class="blog_prev">
                    <?php
                    if($navigation_blog_through_category){
                        previous_post_link('%link','<span class="arrow_carrot-left"></span>', true,'','category');
                    } else {
                        previous_post_link('%link','<span class="arrow_carrot-left"></span>');
                    }
                    ?>
                </div> <!-- close div.blog_prev -->
            <?php } ?>
            <?php if(get_next_post() != ""){ ?>
                <div class="blog_next">
                    <?php
                    if($navigation_blog_through_category){
                        next_post_link('%link','<span class="arrow_carrot-right"></span>', true,'','category');
                    } else {
                        next_post_link('%link','<span class="arrow_carrot-right"></span>');
                    }
                    ?>
                </div> <!-- close div.blog_next -->
            <?php } ?>
        </div>
    </div> <!-- close div.blog_navigation -->
<?php } ?>
