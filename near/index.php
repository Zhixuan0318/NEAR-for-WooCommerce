<?php

get_header();

?>
    <div class="login-page-wrap">
        <div class="login-page-text-wrap">
            <div>
                <img src="<?php echo get_template_directory_uri () . '/images/near_logo.png'; ?>" />
                <h1> Where all the swag vibes begin </h1>
                <p>Get Member access to the best we have to offer, like first dibs on our newest products. RISEUP Experience and the daily inspiration and community you’ll need to keep pushing forward. When you’re with us, you’re a part of something bigger. Join the swag family and feel the vibes.</p>
            </div>

        </div>
        <div class="login-page-form-wrap" style=" overflow: auto;">
            <div class="near-login-loading" style="display: block; width: auto">
                <div class="lds-ripple"><div></div><div></div></div>
            </div>
            <div class="near-login-wrap" style="display: none; overflow: hidden; margin-top: -60px;">
                <h2 class="mb-10">Create an account</h2>
                <span style="    text-align: left !important; margin-top: 0 !important;">Already member? <a href="#">Sign In</a></span>
                <div class="form-control mt-20">
                    <label> email </label>
                    <input type="text" />
                </div>
                <div class="form-control mt-10">
                    <label> password </label>
                    <input type="text" />
                </div>
                <div class="form-control mt-10">
                    <label> confirm password </label>
                    <input type="text" />
                </div>
                <span class="term-and-condition mt-20">By clicking “Sign Up”, I agree that I have read and accepted the <a href="#">Terms of Service</a></span>
                <div class="form-control mt-20">
                    <input type="submit" value="Sign up" />
                </div>
                <span class="text-center mt-30 mb-30"> OR </span>
                <button data-network="<?php echo esc_attr(get_option('network')); ?>" data-address="<?php echo esc_attr(get_option('address')); ?>" class="near_login">
                </button>
            </div>

            <div class="near-dfetails-wrap" style="display: none">
                <div class="near-connect-step-two">
                    <span>Connect NEAR Wallet</span>
                    <span>Customer Account Setup</span>
                </div>
                <h1> Customer Account Setup </h1>
                <p> Bind your personal info with your NEAR-registered account. </p>
                <div class="near-accopunt-address">8ce08fed379fca70f53a36624805ae4c38c9cf1d96582ea491b1622e9377ef938ce08fed379fca70f53a36624805ae4c38c9cf1d96582ea491b1622e9377ef93</div>
                <h3> General Info </h3>
                <div class="form-control half first">
                    <label> First Name * </label>
                    <input name="first_name"  />
                </div>
                <div class="form-control half last">
                    <label> Last Name * </label>
                    <input name="last_name"  />
                </div>
                <div class="form-control">
                    <label> Company Name (Optional) </label>
                    <input name="company"  />
                </div>
                <div class="form-control">
                    <label> Email Address * </label>
                    <input name="company"  />
                </div>
                <div class="form-control">
                    <label> Phone * </label>
                    <input name="company"  />
                </div>
                <h3> Shipping Address </h3>
                <div class="form-control">
                    <label> Street Address * </label>
                    <input name="company"  />
                </div>
                <div class="form-control">
                    <label> Town/City * </label>
                    <input name="company"  />
                </div>
                <div class="form-control">
                    <label> State/Country * </label>
                    <input name="company"  />
                </div>
                <div class="form-control">
                    <label> Postcode/ZIP * </label>
                    <input name="company"  />
                </div>
                <div class="form-control checkbox">
                    <label> <input type="checkbox" /> Different address for billing </label>
                </div>
                <button class="near-login-bind">  </button>
                <span> Complete customer account setup later ->  </span>
            </div>
        </div>
    </div>
    <div class="near-popup-wrap" style="display: none">
        <div class="near-popup-block">
            <span>Personal info successfully binded with NEAR-registered account</span>
            <div class="near-accopunt-address">8ce08fed379fca70f53a36624805ae4c38c9cf1d96582ea491b1622e9377ef938ce08fed379fca70f53a36624805ae4c38c9cf1d96582ea491b1622e9377ef93</div>
            <button> Back to homepage </button>
            <small> Redirect in 5 secs </small>
        </div>
    </div>
<?php

get_footer ();