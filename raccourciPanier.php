<?php

//session_start();
function afficherPanier()
{
    $prices=0;
    ?>
    <div class="cart">
        <p>Welcome to our Online Store! <span>Cart:</span><div id="dd" class="wrapper-dropdown-2">
            <?php

            if (isset($_SESSION['panier']))
            {
                echo 	count($_SESSION['panier']['idProduit']).' ';

            }
            else
                echo "0 ";
            ?>
            article(s)
            <?php
            if (isset($_SESSION['panier']))
            {
              //  ($_SESSION['panier']['idProduit']);
              //  ($_SESSION['panier']['prixProduit']);
//              $_SESSION['panier']['prixProduit']= array();
// $_SESSION['panier']['idProduit']=array();
  //            $_SESSION['panier']['qte']=array();
              //  ($_SESSION['panier']['qte']);
                foreach ($_SESSION['panier']['idProduit']as $key => $value) {
                    $prices+=$_SESSION['panier']['prixProduit'][$key]*$_SESSION['panier']['qte'][$key];


                }
            }
            echo "-".$prices."  ";

            ?> TND
            <ul class="dropdown">

                <?php

                if (isset($_SESSION['panier']))
                {
                    if (count($_SESSION['panier']['idProduit'])>0) {
                        foreach ($_SESSION['panier']['idProduit']as $key => $value) {
                            ?>
                            <li>
                                <div class="steps clearfix">
                                    <label style="display: block; width: 150px; float: Left"><?php
                                        echo $value." x ".$_SESSION['panier']['qte'][$key]." = ".$_SESSION['panier']['qte'][$key]*$_SESSION['panier']['prixProduit'][$key];
                                        ?>
                                    </label>
                                    <div>
                                        <a  href=<?php
                                        echo '"supprimerArticle.php?idProduit='.$value.'"';
                                        ?> class= "btn btn-danger" ><i class="glyphicon glyphicon-remove"></i></a>

                                    </div>
                                </div>
                            </li>

                            <?php


                        }

                    }
                }
                else if (!isset($_SESSION['panier']) or count($_SESSION['panier']['idProduit'])==0)
                    echo "you have no items in your Shopping cart ";
                ?>

                <div>
                    <a href="consulterPanier.php" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> View Cart</a>

                </div>
                </li>
            </ul></div></p>
    </div>
    <?php
}




?>