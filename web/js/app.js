$(document).ready(function(){
	$('#firstBlock').click(function(){
		$('#blockUploadDesktop').fadeOut();
		$('#blockUploadFacebook').fadeIn();
		$("#picture_fb").children().click(function(){
			alert(this.src);
			$("#imgSelected").attr("src",this.src);
			
			$("#myModal").modal('show');	
			$("#inputSrc").attr("value","yo");
		});
	});
	$('#secondBlock').click(function(){
		$('#blockUploadFacebook').fadeOut();
		$('#blockUploadDesktop').fadeIn();
	});
});