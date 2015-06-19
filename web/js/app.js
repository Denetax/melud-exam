$(document).ready(function(){
	$("#loader").hide();
	$('#firstBlock').click(function(){
		$('#blockUploadDesktop').fadeOut();
		$('#blockUploadFacebook').fadeIn();
		
	});
	$("#ImageAlbum").children().children().click(function(){
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
	$( "#listAlbum").children().children().click(function() {
		var id = this.id;
		$("#ImageAlbum div").hide();
		$.each($("#ImageAlbum img"),function(index,value){
			if(id == value.className)
			{
				$("."+id).parents().show();
				$("."+id).show();
			};
		});
	});
	
});