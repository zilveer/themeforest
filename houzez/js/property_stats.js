/**
 * Created by waqasriaz on 04/08/16.
 */
jQuery(document).ready(function ($) {
    "use strict";

    if(  !document.getElementById('myChart') ){
        return;
    }

    var ctx = jQuery("#myChart").get(0).getContext("2d");
    var myNewChart  =    new Chart(ctx);
    var labels      =   '';
    var traffic_value_data ='  ';

    labels        = jQuery.parseJSON ( houzez_stats_vars.stats_labels);
    traffic_value_data  = jQuery.parseJSON ( houzez_stats_vars.stats_values);

    var data = {
        labels:labels ,
        datasets: [
            {
                label: houzez_stats_vars.stats_view,
                backgroundColor: houzez_stats_vars.bg_color,
                borderColor: houzez_stats_vars.border_color,
                borderWidth: 1,
                data: traffic_value_data
            },
        ]
    };

    var options = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero : true,

        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines : true,

        //String - Colour of the grid lines
        scaleGridLineColor : "rgba(0,0,0,.05)",

        //Number - Width of the grid lines
        scaleGridLineWidth : 1,

        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,

        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,

        //Boolean - If there is a stroke on each bar
        barShowStroke : true,

        //Number - Pixel width of the bar stroke
        barStrokeWidth : 2,

        //Number - Spacing between each of the X value sets
        barValueSpacing : 5,

        //Number - Spacing between data sets within X values
        barDatasetSpacing : 1,
        legend: { display: false },

        tooltips: {
            enabled: true,
            mode: 'x-axis',
            cornerRadius: 4
        },
    }

    var myBarChart = new Chart(ctx, {
        type: houzez_stats_vars.chart_type,
        data: data,
        options: options
    });

});