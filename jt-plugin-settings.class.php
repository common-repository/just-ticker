<?php


class JT_Plugin_Settings {
	
	private $jt_setting;
	/**
	 * Construct me
	 */
	public function __construct() {
		$this->jt_setting = get_option( 'jt_setting', '' );
		
		// register the checkbox
		add_action('admin_init', array( $this, 'register_settings' ) );
	}
		
	/**
	 * Setup the settings
	 * 
	 * Add a single checkbox setting for Active/Inactive and a text field 
	 * just for the sake of our demo
	 * 
	 */
	public function register_settings() {
		register_setting( 'jt_setting', 'jt_setting', array( $this, 'jt_validate_settings' ) );
		
		add_settings_section(
			'jt_settings_section',         // ID used to identify this section and with which to register options
			'Just Ticker Options',                  // Title to be displayed on the administration page
			array($this, 'jt_settings_callback'), // Callback used to render the description of the section
			'jt-plugin-base'                           // Page on which to add this section of options
		);
	
		add_settings_field(
			'jt_opt_in',                      // ID used to identify the field throughout the theme
			__( 'Active', 'jtbase' ),                           // The label to the left of the option interface element
			array( $this, 'jt_opt_in_callback' ),   // The name of the function responsible for rendering the option interface
			'jt-plugin-base',                          // The page on which this option will be displayed
			'jt_settings_section'         // The name of the section to which this field belongs
		);
		
		add_settings_field(
			'jt_position',                      // ID used to identify the field throughout the theme
			__( 'Ticker Position', 'jtbase' ),                           // The label to the left of the option interface element
			array( $this, 'jt_position_callback' ),   // The name of the function responsible for rendering the option interface
			'jt-plugin-base',                          // The page on which this option will be displayed
			'jt_settings_section'         // The name of the section to which this field belongs
		);

		add_settings_field(
			'jt_postcount',                      // ID used to identify the field throughout the theme
			__( 'Number of Posts', 'jtbase' ),                           // The label to the left of the option interface element
			array( $this, 'jt_postcount_callback' ),   // The name of the function responsible for rendering the option interface
			'jt-plugin-base',                          // The page on which this option will be displayed
			'jt_settings_section'         // The name of the section to which this field belongs
		);

		

		add_settings_section(
			'jt_fade_section',         // ID used to identify this section and with which to register options
			'Effect Options',                  // Title to be displayed on the administration page
			array($this, 'jt_fade_callback'), // Callback used to render the description of the section
			'jt-plugin-base'                           // Page on which to add this section of options
		);

		add_settings_field(
			'jt_stayfor',                      // ID used to identify the field throughout the theme
			__( 'Stay visible time', 'jtbase' ),                           // The label to the left of the option interface element
			array( $this, 'jt_stayfor_callback' ),   // The name of the function responsible for rendering the option interface
			'jt-plugin-base',                          // The page on which this option will be displayed
			'jt_fade_section'         // The name of the section to which this field belongs
		);

		add_settings_field(
			'jt_delayfor',                      // ID used to identify the field throughout the theme
			__( 'Delay time', 'jtbase' ),                           // The label to the left of the option interface element
			array( $this, 'jt_delayfor_callback' ),   // The name of the function responsible for rendering the option interface
			'jt-plugin-base',                          // The page on which this option will be displayed
			'jt_fade_section'         // The name of the section to which this field belongs
		);

		add_settings_field(
			'jt_fadeinspeed',                      // ID used to identify the field throughout the theme
			__( 'Fade-in time', 'jtbase' ),                           // The label to the left of the option interface element
			array( $this, 'jt_fadeinspeed_callback' ),   // The name of the function responsible for rendering the option interface
			'jt-plugin-base',                          // The page on which this option will be displayed
			'jt_fade_section'         // The name of the section to which this field belongs
		);

		add_settings_field(
			'jt_fadeoutspeed',                      // ID used to identify the field throughout the theme
			__( 'Fade-out time', 'jtbase' ),                           // The label to the left of the option interface element
			array( $this, 'jt_fadeoutspeed_callback' ),   // The name of the function responsible for rendering the option interface
			'jt-plugin-base',                          // The page on which this option will be displayed
			'jt_fade_section'         // The name of the section to which this field belongs
		);
	}
	
	public function jt_settings_callback() {
		echo _e( 'Customize the ticker here.', 'jtbase' );
	}

	public function jt_fade_callback() {
		echo _e( 'Customize the fade-in/fade-out effect.', 'jtbase' );
	}
	
