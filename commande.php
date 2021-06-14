<?php

/**
* 
*/
require_once('ConnexionBD.php');

//session_start();

class Commande
{

	public $conn;
	public $idCommande;
	public $idClient;
	public $idReduction;
	public $etatPaiment;
	public $prixTotale;
	public $tabprixProduit= array();
	public $tabtvaProduit= array();
	public $tabpromProduit= array();
	public $tabqteProduit= array();

    function __construct()
    {
        $this->conn=ConnexionBD::getInstance();
    }
	public function commandefacture($idclient)
	{

		$req="SELECT * from commande where (IDCommande=(SELECT MAX(IDCommande) from commande) and IDClient=".$idclient." )";
		
		$res= $this->conn->query($req);
		
		return $res->fetchall();
	}

	public function  detaillefacture($idCommande)
	{
		$req="SELECT * from linedecommande inner join produit on linedecommande.Ref = produit.Ref  where IDCommande=".$idCommande;
		
		$res= $this->conn->query($req);
		return $res->fetchall();
	}

	 public function afficherdetaillecommande($idCommande)
 {
 	$res=$this->conn->query("SELECT * from commande where IDCommande=".$idCommande);

          return  $liste=$res->fetchall();
 }

 public function affichertoutelesCommande()
 {
 	$res=$this->conn->query("SELECT commande.IDCommande, commande.DateCreation, commande.EtatPaiment, commande.prixtotale, client.nom, client.prenom, client.email from commande , client where client.IDclient=commande.IDClient");

          return  $liste=$res->fetchall();
 }

 public function afficherlignepourClient($idCommande)
 {
 	$res=$this->conn->query("SELECT IDClient from commande where IDCommande=".$idCommande);
 	$res=$res->fetchall();
 	$idclient=$res[0][0];

 	$res=$this->conn->query("SELECT linedecommande.Qte , linedecommande.IDProduit , client.nom , client.prenom , client.cin,produit.Designation from linedecommande , client ,produit where(linedecommande.IDCommande =".$idCommande." and client.IDclient = ".$idclient."  and linedecommande.IDProduit = produit.IDProduit)");
 	
 	return $res->fetchall();
 }

