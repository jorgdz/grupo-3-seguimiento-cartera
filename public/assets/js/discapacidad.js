$('#discapacidad').hide();

$(document).ready(function(){
	$("#si").on( "click", function() {
		$('#discapacidad').show();
	 });
	$("#no").on( "click", function() {
		$('#discapacidad').hide(); 
	});
});
