
<?php require("HeaderLayout.php");
$conn= ConnexionBD::getInstance();
$keyword=$_GET['keyword'] ;
$req="SELECT * from produit where ID_Categorie='.$keyword.'";
$count_results=$conn->query($req);

       $rows=$count_results->fetchAll();

        $num=count($rows);

        $rpp=10;

        $last_page=ceil($num/$rpp);
        $page_number=1;
        $req1="SELECT Designation from produit where ID_Categorie ='.$keyword.' ORDER BY Designation DESC LIMIT ".$rpp*($page_number-1).",".$rpp;

        $name=$conn->query($req1);

        $result=$name->fetchAll(PDO::FETCH_NUM);
        /*  }*/

?>

<script language="Javascript" type="text/javascript">

function submit(np)
{
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "ajax catalog.php";
    var ln = document.getElementById("IDCat").innerHTML;
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
			/*if(return_data.indexOf('ok')!=-1){window.location="http://stackoverflow.com";}*/}}
    hr.send();}

</script>

      <body onload="submit(1)">
      <p id="IDCat" hidden><?php echo $_GET["keyword"]; ?></p>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Products Search :</h3>
    		</div>
    		<div class="see">
    			<p><a href="#">See all Products</a></p>
    		</div>
    		<div class="clear"></div>
    	</div>

    	<div class="slection group">
    		</br>


			<div id="catalog_results" class ="selection group">

            </div>
		</div>


			<div class="content_bottom">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="see">
    			<p><a href="#">See all Products</a></p>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
			
                  $promotion=$conn->query("SELECT IDProduit FROM promotion");
                  $promotion=$promotion->fetchAll();
				  $result=$conn->query("SELECT * FROM produit join promotion on produit.Ref=promotion.IDProduit ORDER BY promotion.DateFin DESC  limit 4");
		          $res=$result->fetchAll();
		          
		          foreach($res as $r)
		          {
		          	$exist=0;
		            echo '<div class="grid_1_of_4 images_1_of_4">';
		            echo '<a href="preview.php?IDProduit='.$r['IDProduit'].'"><div style="width: 250px; height: 250px;;overflow:hidden"><img  src="data:image;base64,'.($r['ImgProduit']).'" /></div></a>';
		            echo ' <h2>'.$r['Designation'].' </h2>';
		            echo '<div class="price-details">';
		            echo '<div class="price-number">';
		            foreach ($promotion as $prom) {
                        if($prom['IDProduit']==$r['IDProduit']){
                        $exist=1;
                        
                        }     
                    }
    				
                    if($exist==1){echo '<p style="text-decoration: line-through"><span class="rupees">'.$r['PrixHT'].' DT</span></p>';
                     $tauxprom=$conn->query("SELECT TauxDeProm FROM promotion where IDProduit=".$r['IDProduit']);
                     $tauxprom=$tauxprom->fetch();
                    $newPrice=$r['PrixHT'] - ($r['PrixHT']*$tauxprom[0]/100);
                    echo '<p><span class="rupees">'.$newPrice.' DT</span></p>';
                    }
                    else{
                    echo '<p><span class="rupees">'.$r['PrixHT'].' DT</span></p>';
                    }

		            echo '</div>';
		            echo '<div class="add-cart">';
		            echo '<h4><a href="preview.php?IDProduit='.$r['IDProduit'].'">Inspect</a></h4>';
		            echo '</div>';
		            echo '<div class="clear"></div>';
		            echo '</div>';
		            echo '</div>';

		          }  ?> 	
			</div>
    </div>
 </div>
</div>
      <?php   require("footerLayout.php");  ?>
    <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

