<?php
/**
 * Allow display name to be changeable.
 *
 * @author Kunoichi INC
 */

// Only redirect.
defined( 'ABSPATH' ) || die();

// If already loaded, simply return.
if ( defined( 'DISPLAY_NAME_CHANGEABLE_IN_WOOCOMMERCE' ) ) {
	return;
}
define( 'DISPLAY_NAME_CHANGEABLE_IN_WOOCOMMERCE', true );

/**
 * Allow display name to be user input.
 *
 * @param array $args
 * @param WC_Customer $customer
 * @return array
 */
function display_name_changeable_in_woocommerce_filter_arguments( $args, $customer ) {
	if ( ! isset( $args['display_name'] ) ) {
		return $args;
	}
	$name = $customer->get_display_name();
	if ( ! is_email( $name ) && ! empty( $name ) ) {
		$args['display_name'] = $name;
	}
	return $args;
}
add_filter( 'woocommerce_update_customer_args', 'display_name_changeable_in_woocommerce_filter_arguments', 11, 2 );