	public function jt_opt_in_callback() {
		$enabled = false;
		$out = ''; 
		
		// check if checkbox is checked
		if(! empty( $this->jt_setting ) && isset ( $this->jt_setting['jt_opt_in'] ) ) {
			$val = true;
		}
		
		// if($val) {
		// 	$out = '<input type="checkbox" id="jt_opt_in" name="jt_setting[jt_opt_in]" CHECKED  />';
		// } else {
		// 	$out = '<input type="checkbox" id="jt_opt_in" name="jt_setting[jt_opt_in]" />';
		// }
		$out = '<input type="checkbox" id="jt_opt_in" name="jt_setting[jt_opt_in]" '.( $val ? 'checked="checked"':'' ).'  />';
		
		echo $out;
	}
	
	public function jt_position_callback() {
		$out = '';
		$val = '';
		
		// check if checkbox is checked
		if(! empty( $this->jt_setting ) && isset ( $this->jt_setting['jt_position'] ) ) {
			$val = $this->jt_setting['jt_position'];
		}
		if(! empty( $this->jt_setting ) && isset ( $this->jt_setting['jt_css_position'] ) ) {
			$valcss = $this->jt_setting['jt_css_position'];
		}

		//$out = '<input type="text" id="jt_position" name="jt_setting[jt_position]" value="' . $val . '"  />';
		$out = '<select id="jt_position" name="jt_setting[jt_position]">';
		$out .= '<option value="top"'.($val=='top' ? ' selected="selected" ' : false).'>Top</option>';
		$out .= '<option value="bottom"'.($val=='bottom' ? ' selected="selected" ' : false).'>Bottom</option>';
		$out .= '</select>';
		$out .= '<select id="jt_css_position" name="jt_setting[jt_css_position]">';
		$out .= '<option value="static"'.($valcss=='static' ? ' selected="selected" ' : false).'>Static</option>';
		$out .= '<option value="fixed"'.($valcss=='fixed' ? ' selected="selected" ' : false).'>Fixed</option>';
		$out .= '<option value="absolute"'.($valcss=='absolute' ? ' selected="selected" ' : false).'>Absolute</option>';
		$out .= '</select>';
		echo $out;
	}

	public function jt_postcount_callback(){
		if(! empty( $this->jt_setting ) && isset ( $this->jt_setting['jt_postcount'] ) ) {
			$val = $this->jt_setting['jt_postcount'];
		}

		$out = '<input type="number" id="jt_postcount" name="jt_setting[jt_postcount]" value="'.$val.'">';
		echo $out;
	}

	public function jt_stayfor_callback(){
		if(! empty( $this->jt_setting ) && isset ( $this->jt_setting['jt_stayfor'] ) ) {
			$val = $this->jt_setting['jt_stayfor'];
		}

		$out = '<input type="number" id="jt_stayfor" name="jt_setting[jt_stayfor]" value="'.$val.'"> ms';
		echo $out;
	}

	public function jt_delayfor_callback(){
		if(! empty( $this->jt_setting ) && isset ( $this->jt_setting['jt_delayfor'] ) ) {
			$val = $this->jt_setting['jt_delayfor'];
		}

		$out = '<input type="number" id="jt_delayfor" name="jt_setting[jt_delayfor]" value="'.$val.'"> ms';
		echo $out;
	}

	public function jt_fadeinspeed_callback(){
		if(! empty( $this->jt_setting ) && isset ( $this->jt_setting['jt_fadeinspeed'] ) ) {
			$val = $this->jt_setting['jt_fadeinspeed'];
		}

		$out = '<input type="number" id="jt_fadeinspeed" name="jt_setting[jt_fadeinspeed]" value="'.$val.'"> ms';
		echo $out;
	}

	public function jt_fadeoutspeed_callback(){
		if(! empty( $this->jt_setting ) && isset ( $this->jt_setting['jt_fadeoutspeed'] ) ) {
			$val = $this->jt_setting['jt_fadeoutspeed'];
		}

		$out = '<input type="number" id="jt_fadeoutspeed" name="jt_setting[jt_fadeoutspeed]" value="'.$val.'"> ms';
		echo $out;
	}
	
	/**
	 * Helper Settings function if you need a setting from the outside.
	 * 
	 * Keep in mind that in our demo the Settings class is initialized in a specific environment and if you
	 * want to make use of this function, you should initialize it earlier (before the base class)
	 * 
	 * @return boolean is enabled
	 */
	public function is_enabled() {
		if(! empty( $this->jt_setting ) && isset ( $this->jt_setting['jt_opt_in'] ) ) {
			return true;
		}
		return false;
	}
	
	/**
	 * Validate Settings
	 * 
	 * Filter the submitted data as per your request and return the array
	 * 
	 * @param array $input
	 */
	public function jt_validate_settings( $input ) {
		
		return $input;
	}
}