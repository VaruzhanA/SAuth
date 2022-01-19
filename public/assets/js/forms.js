$(document)
	.on('focus', '.form-input--pseudo :input', function()
		{
			$(this).parents('.form-input--pseudo').addClass('form-input--focus');
		})

	.on('blur', '.form-input--pseudo :input', function()
		{
			$(this).parents('.form-input--pseudo').removeClass('form-input--focus');
		})

	.on('keyup change', '.form-input--pseudo:not(.form-input--select) :input, .form-input--pseudo .custom-combobox-input', function()
		{
            if ($(this).parents('.form-select--multiple').length) {
                return;
            }

			if (this.value !== '')
			{
				$(this).parents('.form-input').addClass('form-input--active');
			}
			else
			{
				$(this).parents('.form-input').removeClass('form-input--active');
			}
		})

    .on('animationstart', '.form-input--pseudo:not(.form-input--select) input', function(ev)
        {
            if (ev.originalEvent.animationName == 'onAutofill') {
                $(this).parents('.form-input--pseudo').addClass('form-input--active');
            }
        })

	.on('change', '.form-input--pseudo select', function()
		{
			if (
				(this[this.selectedIndex] && this[this.selectedIndex].innerHTML !== '') ||
				(this.getAttribute('multiple') && $(this).val()) ||
                $(this).parents('.form-input--pseudo').find('.multiselect-selected-text').html()
			)
			{
				$(this).parents('.form-input--select').addClass('form-input--active');
			}
			else
			{
				$(this).parents('.form-input--select').removeClass('form-input--active');
			}
		})
    .on('keyup', '[data-automove_pattern]', function(ev)
        {
            // When the user fills out a form field, automatically move them on to the next field once what they've typed matches a pattern
            // e.g. if they've typed a credit card number, automatically move onto the next field after they've typed 16 numbers

            // For certain key presses, we don't want to perform this action
            var code = ev.keyCode || ev.which;
            var ignore_codes = [
                9, // tab
                13, // enter
                16, // shift
                37, // left
                39 // right
            ];

            var pattern = this.getAttribute('data-automove_pattern');

            if (!ignore_codes.includes(code) && this.value.match(pattern)) {
                // Get all focusable elements
                var $focusable = $('a, :input, button, [tabindex]').not(':disabled').not('[tabindex="-1"]');

                // Get the focusable field after the current one, if any, and focus it
                var index = $focusable.index(this);
                if (index > -1 && $focusable[index + 1]) {
                    $focusable[index + 1].focus();
                }
            }
        })
    .on('change', '.image-upload-input', function()
        {
            // Show a preview of an image, uploaded by <input type="file" />
            var $section = $(this).parents('.image-upload');
            var $preview = $section.find('.image-upload-preview img');
            var file    = this.files[0];
            var reader  = new FileReader();

            reader.addEventListener('load', function () {
                $preview.removeClass('hidden').attr('src', reader.result);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        })
    .on('change', '.file-upload-input', function()
        {
            // Show the file name of a file, uploaded by <input type="file" />
            var filename = this.files[0].name;
            var $filename = $(this).parents('.file-upload').find('.file-upload-filename');

            $filename.is(':input') ? $filename.val(filename) : $filename.text(filename);
        })
    ;

$('.form-select').on('change', 'select, .custom-combobox-input', function() {
    var $overlay = $(this).parents('.form-select').find('.form-input-overlay-inner');

    if ($overlay) {
        var $selected    = $(this).parents('.form-select').find(':selected');
        var overlay_text = $selected.data('overlay') || '';
        var status       = $selected.data('status')  || '';

        $overlay.data('status', status).attr('data-status', status).text(overlay_text);
    }
});


$(document).on('change', '.multiselect-native-select select', function () {
    var $selected = $(this).find(':selected:not(:disabled)');
    var count = $(this).val() ? $(this).val().length : 0;
    var count_text = (count == 0) ? '' : (count == $(this).find('option').length ? 'all' : count);
    var selected_text = '';
    $selected.each(function () {
        selected_text += $(this).text();
    });

    $(this).parents('label').find('.form-select-mask-count').html(count_text);
    $(this).parents('label').find('.form-select-mask-selected').html(selected_text);
});

/* Refresh multiselects after their form is reset */
$('form').on('reset', function() {
    setTimeout(function() {
        $(this).find('.form-input--active select').multiselect('refresh');
    }, 1);
});


$(document).ready(function() {

    $('.dropdown-menu-radio').on('change', function() {
        $(this).parents('.dropdown').find('.btn-dropdown-selected_text').text($(this).closest('label').text().trim());
    });
});


$(document).on('change', '.form-datepicker-iso', function(ev, datepicker_change) {
    datepicker_change = typeof datepicker_change == 'undefined' ? false : datepicker_change;

    // If the hidden field was updated automatically after selecting a date via the datepicker, don't continue (the display field is already set)
    // If the hidden field is changed otherwise, update the display field
    if (!datepicker_change)
    {
        var date     = this.value ? new Date(this.value) : '';
        var $display = $(this).parents('.form-datepicker-wrapper').find('.form-datepicker');
        var format   = $display.data('date_format') || 'Y-m-d';

        $display.val(date ? date.dateFormat(format) : '');
    }
});

function ib_initialize_typeselects() {
    $('.form-ajax_typeselect:not(.initialized)').each(function () {
        var $input = $(this);

        $input.autocomplete({
            select: function (e, ui) {
                $input.parents('.form-group').find('.form-ajax_typeselect-value').val(ui.item.id).trigger(':ib-typeselect-select', [e, ui]);
                $input.val(ui.item.label).trigger(':ib-typeselect-select', [ui]);
            },
            source: function (data, callback) {
                $.get($input.data('url'),
                    data,
                    function (response) {
                        callback(response);
                    }
                );
            }
        });
        $input.addClass('initialized');
    });
}
ib_initialize_typeselects();

$(document).on('click', '.form-typeselect-clear', function() {
    var $group = $(this).parents('.form-group, .form-ajax_typeselect-wrapper');
    $group.find('.form-ajax_typeselect').val('');
    $group.find('.form-ajax_typeselect-value').val('');
});

/* Apply Plyr to audio and video players */
$(document).ready(function() {
    $('.ib-video-wrapper').each(function() {
        var selector = '#'+$(this).attr('id');
        if ($(selector).find('video').length) {
            selector = selector+ ' video';
        }

        var player = new Plyr(selector);
    });

    $('.ib-audio-wrapper').each(function() {
        var selector = '#'+$(this).attr('id');
        if ($(selector).find('audio').length) {
            selector = selector+ ' audio';
        }

        var player = new Plyr(selector);
    });
});



/*------------------------------------*\
 #Filter menu
 \*------------------------------------*/
// Clicking inside the dropdown to prevent it dismissing.
// Hack. Fix issue with `data-autodismiss="false` and remove this.
$(document).on('click', '.form-filter .dropdown-menu', function() {
    var $filter = $(this).parents('.form-filter');
    var $menu = $filter.find('.dropdown-menu').addClass('d-block');
    setTimeout(function() {
        $filter.addClass('open');
        $menu.removeClass('d-block');
    }, 1);
});

/* When a category is clicked in the filter menu,
 * Open a sublist, with all selected items from the category.
 * Selected items to be listed under the "Selected" header.
 * The "Selected" header should only be visible when there are selected items.
 * Other items to be listed under the "All" header.
 */
$(document).on('click', '.form-filter-category a', function(ev) {
    ev.preventDefault();
    const $filter   = $(this).parents('.form-filter');
    const $category = $(this).parents('.form-filter-category');
    const group     = $category.data('group');
    const options   = $category.data('options') || [];

    // Hide the main list. Show the sublist.
    $filter.find('.form-filter-menu').addClass('hidden');
    $filter.find('.form-filter-submenu').removeClass('hidden');

    // Sublist HTML to have an "all" header at the top.
    var sublist_html = '<li class="form-filter-category form-filter-li-all"><a href="#">All</a></li>';

    // Add each item in the category to the sublist.
    var has_checked = false;
    var $list_items = $(this).parent().nextUntil('.form-filter-category');

    $list_items.each(function(i, element) {
        var selected = '';
        if ($(element).find(':checked').length) {
            has_checked = true;
            selected = ($(element).find(':checked').length) ? ' class="selected"' : '';
        }

        sublist_html += '<li' + selected + '>' + element.innerHTML + '</li>';
    });

    $filter.find('.form-filter-submenu-load_more').toggleClass('hidden', (options.length <= 10));

    // If any items are checked, show the "Selected" header.
    sublist_html = '<li class="form-filter-category form-filter-li-selected' + (has_checked ? '' : ' hidden') +
    '" style="order: -1;"><a href="#">Selected</a></li>' + sublist_html;

    $filter.find('.form-filter-submenu-title').html($(this).html());
    $filter.find('.form-filter-submenu-list').html(sublist_html).attr('data-group', group).data('group', group);
});

/* If a checkbox in the sublist is changed, toggle the selected class.
 * This will move it to under the "all" header
 */
$(document).on('change', '.form-filter-submenu-list [type="checkbox"]', function() {
    $(this).parents('li').toggleClass('selected', this.checked);
});

/* When the back button is clicked
 * hide the sublist, show the main list
 * Clear anything typed in the sublist search bar
 */
$(document).on('click', '.form-filter-submenu-back', function() {
    var $filter = $(this).parents('.form-filter');

    $('.form-filter-search').val('').keyup();

    $filter.find('.form-filter-submenu').addClass('hidden');
    $filter.find('.form-filter-menu').removeClass('hidden');
});


/**
 * If a checkbox in the filter is changed,
 * add or remove its item in the list of all selected filters
 */
$(document).on('change', '.form-filter .dropdown-menu [type="checkbox"]', function() {
    var $filter = $(this).parents('.form-filter');
    var item_name = $(this).parents('.form-checkbox').find('.form-checkbox-label').text();
    var $selected_text = $filter.find('.form-filter-li-selected');

    var has_checked_items = ($selected_text.find('~ li :checked')).length > 0;
    $selected_text.toggleClass('hidden', !has_checked_items);

    if (this.checked) {
        // Clone the template, populate it with data from the selected filter, add it to the list
        var $template = $filter.find('.form-filter-selected-item-template').clone();
        var $selected_area = $filter.find('.form-filter-selected');

        $template.attr('data-group', this.name).attr('data-id', this.value);
        $template.find('.filter-item-label').html(
            $filter.find('.form-filter-category[data-group="' + this.name + '"]').text().trim()
        );
        $template.find('.filter-item-title').text(item_name).attr('title', item_name);
        $template.find('.form-filter-selected-field').attr('name', this.name).attr('value', this.value);
        $template.removeClass('hidden').removeClass('form-filter-selected-item-template');

        // Clear duplicates
        var $duplicate = $selected_area.find('[data-group="'+this.name+'"][data-id="'+this.value+'"]');
        if ($duplicate.length) {
            $duplicate.remove();
        }

        // Add the new item
        $selected_area.append($template);
    } else {
        // Remove the un-selected filter from the list
        $filter.find('.form-filter-selected-item[data-group="' + this.name + '"][data-id="' + this.value + '"]')
            .remove();
    }

    // Ensure the item is selected in the main list
    $filter.find('.form-filter-menu-list [data-group="' + this.name + '"][data-id="' + this.value + '"]')
        .toggleClass('selected', this.checked)
        .find('[type="checkbox"]').prop('checked', this.checked).attr('checked', this.checked);

    // Trigger an event. So features can tell this was changed, so they know when to refresh data.
    $filter.trigger(':ib-form-filter-change');
});

// If any items where selected on the initial page load, ensure they get an item in the list of all filters
$('.form-filter .dropdown-menu :checked').trigger('change');

// If the user types something in the sublist search bar, show records matching the search term.
// And bold the searched term within results
$(document).on('keyup', '.form-filter-search', function() {
    var term = this.value;
    var lc_term = term.toLowerCase();
    var re = new RegExp(term, 'gi') ;
    var $list = $(this).parents('.form-filter').find('.form-filter-submenu-list');

    const per_page = 10;
    const $load_more = $(this).parents('.form-filter').find('.form-filter-submenu-load_more');

    $list.find('li').each(function(i, element)
    {
        var item = $(this).find('.form-checkbox-label')[0];

        // remove tags (remove bolding from previous search terms)
        if (item) {
            item.innerHTML = item.innerHTML.replace(/(<b>)/ig, '').replace(/(<\/b>)/ig, '');
        }

        var visible = $(this).hasClass('selected') || !item || $(item).text().toLowerCase().indexOf(lc_term) != -1;

        if (!visible) {
            // Hide irrelevant items
            this.style.display = 'none';
        }
        else {
            // Show relevant items and bold the keyword
            this.style.display = '';

            bold_filter_search_term(element, term);
        }
    });

    // If the filtered results do not fill a page and there are more results to show, load more.
    if ($list.find('li:visible').length < per_page && $load_more.is(':visible')) {
        $load_more.click();
    }
});


function bold_filter_search_term(element, term)
{
    var re = new RegExp(term, 'gi') ;

    var item = $(element).find('.form-checkbox-label')[0];

    // Need to implement a better way of wrapping <b></b> tags around terms without breaking HTML in the section.
    // For now, if you're using HTML in a list item, isolate the searchable text in a `class="form-filter-text"`.
    var search_item = item && item.getElementsByClassName('form-filter-text').length > 0
        ? item.getElementsByClassName('form-filter-text')[0]
        : item;

    if (search_item) {
        search_item.innerHTML = search_item.innerHTML.replace('&nbsp;', ' ').replace(re, function(str) {return '<b>'+str+'</b>'});
    }
}


/* If the remove icon is clicked on an item in the list of all applied filters
 * remove the item from the list
 * ensure it is also unselected in the filter dropdown
 */
$(document).on('click', '.form-filter .filter-item-close', function() {
    var $item = $(this).parents('.form-filter-selected-item');
    var $filter = $(this).parents('.form-filter');
    var group = $item.data('group');
    var id = $item.data('id');

    $filter.find('[type="checkbox"][name="' + group + '"][value="' + id + '"]').prop('checked', false).change();

    $filter.trigger(':ib-form-filter-change');
});

$(document).on('click', '.form-filter-submenu-load_more', function() {
    const $filter    = $(this).parents('.form-filter');
    const $sublist   = $(this).parents('.form-filter-submenu').find('.form-filter-submenu-list');
    const group      = $sublist.data('group');
    const $category  = $filter.find('.form-filter-category[data-group="' + group + '"]');
    const num_loaded = $sublist.find('> li:not(.form-filter-category):visible').length;
    const per_page   = 10;
    const options    = $category.data('options');
    const $template  = $sublist.find('li:last-child').clone();
    const term       = $(this).parents('.form-filter-submenu').find('.form-filter-search').val();

    // Get only options that match the filter.
    let filtered_options = [];
    let option;
    let found = 0;
    let option_text;
    for (let i = 0; found < num_loaded + per_page && i < options.length; i++) {
        option = options[i];

        // If the text contains HTML, we only want to searrch the plain text, not the tags or entities.
        option_text = option.is_html ? $(option.html).text() : option.html;

        // If the option contains the search term, return it.
        if (option_text.toLowerCase().indexOf(term.toLowerCase()) != -1) {
            filtered_options.push(option);
            found++;
        }
    }

    // Get the next 10 items. Add them to the end of the list.
    const next_items = filtered_options.slice(num_loaded, num_loaded + per_page);
    let next_items_html = '';
    let next_items_sub_html = '';

    next_items.forEach(item => {
        $template.find('.form-checkbox [type="checkbox"]').val(item.id);
        $template.find('.form-checkbox-label').html(item.html);

        bold_filter_search_term($template, term);

        next_items_html += '<li data-group="' + group + '" data-id="' + item.id + '">'+$template.html()+'</li>';
        next_items_sub_html += '<li>'+$template.html()+'</li>';
    });

    $filter.find('.form-filter-menu-list .form-filter-category[data-group="' + group + '"]')
        .nextUntil('.form-filter-category').last().after(next_items_html);
    $sublist.append(next_items_sub_html);

    // Hide the "load more" button if all items have been loaded.
    $filter.find('.form-filter-submenu-load_more').toggleClass('hidden', (options.length <= num_loaded + per_page));
});

/* Sidebar menu */
$(document).ready(function() {

    $('.mobile-menu-toggle').on('click', function()
    {
        $('body').toggleClass('mobile-menu-open');
    });

    // Dismiss when clicked away from
    $(document).on('click', function (ev)
    {
        var $target    = $(ev.target);
        var is_menu    = ($target.hasClass('mobile-menu')  || $target.parents('.mobile-menu').length > 0);
        var is_toggle  = ($target.attr('id') === 'mobile-menu-toggle' || $target.parents('.mobile-menu-toggle').length > 0);
        var is_spinner = ($target.is('[style*="ajax-loader"]') || $target.find('[style*="ajax-loader"]').length > 0);

        // If the user has not clicked on the menu, the menu toggle or an AJAX spinner
        if (!is_menu && !is_toggle && !is_spinner) {
            $('body').removeClass('mobile-menu-open');
        }
    });

    var $mobile_menu = $('.mobile-menu');

    $mobile_menu.find('.submenu-expand').on('click' ,function()
    {
        $(this).closest('.has_submenu').toggleClass('expanded');
    });

    // Expand submenu when clicked
    // Whether this runs depends on the sidebar behaviour (does a new page open or not)
    $('.sidebar-behavior--current_page .mobile-menu .level_2.has_submenu > a').on('click' ,function(ev)
    {
        ev.preventDefault();
        var id = $(this).data('id');
        var $level3_section = $(this).parents('.mobile-menu').find('.mobile-menu-level3-section');
        var $menu = $('.mobile-menu');

        $menu[0].scrollTop = 0;
        $menu.css('overflow', 'hidden');

        $menu.addClass('mobile-menu--level3_expanded');
        $level3_section.find('.mobile-menu-list[data-parent_id="'+id+'"]').removeClass('hidden');
    });

    $('.mobile-menu-back').on('click', function()
    {
        var $level3_section = $(this).parents('.mobile-menu-level3-section');

        $('.mobile-menu').css('overflow', '').removeClass('mobile-menu--level3_expanded');
        $level3_section.find('.mobile-menu-list').addClass('hidden');
    });

    $('.footer-column-title').on('click', function()
    {
        $(this).toggleClass('expanded');
    });

    if (typeof $.fn.multiselect == 'function' && window.location.href.indexOf('/admin') == -1) {
        $('.form-select--multiple .form-input > select').multiselect();

        // if Bootstrap multiselect is loaded, but Bootstrap itself is not, this is needed to handle dropdowns.
        $('.form-select--multiple .multiselect-container').hide();

        $('.form-select--multiple .multiselect').on('click', function() {
            $(this).find('\+ .multiselect-container').toggle();
        });

        $(document).on('click', function(ev)
        {
            var $clicked_element = $(ev.target);
            if (!$clicked_element.hasClass('multiselect-container') && !$clicked_element.parents('.multiselect-container').length) {
                $('.multiselect-container').hide();
            }
        })

    }
});

/* Hide toggle */
// Allow clicking one element to toggle the visibility of another
// Toggles the "hidden" class (or a different specified class)
// Triggers custom events, so callbacks can be run immediately afterwards
$(document).on('click', '[data-hide_toggle]', function()
{
    var $target = $($(this).data('hide_toggle'));
    var class_name = $(this).data('hide_toggle-class') || 'hidden';

    if ($target.hasClass(class_name)) {
        $target.trigger(':ib-expand');
        $target.removeClass(class_name);

        var hide_text = $(this).data('hide_text');
        if (hide_text) {
            $(this).html(hide_text);
        }
        $(this).addClass('expanded');

        $target.trigger(':ib-expanded');
    } else {
        $target.trigger(':ib-collapse');
        $target.addClass(class_name);

        var show_text = $(this).data('show_text');
        if (show_text) {
            $(this).html(show_text);
        }
        $(this).removeClass('expanded');

        $target.trigger(':ib-collapsed');
    }
});

// Dismiss when clicked away from, if that option is enabled
$(document).on('click', function(ev) {
    var $target = $(ev.target);

    var is_toggle  = $target.closest('[data-hide_toggle]').length;
    var is_menu    = $target.closest('[data-hide_toggle-click_away][data-hide_toggle-trigger]').length;
    var is_spinner = ($target.is('[style*="ajax-loader"]') || $target.find('[style*="ajax-loader"]').length > 0);

    // If the user has not clicked on the menu, the menu toggle or an AJAX spinner
    if (!is_menu && !is_toggle && !is_spinner) {
        var $toggler = $($('[data-hide_toggle-click_away][data-hide_toggle-trigger]:visible').data('hide_toggle-trigger'));
        var $section = $($toggler.data('hide_toggle'));
        var hide_class = $toggler.data('hide_toggle-class') || 'hidden';
        $section.addClass(hide_class);
        $toggler.removeClass('expanded');
    }
});

$(document).on('click', '[data-accordion-show]', function() {
    var currently_active = $(this).hasClass('active');

    if (!currently_active) {
        var $hide = $(this).parents('.course-subject-accordion-wrapper').find($($(this).data('accordion-hide')));
        var $show = $($(this).data('accordion-show'));

        $show.parents('ul').find('[data-accordion-show], li').removeClass('active');
        $hide.addClass('hidden');
        $(this).addClass('active');
        $(this).parents('li').addClass('active');
        $show.removeClass('hidden');
    }
});

// Needs to be made more accessible and merged with the above
$('.accordion-basic h3').on('click', function() {
    var was_active = $(this).hasClass('active');
    $(this).parents('ul').find('h3 ~ *').addClass('hidden');
    $(this).find('~ *').toggleClass('hidden', was_active);
    $(this).parents('ul').find('.active').removeClass('active');
    $(this).toggleClass('active', !was_active);
});

// Toggle the visibility of a section based on an option chosen in a select list or radio group
$(document).on('change', 'select[data-form-show-option], [data-form-show-option] :radio', function()
{
    var $selector   = $(this).closest('[data-form-show-option]');
    var $target     = $($selector.data('target'));
    var show_option = $selector.data('form-show-option');
    var selected    = $selector.find(':selected, :checked').val();
    var show        = (show_option == selected);

    $target.find(':input').prop('disabled', !show);
    $target.toggleClass('hidden', !show);
});

$(document).on('click', '.panel-remove', function() {
    $(this).parents('.panel').remove();
});

function clean_date_string(date){ //Add "T" to date strings for Safari browsers - PAC-281
    try {
        return (date.match(/(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}(:\d{2})?)/) ? date.replace(/\s/, "T") : date);
    } catch (exc) {
        console.log(date);
        console.log(exc);
        return date;
    }
}

/*
 Password strength meter
 */
$.fn.get_password_meter = function() {
    var $label = $(this).parents('label');

    if ($label.length) {
        return $label.find('\+ .password-info');
    } else {
        return this.find('\+ .password-info');
    }
};

$('.password-with_meter')
    .focus(function()
    {
        $(this).get_password_meter().removeClass('hidden');
    }).blur(function()
    {
        $(this).get_password_meter().addClass('hidden');
    }).on('input',function()
    {
        var pswd        = this.value;
        var long_enough = pswd.length >= 8;
        var has_lower   = !!pswd.match(/[a-z]/);
        var has_upper   = !!pswd.match(/[A-Z]/);
        var has_number  = !!pswd.match(/\d/);
        var has_special  = !!pswd.match(/[^a-zA-Z0-9]/);
        var strength;

        var $meter = $(this).get_password_meter();

        $meter.find('.password-strength-length' ).toggleClass('invalid', !long_enough).toggleClass('valid', long_enough);
        $meter.find('.password-strength-letter' ).toggleClass('invalid', !has_lower  ).toggleClass('valid', has_lower);
        $meter.find('.password-strength-capital').toggleClass('invalid', !has_upper  ).toggleClass('valid', has_upper);
        $meter.find('.password-strength-number' ).toggleClass('invalid', !has_number ).toggleClass('valid', has_number);
        $meter.find('.password-strength-nospecial' ).toggleClass('invalid', has_special ).toggleClass('valid', !has_special);

        if (long_enough && has_lower && has_upper && has_number) {
            strength = (pswd.length == 8) ? 'Good' : 'Strong';
        } else {
            strength = 'Weak';
        }

        $meter.find('.password-strength-result').text(strength);
        $('.password-strength-meter > span').addClass('hidden');
        switch (strength) {
            case 'Strong': $meter.find('.password-strength-meter-strong').removeClass('hidden'); break;
            case 'Good'  : $meter.find('.password-strength-meter-good'  ).removeClass('hidden'); break;
            default      : $meter.find('.password-strength-meter-weak'  ).removeClass('hidden'); break;
        }
    })
    .focusout(function()
    {
        var $meter = $(this).get_password_meter();

        if ($meter.find('.password-strength-meter-strong').is(':visible')) {
            $('#invalid_password').addClass('hidden');
        }else{
            $('#invalid_password').removeClass('hidden');
        }
    });


// Make it possible to unselect a radio button which has the class "radio-unselectable"
$(document).on('mousedown', 'label.radio-unselectable .radio-icon-checked', function()
{
    $(this).closest('label').find(':radio').prop('checked', false);
});

// Convert special characters to their HTML entities
function htmlentities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function seconds_to_time(total_seconds, format) {
    format = format || 'short';

    var formatted_time;
    var hours   = Math.floor(total_seconds / 60 / 60);
    var minutes = Math.floor((total_seconds - hours * 60 * 60) / 60);
    var seconds = Math.floor(total_seconds % 60);
    var h_label = 'h';
    var m_label = 'm';
    var s_label = 's';


    switch (format) {
        case 'long':
            h_label = hours   == 1 ? ' hour'   : ' hours';
            m_label = minutes == 1 ? ' minute' : ' minutes';
            s_label = seconds == 1 ? ' second' : ' seconds';
            break;

        case 'medium':
            h_label = 'hr';
            m_label = 'min';
            s_label = 'sec';
            break;
    }

    formatted_time  = hours   ? hours   + h_label+' ' : '';
    formatted_time += minutes ? minutes + m_label+' ' : '';
    formatted_time += seconds ? seconds + s_label     : '';
    formatted_time  = formatted_time ? formatted_time.trim() : '0'+s_label;

    return formatted_time
}

// Convert array of objects to HTML options
function html_options_from_rows(value_column, label_column, options, selected, first_option)
{
    var html = '';

    if (first_option) {
        html += '<option value="'+first_option.value+'">'+first_option.label+'</option>';
    }

    for (var i = 0; i < options.length; i++) {
        html += '<option ' +
            'value="'+options[i][value_column]+'"' +
            ((options[i][value_column] == selected) ? ' selected="selected"' : '') +
        '>'+htmlentities(options[i][label_column])+'</option>';
    }

    return html;
}



function set_up_google_map_form(args)
{
    args = args || {};
    var container = args.container;
    var lat = args.lat || 53.32693558541906;
    var lng = args.lng || -6.416015625;
    var lat_field = args.lat_field;
    var lng_field = args.lng_field;
    var find_btn  = args.find_btn;
    var search_field = args.search_field;
    var get_address_function = args.get_address_function;
    if (typeof targetX == 'undefined') {
        var targetX = args.targetX;
        var targetY = args.targetY;
    }

    var options = {
        center: new google.maps.LatLng(lat, lng),
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        panControl: true,
        zoomControl: true,
        mapTypeControl: true,
        streetViewControl: true,
        overviewMapControl: true
    };

    var map      = new google.maps.Map(container, options);
    var geocoder = new google.maps.Geocoder();
    var marker   = new google.maps.Marker({  position: options.center, map: map });

    var searchBox = new google.maps.places.SearchBox(search_field);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() { searchBox.setBounds(map.getBounds()); });

    google.maps.event.addListener(map, 'click', function(event) {
        map.setCenter(event.latLng);
        if (marker != null) {
            marker.setMap(null);
        }
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
            map: map
        });

        $(lat_field).val(event.latLng.lat());
        $(lng_field).val(event.latLng.lng());

        if (args.coordinates_field) {
            $(args.coordinates_field).val(event.latLng.lat()+','+event.latLng.lng());
        }
    });

    $(searchBox).on('keydown', function() {
        google.maps.event.trigger(searchBox, 'places_changed');
    });


    $(find_btn).off('click').on('click', function() {
        var address = get_address_function();

        // Trigger a change
        try {
            var input = document.getElementById('location-modal-map_search');
            google.maps.event.trigger(input, 'focus');
            google.maps.event.trigger(input, 'keydown', {keyCode: 13});
        } catch (e) {
            console.log(e);
        }

        geocoder.geocode(
            { 'address': address },
            function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (marker != null) {
                        marker.setMap(null);
                    }
                    map.setCenter(results[0].geometry.location);
                    marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                    trackXY = false;
                    $(targetX).val(results[0].geometry.location.lat());
                    $(targetY).val(results[0].geometry.location.lng());

                    if (args.coordinates_field) {
                        $(args.coordinates_field).val(results[0].geometry.location.lat()+','+results[0].geometry.location.lng());
                    }
                    trackXY = true;
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            }
        );

    });
}


