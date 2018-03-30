<div class="row">
    <hr>
</div>

<?php if ($smof_data['pkb_list_mod_title']) { ?>
    <div class="row section-title">
        <div class="columns large-10">
            <?php if ($smof_data['pkb_list_mod_url']) { ?>
                <h4 class="replace"><a
                        href="?pagename=<?php echo stripslashes($smof_data['pkb_list_mod_url']); ?>"><?php echo stripslashes($smof_data['pkb_list_mod_title']); ?></a>
                </h4>
            <?php } else { ?>
                <h4 class="replace"><?php echo stripslashes($smof_data['pkb_list_mod_title']); ?></h4>
            <?php } ?>

        </div>
        <?php if ($smof_data['pkb_list_mod_more_link']) { ?>
            <div class="columns large-2 hide-for-small">
                <a href="?pagename=<?php echo stripslashes($smof_data['pkb_list_mod_url']); ?>"
                   class="button fancy small secondary"><?php echo stripslashes($smof_data['pkb_list_mod_more_link']); ?></a>
            </div>
        <?php } ?>
    </div>
<?php } ?>

<div class="row">
    <div class="large-12 columns large-centered">
        <section class="mod-def-list">

            <?php if ($smof_data['pkb_list_mod_content']) { ?>
                <div class="mod-def-list-content">
                    <?php echo stripslashes($smof_data['pkb_list_mod_content']); ?>
                </div>
            <?php } ?>

            <?php
            $listNumber = $smof_data['pkb_list_mod_col'];
            if ($listNumber == 2) {
                echo '<ul class="large-block-grid-2 small-block-grid-2">';
            } elseif ($listNumber == 3) {
                echo '<ul class="large-block-grid-3 small-block-grid-2">';
            } elseif ($listNumber == 4) {
                echo '<ul class="large-block-grid-4 small-block-grid-2">';
            } else {
                echo '<ul class="large-block-grid-5 small-block-grid-2">';
            };

            if ($smof_data['pkb_list_mod_item']) {
                $listItem = $smof_data['pkb_list_mod_item'];

                foreach ($listItem as $list) {
                    $listbtnTitle = $list['title'];
                    $listbtnUrl = $list['url'];
                    $listbtnLink = $list['link'];
                    $listbtnDesc = $list['description'];
                    echo '<li>';
                    if ($listbtnLink) {
                        echo '<dl class="def-list">';
                    } else {
                        echo '<dl class="def-list">';
                    }
                    echo '<dt>';
                    if ($listbtnUrl) {
                        echo '<img src="' . $listbtnUrl . '" alt="' . $listbtnTitle . '"><h4>';
                    } else {
                        echo '<h4>';
                    }
                    if ($listbtnLink) {
                        echo '<a href="' . $listbtnLink . '">' . $listbtnTitle . '</a>';
                    } else {
                        echo $listbtnTitle;
                    }
                    echo '</h4></dt><dd>' . $listbtnDesc . '</dd></dl></li>';
                }
                ;
                echo '</ul>';
            } ?>

        </section>
    </div>
</div>