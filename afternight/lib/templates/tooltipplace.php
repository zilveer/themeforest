    <div class="place">
        <input type="hidden" class="place-id" value="<?php echo $this -> id;?>" name="tooltips[places][<?php echo $this -> id;?>][id]">
        <input type="hidden" class="place-name" value="<?php echo $this -> name;?>" name="tooltips[places][<?php echo $this -> id;?>][name]">
        <input type="hidden" class="place-url" value="<?php echo $this -> placeurl;?>" name="tooltips[places][<?php echo $this -> id;?>][placeurl]">
        <div class="title">
            <a href="<?php echo $this -> placeurl;?>">
                <?php echo $this -> name;?>
            </a>
        </div>
        <div class="container">
            <?php
                foreach( $this -> tooltips as $tooltip ){
                    $tooltip -> render_backend();
                }
            ?>
            <div class="addmore">
                <div class="fl">
                    <div class="big-plus"></div>
                    <h3>
                        <?php echo __( 'Add new tooltip to', 'cosmotheme' );?> <?php echo $this -> name;?>
                    </h3>
                </div>
            </div>
        </div>
    </div>