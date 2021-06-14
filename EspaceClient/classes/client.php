<?php
class Client{
	//attributs
	protected $username;
	protected $email;
	protected $nom;
	protected $prenom;
	protected $mdp;
	protected $CIN;
	protected $telephone;
	protected $adresse;
	protected $age;
	//constructeur
	function __construct($username,$email,$nom,$prenom,$mdp,$CIN,$telephone,$adresse,$age){
		$this->username=$username;
		$this->email=$email;
		$this->nom=$nom;
		$this->prenom=$prenom;
		$this->mdp=$mdp;
		$this->CIN=$CIN;
		$this->telephone=$telephone;
		$this->adresse=$adresse;
		$this->age=$age;
	}
	function getusername(){
		return $this->username;
	}
	function getemail(){
		return $this->email;
	}
	function getNom(){
		return $this->nom;
	}
	function getPrenom(){
		return $this->prenom;
	}
	
	function getCIN(){
		return $this->CIN;
	}
	function getmdp(){
		return $this->mdp;
	}
	function gettelephone(){
		return $this->telephone;
	}
	function getadresse(){
		return $this->adresse;
	}
	function getage(){
		return $this->age;
	}

	
}

?>