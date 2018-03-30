<?php
/**
 * The template for displaying faqs on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since Conexus 1.0
 */

if(tfuse_page_options('buy_text')=='' && tfuse_page_options('contact_text')=='')$col = 'col_1';
else $col = 'col_2_3';
?>
<div class="row clearfix">
    <div class="col <?php echo $col; ?> alpha">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_content(''); ?>
    </div>
    <?php if(tfuse_page_options('buy_text')!='' || tfuse_page_options('contact_text')!=''){ ?>
        <div class="col col_1_3 omega">
            <div class="text-center">
                <br>
                <p>
                    <?php if(tfuse_page_options('buy_text')!=''){ ?>
                        <a href="<?php echo tfuse_page_options('buy_link'); ?>" class="button_link <?php echo tfuse_page_options('button_class'); ?>" hidefocus="true" style="outline: none;"><span><?php echo tfuse_page_options('buy_text'); ?></span></a><br>
                    <?php } ?>
                    <?php if(tfuse_page_options('contact_text')!=''){ ?>
                        <a href="<?php echo tfuse_page_options('contact_link'); ?>" class="button_link <?php echo tfuse_page_options('button_class'); ?>" hidefocus="true" style="outline: none;"><span><?php echo tfuse_page_options('contact_text'); ?></span></a>
                    <?php } ?>
                </p>
            </div>
        </div>
    <?php } ?>
</div>
