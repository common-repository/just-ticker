jQuery(function(){
	var position = jQuery('#jt_position').val();
	console.log(position);
	if (position == 'top') {
		jQuery('#jt_css_position option[value=static]').attr('disabled','disabled');
	}
	else if(position == 'bottom'){
		jQuery('#jt_css_position option[value=absolute]').attr('disabled','disabled');
	}
});