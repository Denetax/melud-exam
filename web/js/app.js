$(document).ready(function(){
	$('#firstBlock').click(function(){
		$('#blockUploadDesktop').fadeOut();
		$('#blockUploadFacebook').fadeIn();
		
	});
	$("#picture_fb").children().click(function(){
			var LienImage = this.src;
			$("#imgSelected").attr("src",LienImage);
			$("#inputSrc").attr("value",LienImage);
			$("#myModal").modal('show');	
		});
	$('#secondBlock').click(function(){
		$('#blockUploadFacebook').fadeOut();
		$('#blockUploadDesktop').fadeIn();
	});
	
	$("#photoVote img").click(function(){
			var LienImage = this.src;
			$("#imgSelected").attr("src",LienImage);
			$("#myModalVote").modal('show');	
		});
});