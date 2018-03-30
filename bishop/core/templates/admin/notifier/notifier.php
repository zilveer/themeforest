<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$screenshot = $theme->get_screenshot(); ?>
    <style>
        .update-nag { display: none; }
        #instructions {max-width: 670px;}
        h3.title {margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd;}
    </style>

    <div class="wrap">

        <div id="icon-tools" class="icon32"></div>
        <h2><?php echo $theme->Name; ?> Theme Updates</h2>
        <div id="message" class="updated below-h2"><p><strong>A new version of <?php echo $theme->Name; ?> is available for download.</strong> You have installed version <?php echo $theme->Version; ?> installed. Update to version <?php echo $xml->latest ?>.</p></div>

        <img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo $screenshot ?>" />

        <?php if(YIT_MARKETPLACE == "tf"): ?>

        <div id="instructions">
            <h3>Update Download and Instructions</h3>
            <p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo get_template(); ?>/</strong>. I also encourage you to make a full backup your site and database before performing an update.</p>
            <p>To get the latest update of the Theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>Downloads</strong> section and re-download the theme like you did when you bought it.</p>
            <p>Extract the contents of the zip file, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo get_template(); ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
            <p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, slider images, etc.</p>
            <p>Now if you have modified files like CSS or some php files and you haven't kept track of your changes then you can use some 'diff' tools to compare the two versions' files and folders. That way you'd know exactly what files to update and where, line by line. Otherwise you'll loose your customizations.</p>
        </div>

		<?php elseif(YIT_MARKETPLACE == "yit"): ?>

        <div id="instructions">
            <h3>Update Download and Instructions</h3>
            <p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo get_template(); ?>/</strong>. I also encourage you to make a full backup your site and database before performing an update.</p>
            <p>To get the latest update of the Theme, login to <a href="http://www.yithemes.com/">YIThemes</a>, head over to your <strong>My Account</strong> section and re-download the theme like you did when you bought it.</p>
            <p>Extract the contents of the zip file, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo get_template(); ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
            <p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, slider images, etc.</p>
            <p>Now if you have modified files like CSS or some php files and you haven't kept track of your changes then you can use some 'diff' tools to compare the two versions' files and folders. That way you'd know exactly what files to update and where, line by line. Otherwise you'll loose your customizations.</p>
        </div>

        <?php elseif(YIT_MARKETPLACE == "free"): ?>

        <div id="instructions">
            <h3>Update Download and Instructions</h3>
            <p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo get_template(); ?>/</strong>. I also encourage you to make a full backup your site and database before performing an update.</p>
            <p>To get the latest update of the Theme, login to <a href="http://www.yithemes.com/">YIThemes</a> and re-download the theme.</p>
            <p>Extract the contents of the zip file, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo get_template(); ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
            <p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, slider images, etc.</p>
            <p>Now if you have modified files like CSS or some php files and you haven't kept track of your changes then you can use some 'diff' tools to compare the two versions' files and folders. That way you'd know exactly what files to update and where, line by line. Otherwise you'll loose your customizations.</p>
        </div>

        <?php endif; ?>

        <h3 class="title">Changelog</h3>
        <?php echo $xml->changelog ?>

    </div>