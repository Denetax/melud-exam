$(document).ready(function(){

	$('#firstBlock').click(function(){
		$('#blockUploadDesktop').fadeOut();
		$('#blockUploadFacebook').fadeIn();
		console.log($("#LesImages").children());
	});

	$('#secondBlock').click(function(){
		$('#blockUploadFacebook').fadeOut();
		$('#blockUploadDesktop').fadeIn();
	});

});