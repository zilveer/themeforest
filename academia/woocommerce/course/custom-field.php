<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/6/15
 * Time: 11:07 AM
 */
?>
<div class="course-custom-field">
    <?php
    while($mb->have_fields_and_multi('course_custom_fields',array('length' => 1))): ?>
        <?php $mb->the_group_open(); ?>

        <?php $mb->the_field('title'); ?>
        <label><?php esc_html_e('Title', 'g5plus-academia') ; ?></label>
        <input class="form-control" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

        <?php $mb->the_field('description'); ?>
        <label><?php esc_html_e('Description', 'g5plus-academia'); ?></label>
        <textarea name="<?php $mb->the_name(); ?>" class="form-control" rows="3"><?php echo wp_kses_post($mb->the_value()); ?></textarea>
        <a href="#" class="dodelete button">Remove</a>
        <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    <div style="clear: both;"></div>
    <p>
        <a href="#" class="docopy-course_custom_fields button"><?php esc_html_e('Add custom field', 'g5plus-academia'); ?></a>

        <a href="#" class="dodelete-course_custom_fields button">Remove All</a>
    </p>
</div>

<style>
    .course-custom-field .description
    { display:none; }
    .wpa_group-course_custom_fields{
        width: 50%;
        float: left;
    }
    .course-custom-field label
    { display:block; font-weight:bold; margin-bottom:0; margin-top:12px; }

    .course-custom-field label span
    { display:inline; font-weight:normal; }

    .course-custom-field span
    { color:#999; display:block; }

    .course-custom-field textarea, .course-custom-field input[type='text']
    { margin-bottom:3px; width:99%; }

    .course-custom-field h4
    { color:#999; font-size:1em; margin:15px 6px; text-transform:uppercase; }
    .wpa_group.wpa_group-process {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 0 15px 15px 0;
        background: #fff;
        width: 20%;
        float: left;
    }
</style>