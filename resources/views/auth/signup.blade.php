@extends('auth.layouts.app')

@section('content')
    <form class="form-horizontal tab-pane active" id="login-tab-signup" method="post" action="{{route('signup.post')}}">
        <input type="hidden" name="external_user_id" id="external_user_id_on_sign_up">
        <input type="hidden" name="external_provider_id" id="external_provider_id_on_sign_up">
        <input type="hidden" name="invite_member" value="">
        <input type="hidden" name="invite_hash" value="">
        <input type="hidden" name="validate" value="">
        @csrf
        <div class="modal-body">
            <div class="individual-sign-up-section">
                <div class="form-group">
                    <div class="col-sm-12"><h3>Sign up to your account</h3>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="col-sm-12" style="font-size: 16px;">
                        <div class="contact-type-selection">
                            <p style="margin: 0 0 .5em;">I am an</p>
                            <div class="btn-group btn-group-pills btn-group-pills-regular stay_inline">


                                <label class="radio-icon">
                                    <input type="radio" name="contact-type" class="validate[required]" value="1" id="form-validation-field-1">
                                    <span class="radio-icon-unchecked btn"><span>Individual</span></span>
                                    <span class="radio-icon-checked btn btn-primary"><span>Individual</span></span>
                                </label>

                                <label class="radio-icon">
                                    <input type="radio" name="contact-type" class="validate[required]" value="2" id="form-validation-field-0">
                                    <span class="radio-icon-unchecked btn"><span>Organisation</span></span>
                                    <span class="radio-icon-checked btn btn-primary"><span>Organisation</span></span>
                                </label>
                            </div><div class="btn-group btn-group-pills btn-group-pills-regular stay_inline individual_role_selection mt-3 mb-0 hidden">

                            </div>                                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-6">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label label--mandatory">First name</span>
                            <input type="text" id="first-name" name="first_name" value="" maxlength="100" class="validate[required]" placeholder="First name:*">
                        </label>

                    </div>

                    <div class="col-xs-6">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label label--mandatory">Last name</span>
                            <input type="text" id="last-name" name="last_name" value="" maxlength="100" class="validate[required]" placeholder="Last name:*">
                        </label>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label label--mandatory">Your email</span>
                            <input type="text" id="email" name="email" value="" maxlength="80" class="validate[required,custom[email]]" placeholder="Your email:*">
                        </label>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 login-password-wrapper">

                        <input type="hidden" name="can_view_password" value="1">

                        <label class="input_group">

                                                        <span class="form-input form-input--text form-input--pseudo">
                                                            <span class="form-input--pseudo-label label--mandatory">Password</span>
                                                            <input type="password" id="pswd" name="password" value="" maxlength="40" class="validate[required, custom[customPassword]] password-with_meter" placeholder="Password:*">
                                                        </span>

                            <span class="input_group-icon">                                            <span class="view-pwd">
                                                                <button type="button" class="btn-link button--plain showPass" data-target="#pswd">
                                                                    <span class="sr-only">Show password?</span>

                                                                    <span class="fa fa-eye icon icon-eye" aria-hidden="true"></span>
                                                                </button>
                                                            </span>
                                                        </span>
                        </label>

                        <div class="password-info hidden">
                            <div>
                                <button type="button" class="button--plain password-info-close">
                                    <span class="icon_close" aria-hidden="true"></span>
                                </button>

                                <div class="password-strength">
                                    <h4>Password strength: <span class="password-strength-result">Weak</span></h4>

                                    <div class="password-strength-meter">
                                        <span class="password-strength-meter-weak" data-label="Weak"></span>
                                        <span class="password-strength-meter-good hidden" data-label="Good"></span>
                                        <span class="password-strength-meter-strong hidden" data-label="Strong"></span>
                                    </div>
                                </div>
                            </div>

                            <ul>
                                <li class="password-strength-length  invalid">Be at least eight characters</li>
                                <li class="password-strength-letter  invalid">Have at least one lower case letter</li>
                                <li class="password-strength-capital invalid">Have at least one upper case letter</li>
                                <li class="password-strength-number  invalid">Have at least one number</li>
                            </ul>
                        </div>                                    </div>
                </div>

            </div>
            <div class="org-sign-up-section hidden">
                <div class="form-group">
                    <div class="col-sm-12"><h3>Please enter your job title &amp; organisation details - this
                            will help us to personalise our service.</h3></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label label--mandatory">Job title</span>
                            <input type="text" id="job_title" name="job_title" value="" maxlength="100" class="validate[required]" placeholder="Job title:*">
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label label--mandatory">Organisation name</span>
                            <input type="text" id="org-name" name="org_name" value="" maxlength="100" class="validate[required]" placeholder="Organisation name:*">
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">

                        <!-- Label and no icon -->

                        <label class="form-select">

                                                        <span class="form-input form-input--select form-input--pseudo form-input--active">
                                                            <span class="form-input--pseudo-label">Industry</span>
                                                            <select id="org-industry" name="org_industry">
                                                                <option value="">Please select</option>
                                                                <option value="1">Agriculture</option>
                                                                <option value="2">Arts</option>
                                                                <option value="3">Construction</option>
                                                                <option value="4">Corporate Services</option>
                                                                <option value="5">Design</option>
                                                                <option value="6">Education</option>
                                                                <option value="7">Energy &amp; Mining</option>
                                                                <option value="8">Entertainment</option>
                                                                <option value="9">Finance</option>
                                                                <option value="10">Hardware &amp; Networking</option>
                                                                <option value="11">Healthcare</option>
                                                                <option value="12">Hospitality</option>
                                                                <option value="13">Legal</option>
                                                                <option value="14">Manufacturing</option>
                                                                <option value="15">Media &amp; Communications</option>
                                                                <option value="16">Non-profit</option>
                                                                <option value="17">Public administration</option>
                                                                <option value="18">Public safety</option>
                                                                <option value="19">Real estate</option>
                                                                <option value="20">Retail</option>
                                                                <option value="21">Software &amp; IT services</option>
                                                                <option value="22">Transportation &amp; logistics</option>
                                                                <option value="23">Travel</option>
                                                                <option value="24">Wellness &amp; Fitness</option>
                                                            </select>        </span>
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">

                        <!-- Label and no icon -->

                        <label class="form-select">

                                                        <span class="form-input form-input--select form-input--pseudo form-input--active">
                                                            <span class="form-input--pseudo-label">Organisation size</span>
                                                            <select id="org-size" name="org_size">
                                                                <option value="">Please select</option>
                                                                <option value="1">1 - 25</option>
                                                                <option value="2">26 - 50</option>
                                                                <option value="3">51 - 100</option>
                                                                <option value="4">101 - 500</option>
                                                                <option value="5">501 - 1000</option>
                                                                <option value="6">More than 1000</option>
                                                            </select>        </span>
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">

                        <!-- Label and no icon -->

                        <label class="form-select">

                                                        <span class="form-input form-input--select form-input--pseudo form-input--active">
                                                            <span class="form-input--pseudo-label">Job function</span>
                                                            <select id="job-function" name="job_function">
                                                                <option value="">Please select</option>
                                                                <option value="1">Accounting &amp; Finance</option>
                                                                <option value="2">Administrative</option>
                                                                <option value="3">Business Development &amp; Sales</option>
                                                                <option value="4">Consulting</option>
                                                                <option value="5">Engineering</option>
                                                                <option value="6">Human Resources</option>
                                                                <option value="7">Information Technology</option>
                                                                <option value="8">Learning &amp; Development</option>
                                                                <option value="9">Legal</option>
                                                                <option value="10">Marketing</option>
                                                                <option value="11">Operations</option>
                                                                <option value="12">Program &amp; Product Management</option>
                                                                <option value="13">Purchasing</option>
                                                                <option value="14">Research</option>
                                                                <option value="15">Support</option>
                                                            </select>        </span>
                        </label>

                    </div>
                </div>
            </div>
            <div class="org-check-section hidden">
                <div class="simplebox" id="existing_organisations">
                    <p>Please choose any entries below that match you organisation info</p>

                </div>
            </div>
            <div class="org-details-section hidden">
                <input type="hidden" name="selected_organisation" id="selected_organisation" value="">
                <input type="hidden" name="synced_organisation" id="synced_organisation" value="">
                <input type="hidden" name="domain_blacklisted" id="domain_blacklisted" value="">
                <input type="hidden" name="signup" id="signup" value="">
                <div class="form-group">
                    <div class="col-sm-12">

                        <label class="form-input form-input--text form-input--pseudo disabled">
                            <span class="form-input--pseudo-label label--mandatory">Organisation Name</span>
                            <input type="text" id="org-details-name" name="organisation_name" value="" class="validate[required]" disabled="disabled" placeholder="Organisation Name:*">
                        </label>

                    </div>
                </div>
                <div class="form-group hidden">
                    <div class="col-sm-4">
                        <label class="form-input form-input--text form-input--pseudo disabled">
                            <span class="form-input--pseudo-label">www</span>
                            <input type="text" id="org-details-www" name="www" value="" class="" disabled="disabled" placeholder="www:">
                        </label>


                    </div>
                    <div class="col-sm-8">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label">Organisation Website</span>
                            <input type="text" id="org-details-domain-name" name="domain_name" value="" class="" placeholder="Organisation Website:">
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label label--mandatory">Address 1</span>
                            <input type="text" id="org-details-address1" name="address1" value="" class="validate[required]" placeholder="Address 1:*">
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label">Address 2</span>
                            <input type="text" id="org-details-address2" name="address2" value="" placeholder="Address 2:">
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label">Address 3</span>
                            <input type="text" id="org-details-address3" name="address3" value="" placeholder="Address 3:">
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">

                        <!-- Label and no icon -->

                        <label class="form-select">

                                                        <span class="form-input form-input--select form-input--pseudo form-input--active">
                                                            <span class="form-input--pseudo-label label--mandatory">Country</span>
                                                            <select id="org-details-country" name="country" class="validate[required]">
                                                                <option value="">Please select...</option>
                                                                <option value="AF">Afghanistan</option>
                                                                <option value="AL">Albania</option>
                                                                <option value="DZ">Algeria</option>
                                                                <option value="AS">American Samoa</option>
                                                                <option value="AD">Andorra</option>
                                                                <option value="AO">Angola</option>
                                                                <option value="AI">Anguilla</option>
                                                                <option value="AQ">Antarctica</option>
                                                                <option value="AG">Antigua And Barbuda</option>
                                                                <option value="AR">Argentina</option>
                                                                <option value="AM">Armenia</option>
                                                                <option value="AW">Aruba</option>
                                                                <option value="AU">Australia</option>
                                                                <option value="AT">Austria</option>
                                                                <option value="AZ">Azerbaijan</option>
                                                                <option value="BS">Bahamas</option>
                                                                <option value="BH">Bahrain</option>
                                                                <option value="BD">Bangladesh</option>
                                                                <option value="BB">Barbados</option>
                                                                <option value="BY">Belarus</option>
                                                                <option value="BE">Belgium</option>
                                                                <option value="BZ">Belize</option>
                                                                <option value="BJ">Benin</option>
                                                                <option value="BM">Bermuda</option>
                                                                <option value="BT">Bhutan</option>
                                                                <option value="BO">Bolivia</option>
                                                                <option value="BA">Bosnia And Herzegovina</option>
                                                                <option value="BW">Botswana</option>
                                                                <option value="BR">Brazil</option>
                                                                <option value="IO">British Indian Ocean Territory</option>
                                                                <option value="BN">Brunei Darussalam</option>
                                                                <option value="BG">Bulgaria</option>
                                                                <option value="BF">Burkina Faso</option>
                                                                <option value="BI">Burundi</option>
                                                                <option value="CV">Cabo Verde</option>
                                                                <option value="KH">Cambodia</option>
                                                                <option value="CM">Cameroon</option>
                                                                <option value="CA">Canada</option>
                                                                <option value="KY">Cayman Islands</option>
                                                                <option value="CF">Central African Republic</option>
                                                                <option value="TD">Chad</option>
                                                                <option value="CL">Chile</option>
                                                                <option value="CN">China</option>
                                                                <option value="CX">Christmas Island</option>
                                                                <option value="CC">Cocos (keeling) Islands</option>
                                                                <option value="CO">Colombia</option>
                                                                <option value="KM">Comoros</option>
                                                                <option value="CG">Congo</option>
                                                                <option value="CD">Congo, The Democratic Republic Of The</option>
                                                                <option value="CK">Cook Islands</option>
                                                                <option value="CR">Costa Rica</option>
                                                                <option value="CI">Cote D Ivoire</option>
                                                                <option value="HR">Croatia</option>
                                                                <option value="CU">Cuba</option>
                                                                <option value="CW">Curasao</option>
                                                                <option value="CY">Cyprus</option>
                                                                <option value="CZ">Czech Republic</option>
                                                                <option value="DK">Denmark</option>
                                                                <option value="DJ">Djibouti</option>
                                                                <option value="DM">Dominica</option>
                                                                <option value="DO">Dominican Republic</option>
                                                                <option value="EC">Ecuador</option>
                                                                <option value="EG">Egypt</option>
                                                                <option value="SV">El Salvador</option>
                                                                <option value="ENG">England</option>
                                                                <option value="GQ">Equatorial Guinea</option>
                                                                <option value="ER">Eritrea</option>
                                                                <option value="EE">Estonia</option>
                                                                <option value="SZ">Eswatini</option>
                                                                <option value="ET">Ethiopia</option>
                                                                <option value="FK">Falkland Islands (malvinas)</option>
                                                                <option value="FO">Faroe Islands</option>
                                                                <option value="FJ">Fiji</option>
                                                                <option value="FI">Finland</option>
                                                                <option value="FR">France</option>
                                                                <option value="GF">French Guiana</option>
                                                                <option value="PF">French Polynesia</option>
                                                                <option value="TF">French Southern Territories</option>
                                                                <option value="GA">Gabon</option>
                                                                <option value="GM">Gambia</option>
                                                                <option value="GE">Georgia</option>
                                                                <option value="DE">Germany</option>
                                                                <option value="GH">Ghana</option>
                                                                <option value="GI">Gibraltar</option>
                                                                <option value="GR">Greece</option>
                                                                <option value="GL">Greenland</option>
                                                                <option value="GD">Grenada</option>
                                                                <option value="GP">Guadeloupe</option>
                                                                <option value="GU">Guam</option>
                                                                <option value="GT">Guatemala</option>
                                                                <option value="GN">Guinea</option>
                                                                <option value="GW">Guinea-bissau</option>
                                                                <option value="GY">Guyana</option>
                                                                <option value="HT">Haiti</option>
                                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                                <option value="VA">Holy See (vatican City State)</option>
                                                                <option value="HN">Honduras</option>
                                                                <option value="HK">Hong Kong</option>
                                                                <option value="HU">Hungary</option>
                                                                <option value="IS">Iceland</option>
                                                                <option value="IN">India</option>
                                                                <option value="ID">Indonesia</option>
                                                                <option value="IR">Iran, Islamic Republic Of</option>
                                                                <option value="IQ">Iraq</option>
                                                                <option value="IE">Ireland</option>
                                                                <option value="IL">Israel</option>
                                                                <option value="IT">Italy</option>
                                                                <option value="JM">Jamaica</option>
                                                                <option value="JP">Japan</option>
                                                                <option value="JO">Jordan</option>
                                                                <option value="KZ">Kazakhstan</option>
                                                                <option value="KE">Kenya</option>
                                                                <option value="KI">Kiribati</option>
                                                                <option value="KP">Korea Democratic Peoples Republic Of</option>
                                                                <option value="KR">Korea Republic Of</option>
                                                                <option value="KW">Kuwait</option>
                                                                <option value="KG">Kyrgyzstan</option>
                                                                <option value="LA">Lao Peoples Democratic Republic</option>
                                                                <option value="LV">Latvia</option>
                                                                <option value="LB">Lebanon</option>
                                                                <option value="LS">Lesotho</option>
                                                                <option value="LR">Liberia</option>
                                                                <option value="LY">Libyan Arab Jamahiriya</option>
                                                                <option value="LI">Liechtenstein</option>
                                                                <option value="LT">Lithuania</option>
                                                                <option value="LU">Luxembourg</option>
                                                                <option value="MO">Macao</option>
                                                                <option value="MG">Madagascar</option>
                                                                <option value="MW">Malawi</option>
                                                                <option value="MY">Malaysia</option>
                                                                <option value="MV">Maldives</option>
                                                                <option value="ML">Mali</option>
                                                                <option value="MT">Malta</option>
                                                                <option value="MH">Marshall Islands</option>
                                                                <option value="MQ">Martinique</option>
                                                                <option value="MR">Mauritania</option>
                                                                <option value="MU">Mauritius</option>
                                                                <option value="YT">Mayotte</option>
                                                                <option value="MX">Mexico</option>
                                                                <option value="FM">Micronesia, Federated States Of</option>
                                                                <option value="MD">Moldova, Republic Of</option>
                                                                <option value="MC">Monaco</option>
                                                                <option value="MN">Mongolia</option>
                                                                <option value="ME">Montenegro</option>
                                                                <option value="MS">Montserrat</option>
                                                                <option value="MA">Morocco</option>
                                                                <option value="MZ">Mozambique</option>
                                                                <option value="MM">Myanmar</option>
                                                                <option value="NA">Namibia</option>
                                                                <option value="NR">Nauru</option>
                                                                <option value="NP">Nepal</option>
                                                                <option value="NL">Netherlands</option>
                                                                <option value="AN">Netherlands Antilles</option>
                                                                <option value="NC">New Caledonia</option>
                                                                <option value="NZ">New Zealand</option>
                                                                <option value="NI">Nicaragua</option>
                                                                <option value="NE">Niger</option>
                                                                <option value="NG">Nigeria</option>
                                                                <option value="NU">Niue</option>
                                                                <option value="NF">Norfolk Island</option>
                                                                <option value="NIR">Northern Ireland</option>
                                                                <option value="MP">Northern Mariana Islands</option>
                                                                <option value="NO">Norway</option>
                                                                <option value="OM">Oman</option>
                                                                <option value="PK">Pakistan</option>
                                                                <option value="PW">Palau</option>
                                                                <option value="PS">Palestine</option>
                                                                <option value="PA">Panama</option>
                                                                <option value="PG">Papua New Guinea</option>
                                                                <option value="PY">Paraguay</option>
                                                                <option value="PE">Peru</option>
                                                                <option value="PH">Philippines</option>
                                                                <option value="PN">Pitcairn</option>
                                                                <option value="PL">Poland</option>
                                                                <option value="PT">Portugal</option>
                                                                <option value="PR">Puerto Rico</option>
                                                                <option value="QA">Qatar</option>
                                                                <option value="MK">Republic of North Macedonia</option>
                                                                <option value="RE">Reunion</option>
                                                                <option value="RO">Romania</option>
                                                                <option value="RU">Russian Federation</option>
                                                                <option value="RW">Rwanda</option>
                                                                <option value="BL">Saint Barthelemy</option>
                                                                <option value="SH">Saint Helena</option>
                                                                <option value="KN">Saint Kitts And Nevis</option>
                                                                <option value="LC">Saint Lucia</option>
                                                                <option value="MF">Saint Martin</option>
                                                                <option value="PM">Saint Pierre And Miquelon</option>
                                                                <option value="VC">Saint Vincent And The Grenadines</option>
                                                                <option value="WS">Samoa</option>
                                                                <option value="SM">San Marino</option>
                                                                <option value="ST">Sao Tome And Principe</option>
                                                                <option value="SA">Saudi Arabia</option>
                                                                <option value="SCT">Scotland</option>
                                                                <option value="SN">Senegal</option>
                                                                <option value="RS">Serbia</option>
                                                                <option value="SC">Seychelles</option>
                                                                <option value="SL">Sierra Leone</option>
                                                                <option value="SG">Singapore</option>
                                                                <option value="SK">Slovakia</option>
                                                                <option value="SI">Slovenia</option>
                                                                <option value="SB">Solomon Islands</option>
                                                                <option value="SO">Somalia</option>
                                                                <option value="ZA">South Africa</option>
                                                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                                <option value="SS">South Sudan</option>
                                                                <option value="ES">Spain</option>
                                                                <option value="LK">Sri Lanka</option>
                                                                <option value="SD">Sudan</option>
                                                                <option value="SR">Suriname</option>
                                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                                <option value="SE">Sweden</option>
                                                                <option value="CH">Switzerland</option>
                                                                <option value="SY">Syrian Arab Republic</option>
                                                                <option value="TW">Taiwan, Province Of China</option>
                                                                <option value="TJ">Tajikistan</option>
                                                                <option value="TZ">Tanzania, United Republic Of</option>
                                                                <option value="TH">Thailand</option>
                                                                <option value="TL">Timor-Leste</option>
                                                                <option value="TG">Togo</option>
                                                                <option value="TK">Tokelau</option>
                                                                <option value="TO">Tonga</option>
                                                                <option value="TT">Trinidad And Tobago</option>
                                                                <option value="TN">Tunisia</option>
                                                                <option value="TR">Turkey</option>
                                                                <option value="TM">Turkmenistan</option>
                                                                <option value="TC">Turks And Caicos Islands</option>
                                                                <option value="TV">Tuvalu</option>
                                                                <option value="UG">Uganda</option>
                                                                <option value="UA">Ukraine</option>
                                                                <option value="AE">United Arab Emirates</option>
                                                                <option value="GB">United Kingdom</option>
                                                                <option value="UM">United States Minor Outlying Islands</option>
                                                                <option value="US">United States of America</option>
                                                                <option value="UY">Uruguay</option>
                                                                <option value="UZ">Uzbekistan</option>
                                                                <option value="VU">Vanuatu</option>
                                                                <option value="VE">Venezuela</option>
                                                                <option value="VN">Viet Nam</option>
                                                                <option value="VG">Virgin Islands, British</option>
                                                                <option value="VI">Virgin Islands, U.s.</option>
                                                                <option value="WLS">Wales</option>
                                                                <option value="WF">Wallis And Futuna</option>
                                                                <option value="EH">Western Sahara</option>
                                                                <option value="YE">Yemen</option>
                                                                <option value="ZM">Zambia</option>
                                                                <option value="ZW">Zimbabwe</option>
                                                            </select>        </span>
                        </label>

                    </div>
                </div>
                <div class="form-group hidden">
                    <div class="col-sm-12">


                        <!-- Label and no icon -->

                        <label class="form-select">

                                                        <span class="form-input form-input--select form-input--pseudo form-input--active">
                                                            <span class="form-input--pseudo-label">County</span>
                                                            <select id="org-details-county" name="county">
                                                                <option value="">Please select...</option>
                                                                <option value="33">Antrim</option>
                                                                <option value="34">Armagh</option>
                                                                <option value="35">Carlow</option>
                                                                <option value="36">Cavan</option>
                                                                <option value="37">Clare</option>
                                                                <option value="38">Cork</option>
                                                                <option value="39">Derry</option>
                                                                <option value="40">Donegal</option>
                                                                <option value="41">Down</option>
                                                                <option value="42">Dublin</option>
                                                                <option value="43">Fermanagh</option>
                                                                <option value="44">Galway</option>
                                                                <option value="45">Kerry</option>
                                                                <option value="46">Kildare</option>
                                                                <option value="47">Kilkenny</option>
                                                                <option value="48">Laois</option>
                                                                <option value="49">Leitrim</option>
                                                                <option value="50">Limerick</option>
                                                                <option value="51">Longford</option>
                                                                <option value="52">Louth</option>
                                                                <option value="53">Mayo</option>
                                                                <option value="54">Meath</option>
                                                                <option value="55">Monaghan</option>
                                                                <option value="56">Offaly</option>
                                                                <option value="57">Roscommon</option>
                                                                <option value="58">Sligo</option>
                                                                <option value="59">Tipperary</option>
                                                                <option value="60">Tyrone</option>
                                                                <option value="61">Waterford</option>
                                                                <option value="62">Westmeath</option>
                                                                <option value="63">Wexford</option>
                                                                <option value="64">Wicklow</option>
                                                                <option value="65">Online</option>
                                                            </select>        </span>
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label label--mandatory">City</span>
                            <input type="text" id="org-details-city" name="city" value="" class="validate[required]" placeholder="City:*">
                        </label>

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="form-input form-input--text form-input--pseudo">
                            <span class="form-input--pseudo-label">Post Code</span>
                            <input type="text" id="org-details-post_code" name="postcode" value="" placeholder="Post Code:">
                        </label>

                    </div>
                </div>

            </div>
            <div class="form-group vertically_center login-disclaimer">
                <div class="col-xs-8 col-sm-9"><p>By signing up, you agree to the <a href=""><strong>privacy policy</strong></a> and <a href="https://courseco-demo.uat.courseco.co/terms-of-use.html"><strong>terms of use</strong></a>. <strong>Also note not to sign-up twice. This process is only required once.&nbsp;</strong></p></div>

                <div class="col-xs-4 col-sm-3" style="display: flex; justify-content: flex-end;">
                    <img src="{{asset('assets/images/comodo-secure-logo.png')}}" alt="Comodo Secure" style="width: 69px;height:39px;max-width:none;">
                </div>
            </div>
            <div class="form-group login-buttons">
                <div class="col-sm-12">
                    <button type="submit" class="button btn btn-lg btn--full btn-success" name="action" id="sign_up_button" value="register">Continue</button>
                </div>
            </div>
            <div class="form-group org-back-to-personal-details org-sign-up-section hidden mb-0">
                <div class="col-sm-12">
                    <button type="button" class="mobile-menu-back button--plain" id="mobile-menu-back" title="Back">
                        <strong>
                            <span class="icon-angle-left fa fa-angle-left"></span>
                            <span class="sr-only">Back</span>
                        </strong>
                    </button>
                    <strong class="org-sign-up-back-header" style="cursor: pointer;">Go back</strong>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('after-scripts')
    @if (config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@endsection
