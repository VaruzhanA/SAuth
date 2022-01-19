<footer class="footer" id="footer">
    <div class="footer-stats clearfix">
        <div class="footer-logo">
            <img src="{{asset('assets/images/sauth-m-logo.png')}}" alt="">
        </div>

        <p class="footer-slogan">Book. Train. Learn.</p>

        <div class="footer-stats-row clearfix">
            <ul class="footer-stats-list">
                <li class="footer-stat"><h2>20</h2>
                    <h3>Teachers</h3>
                    <p>&nbsp;</p>
                </li>
                <li class="footer-stat"><h2>12</h2>
                    <h3>Rooms</h3>
                </li>
                <li class="footer-stat"><h2>60</h2>
                    <h3>Courses</h3>
                </li>
                <li class="footer-stat"><h2>16</h2>
                    <h3>Subjects</h3>
                </li>
                <li class="footer-stat"><h2>30</h2>
                    <h3>Years</h3>
                </li>
            </ul>
        </div>
    </div>

    <div class="footer-social">
        <div class="row">
            <h2>Follow us</h2>

            <ul class="social-icons">
                <li>
                    <a target="_blank" href="http://facebook.com/testing" title="Facebook">
                        <span class="show-for-sr">Facebook</span>
                        <span class="social-icon social-icon--facebook"></span>
                    </a>
                </li>

                <li>
                    <a target="_blank" href="http://twitter.com/testing" title="Twitter">
                        <span class="show-for-sr">Twitter</span>
                        <span class="social-icon social-icon--twitter"></span>
                    </a>
                </li>

                <li>
                    <a target="_blank" href="http://snapchat.com/add/testing" title="Snapchat">
                        <span class="show-for-sr">Snapchat</span>
                        <span class="social-icon social-icon--snapchat"></span>
                    </a>
                </li>

                <li>
                    <a target="_blank" href="http://instagram.com/testing" title="Instagram">
                        <span class="show-for-sr">Instagram</span>
                        <span class="social-icon social-icon--instagram"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <div class="hidden--tablet hidden--desktop hidden-sm hidden-md hidden-lg hidden-xl">
        <div class="footer-credit_cards">
            <img src="{{asset('assets/images/visa_logo.png')}}" alt="Visa" title="Visa">
            <img src="{{asset('assets/images/master_card_logo.png')}}" alt="MasterCard" title="MasterCard"></div>
    </div>

    <div class="footer-columns">
        <div class="container">
            <div class="row gutters w-100">
                <div class="footer-column has_sublist footer-column--contact">
                    <button type="button" class="footer-column-title">Contact details</button>
                    <ul class="footer-column-content">
                        <li>
                            <h4>Name of business</h4>
                            <span class="footer-address-line">Address, City, County</span>
                            <span class="footer-address-line">Phone Number</span>
                        </li>

                        <li>
                            <dl class="footer-contact-items clearfix">
                            </dl>
                        </li>
                    </ul>
                </div>

                <div class="footer-column has_sublist" data-group="Terms &amp; Conditions">
                    <button type="button" class="footer-column-title">Terms &amp; Conditions</button>
                    <ul class="footer-column-content">
                        <li>
                            <a href="#">Privacy Policy</a>
                        </li>
                    </ul>
                </div>


                <div class="footer-column has_sublist footer-column--newsletter">
                    <button type="button" class="footer-column-title">Newsletter signup</button>

                    <form class="footer-column-content newsletter-signup-form" id="form-newsletter" method="post">

                        <div class="form-group">
                            <input type="text" class="form-input validate[required]" id="newsletter-form-first-name"
                                   name="newsletter_signup_form_first_name" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input validate[required]" id="newsletter-form-last-name"
                                   name="newsletter_signup_form_last_name" placeholder="Last Name">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-input validate[required,custom[email]]"
                                   id="newsletter-form-email" name="newsletter_signup_form_email_address"
                                   placeholder="E-mail">
                        </div>

                        <div class="form-group">
                            <label class="newsletter-signup-terms d-flex">
                                <label class="form-checkbox">
                                    <input type="checkbox" name="terms" value="1" class="validate[required]">
                                    <span class="form-checkbox-helper"></span>
                                </label>
                                <div class="newsletter-signup-terms-text"><p>&nbsp;</p>
                                    <p><strong>(Change the text here)</strong><br>&nbsp;</p>
                                    <p>&nbsp;</p>
                                </div>
                            </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="button button--newsletter" id="submit-newsletter">Submit
                            </button>
                        </div>
                    </form>

                    <div class="hidden--mobile hidden-xs">
                        <div class="footer-credit_cards">
                            <img src="{{asset('assets/images/visa_logo.png')}}" alt="Visa" title="Visa">
                            <img src="{{asset('assets/images/master_card_logo.png')}}" alt="MasterCard" title="MasterCard">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="footer-copyright">
        <div class="row">
            <div class="footer-copyright-company">© Copyright 2022</div>
        </div>
    </div>
</footer>
