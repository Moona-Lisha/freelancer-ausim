
jQuery( document ).ready(
    function() {
        /*JS for shortcode section*/

        /********************************************
         * ** Generate uniq id ***
         *********************************************/
        function zerif_uniqid(prefix, more_entropy) {

            if (typeof prefix === 'undefined') {
                prefix = '';
            }

            var retId;
            var formatSeed = function (seed, reqWidth) {
                seed = parseInt(seed, 10)
                    .toString(16); // to hex str
                if (reqWidth < seed.length) { // so long we split
                    return seed.slice(seed.length - reqWidth);
                }
                if (reqWidth > seed.length) { // so short we pad
                    return Array(1 + (reqWidth - seed.length))
                        .join('0') + seed;
                }
                return seed;
            };

            // BEGIN REDUNDANT
            if (!this.php_js) {
                this.php_js = {};
            }
            // END REDUNDANT
            if (!this.php_js.uniqidSeed) { // init seed with big random int
                this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
            }
            this.php_js.uniqidSeed++;

            retId = prefix; // start with prefix, add current milliseconds hex string
            retId += formatSeed(
                parseInt(
                    new Date()
                        .getTime() / 1000, 10
                ), 8
            );
            retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
            if (more_entropy) {
                // for more entropy we add a float lower to 10
                retId += (Math.random() * 10)
                    .toFixed(8)
                    .toString();
            }

            return retId;
        }

        /********************************************
         * ** General Repeater ***
         *********************************************/

        var entityMap = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            '\'': '&#39;',
            '/': '&#x2F;',
        };

        function escapeHtml(string) {
            string = String(string).replace(new RegExp('\r?\n', 'g'), '<br />');
            string = String(string).replace(/\\/g, '&#92;');
            return String(string).replace(
                /[&<>"'\/]/g, function (s) {
                    return entityMap[s];
                }
            );

        }

        function zerif_refresh_general_control_values() {
            jQuery('.zerif_general_control_repeater').each(
                function () {
                    var values = [];
                    var th = jQuery(this);
                    th.find('.zerif_general_control_repeater_container').each(
                        function () {

                            var title = jQuery(this).find('.zerif_title_control').val();
                            var subtitle = jQuery(this).find('.zerif_subtitle_control').val();
                            var id = jQuery(this).find('.zerif_box_id').val();
                            var color = jQuery(this).find('.zerif_color_control').val();
                            var opacity = jQuery(this).find('.zerif_opacity_control').val();
                            var text_color = jQuery(this).find('.zerif_text_color_control').val();
                            if (!id) {
                                id = 'zerif_' + zerif_uniqid();
                                jQuery(this).find('.zerif_box_id').val(id);
                            }
                            var shortcode = jQuery(this).find('.zerif_shortcode_control').val();

                            if (title !== '' || subtitle !== '' || shortcode !== '') {
                                values.push(
                                    {
                                        'title': escapeHtml(title),
                                        'subtitle': escapeHtml(subtitle),
                                        'color': color,
                                        'id': id,
                                        'shortcode': escapeHtml(shortcode),
                                        'opacity': opacity,
                                        'text_color': text_color
                                    }
                                );
                            }

                        }
                    );
                    th.find('.zerif_repeater_colector').val(JSON.stringify(values));
                    th.find('.zerif_repeater_colector').trigger('change');
                }
            );
        }

        jQuery('#customize-theme-controls').on(
            'click', '.zerif-customize-control-title', function () {
                jQuery(this).next().slideToggle(
                    'medium', function () {
                        if (jQuery(this).is(':visible')) {
                            jQuery(this).css('display', 'block');
                        }
                    }
                );
            }
        );

        var color_options = {
            change: function () {
                zerif_refresh_general_control_values();
            }
        };

        /**
         * This adds a new box to repeater
         */
        jQuery('#customize-theme-controls').on(
            'click', '.zerif_general_control_new_field', function () {
                var th = jQuery(this).parent();
                var id = 'zerif_' + zerif_uniqid();
                if (typeof th !== 'undefined') {
                    /* Clone the first box*/
                    var field = th.find('.zerif_general_control_repeater_container:first').clone();

                    if (typeof field !== 'undefined') {

                        /*Show delete box button because it's not the first box*/
                        field.find('.zerif_general_control_remove_field').show();

                        /*Set box id*/
                        field.find('.zerif_box_id').val(id);

                        /* Remove value from text color field */
                        field.find('.zerif_text_color_control').val('#000000');

                        /* Remove value from color field */
                        field.find('.zerif_color_control').val('#ffffff');

                        /* Remove value from opacity field */
                        field.find('.zerif_opacity_control').val('');

                        /*Remove value from title field*/
                        field.find('.zerif_title_control').val('');

                        /*Remove value from color field*/
                        field.find('div.customizer-repeater-color-control .wp-picker-container').replaceWith('<input type="text" class="zerif_text_color_control">');
                        field.find('input.zerif_text_color_control').wpColorPicker(color_options);
                        /*Remove value from color field*/

                        field.find('div.customizer-repeater-color2-control .wp-picker-container').replaceWith('<input type="text" class="zerif_color_control">');
                        field.find('input.zerif_color_control').wpColorPicker(color_options);

                        /*Remove value from subtitle field*/
                        field.find('.zerif_subtitle_control').val('');

                        /*Remove value from shortcode field*/
                        field.find('.zerif_shortcode_control').val('');

                        /*Append new box*/
                        th.find('.zerif_general_control_repeater_container:first').parent().append(field);

                        /*Refresh values*/
                        zerif_refresh_general_control_values();
                    }

                }
                return false;
            }
        );

        jQuery('#customize-theme-controls').on(
            'click', '.zerif_general_control_remove_field', function () {
                if (typeof    jQuery(this).parent() !== 'undefined') {
                    jQuery(this).parent().parent().remove();
                    zerif_refresh_general_control_values();
                }
                return false;
            }
        );

        jQuery('#customize-theme-controls').on(
            'keyup', '.zerif_title_control', function () {
                zerif_refresh_general_control_values();
            }
        );

        jQuery('input.zerif_text_color_control').wpColorPicker(color_options);
        jQuery('input.zerif_color_control').wpColorPicker(color_options);

        jQuery('#customize-theme-controls').on(
            'keyup', '.zerif_subtitle_control', function () {
                zerif_refresh_general_control_values();
            }
        );

        jQuery('#customize-theme-controls').on(
            'keyup', '.zerif_shortcode_control', function () {
                zerif_refresh_general_control_values();
            }
        );

        jQuery('#customize-theme-controls').on(
            'change', '.zerif_text_color_control', function () {
                zerif_refresh_general_control_values();
            }
        );

        jQuery('#customize-theme-controls').on(
            'change', '.zerif_color_control', function () {
                zerif_refresh_general_control_values();
            }
        );

        jQuery('#customize-theme-controls').on(
            'change', '.zerif_opacity_control', function () {
                zerif_refresh_general_control_values();
            }
        );

        /*Drag and drop to change icons order*/

        jQuery('.zerif_general_control_droppable').sortable(
            {
                update: function () {
                    zerif_refresh_general_control_values();
                }
            }
        );
    }
);