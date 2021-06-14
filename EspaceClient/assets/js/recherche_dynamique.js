$(document).ready(function(){


$('#search').keyup(function(){

var search=$(this).val();
search=$.trim(search);

if(search!=="")
{
	$.post('post.php',{search:search},function(data){

		$('#resultat ul').html(data);


	});
}


});



});