/**
 * Notice for importing Zerif frontpage
 *
 * @package Hestia
 */

/* global zerifNotice */

(function ($) {
    $(document).ready(function () {

        $(document).on('click', '.notice.zerif-zelle-notice .notice-dismiss', function () {
            jQuery.ajax({
                async: true,
                type: 'POST',
                data: {
                    action: 'zerif_dismiss_zelle_notice',
                    nonce: zerifNotice.dismissNonce
                },
                url: zerifNotice.ajaxurl
            });
        });
    });
})(jQuery);