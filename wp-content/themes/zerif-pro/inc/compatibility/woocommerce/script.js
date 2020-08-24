(function ( $ ) {
    $.zerifActions = {
        sidebarToggle: function () {
            // Sidebar toggle
            if ( $( '.shop-sidebar-wrapper' ).length <= 0 ) {
                return;
            }

            var sidebarOrientation = 'left';

            // RTL
            if ( $( 'body.rtl' ).length !== 0 ) {
                sidebarOrientation = 'right';
            }

            $( '.zerif-sidebar-open' ).click(
                function () {
                    $( '.shop-sidebar-wrapper' ).css( sidebarOrientation, '0' );
                }
            );

            $( '.zerif-sidebar-close' ).click(
                function () {
                    $( '.shop-sidebar-wrapper' ).css( sidebarOrientation, '-100%' );
                }
            );
        },
    };
}( jQuery ));

jQuery( document ).ready(
    function () {
        jQuery.zerifActions.sidebarToggle();
    }
);