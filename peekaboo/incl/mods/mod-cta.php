<div class="row">
    <hr>
</div>

<?php if ($smof_data['pkb_cta_mod_title']) { ?>
    <div class="row section-title">
        <div class="columns large-10">
            <?php if ($smof_data['pkb_cta_mod_url']) { ?>
                <h4 class="replace"><a
                        href="?p=<?php echo stripslashes($smof_data['pkb_cta_mod_url']); ?>"><?php echo stripslashes($smof_data['pkb_cta_mod_title']); ?></a>
                </h4>
            <?php } else { ?>
                <h4 class="replace"><?php echo stripslashes($smof_data['pkb_cta_mod_title']); ?></h4>
            <?php } ?>

        </div>
        <?php if ($smof_data['pkb_cta_mod_more_link']) { ?>
            <div class="columns large-2 hide-for-small">
                <a href="?pagename=<?php echo stripslashes($smof_data['pkb_cta_mod_url']); ?>"
                   class="button fancy small secondary"><?php echo stripslashes($smof_data['pkb_cta_mod_more_link']); ?></a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<div class="row">
    <section class="intro-btn">
        <?php
        if ($smof_data['pkb_cta_img']) {
            $ctaImg = $smof_data['pkb_cta_img'];
            $ctaNumber = $smof_data['pkb_cta_number'];
            $ctaMore = $smof_data['pkb_cta_more_link'];

            foreach ($ctaImg as $cta) {
                $ctabtnTitle = $cta['title'];
                $ctabtnUrl = $cta['url'];
                $ctabtnLink = $cta['link'];
                $ctabtnDesc = $cta['description'];

                if ($ctaNumber == 2) {
                    echo '<article class="large-6 columns clickable">';
                } elseif ($ctaNumber == 3) {
                    echo '<article class="large-4 columns clickable">';
                } else {
                    echo '<article class="large-3 columns clickable">';
                }
                ;
                echo '<div class="intro-btn-img"><a href="' . $ctabtnLink . '"><img src="' . $ctabtnUrl . '" alt="' . $ctabtnTitle . '"></a></div>';
                echo '<h2 class="replace"><a href="' . $ctabtnLink . '">' . $ctabtnTitle . '</a></h2>';
                echo '<p>' . $ctabtnDesc . '</p>';
                if ($ctabtnLink != '') {
                    echo '<a href="' . $ctabtnLink . '" class="button fancy small cta">' . $ctaMore . '</a>';
                }
                ;
                echo '</article>';
            }
            ;
        } ?>

    </section>
</div>