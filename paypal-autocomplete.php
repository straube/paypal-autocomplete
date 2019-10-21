<?php

/**
 * Plugin Name:       PayPal Autocomplete Order
 * Plugin URI:        https://github.com/straube/paypal-autocomplete
 * Description:       WooCommerce plugin to autocomplete PayPal orders.
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Gustavo Straube
 * Author URI:        https://github.com/straube
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       paypal-autocomplete
 * Domain Path:       /languages
 */

/**
 * Autocomplete WooCommerce orders placed through PayPal Express Checkout.
 */
add_action('woocommerce_thankyou', 'paypal_autocomplete_order');

function paypal_autocomplete_order($order_id)
{
    if (!$order_id) {
        return;
    }

    $order = wc_get_order($order_id);

    // Doesn't complete the order if it was not paid through Pay Pal Express
    // Checkout.
    if ('ppec_paypal' !== $order->get_payment_method()) {
        return;
    }

    $order->update_status('completed');
}
