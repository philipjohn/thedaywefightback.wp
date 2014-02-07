<?php
global $tdwfb_options;

$tdwfb_options = get_option('tdwfb_plugin_options');


/**
 * tdwfb_plugin_menu function.
 *
 * @access public
 * @return void
 */
function tdwfb_plugin_menu() {
	add_options_page('TDWFB', 'TDWFB', 'manage_options', 'tdwfb', 'tdwfb_plugin_options_page' );

}
add_action('admin_menu', 'tdwfb_plugin_menu');
add_action('network_admin_menu', 'tdwfb_plugin_menu');


/**
 * tdwfb_plugin_admin_init function.
 *
 * @access public
 * @return void
 */
function tdwfb_plugin_admin_init() {
	register_setting( 'tdwfb_plugin_options', 'tdwfb_plugin_options', 'tdwfb_plugin_options_validate' );
	add_settings_section('general_section', 'General Options', 'tdwfb_section_general', __FILE__);

	//general options
	add_settings_field('greeting', 'Greeting Text', 'tdwfb_setting_greeting', __FILE__, 'general_section');
	add_settings_field('date', 'Disable Date', 'tdwfb_setting_date', __FILE__, 'general_section');
	add_settings_field('call', 'Call Form', 'tdwfb_setting_call', __FILE__, 'general_section');

}
add_action('admin_init', 'tdwfb_plugin_admin_init');


/**
 * tdwfb_plugin_options_page function.
 *
 * @access public
 * @return void
 */
function tdwfb_plugin_options_page() {
?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>The Day We Fight Back</h2>
		<form action="options.php" method="post">
			<?php settings_fields('tdwfb_plugin_options'); ?>
			<?php do_settings_sections(__FILE__); ?>
			<p class="submit">
				<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
			</p>
		</form>

	</div>
<?php
}


/**
 * tdwfb_section_general function.
 *
 * @access public
 * @return void
 */
function tdwfb_section_general() {

}


/**
 * tdwfb_plugin_options_validate function.
 *
 * @access public
 * @param mixed $input
 * @return void
 */
function tdwfb_plugin_options_validate($input) {

	$input['greeeting'] = strip_tags($input['greeeting']);

	return $input; // return validated input

}


/**
 * tdwfb_setting_greeting function.
 *
 * @access public
 * @return void
 */
function tdwfb_setting_greeting() {
	global $tdwfb_options;

	$text = !empty( $tdwfb_options['greeting'] ) ? $tdwfb_options['greeting'] : '' ;

	echo "<input id='greeting' name='tdwfb_plugin_options[greeting]' size='40' type='text' value='$text' />  ";
	_e('Please enter greeting text.', 'tdwfb');
}


/**
 * tdwfb_setting_date function.
 *
 * @access public
 * @return void
 */
function tdwfb_setting_date() {
	global $tdwfb_options;
	$checked = '';

	if( !empty( $tdwfb_options['date']) ) { $checked = ' checked="checked" '; }
	echo "<input ".$checked." id='responsive_css' name='tdwfb_plugin_options[date]' type='checkbox' />	 ";
	_e('Disable the date and display banner now.', 'tdwfb');

}


/**
 * tdwfb_setting_call function.
 *
 * @access public
 * @return void
 */
function tdwfb_setting_call() {
	global $tdwfb_options;
	$checked = '';

	if( !empty( $tdwfb_options['call']) ) { $checked = ' checked="checked" '; }
	echo "<input ".$checked." id='responsive_css' name='tdwfb_plugin_options[call]' type='checkbox' />	 ";
	_e('Only display a form for calling congress.', 'tdwfb');

}