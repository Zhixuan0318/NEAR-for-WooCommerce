<?php

    add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

    function enqueue_parent_styles() {
        wp_enqueue_style ( 'parent-style', get_template_directory_uri() . '/style.css', time () );

        wp_enqueue_script ( 'near-api', get_template_directory_uri() . '/js/near-api-js.min.js', array( 'jquery' ), time (), true);
        wp_enqueue_script ( 'script', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'near-api' ), time (), true);
    }

    add_action( 'admin_enqueue_scripts', 'admin_enqueue_parent_styles' );

    function admin_enqueue_parent_styles () {

        $data = Array (
                'main_logo' => get_template_directory_uri() . '/images/logo.svg',
                'product_url' => home_url() . '/product'
        );

        wp_enqueue_style ( 'near-cms', get_template_directory_uri() . '/admin.css', time () );

        wp_enqueue_script ( 'near-admin', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ), time (), true);
        wp_enqueue_script ( 'near-cms', get_template_directory_uri() . '/js/admin_lib.js', array( 'jquery', 'near-admin' ), time (), true);

        wp_localize_script( 'near-admin', 'NEAR_vars', $data );

    }

/**
 * Register a custom menu page.
 */
function wpdocs_register_my_custom_menu_page(){
    add_menu_page(
        __( 'NEAR for WooCommerce', 'textdomain' ),
        'NEAR for WC',
        'manage_options',
        'custompage',
        'my_custom_menu_page',
        get_template_directory_uri() . '/images/logo purple (1).png',
        6
    );
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

/**
 * Display a custom menu page
 */
function my_custom_menu_page(){
    ?>
    <div id="near-root"></div>
    <?php
}

add_action('admin_menu', 'near_pay_setup_menu');

function near_pay_setup_menu()
{
    add_menu_page('NEAR Pay', 'NEAR Pay', 'manage_options', 'near-pay', 'near_pay_init');
}

function near_pay_init()
{
    ?>
    <div class="wrap">
        <h2>NEAR Pay</h2>
        <div class="np-description">
            <p>
                <a href="https://near.org/" target="_blank"><b>NEAR</b></a>
                is a decentralized application platform which is built atop the NEAR Protocol, a revolutionary public proof-of-stake blockchain
                which uses sharding to scale and an innovative account model to make apps similarly usable to those on today’s web.
            </p>

            <p><b>Don't have NEAR wallet?</b> <br>
                You can create it in few minutes: <br>
                - Create mainnet wallet: <a href="https://wallet.near.org/create" target="_blank">https://wallet.near.org/</a><br>
                - Create testnet wallet: <a href="https://wallet.testnet.near.org/create" target="_blank">https://wallet.testnet.near.org/</a>
            </p>
            <b>To use this Plugin:</b> <br>
            1. Provide your NEAR wallet address, select Network and save changes.<br>
            2. Add shortcode to any Post or Page: <code>[near_pay]</code><br>
            <p>Additionally you can customize payment amount (5 NEAR in this example): <code>[near_pay amount=5]</code> <br>
                and text on the button: <code>[near_pay text="Make a Payment with NEAR"]</code>.</p>
            <hr class="np-divider">
        </div>

        <h2 class="np-settings-subtitle">Settings</h2>
        <form action="options.php" method="post" class="np-form"><?php
            settings_fields('near_pay');
            do_settings_sections('near_pay'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">NEAR Network: <sup>*</sup></th>
                    <td>
                        <fieldset>
                            <select name="network">
                                <option value="test" <?php echo (esc_attr(get_option('network')) == 'test') ? "selected" : ""; ?>>TestNet</option>
                                <option value="main" <?php echo (esc_attr(get_option('network')) == 'main') ? "selected" : ""; ?>>MainNet</option>
                            </select>
                            <label>
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">NEAR Wallet: <sup>*</sup></th>
                    <td>
                        <fieldset>
                            <label>
                                <input name="address" type="text" id="address" value="<?php echo esc_attr(get_option('address')); ?>" />
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Show Logout button: <sup>*</sup></th>
                    <td>
                        <fieldset>
                            <label>
                                <select name="logout">
                                    <option value="" <?php echo (esc_attr(get_option('logout')) == '') ? "selected" : ""; ?>>No</option>
                                    <option value="yes" <?php echo (esc_attr(get_option('logout')) == 'yes') ? "selected" : ""; ?>>Yes</option>
                                </select>
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function near_pay_settings()
{
    register_setting('near_pay', 'address');
    register_setting('near_pay', 'network');
    register_setting('near_pay', 'logout');
}