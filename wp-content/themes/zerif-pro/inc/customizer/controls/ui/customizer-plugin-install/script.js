/* global zerif_plugin_install */
/* global console */

jQuery( document ).ready(
    function ($) {
        $.pluginInstall = {
            'init': function () {
                this.handleInstall();
                this.handleActivate();
            },

            'handleInstall': function () {
                var self = this;
                $( 'body' ).on( 'click', '.install-plugin', function (e) {
                    e.preventDefault();
                    var button = $( this );
                    var url = zerif_plugin_install.activate_nonce;
                    var slug = button.attr( 'data-slug' );

                    button.addClass('updating-message');
                    button.text(zerif_plugin_install.install_message);

                    wp.updates.installPlugin(
                        {
                            slug: slug,
                            success: function(){
                                button.text('Activating...');
                                self.activatePlugin(url);
                            }
                        }
                    );
                    return false;
                });
            },

            'handleActivate': function () {
                var self = this;
                $( 'body' ).on( 'click', '.activate-plugin', function (e) {
                    e.preventDefault();
                    var button = $( this );
                    var url = zerif_plugin_install.activate_nonce;

                    button.addClass('updating-message');
                    button.text(zerif_plugin_install.activate_message);

                    self.activatePlugin(url);
                });
            },

            'activatePlugin': function (url) {
                if (typeof url === 'undefined' || !url) {
                    return;
                }

                jQuery.ajax(
                    {
                        async: true,
                        type: 'GET',
                        url: url,
                        success: function () {
                            // Reload the page.
                            if( zerif_plugin_install.redirect_link ){
                                window.location.replace(zerif_plugin_install.redirect_link);
                            } else {
                                location.reload();
                            }
                        },
                        error: function (jqXHR, exception) {
                            var msg = '';
                            if (jqXHR.status === 0) {
                                msg = 'Not connect.\n Verify Network.';
                            } else if (jqXHR.status === 404) {
                                msg = 'Requested page not found. [404]';
                            } else if (jqXHR.status === 500) {
                                msg = 'Internal Server Error [500].';
                            } else if (exception === 'parsererror') {
                                msg = 'Requested JSON parse failed.';
                            } else if (exception === 'timeout') {
                                msg = 'Time out error.';
                            } else if (exception === 'abort') {
                                msg = 'Ajax request aborted.';
                            } else {
                                msg = 'Uncaught Error.\n' + jqXHR.responseText;
                            }
                            console.log(msg);
                        },
                    }
                );
            }
        };

        $.pluginInstall.init();
    }
);