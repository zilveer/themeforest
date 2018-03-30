<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 27/09/16
 * Time: 5:05 PM
 * Since v1.4.0
 */
$houzez_stats_graph = houzez_option('houzez_stats_graph');

if( $houzez_stats_graph != 0 ) { ?>
    <div id="stats" class="detail-page-view detail-block">
        <div class="container">
            <div class="detail-title">
                <h2 class="title-left"><?php esc_html_e( 'Page Views', 'houzez' ); ?></h2>
            </div>
            <div class="stats-block">
                <canvas id="myChart"></canvas>
                <div id="chartjs-tooltip"></div>
            </div>
        </div>
    </div>
<?php } ?>