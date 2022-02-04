(function ($) {
    "use strict";

    $(document).ready(function () {

        var ajaxUrl = majc_admin_js_obj.ajax_url;
        var adminNonce = majc_admin_js_obj.ajax_nonce;

        $('.majc-color-picker').wpColorPicker();

        $('body').on('click', '.majc-tab', function () {
            var selected_menu = $(this).data('tab');
            var hideDivs = $(this).data('tohide');

            // Display The Clicked Tab Content
            $('body').find('.' + hideDivs).hide();
            $('body').find('#' + selected_menu).show();

            // Add and remove the class for active tab
            $(this).parent().find('.majc-tab').removeClass('majc-tab-active');
            $(this).addClass('majc-tab-active');

            if ($(this).find('input'))
                $(this).find('input').prop('checked', true);
        });

        // Call all the necessary functions for Icon Picker
        iconPickerFunction();
        function iconPickerFunction() {
            // FontAwesome Icon Control JS
            $('body').on('click', '.majc-icon-box-wrap .majc-icon-list li', function () {
                var icon_class = $(this).find('i').attr('class');
                $(this).closest('.majc-icon-box').find('.majc-icon-list li').removeClass('icon-active');
                $(this).addClass('icon-active');
                $(this).closest('.majc-icon-box').prev('.majc-selected-icon').children('i').attr('class', '').addClass(icon_class);
                $(this).closest('.majc-icon-box').next('input').val(icon_class).trigger('change');
                $(this).closest('.majc-icon-box').slideUp();
            });

            $('body').on('click', '.majc-icon-box-wrap .majc-selected-icon', function () {
                $(this).next().slideToggle();
            });

            $('body').on('change', '.majc-icon-box-wrap .majc-icon-search select', function () {
                var selected = $(this).val();
                $(this).parents('.majc-icon-box').find('.majc-icon-search-input').val('');
                $(this).parents('.majc-icon-box').children('.majc-icon-list').hide().removeClass('active');
                $(this).parents('.majc-icon-box').children('.' + selected).fadeIn().addClass('active');
                $(this).parents('.majc-icon-box').children('.' + selected).find('li').show();
            });

            $('body').on('keyup', '.majc-icon-box-wrap .majc-icon-search input', function (e) {
                var $input = $(this);
                var keyword = $input.val().toLowerCase();
                var search_criteria = $input.closest('.majc-icon-box').find('.majc-icon-list.active i');
                delay(function () {
                    $(search_criteria).each(function () {
                        if ($(this).attr('class').indexOf(keyword) > -1) {
                            $(this).parent().show();
                        } else {
                            $(this).parent().hide();
                        }
                    });
                }, 500);
            });

            var delay = (function () {
                var timer = 0;
                return function (callback, ms) {
                    clearTimeout(timer);
                    timer = setTimeout(callback, ms);
                };
            })();
        }

        /* Custom Image Upload */
        $('body').on('click', '.majc-image-upload', function (e) {
            e.preventDefault();
            var $this = $(this);
            $this.closest('.majc-icon-image-uploader').find('.majc-custom-menu-image-icon').html('');
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open().on('select', function () {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;

                $this.closest('.majc-icon-image-uploader').find('.majc-upload-background-url').val(image_url);
                $this.closest('.majc-icon-image-uploader').find('.majc-custom-menu-image-icon').append('<img src="' + image_url + '"/>');
                if ($this.closest('.majc-icon-image-uploader').find('.majc-upload-background-url').val(image_url) !== '') {
                    $this.closest('.majc-icon-image-uploader').find('.majc-custom-menu-image-icon').show();
                } else {
                    $this.closest('.majc-icon-image-uploader').find('.majc-custom-menu-image-icon').hide();
                }
            });
        });

        /* Remove Uploaded Custom Image */
        $('body').on('click', '.majc-image-remove', function () {
            $(this).closest('.majc-icon-image-uploader').find('.majc-custom-menu-image-icon').html('');

            $(this).closest('.majc-icon-image-uploader').find('.majc-upload-background-url').val('');
        });

        // Range JS
        $('.majc-range-input-selector').each(function () {
            var newSlider = $(this);
            var sliderValue = newSlider.val();
            var sliderMinValue = parseFloat(newSlider.attr('min'));
            var sliderMaxValue = parseFloat(newSlider.attr('max'));
            var sliderStepValue = parseFloat(newSlider.attr('step'));
            newSlider.prev('.majc-range-slider').slider({
                value: sliderValue,
                min: sliderMinValue,
                max: sliderMaxValue,
                step: sliderStepValue,
                range: 'min',
                slide: function (e, ui) {
                    $(this).next().val(ui.value);
                }
            });
        });

        // Update slider if the input field loses focus as it's most likely changed
        $('.majc-range-input-selector').blur(function () {
            var resetValue = isNaN($(this).val()) ? '' : $(this).val();

            if (resetValue) {
                var sliderMinValue = parseFloat($(this).attr('min'));
                var sliderMaxValue = parseFloat($(this).attr('max'));
                // Make sure our manual input value doesn't exceed the minimum & maxmium values
                if (resetValue < sliderMinValue) {
                    resetValue = sliderMinValue;
                    $(this).val(resetValue);
                }
                if (resetValue > sliderMaxValue) {
                    resetValue = sliderMaxValue;
                    $(this).val(resetValue);
                }
            }
            $(this).val(resetValue);
            $(this).prev('.majc-range-slider').slider('value', resetValue);
        });

        /*Show/ Hide Single Page Options*/
        $('input#majc_single_pages').on('change', function () {
            var checked_value = $('input#majc_single_pages:checked').val();

            if (checked_value == 'on') {
                $(this).closest('.majc-display-lists').find('.majc-hide-singular').fadeOut();
            } else {
                $(this).closest('.majc-display-lists').find('.majc-hide-singular').fadeIn();
            }
        });

        $(document).on('change', '.majc-typography-font-family', function () {

            var font_family = $(this).val();
            var $this = $(this);
            $.ajax({
                url: ajaxUrl,
                data: {
                    action: 'majc_get_google_font_variants',
                    font_family: font_family,
                    wp_nonce: adminNonce
                },
                beforeSend: function () {
                    $this.closest('.majc-typography-font-family-field').next('.majc-typography-font-style-field').addClass('majc-typography-loading');
                },
                success: function (response) {
                    $this.closest('.majc-typography-font-family-field').next('.majc-typography-font-style-field').removeClass('majc-typography-loading');
                    $this.closest('.majc-typography-font-family-field').next('.majc-typography-font-style-field').find('select').html(response).trigger("chosen:updated").trigger('change');
                }
            });
        });

        $('body').find(".majc-typography-fields select").chosen({width: "100%"});

        $(".majc-toggle-tab-body").mCustomScrollbar({
            theme: 'dark-thin',
            scrollbarPosition: 'outside'
        });
    });

})(jQuery);