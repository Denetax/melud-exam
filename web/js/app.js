$(document).ready(function(){

	$('#firstBlock').click(function(){
		$('#blockUploadDesktop').fadeOut();
		$('#blockUploadFacebook').fadeIn();
		$("#picture_fb").children().click(function(){
			$("#imgSelected").attr("src",this.src);
			$("#myModal").modal('show');
		});
	});

	$('#secondBlock').click(function(){
		$('#blockUploadFacebook').fadeOut();
		$('#blockUploadDesktop').fadeIn();
	});

});