<?php
	

	class Livraison	{
		public $conn;
		public $idCommande;
		public $dateLivraison;
		public $etatLivraison;
		public $adresse;
		public $idClient;

		public function AfficherLivraisonClient($id)
		{
			$sql = "SELECT * from livraison where IDClient=".$id;
			$res=$this->conn->query($sql);
			return $res->fetchall();
		}

		public function Modifier($id,$date,$etat)
		{
			$sql="UPDATE livraison 
			set 
			DateLivraison	='".$date."' 
			 , etatLivraison 	='".$etat."' 
			  where IDLivraison=".$id."
			";
			//($sql);
			return $this->conn->query($sql);
		}

		public function Supprimer($value)
		{
			$liste=$this->conn->query("DELETE  from livraison where IDLivraison = ".$value);	
			return $liste->fetchall();
		}

		public function afficherlivraison()
		{
			$sql="SELECT * from livraison inner join client on livraison.IDClient=client.IDclient order by EtatLivraison";
				$res=$this->conn->query($sql);
				return $res->fetchall();
		}
		public function afficherdetaillelivraison($idlivraison)
		{
			$sql="SELECT * from livraison inner join client on livraison.IDClient=client.IDclient where livraison.idlivraison=".$idlivraison;
				$res=$this->conn->query($sql);
				return $res->fetchall();
		}
		
		
		public function detailleLivraison($dateLivraison,$adresse,$l)
		{   session_start();
			$this->dateLivraison=$dateLivraison;
			$this->adresse=$adresse;
			$this->idClient=$_SESSION['user_session'];
		}

		public function creerLivraison()
		{
			$sql="INSERT into livraison (DateLivraison,etatLivraison,IDCommande,adresse,IDClient)	values(CURDATE(),'Approuvée',".$_SESSION['idCommande'][0].",'".$this->adresse."',".$this->idClient.")";
			//var_dump($sql);
			$res=$this->conn->query($sql);
			//var_dump($res);
			if($res)
			{
				echo "<br>Votre Commande et livraison ont été ajoutés avec Succes!<br>";
                $_SESSION['panier']['prixProduit']= array();
                $_SESSION['panier']['idProduit']=array();
                $_SESSION['panier']['qte']=array();
                echo"<a href='index.php'> Rentrez au Shop </a>";
                //header('');
			}
			else{
                $_SESSION['panier']['prixProduit']= array();
                $_SESSION['panier']['idProduit']=array();
                $_SESSION['panier']['qte']=array();
                echo "<br>livraison non ajoutée<br>";
             echo"<a href='index.php'> Rentrez au Shop </a>";
			    ;}
		//	($res);
		}

		function __construct()
		{
            $this->conn= ConnexionBD::getInstance();
		}}

?>