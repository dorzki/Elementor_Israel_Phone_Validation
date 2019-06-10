<?php
/**
 * Main plugin file.
 *
 * @package    dorzki\Elementor\Israeli_Phone
 * @subpackage Plugin
 * @author     Dor Zuberi <webmaster@dorzki.co.il>
 * @version    1.0.0
 */

namespace dorzki\Elementor\Israeli_Phone;

// Block if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class Plugin
 *
 * @package dorzki\Elementor\Israeli_Phone
 */
class Plugin {

	/**
	 * Israeli Phone RegExp.
	 *
	 * @var string
	 */
	const FIELD_REGEX = '/^((0\d{1,2}\-\d{7})|(0\d{8,9}))$/';


	/* ------------------------------------------ */


	/**
	 * Plugin constructor.
	 */
	public function __construct() {

		add_action( 'elementor_pro/forms/validation/tel', [ $this, 'validate_phone' ], 10, 3 );

	}


	/* ------------------------------------------ */


	/**
	 * Validate phone format for israeli numbers.
	 *
	 * Supports:
	 * XX-XXXXXXX
	 * XXX-XXXXXXX
	 * XXXXXXXXX
	 * XXXXXXXXXX
	 *
	 * @param array        $field        Form field.
	 * @param Form_Record  $record       An instance of the form record.
	 * @param Ajax_Handler $ajax_handler An instance of the ajax handler.
	 */
	public function validate_phone( $field, $record, $ajax_handler ) {

		if ( preg_match( self::FIELD_REGEX, $field['value'] ) !== 1 ) {

			$ajax_handler->add_error( $field['id'], esc_html__( 'Phone number format is invalid, please enter the phone number without spaces and special chars.', 'dorzki-elm-phone' ) );

		}

	}

}

// Init class.
new Plugin();