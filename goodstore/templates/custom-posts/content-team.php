<?php
global $jaw_data, $post;
$meta = get_post_meta(get_the_ID());
?>

<article id="team-<?php the_ID(); ?>"  <?php post_class(array('element', 'col-lg-3', 'content-team')); ?>   >
    <div class="box ">

        <div class="image">
            <?php
            if (isset($meta['_team_photo'][0])) {
                $img = json_decode($meta['_team_photo'][0]);
                echo wp_get_attachment_image($img[0]->id, 'team-size');
            }
            ?>
        </div>
        <div class="content-box">
            <?php if (isset($meta['_team_possition'][0])) { ?>
                <div><?php echo $meta['_team_possition'][0]; ?></div>
            <?php } ?>
            <header>
                <h2>
                    <?php if (jaw_template_get_var('clickable_title', '0') == '1') { ?>
                        <a href="<?php the_permalink(); ?>" class="post_name">
                        <?php } ?>
                        <?php echo get_the_title(); ?>
                        <?php if (jaw_template_get_var('clickable_title', '0') == '1') { ?>
                        </a>
                    <?php } ?>
                </h2>
            </header>  

            <?php if (isset($meta['_team_mail'][0])) { ?>
                <div><a href="mailto:<?php echo $meta['_team_mail'][0]; ?>"><?php echo __('Email:', 'jawtemplates') . ' ' . $meta['_team_mail'][0]; ?></a></div>
            <?php } ?>

            <div class="clear"></div>

            <div  class="el-social-icons team_social_icons">
                <?php if (isset($meta['_team_fb'][0])) { ?>
                    <a class="facebook" href="<?php echo $meta['_team_fb'][0]; ?>"><i class="icon-facebook4 "></i></a>
                <?php } ?>

                <?php if (isset($meta['_team_tw'][0])) { ?>
                    <a class="twitter" href="<?php echo $meta['_team_tw'][0]; ?>"><i class="icon-twitter3  "></i></a>
                <?php } ?>

                <?php if (isset($meta['_team_gp'][0])) { ?>
                    <a class="google" href="<?php echo $meta['_team_gp'][0]; ?>"><i class="icon-google-plus4  "></i></a>
                <?php } ?>

                <?php if (isset($meta['_team_lin'][0])) { ?>
                    <a class="linkedin" href="<?php echo $meta['_team_lin'][0]; ?>"><i class="icon-linkedin  "></i></a>
                <?php } ?>

                <?php if (isset($meta['_team_bl'][0])) { ?>
                    <a class="blogger" href="<?php echo $meta['_team_bl'][0]; ?>"><i class="icon-blogger2  "></i></a>
                <?php } ?>

            </div>

            <p><?php echo jwUtils::crop_length(jwRender::get_the_excerpt(), jaw_template_get_var('letter_excerpt', -1)); ?></p>



        </div>

        <div class="clear"></div>
    </div>
</article>