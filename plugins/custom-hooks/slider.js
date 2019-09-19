(function($) {

    /* ======== customSlider ======== */

    wp.hooks.addAction('facetwp/refresh/customSlider', function($this, facet_name) {
        FWP.facets[facet_name] = [];

        // settings have already been loaded
        if ('undefined' !== typeof FWP.used_facets[facet_name]) {
            if ('undefined' !== typeof $this.find('.facetwp-customSlider')[0].noUiSlider) {
                FWP.facets[facet_name] = $this.find('.facetwp-customSlider')[0].noUiSlider.get();
            }
        }
    });

    wp.hooks.addAction('facetwp/set_label/customSlider', function($this) {
        var facet_name = $this.attr('data-name');
        var min = FWP.settings[facet_name]['lower'];
        var max = FWP.settings[facet_name]['upper'];
        var format = FWP.settings[facet_name]['format'];
        var opts = {
            decimal_separator: FWP.settings[facet_name]['decimal_separator'],
            thousands_separator: FWP.settings[facet_name]['thousands_separator']
        };

        if(FWP.settings[facet_name]['subtitle'] == null) {
            var subtitle = "";
        } else {
            var subtitle = FWP.settings[facet_name]['subtitle'];
        }

            var label = 
                '<span class="prefix">' + FWP.settings[facet_name]['prefix']
                + '</span>'
                + '<span class="suffix">'
                + nummy(max).format(format, opts)
                //+ ' &nbsp; '
                + FWP.settings[facet_name]['suffix']
                + '</span>';

            var title = 
                '<p>' + FWP.settings[facet_name]['title'] 
                + '<span class="facetwp-num">'
                + '<span class="num">'
                + nummy(max).format(format, opts)
                + '</span>'
                + '<i>'
                + subtitle
                + '</i>'
                + '</span>'
                + '</p>';

        $this.find('.facetwp-customSlider-label').html(label);
        $this.find('.facetwp-title').html(title);

    });

    wp.hooks.addFilter('facetwp/selections/customSlider', function(output, params) {
        return params.el.find('.facetwp-customSlider-label').text();
    });

    $(document).on('facetwp-loaded', function() {
        $('.facetwp-customSlider:not(.ready)').each(function() {
            var $parent = $(this).closest('.facetwp-facet');
            var facet_name = $parent.attr('data-name');
            var opts = FWP.settings[facet_name];
            
            //alert(facet_name);

            // on first load, check for customSlider URL variable
            if (false !== FWP_Helper.get_url_var(facet_name)) {
                FWP.used_facets[facet_name] = true;
            }

            // fail on customSlider already initialized
            if ('undefined' != typeof $(this).data('options')) {
                return;
            }

            // fail if start values are null
            if (null === FWP.settings[facet_name].start[0]) {
                return;
            }

            // fail on invalid ranges
            if (parseFloat(opts.range.min) >= parseFloat(opts.range.max)) {
                FWP.settings[facet_name]['lower'] = opts.range.min;
                FWP.settings[facet_name]['upper'] = opts.range.max;
                wp.hooks.doAction('facetwp/set_label/customSlider', $parent);
                return;
            }

            // custom customSlider options
            var customSlider_opts = wp.hooks.applyFilters('facetwp/set_options/customSlider', {
                range: opts.range,
                start: opts.start,
                step: parseFloat(opts.step),
                connect: true,
            }, { 'facet_name': facet_name });


            var customSlider = $(this)[0];
            noUiSlider.create(customSlider, customSlider_opts);
            customSlider.noUiSlider.on('update', function(values, handle) {
                FWP.settings[facet_name]['lower'] = values[0];
                FWP.settings[facet_name]['upper'] = values[1];
                wp.hooks.doAction('facetwp/set_label/customSlider', $parent);
            });
            customSlider.noUiSlider.on('set', function() {
                FWP.used_facets[facet_name] = true;
                FWP.autoload();
            });

            $(this).addClass('ready');
        });

        // hide reset buttons
        $('.facetwp-type-customSlider').each(function() {
            var name = $(this).attr('data-name');
            var $button = $(this).find('.facetwp-customSlider-reset');
            $.isEmptyObject(FWP.facets[name]) ? $button.hide() : $button.show();
        });
    });

    $(document).on('click', '.facetwp-customSlider-reset', function() {
        var facet_name = $(this).closest('.facetwp-facet').attr('data-name');
        delete FWP.used_facets[facet_name];
        FWP.refresh();
    });

})(jQuery);