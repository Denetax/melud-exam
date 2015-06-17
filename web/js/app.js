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
			var inputNameUser = $("inputNameUser").val();
			$("titreNomUser").val("Voter pour la photo de"+ inputNameUser);
			var LienImage = this.src;
			$("#imgSelected").attr("src",LienImage);
			$("#myModalVote").modal('show');	
		});
		
	$("#photoGalerie div.img").click(function(){
			var LienImage = this.src;
			$("#imgSelected").attr("src",LienImage);
			$("#myModalGalerie").modal('show');	
		});
		
	
	$.each($("#ImageAlbum img"),function(index,value){
		var res = value.split(" "); 
		console.log(res);
		var res1 = res[1].split("="); 
		console.log(res1);
		
	});
});