/* Videos */
$(document).on('click', '.video-cover', function() {
    $(this).parents('.video-wrapper').ib_show_video();
});

$.fn.ib_show_video = function() {
    $(this).find('iframe').removeClass('hidden').show();
    $(this).find('.video-cover').addClass('hidden');
};

$.fn.ib_cover_video = function() {
    $(this).find('.video-cover').removeClass('hidden');
    $(this).find('iframe').addClass('hidden');
};


// Fix issue with not being able to scroll when a model is dismissed while another one is still open
$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
});

if (!window.disableScreenDiv) {
    window.disableScreenDiv = document.createElement("div");
    window.disableScreenDiv.hide = true;
    window.disableScreenDiv.style.display = "block";
    window.disableScreenDiv.style.position = "fixed";
    window.disableScreenDiv.style.top = "0px";
    window.disableScreenDiv.style.left = "0px";
    window.disableScreenDiv.style.right = "0px";
    window.disableScreenDiv.style.bottom = "0px";
    window.disableScreenDiv.style.textAlign = "center";
    window.disableScreenDiv.style.visibility = "hidden";
    window.disableScreenDiv.style.zIndex = 9999;
    window.disableScreenDiv.innerHTML = '<div class="ajax_loader_icon" style="position:absolute;top:0;left:0;right:0;bottom:0;background-color:#000;opacity:0.2;filter:alpha(opacity=20);z-index:1;"></div>' +
    '<div class="ajax_loader_icon_inner" style="position:absolute;top:50%;left:50%;z-index:2;width: 32px;height: 32px;margin: 0 auto;background-image: url(\'../assets/images/ajax-loader.gif\')"></div>';
    window.disableScreenDiv.autoHide = true;

    $(document).ready(function() {
        document.body.appendChild(window.disableScreenDiv);

        $(document).ajaxStart(function() {
            if (window.disableScreenDiv && window.disableScreenDiv.hide) {
                window.disableScreenDiv.style.visibility = 'visible';
            }
        });

        $(document).ajaxStop(function() {
            if (window.disableScreenDiv && window.disableScreenDiv.autoHide) {
                window.disableScreenDiv.style.visibility = 'hidden';
            }
        });
    });
}
