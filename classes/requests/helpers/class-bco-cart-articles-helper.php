<?php
/**
 * Articles helper.
 *
 * @package Billmate_Checkout/Classes/Helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Cart Articles helper class.
 */
class BCO_Cart_Articles_Helper {

	/**
	 * Get cart item article number.
	 *
	 * Returns SKU or product ID.
	 *
	 * @param object $product Product object.
	 * @return string $article_number Cart item article number.
	 */
	public static function get_article_number( $product ) {
		if ( $product->get_sku() ) {
			$article_number = $product->get_sku();
		} else {
			$article_number = $product->get_id();
		}

		return substr( (string) $article_number, 0, 64 ); // TODO: Check what the max character is here.
	}

	/**
	 * Get cart item title.
	 *
	 * @param array $cart_item Cart item.
	 * @return string $item_title Cart item title.
	 */
	public function get_title( $cart_item ) {
		$cart_item_data = $cart_item['data'];
		$item_title     = $cart_item_data->get_name();

		return strip_tags( $item_title ); //phpcs:ignore
	}

	/**
	 * Get cart item quantity
	 *
	 * @param array $cart_item Cart item.
	 * @return int $item_quantity Cart item quantity.
	 */
	public function get_quantity( $cart_item ) {
		return round( $cart_item['quantity'] );
	}

	/**
	 * Get cart item article price excluding tax
	 *
	 * @param array $cart_item Cart item.
	 * @return int $item_price Item price.
	 */
	public function get_article_price( $cart_item ) {
		$item_subtotal = wc_get_price_excluding_tax( $cart_item['data'] );
		$item_price    = number_format( $item_subtotal, wc_get_price_decimals(), '.', '' ) * 100;
		return round( $item_price );
	}

}
