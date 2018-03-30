<?php
/*
Content Mod
Display the content of the home page.
*/
?>
<div class="row">
    <hr>
</div>
<div class="row">
    <section class="home page-content">
        <div class="large-12 columns">
            <?php  if (have_posts()) while (have_posts()) : the_post();
                the_content();
            endwhile; ?>
        </div>
    </section>
</div>