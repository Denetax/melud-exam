$(document).ready(function(){

	$('#firstBlock').click(function(){
		$('#blockUploadDesktop').fadeOut();
		$('#blockUploadFacebook').fadeIn();
		console.log($("#picture_fb").children());
	});

	$('#secondBlock').click(function(){
		$('#blockUploadFacebook').fadeOut();
		$('#blockUploadDesktop').fadeIn();
	});

});