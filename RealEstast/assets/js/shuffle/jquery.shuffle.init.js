jQuery(document).ready(function() {
    var $grid = jQuery('#able-list'),
        $filterOptions = jQuery('.filter-options'),
        $filterSelect = jQuery('#filter-select'),
    $sizer = $grid.find('.grid-sizer');

    $grid.shuffle({
        itemSelector: '.shuffle-box',
        sizer: $sizer
    });
    setTimeout(function() {
        setupFilters();
    }, 100);
    setupFilters = function() {
        var $btns = $filterOptions.children();
        $btns.on('click', function() {
            var $this = jQuery(this),
                isActive = $this.hasClass( 'active' ),
                group = isActive ? 'all' : $this.data('group');
// Hide current label, show current label in title
            if ( !isActive ) {
                jQuery('.filter-options .active').removeClass('active');
            }
            $this.toggleClass('active');
// Filter elements
            $grid.shuffle( 'shuffle', group );
        });
        $filterSelect.on('change', function(){
            $this = jQuery(this);
            $grid.shuffle('shuffle', $this.val());
        });
        $btns = null;
    }
});