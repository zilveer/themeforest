<?php

class Listify_Rating_Listing extends Listify_Rating {

    public function __construct( $args = array() ) {
        parent::__construct( $args );
    }

    public function save() {
        global $wpdb;

        delete_transient( 'listify_review_count_' . $this->object_id );

        $query = $wpdb->prepare( "
            SELECT SUM(wpcm.meta_value)
            FROM $wpdb->comments AS wpc
            JOIN $wpdb->commentmeta AS wpcm
                ON wpc.comment_id  = wpcm.comment_id
            WHERE wpcm.meta_key = 'rating'
                AND wpc.comment_post_ID = %s
                AND wpc.comment_approved = '1'
        ", $this->object_id );

        $total = $wpdb->get_var( $query );
        $votes = $this->count();

        if ( ! $total || $votes == 0 ) {
            update_post_meta( $this->object_id, 'rating', 0 );

            return;
        }

        $avg    = $total / $votes;
        $rating = round( round( $avg * 2 ) / 2, 1 );

        update_post_meta( $this->object_id, 'rating', $rating );

        return $rating;
    }

    public function get() {
        $this->rating = $this->object->rating;

        if ( ! $this->rating ) {
            return 0;
        }

        return $this->rating;
    }

    public function count() {
        global $wpdb;

        $post_id = $this->object_id;

        $count_hash = 'listify_review_count_' . $post_id;

        if ( false === ( $result = get_transient( $count_hash ) ) ) {
            $where = '';

            if ( $post_id > 0 ) {
                $where = $wpdb->prepare("WHERE comment_post_ID = %d AND comment_parent = 0 AND comment_approved = 1", $post_id);
            }

            $totals = (array) $wpdb->get_var("
                SELECT COUNT( * ) AS total
                FROM {$wpdb->comments}
                {$where}
            ");

            if ( null != $totals ) {
                $result = $totals[0];
            } else {
                $result = 0;
            }

            set_transient( $count_hash, $result );
        }

        return $result;
    }

}
