<?php
class Reclamation{
	//attributs
	protected $IDReclamation;
	protected $description;
	protected $sujet;
	protected $dateReclamation;
	protected $IDClient;
	//constructeur
	function __construct($description,$sujet,$IDClient){

		$this->description=$description;
		$this->sujet=$sujet;
		$this->IDClient=$IDClient;
	}
	function getIDReclamation(){
		return $this->IDReclamation;
	}
	function getDescription(){
		return $this->description;
	}
	function getSujet(){
		return $this->sujet;
	}
	function getDateReclamation(){
		return $this->dateReclamation;
	}
	function getIDClient(){
		return $this->IDClient;
	}
}


?>