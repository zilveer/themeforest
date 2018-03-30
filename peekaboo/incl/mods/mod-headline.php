<div class="row">
    <hr>
</div>

<?php
$hlTitle = $data['pkb_headline_title'];
$hlSubtitle = $data['pkb_headline_subtitle'];
$hlContent = $data['pkb_headline_content'];
$hlButton = $data['pkb_headline_button'];
$hlPage = $data['pkb_headline_page'];
$hlMedia = $data['pkb_headline_media'];
$hlImage = $data['pkb_headline_img'];
$hlVideo = $data['pkb_headline_vid_code'];
$hlVideoRatio = $data['pkb_headline_vid_ratio'];

if ($hlTitle || $hlSubtitle || $hlButton || $hlPage) {

    if (($hlImage == '') && ($hlVideo == '')) {
        ?>

        <div class="row">
            <section class="large-11 columns large-centered headline-mod ">
                <div class="headline-content tcenter">
                    <?php if ($hlTitle) {
                        echo '<h2 class="replace"><strong>' . $hlTitle . '</strong></h2>';
                    } ?>
                    <?php if ($hlSubtitle) {
                        echo '<h4 class="subheader">' . $hlSubtitle . '</h4>';
                    } ?>
                    <?php if ($hlContent) {
                        echo $hlContent;
                    } ?>
                    <?php if ($hlPage && $hlButton) {
                        echo '<a href="' . home_url('/') . '?pagename=' . $hlPage . '" class="button-action replace button green ">' . $hlButton . '<i class="fontawesome-right-open"></i></a>';
                    } ?>
                </div>
            </section>
        </div>

    <?php } else { ?>

        <div class="row">
            <section class="large-12 columns headline-mod">
                <div class="columns large-6 headline-content">
                    <?php if ($hlTitle) {
                        echo '<h2 class="replace"><strong>' . $hlTitle . '</strong></h2>';
                    } ?>
                    <?php if ($hlSubtitle) {
                        echo '<h4 class="subheader">' . $hlSubtitle . '</h4>';
                    } ?>
                    <?php if ($hlContent) {
                        echo $hlContent;
                    } ?>
                    <?php if ($hlPage && $hlButton) {
                        echo '<a href="' . home_url('/') . '?pagename=' . $hlPage . '" class="button-action replace button green ">' . $hlButton . '<i class="fontawesome-right-open"></i></a>';
                    } ?>
                </div>
                <div class="columns large-6">
                    <?php if ($hlMedia == 'video') {

                        echo '<div class="flex-video ' . $hlVideoRatio . '">';
                        echo $hlVideo;
                        echo '</div>';
                    } else {
                        echo '<img src="' . $hlImage . '" />';
                    } ?>
                </div>
            </section>
        </div>
    <?php
    }
} ?>