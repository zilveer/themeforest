<?php global $jaw_data; ?>

<?php if (jaw_template_get_var('title', '') != '') { ?>
    <div class = "contact-name">
        <h3><?php echo jaw_template_get_var('title');
    ?></h3>
    </div>
<?php } ?>

<?php if (jaw_template_get_var('street', '') != '' || jaw_template_get_var('city', '') != '' || jaw_template_get_var('country', '') != '') { ?>
    <div class="contact-address">
        <?php if (jaw_template_get_var('street', '') != '') { ?>
            <p><?php echo jaw_template_get_var('street');
            ?><br>
            <?php } ?>
            <?php if (jaw_template_get_var('city', '') != '') { ?>
                <?php echo jaw_template_get_var('city');
                ?><br>
            <?php } ?>
            <?php if (jaw_template_get_var('country', '') != '') { ?>
                <?php echo jaw_template_get_var('country');
                ?></p>
        <?php } ?>
    </div>
<?php } ?>

<div class="contact-contact">
    <?php if (jaw_template_get_var('mail', '') != '') { ?>
        <div class="contact-mail">
            <?php if (jaw_template_get_var('show_titles', 'icon') == 'icon') { ?>
                <i class="icon-mail4"></i>
            <?php } else { ?>
                <span><?php echo __('E-mail:', 'jawtemplates'); ?></span> 
            <?php } ?>
            <a href="mailto:<?php echo jaw_template_get_var('mail', ''); ?>"><?php echo ' ' . jaw_template_get_var('mail', ''); ?></a>
        </div>
    <?php } ?>

    <?php if (jaw_template_get_var('phone', '') != '') { ?>
        <div class="contact-mail">
            <?php if (jaw_template_get_var('show_titles', 'icon') == 'icon') { ?>
                <i class=" icon-phone2  "></i>
            <?php } else { ?>
                <span><?php echo __('Phone:', 'jawtemplates'); ?></span> 
            <?php } ?>
            <a href="skype:<?php echo jaw_template_get_var('phone', ''); ?>?call"><?php echo ' ' . jaw_template_get_var('phone', ''); ?></a>
        </div>
    <?php } ?>

    <?php if (jaw_template_get_var('mobile', '') != '') { ?>
        <div class="contact-mail">
            <?php if (jaw_template_get_var('show_titles', 'icon') == 'icon') { ?>
                <i class=" icon-mobile3  "></i>
            <?php } else { ?>
                <span><?php echo __('Mobile:', 'jawtemplates'); ?></span> 
            <?php } ?>
            <a href="skype:<?php echo jaw_template_get_var('mobile', ''); ?>?call"><?php echo ' ' . jaw_template_get_var('mobile', ''); ?></a>
        </div>
    <?php } ?>

    <?php if (jaw_template_get_var('web', '') != '') { ?>
        <div class="contact-mail">
            <?php if (jaw_template_get_var('show_titles', 'icon') == 'icon') { ?>
                <i class="icon-earth"></i>
            <?php } else { ?>
                <span><?php echo __('Web:', 'jawtemplates'); ?></span> 
            <?php } ?>
            <a href="<?php echo jaw_template_get_var('web', ''); ?>"><?php echo jaw_template_get_var('web', ''); ?></a>
        </div>
    <?php } ?>

    <?php if (jaw_template_get_var('skype', '') != '') { ?>
        <div class="contact-mail">
            <?php if (jaw_template_get_var('show_titles', 'icon') == 'icon') { ?>
                <i class="icon-skype "></i>
            <?php } else { ?>
                <span><?php echo __('Skype:', 'jawtemplates'); ?></span> 
            <?php } ?>
                <a href="skype:<?php echo str_replace(' ', '',jaw_template_get_var('skype', '')); ?>?chat"><?php echo ' ' . jaw_template_get_var('skype', ''); ?></a>
        </div>
    <?php } ?>
</div>

<?php if (jaw_template_get_var('desc', '') != '') { ?>
    <div class="contact-desc">
        <p><?php echo jaw_template_get_var('desc');
    ?></p>
    </div>
<?php } ?>


<div class="contact-time">
    <h4><?php echo __('Opening hours:', 'jawtemplates'); ?></h4> 
    <?php if (jaw_template_get_var('mo', '') != '') { ?>
        <div class="contact-time-mo">
            <span><?php echo __('Monday:', 'jawtemplates'); ?></span> 
            <p><?php echo jaw_template_get_var('mo');
        ?></p>
        </div>
    <?php } ?>

    <?php if (jaw_template_get_var('tu', '') != '') { ?>
        <div class="contact-time-mo">
            <span><?php echo __('Tuesday:', 'jawtemplates'); ?></span> 
            <p><?php echo jaw_template_get_var('tu');
        ?></p>
        </div>
    <?php } ?>
    <?php if (jaw_template_get_var('we', '') != '') { ?>
        <div class="contact-time-mo">
            <span><?php echo __('Wednesday:', 'jawtemplates'); ?></span> 
            <p><?php echo jaw_template_get_var('we');
        ?></p>
        </div>
    <?php } ?>
    <?php if (jaw_template_get_var('th', '') != '') { ?>
        <div class="contact-time-mo">
            <span><?php echo __('Thursday:', 'jawtemplates'); ?></span> 
            <p><?php echo jaw_template_get_var('th');
        ?></p>
        </div>
    <?php } ?>
    <?php if (jaw_template_get_var('fr', '') != '') { ?>
        <div class="contact-time-mo">
            <span><?php echo __('Friday:', 'jawtemplates'); ?></span> 
            <p><?php echo jaw_template_get_var('fr');
        ?></p>
        </div>
    <?php } ?>
    <?php if (jaw_template_get_var('sa', '') != '') { ?>
        <div class="contact-time-mo">
            <span><?php echo __('Saturday:', 'jawtemplates'); ?></span> 
            <p><?php echo jaw_template_get_var('sa');
        ?></p>
        </div>
    <?php } ?>
    <?php if (jaw_template_get_var('su', '') != '') { ?>
        <div class="contact-time-mo">
            <span><?php echo __('Sunday:', 'jawtemplates'); ?></span> 
            <p><?php echo jaw_template_get_var('su');
        ?></p>
        </div>
    <?php } ?>
</div>