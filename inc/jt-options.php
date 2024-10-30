<div class="wrap">
	<div id="icon-edit" class="icon32 icon32-base-template"><br></div>
	<h2><?php _e( 'Just Ticker', 'jtbase' ); ?></h2>
	
	<!-- <p><?php _e(' Sample base plugin page', 'jtbase' ); ?></p> -->
	
	<form id="jt-plugin-base-form" action="options.php" method="POST">
		<?php settings_fields( 'jt_setting' ) ?>
		<?php do_settings_sections( 'jt-plugin-base' ) ?>
		<?php submit_button()?>
	</form><!-- end of #jttemplate-form -->
</div>