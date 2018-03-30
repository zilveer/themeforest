<?php

class Listify_Rating_Comment extends listify_Rating {

    public function __construct( $args = array() ) {
        parent::__construct( $args );
    }

    public function save() {
        update_comment_meta( $this->object_id, 'rating', $this->rating );
    }

    public function get() {
        $this->rating = get_comment_meta( $this->object_id, 'rating', true );

        if ( ! $this->rating ) {
            $this->rating = 0;
        }

        return $this->rating;
    }

}