    public function ValiderSession($uname,$upass){

            $stmt = $this->conn->prepare("SELECT IDclient, username, email, mdp,etatCompte FROM client WHERE username=:uname ");
            $stmt->execute(array(':uname'=>$uname));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 1)
            {

                if($upass == $userRow['mdp'])
                {
                    $this->idClient= $userRow['IDclient'];

                    return true;
                }else
                {
                    echo "no client";

                    return false;  }}}

	/*public function ValiderSession($username,$mdp)
	
	{
		
			$stmt = $this->conn->prepare("SELECT IDclient, username, email, mdp FROM client WHERE username='".$username."'");
			$stmt->execute();
			//($stmt);
			$userRow=$stmt->fetch();
			if($stmt->rowCount() == 1)
			{
				if(password_verify($mdp, $userRow['mdp']))
				{

					$this->idClient = $userRow['IDclient'];
					//echo $this->idClient;
					return true;
				}
				else
				{
					echo "no client";
					return false;
				}
			}
		} */

	public function CalculerPrixTotale()
	{
		$prom=array();
		//($_SESSION['panier']['idProduit'] );
		foreach ($_SESSION['panier']['idProduit'] as $key => $value) {
			
			$res=$this->conn->query("SELECT PrixHT ,TVA,Ref from produit where Ref='".$value."'");
		//	($res );
			$liste=$res->fetchall();
//($liste);
			foreach ($liste as $i => $l) {
				array_push($this->tabprixProduit, $l['PrixHT']);
				array_push($this->tabtvaProduit, $l['TVA']);
				array_push($prom, $l['Ref']);





			}



		}

		if (!isset($_SESSION['panier']['Qte'])) {
			$_SESSION['panier']['Qte'] = array( );
		}


foreach ($_SESSION['panier']['qte'] as $key => $value) {
	array_push($_SESSION['panier']['Qte'], $value);
}

		

		foreach ($prom as $key => $value) {
			
			$res=$this->conn->query("SELECT TauxDeProm from promotion where (IDProduit=".$value." and DateFin > CURDATE() )");
		
			$liste=$res->fetchall();
//($liste);
			foreach ($liste as $i => $l) {
				array_push($_SESSION['panier']['Qte'], $l['TauxDeProm']);
			}



		}
		


		foreach ($this->tabtvaProduit as $k => $value) {
		 	
			$this->prixTotale+=(($this->tabprixProduit[$k]
				+$this->tabprixProduit[$k]
				*$this->tabtvaProduit[$k]/100)
			*$_SESSION['panier']['Qte'][$k]);

			}
/*promotion */			
foreach ($this->tabpromProduit as $k => $value) {
	# code...

$this->prixTotale-=(($this->tabprixProduit[$k]+
	$this->tabprixProduit[$k]*
	$this->tabtvaProduit[$k]/100)*
$_SESSION['panier']['qte'][$k])*
$value/100+8;
			
		}
		

			$sql="SELECT IDReduction,TauxReduction  from reduction where MontantMin = (SELECT MAX(MontantMin) from reduction where  (MontantMin <'.$this->prixTotale.' and DateFin> CURDATE() ))";
			//($sql);
			$res=$this->conn->query($sql);
			$res=$res->fetchall();
			if(count($res)==1)
			{
				$this->prixTotale=$this->prixTotale-$this->prixTotale*$res[0][1]/100;
				$this->idReduction=$res[0][0];
			}
			else
			{
				$req=$this->conn->query("SELECT IDReduction  from reduction where titre ='default'");
				$res=$req->fetchall();
				if (count($res)) {
					# code...
					$this->idReduction=$res[0][0];
				}
				
			}
		return $this->prixTotale;



	}


		public function ajouterCommande()
		{   //($_SESSION['user_id']);
			$this->idClient=$_SESSION['user_id'];
			$this->prixTotale=$_SESSION['prixtot'];
			$sql="INSERT into commande (DateCreation,EtatPaiment,prixtotale,IDClient,IDReduction) values(CURDATE(),'non payée',".$this->prixTotale.",".$this->idClient.",2)";
			echo 'requete insert commande';
			var_dump($sql);
			$resultatreq=$this->conn->query($sql);
			//$this->idCommande=$resultatreq[IDCommande];
			var_dump($sql);
			var_dump($resultatreq);
			if ($resultatreq==false) {
				echo "errrr";
			}
				else{
				$sql="SELECT Max(IDCommande) from commande";
				$res=$this->conn->query($sql);
				$liste=$res->fetchall();
			//	($liste);
                    $this->idCommande=$liste[0];
                    ($this->idCommande);
                    $_SESSION['idCommande']=$this->idCommande;
//				foreach ($liste as $l) {;
//					$this->idCommande=$l[0];
//				//	($this->idCommande);
//					$_SESSION['idCommande']=$this->idCommande;
//				}


				foreach ($_SESSION['panier']['idProduit'] as $key => $value) {

						$req="SELECT Ref from produit where Ref='".$value."'";
						$resul=$this->conn->query($req);
						$idprod=$resul->fetchall();
						foreach ($idprod as $idp) {
						($this->idCommande);
					$sql="INSERT into linedecommande (IDCommande,Qte,Ref) values(".$this->idCommande[0].",".$_SESSION['panier']['qte'][$key].",".$idp[0].")";
					($sql);
					if($this->conn->query($sql))
					{
						$sql="UPDATE produit set Quantite=(Quantite-".$_SESSION['panier']['qte'][$key].") WHERE IDProduit=".$idp[0];
						if($this->conn->query($sql))
							{ echo "qte updated<br>";}
						//echo "ok";
					}
				}
				}
			}
		}

}




?>