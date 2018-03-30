<?php
/**
 * Property stats
 * since 1.3.0
 *
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 04/08/16
 * Time: 8:55 PM
 */
$houzez_stats_graph = houzez_option('houzez_stats_graph');

if( $houzez_stats_graph != 0 ) { ?>
<div id="stats" class="detail-features detail-block">
    <div class="detail-title">
        <h2 class="title-left"><?php esc_html_e( 'Page Views', 'houzez' ); ?></h2>
    </div>
    <div class="stats-block">
        <canvas id="myChart"></canvas>
        <div id="chartjs-tooltip"></div>
    </div>

</div>
<?php } ?>