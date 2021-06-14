<?php

/**
* 
*/
if (!isset($_SESSION)) {
	# code...
	session_start();
}

require_once('../classes/ConnexionBD.php');


class Commande
{
   //attributs
	protected $conn;
    protected $idCommande;
    protected $idClient;
    protected $idReduction;
    protected $etatPaiment;
    protected $prixTotale;
    protected $tabprixProduit= array();
    protected $tabtvaProduit= array();
    protected $tabpromProduit= array();

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
 	$res=$this->conn->query("SELECT commande.IDCommande, commande.DateCreation, commande.EtatPaiment, commande.prixtotale, client.nom, client.prenom, client.email from commande , client where client.IDclient=commande.IDclient");

          return  $liste=$res->fetchall();
 }

 public function afficherlignepourClient($idCommande)
 {
 	$res=$this->conn->query("SELECT IDclient from commande where IDCommande=".$idCommande);
 	$res=$res->fetchall();
 	$idclient=$res[0][0];

 	$res=$this->conn->query("SELECT linedecommande.Qte , linedecommande.Ref , client.nom , client.prenom , client.cin,produit.Designation from linedecommande , client ,produit where(linedecommande.IDCommande =".$idCommande." and client.IDclient = ".$idclient."  and linedecommande.Ref = produit.Ref)");
 	
 	return $res->fetchall();
 }



	public function ValiderSession($username,$mdp)
	
	{
		
			$stmt = $this->conn->prepare("SELECT IDclient, username, email, mdp FROM client WHERE username='".$username."'");
			$stmt->execute();
			//var_dump($stmt);
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
		}

	public function CalculerPrixTotale()
	{
		$prom=array();
		//var_dump($_SESSION['panier']['idProduit'] );
		foreach ($_SESSION['panier']['idProduit'] as $key => $value) {
			
			$res=$this->conn->query("SELECT PrixHT ,TVA,IDProduit from produit where Designation='".$value."'");
		//	var_dump($res );
			$liste=$res->fetchall();
//var_dump($liste);
			foreach ($liste as $i => $l) {
				array_push($this->tabprixProduit, $l['PrixHT']);
				array_push($this->tabtvaProduit, $l['TVA']);
				array_push($prom, $l['IDProduit']);


			}



		}



		

		foreach ($prom as $key => $value) {
			
			$res=$this->conn->query("SELECT TauxDeProm from promotion where (IDPromotion=".$value." and DateFin > CURDATE() )");
			$liste=$res->fetchall();
//var_dump($liste);
			foreach ($liste as $i => $l) {
				array_push($this->tabpromProduit, $l['TauxDeProm']);
			}



		}
		


		for ($k=0;$k<count($_SESSION['panier']['idProduit']);$k++) {
			$this->prixTotale+=(($this->tabprixProduit[$k]
				+$this->tabprixProduit[$k]
				*$this->tabtvaProduit[$k]/100)
			*$_SESSION['panier']['qte'][$k])
/*promotion */			

-(($this->tabprixProduit[$k]+
	$this->tabprixProduit[$k]*
	$this->tabtvaProduit[$k]/100)*
$_SESSION['panier']['qte'][$k])*
$this->tabpromProduit[$k]/100+8;
			;
		}
		return $this->prixTotale;
	}


		public function ajouterCommande()
		{   session_start();
			$this->idClient=$_SESSION['user_session'];
			$sql="INSERT into commande (DateCreation,EtatPaiment,IDClient,IDReduction,prixtotale) values(CURDATE(),'".$this->etatPaiment."',".$this->idClient.",".$this->idReduction.",".$this->prixTotale.")";
			$resultatreq=$this->conn->query($sql);
		/*	var_dump($sql);
			var_dump($resultatreq);*/
			if ($resultatreq==false) {
				echo "errrr";
			}
				else{
				$sql="SELECT Max(IDCommande) from commande ";
				$res=$this->conn->query($sql);
				$liste=$res->fetchall();
			//	var_dump($liste);
				foreach ($liste as $l) {
					$this->idCommande=$l[0];
				//	var_dump($this->idCommande);
					$_SESSION['idCommande']=$this->idCommande;
				}


				foreach ($_SESSION['panier']['idProduit'] as $key => $value) {

						$req="SELECT IDProduit from produit where Designation='".$value."'";
						$resul=$this->conn->query($req);
						$idprod=$resul->fetchall();
						foreach ($idprod as $idp) {
							
						
					$sql="INSERT into linedecommande (IDCommande,Qte,IDProduit) values(".$this->idCommande.",".$_SESSION['panier']['qte'][$key].",".$idp[0].")";
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