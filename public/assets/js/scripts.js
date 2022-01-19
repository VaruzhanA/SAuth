var selected_existing_organisation = null;
var domain_name = '';
var count_organisations_found = 0;

function capitalize_input() {
    var value = this.value.toLowerCase();
    value = value.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1);
    });
    // Capitalise the letter after "Mc" or "O'". e.g. "McMahon" and "O'Mahony"
    this.value = value.replace(/(Mc|O')([a-z])/g, function (txt, $1, $2) {
        return $1 + $2.toUpperCase();
    });
}

$(document).ready(function () {
    $("#first-name, #last-name, #org-name").on("change", capitalize_input);
    $('.showPass')
        .on('mouseup touchend', function () {
            $(this.getAttribute('data-target')).attr('type', 'password');
        })
        .on('mousedown touchstart', function () {
            $(this.getAttribute('data-target')).attr('type', 'text');
        });
    $('.contact-type-selection').on('click', '[name="contact-type"]', function () {
        if (this.value == 'organisation') {
            $('.contact-type-selection').data('contact-type', 'organisation');
            $('#sign_up_button').text('Continue');
            $('.individual_role_selection').addClass('hidden');
        } else {
            $('.contact-type-selection').data('contact-type', 'individual');
            $('#sign_up_button').text('Sign up');
            $('.individual_role_selection').removeClass('hidden');
        }
    });
    $(document).on('change', 'input[type=radio][name=existing_organisation]', function () {
        if ($('input[type=radio][name=existing_organisation]:checked').val() == 'none') {
            $('#sign_up_button').text('Continue');
        } else {
            $('#sign_up_button').text('Verify and Continue');
        }
    });
    $(document).on('change', '#org-details-country', function () {
        var country = $(this).val();
        get_counties(country);
    });

    function get_counties(country, county = '', disabled = false) {
        if (country === '') {
            $('#org-details-county').find('option').remove();
            $('#org-details-county').append('<option value="">Please select...</option>');
            $('#org-details-county').removeClass('validate[required]');
            $('#org-details-county').closest('div.form-group').addClass('hidden');
        } else if (country !== 'IE' && country !== 'NIR') {
            $('#org-details-county').find('option').remove();
            $('#org-details-county').append('<option value="">Please select...</option>');
            $('#org-details-county').removeClass('validate[required]');
            $('#org-details-county').closest('div.form-group').addClass('hidden');
        } else {
            var data = {
                country: country
            };
            if (county != '') {
                data.county = county;
            }
            $.ajax(
                {
                    url: "/admin/login/ajax_get_counties",
                    data: data,
                    type: "POST",
                    success: function (response) {
                        if (response.length === 0) {
                            $('#org-details-county')
                                .find('option')
                                .remove();
                            $('#org-details-county').append('<option value="">Please select...</option>');
                            $('#org-details-county').removeClass('validate[required]');
                            $('#org-details-county').closest('div.form-group').addClass('hidden');
                        } else {
                            $('#org-details-county')
                                .find('option')
                                .remove();
                            if (!response.counties || response.counties.length === 0) {
                                $('#org-details-county').append('<option value="">Please select...</option>')
                                $('#org-details-county').removeClass('validate[required]');
                                $('#org-details-county').closest('div.form-group').addClass('hidden');
                            } else {
                                $('#org-details-county').append('<option value="">Please select...</option>')
                                if (country == 'IE' || country == 'NIR') {
                                    $.each(response.counties, function (key, county) {
                                        var option = '<option value="' + county.id + '">' + county.name + '</option>';
                                        $('#org-details-county').append(option);
                                    });
                                    if (response.county.id) {
                                        $('#org-details-county').val(response.county.id);
                                    } else {
                                        $('#org-details-county').val(county);
                                    }
                                    if (disabled) {
                                        $('#org-details-county').attr('disabled', 'disabled');
                                    } else {
                                        $('#org-details-county').removeAttr('disabled');
                                    }
                                    $('#org-details-county').addClass('validate[required]');
                                    $('#org-details-county').closest('div.form-group').removeClass('hidden');
                                } else {
                                    $('#org-details-county').removeClass('validate[required]');
                                    $('#org-details-county').closest('div.form-group').addClass('hidden');
                                }
                            }
                        }
                    }
                });
        }
    }

    var signup_session_string = window.location.search;
    if (signup_session_string !== undefined) {
        var urlParams = new URLSearchParams(signup_session_string);
        var signup_param = urlParams.get('signup');
        $('#signup').val(signup_param);
        if (signup_param) {
            $(".g-recaptcha").remove();
            window.disableScreenDiv.style.visibility = "visible";
            $('.individual-sign-up-section').addClass('hidden');
            $('.org-sign-up-section').addClass('hidden');
            $('.org-check-section').removeClass('hidden');
            $('.org-details-section').addClass('hidden');
            $('.org-back-to-personal-details').addClass('hidden');
            $('.contact-type-selection').data('contact-type', 'organisation');
            $('input[name=contact-type][value=organisation]').attr('checked', true);
            $('#sign_up_button').text('Verify and Continue');
            $('#login-form-tabs a[href="#login-tab-signup"]').tab('show');
            $('#pswd').removeClass['validate[required]'];
            var email = $('#email').val();
            var ind = email.indexOf("@");
            domain_name = email.substr(ind + 1);
            $.ajax(
                {
                    url: "/admin/login/ajax_check_signup_param",
                    data: {
                        //here we  param name, name to check if the session for this url existis and receive data to continue
                        signup: signup_param
                    },
                    type: "POST",
                    success: function (response) {
                        window.disableScreenDiv.style.visibility = "visible";
                        if (response.result == 'success') {
                            console.log(response);
                            $('#first-name').val(response.first_name);
                            $('#last-name').val(response.last_name);
                            $('#email').val(response.email);
                            $('#job-function').val(response.job_function);
                            $('#job_title').val(response.job_title);
                            $('#org-name').val(response.org_name);
                            $('#org-industry').val(response.org_industry);
                            $('#org-size').val(response.org_size);
                            $('#domain_blacklisted').val(response.domain_is_blacklisted);
                            $('#org-details-domain-name').val(response.domain_name);
                            domain_name = response.domain_name;
                            $.ajax(
                                {
                                    url: "/admin/login/ajax_get_organisations",
                                    data: {
                                        //here we  send organisation name to filter only similar
                                        name: $('#org-name').val(),
                                        domain_name: domain_name,
                                        signup: signup_param
                                    },
                                    type: "POST",
                                    success: function (response) {
                                        if (response.length == 0) {
                                            count_organisations_found = 0;
                                            $('#org-details-name').val($('#org-name').val());
                                            $('#org-details-domain-name').val(domain_name);
                                            $('#org-details-name').removeAttr('disabled');
                                            $('#org-details-domain-name').removeAttr('disabled');
                                            $('#org-details-name').attr('readonly', true);
                                            $('#org-details-domain-name').attr('readonly', true);
                                            $('#org-details-address1').removeAttr('disabled');
                                            $('#org-details-address2').removeAttr('disabled');
                                            $('#org-details-address3').removeAttr('disabled');
                                            $('#org-details-city').removeAttr('disabled');
                                            $('#org-details-post_code').removeAttr('disabled');
                                            $('#org-details-county').removeAttr('disabled');
                                            $('#org-details-country').removeAttr('disabled');
                                            $('.individual-sign-up-section').addClass('hidden');
                                            $('.org-sign-up-section').addClass('hidden');
                                            $('.org-check-section').addClass('hidden');
                                            $('.org-details-section').removeClass('hidden');
                                            $('.org-back-to-personal-details').addClass('hidden');
                                        } else {
                                            $.each(response, function (el, organisation) {
                                                var organisation_address = organisation.address ? ', ' + organisation.address : '';
                                                var organisation_id = organisation.id.cms_id !== undefined ? organisation.id.cms_id : organisation.id;
                                                console.log(organisation_id);
                                                var organisation_el = '<div class="form-group">' +
                                                    '<div class="col-sm-12">' +
                                                    '<label class="form-radio">' +
                                                    '<input type="radio" data-synced="' + organisation.synced + '" name="existing_organisation"' +
                                                    ' id="existing_organisation_' + organisation_id + '" value="' + organisation_id + '"/>' +
                                                    '<span class="form-radio-helper"></span>' +
                                                    '<span class="form-radio-label">' + organisation.name + ' ' + organisation_address + '</span>' +
                                                    '</label></div></div>';
                                                $('#existing_organisations').append(organisation_el);
                                            });
                                            count_organisations_found = response.length;
                                            $('#existing_organisations').append('' +
                                                '<div class="form-group">' +
                                                '<div class="col-sm-12">' +
                                                '<label class="form-radio">' +
                                                '<input type="radio" name="existing_organisation" id="existing_organisation_none" value="none"/>' +
                                                '<span class="form-radio-helper"></span>' +
                                                '<span class="form-radio-label">None of Above</span>' +
                                                '</label>' +
                                                '</div>' +
                                                '</div>');
                                            if (selected_existing_organisation) {
                                                $('#' + selected_existing_organisation).attr('checked', true);
                                            }
                                        }
                                        window.disableScreenDiv.style.visibility = "hidden";
                                    }
                                });
                        } else {
                            window.location.href = '/admin/login';
                        }
                    }
                });
        }
    }

    $('#login-tab-signup').validationEngine({
        onValidationComplete: function (form, status) {
            try {
                if (status == false) {
                    return false;
                }
                // if (grecaptcha) {
                //     var $captcha_iframe = $(form).find('iframe[src*="/recaptcha/"]');
                //     if ($captcha_iframe.length > 0) {
                //         var captcha_number = -1;
                //         $('iframe[src*="/recaptcha/"]').each(function (index) {
                //             if ($(this).is($captcha_iframe)) {
                //                 captcha_number = index;
                //             }
                //         });
                //         if (grecaptcha.getResponse(captcha_number).length == 0) {
                //             return false;
                //         }
                //     }
                // }
                if (form !== undefined
                    && (status
                        && $('.contact-type-selection').data('contact-type') == 'organisation'
                        && $('.org-details-section').hasClass('hidden'))) {
                    $.post(
                        '/admin/login/check_duplicate_contact',
                        {
                            email: $("#email").val()
                        },
                        function response(data) {
                            if (data.success == false) {
                                window.location.href = '/admin/login/duplicate_contact?email=' + encodeURIComponent($("#email").val())
                            } else {

                                $('#org-details-name').val($('#org-name').val());
                                var email = $('#email').val();
                                var ind = email.indexOf("@");
                                domain_name = email.substr(ind + 1);
                                $('#org-details-domain-name').val(domain_name);
                                if (!$('.individual-sign-up-section').hasClass('hidden')) {
                                    $('.individual-sign-up-section').addClass('hidden');
                                    $('.org-sign-up-section').removeClass('hidden');
                                    $('.org-check-section').addClass('hidden');
                                    $('.org-details-section').addClass('hidden');
                                    $('.org-back-to-personal-details').removeClass('hidden');
                                    $('#sign_up_button').text('Continue');
                                    document.cookie = "domain_name=" + domain_name;
                                    document.cookie = "first_name=" + $('#first-name').val();
                                    document.cookie = "last_name=" + $('#last-name').val();
                                    document.cookie = "email=" + $('#email').val();
                                    return false;
                                }
                                if (!$('.org-sign-up-section').hasClass('hidden')) {
                                    $('.individual-sign-up-section').addClass('hidden');
                                    $('.org-sign-up-section').addClass('hidden');
                                    $('.org-check-section').removeClass('hidden');
                                    $('.org-details-section').addClass('hidden');
                                    $('.org-back-to-personal-details').removeClass('hidden');
                                    $('#sign_up_button').text('Verify and Continue');
                                    if ($('#existing_organisations').find('input').length > 0) {
                                        selected_existing_organisation = $('input[name="existing_organisation"]:checked').attr('id');
                                        $('#existing_organisations').find('input').closest('div.form-group').remove();
                                    } else {
                                        selected_existing_organisation = null;
                                    }
                                    var signup_data = {};
                                    signup_data.domain_name = domain_name;
                                    signup_data.first_name = $('#first-name').val();
                                    signup_data.last_name = $('#last-name').val();
                                    signup_data.email = $('#email').val();
                                    signup_data.password = $('#pswd').val();
                                    signup_data.job_title = $('#job_title').val();
                                    signup_data.org_name = $('#org-name').val();
                                    signup_data.org_industry = $('#org-industry').val();
                                    signup_data.org_size = $('#org-size').val();
                                    signup_data.job_function = $('#job-function').val();
                                    signup_data.domain_is_blacklisted = $('#domain_blacklisted').val();
                                    signup_data.return_url = window.location.pathname;
                                    $.ajax(
                                        {
                                            url: "/admin/login/ajax_save_organisation_data",
                                            data: signup_data,
                                            type: "POST",
                                            success: function (response) {
                                                window.location.href = '/admin/login';
                                            }
                                        }
                                    );
                                    return false;
                                }
                                if (!$('.org-check-section').hasClass('hidden')) {
                                    var selected_existing_organisation = $('input[name="existing_organisation"]:checked').val();
                                    var selected_existing_organisation_synced = $('input[name="existing_organisation"]:checked').data('synced');
                                    if (selected_existing_organisation !== undefined && selected_existing_organisation !== 'none') {
                                        $('#selected-organisation').val($('#existing_organisation_' + selected_existing_organisation).val());
                                        $('#org-details-name').val($('#existing_organisation_' + selected_existing_organisation).closest('label').find('.form-radio-label').html());
                                        $.ajax(
                                            {
                                                url: "/admin/login/ajax_get_organisation",
                                                data: {
                                                    id: selected_existing_organisation,
                                                    synced: selected_existing_organisation_synced
                                                },
                                                type: "POST",
                                                success: function (response) {
                                                    if (response && response.id) {
                                                        $('#org-details-name').val(response.name).attr('disabled', 'disabled');
                                                        $('#org-details-domain-name').val(response.domain_name).attr('disabled', 'disabled');
                                                        $('#org-details-address1').val(response.address1).attr('disabled', 'disabled');
                                                        $('#org-details-address2').val(response.address2).attr('disabled', 'disabled');
                                                        $('#org-details-address3').val(response.address3).attr('disabled', 'disabled');
                                                        $('#org-details-city').val(response.city).attr('disabled', 'disabled');
                                                        $('#org-details-post_code').val(response.postcode).attr('disabled', 'disabled');
                                                        $('#org-details-country').val(response.country).attr('disabled', 'disabled');
                                                        get_counties(response.country, response.county, true);
                                                        $('#selected_organisation').val(response.id);
                                                        $('#synced_organisation').val(response.synced);
                                                    } else {
                                                        $('#org-details-name').removeAttr('disabled');
                                                        $('#org-details-domain-name').removeAttr('disabled');
                                                        $('#org-details-name').attr('readonly', true);
                                                        $('#org-details-domain-name').attr('readonly', true);
                                                        $('#org-details-address1').removeAttr('disabled');
                                                        $('#org-details-address2').removeAttr('disabled');
                                                        $('#org-details-address3').removeAttr('disabled');
                                                        $('#org-details-city').removeAttr('disabled');
                                                        $('#org-details-post_code').removeAttr('disabled');
                                                        $('#org-details-county').removeAttr('disabled');
                                                        $('#org-details-country').removeAttr('disabled');
                                                        $('#selected_organisation').val('');
                                                        $('#synced_organisation').val(false);
                                                    }
                                                }
                                            });
                                    } else {
                                        $('#org-details-name').val($('#org-name').val());
                                        $('#org-details-domain-name').val(domain_name);
                                        $('#org-details-name').removeAttr('disabled');
                                        $('#org-details-domain-name').removeAttr('disabled');
                                        $('#org-details-name').attr('readonly', true);
                                        $('#org-details-domain-name').attr('readonly', true);
                                        $('#org-details-address1').removeAttr('disabled');
                                        $('#org-details-address2').removeAttr('disabled');
                                        $('#org-details-address3').removeAttr('disabled');
                                        $('#org-details-city').removeAttr('disabled');
                                        $('#org-details-post_code').removeAttr('disabled');
                                        $('#org-details-county').removeAttr('disabled');
                                        $('#org-details-country').removeAttr('disabled');
                                        $('#selected_organisation').val('');
                                        $('#synced_organisation').val(false);
                                        if (selected_existing_organisation == 'none') {
                                            $('#org-details-address1').val('');
                                            $('#org-details-address2').val('');
                                            $('#org-details-address3').val('');
                                            $('#org-details-city').val('');
                                            $('#org-details-post_code').val('');
                                            $('#org-details-county').val('');
                                            $('#org-details-country').val('');
                                            $('#selected_organisation').val('');
                                            $('#synced_organisation').val(false);
                                        }

                                    }
                                    $('.individual-sign-up-section').addClass('hidden');
                                    $('.org-sign-up-section').addClass('hidden');
                                    $('.org-check-section').addClass('hidden');
                                    $('.org-details-section').removeClass('hidden');
                                    $('.org-back-to-personal-details').removeClass('hidden');
                                    $('#sign_up_button').text('Sign Up');
                                    return false;
                                }

                            }
                        }
                    );
                    return false;
                } else if (status && !($('.contact-type-selection').data('contact-type') == 'organisation'
                    && $('.org-details-section').hasClass('hidden'))) {
                    return true;
                }

            } catch (e) {
                console.log(e);
                return false;
            }
        }
    });
    $('#login-tab-signup').on('click', '.org-back-to-personal-details', function (ev) {
        if (!$('.individual-sign-up-section').hasClass('hidden')) {
            $('#sign_up_button').text('Continue');
            $('.org-back-to-personal-details').addClass('hidden');
        }
        if (!$('.org-sign-up-section').hasClass('hidden')) {
            $('.individual-sign-up-section').removeClass('hidden');
            $('.org-sign-up-section').addClass('hidden');
            $('.org-check-section').addClass('hidden');
            $('.org-details-section').addClass('hidden');
            $('.org-back-to-personal-details').addClass('hidden');
            $('#sign_up_button').text('Continue');
        }
        if (!$('.org-check-section').hasClass('hidden')) {
            $('.individual-sign-up-section').addClass('hidden');
            $('.org-sign-up-section').removeClass('hidden');
            $('.org-check-section').addClass('hidden');
            $('.org-details-section').addClass('hidden');
            $('#sign_up_button').text('Continue');
        }
        if (!$('.org-details-section').hasClass('hidden')) {
            if (count_organisations_found == 0) {
                $('.individual-sign-up-section').addClass('hidden');
                $('.org-sign-up-section').removeClass('hidden');
                $('.org-check-section').addClass('hidden');
                $('.org-details-section').addClass('hidden');
                $('.org-back-to-personal-details').addClass('hidden');
                $('#sign_up_button').text('Continue');
            } else {
                $('.individual-sign-up-section').addClass('hidden');
                $('.org-sign-up-section').addClass('hidden');
                $('.org-check-section').removeClass('hidden');
                $('.org-details-section').addClass('hidden');
                $('.org-back-to-personal-details').addClass('hidden');
                $('#sign_up_button').text('Verify and Continue');
            }

        }
    });
    $("[name=email], [name=password]").on(
        "change",
        function () {
            this.value = $.trim(this.value);
        }
    );
    $("[name=email], [name=password]").on(
        "blur",
        function () {
            this.value = $.trim(this.value);
        }
    );
});
