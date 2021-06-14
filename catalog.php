<?php

//require_once('../classes/ConnexionBD.php');
require_once('ConnexionBD.php');

        $conn= ConnexionBD::getInstance();

$keyword=$_GET['keyword'] ;
        $count_results=$conn->query("SELECT * from produit where Designation  LIKE '%". $keyword . "%'");

        $rows=$count_results->fetchAll();


        $num=count($rows);
        echo 'nombre de result total est '.$num;
        echo "</br>";

        $rpp=10;

        $last_page=ceil($num/$rpp);


        echo 'last page est '.$last_page;
        echo "</br>";


        $page_number=$_GET['pagenum'];

        $name=$conn->query("SELECT Designation from produit where Designation  LIKE '%". $keyword . "%' ORDER BY Designation DESC LIMIT ".$rpp*($page_number-1).",".$rpp);
        $result=$name->fetchAll(PDO::FETCH_NUM);

        /*
    }

*/


?>

<!DOCTYPE html>

<html>
<head>
<meta charset="utf8">
<script language="Javascript" type="text/javascript">
	
function submit(np)
{
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "ajax catalog.php";
    var fn = document.getElementById("numpage").value;
    var ln = document.getElementById("keyword").value;
    var vars = "?&pagenum="+np+"&keyword="+ln;
    url=url+vars;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
			document.getElementById("catalog_results").innerHTML = return_data;
			console.log(return_data);
			/*
			if(return_data.indexOf('ok')!=-1)
			{
				window.location="http://stackoverflow.com";

			}
*/

	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(); // Actually execute the request

}	

</script>

</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="web/css/slider.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="web/js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="web/js/move-top.js"></script>
<script type="text/javascript" src="web/js/easing.js"></script>
<script type="text/javascript" src="web/js/startstop-slider.js"></script>
<body onload="submit(1)">

<input type="text" name="keyword" id="keyword" onkeyup="submit()"> Keyword </input>
<input type="text" name="numpage" id="numpage"> number page</input>
<div id="catalog_results" class ="selection group"></div>



</body>
</html>