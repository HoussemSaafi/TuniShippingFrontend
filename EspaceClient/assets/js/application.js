function getListReclamation(){
	$.ajax({
		method: "POST",
		url: "afficheReclamation.php",
	}).complete(function(data) {
		$("#page-inner").html(data.responseText);
	});
}

function getAjoutReclamation(){
	$.ajax({
		method: "POST",
		url: "ajoutFormReclamation.php",
	}).complete(function(data) {
		$("#page-inner").html(data.responseText);
	});
}

function afficheReclamation() {
	$("#pageframe").attr("src", "afficheReclamation.php");
}

function afficheReponse() {
	$("#pageframe").attr("src", "afficheReponseReclamation.php");
}

function afficheAjoutForm() {
	$("#pageframe").attr("src", "ajoutFormReclamation.php");
}