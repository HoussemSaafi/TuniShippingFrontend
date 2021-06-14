<?php

require_once('../classes/ConnexionBD.php');

class crudChat
{

    protected $bd;
	
	public function __construct()
	{
        $this->bd=ConnexionBD::getInstance();
     }
  

     public function savechat($upseudo,$umessage)
     {
    		try
		{

			$stmt = $this->bd->prepare('INSERT INTO chat (Pseudo, message) VALUES(:upseudo, :umessage)');
     		$stmt->bindparam(":upseudo", $upseudo);
			$stmt->bindparam(":umessage", $umessage);
    		$stmt->execute();

				return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}



     }

  
    public function loadchat()
    {
    	try
		{ 

			$reponse = $this->bd->query('SELECT Pseudo, message ,datechat FROM chat ORDER BY  Idchat DESC LIMIT 0, 30');
    	 	return $reponse;

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
    	

    }

    public function numberUser_connecte()
	{
			try
		{
			$stmt = $this->bd->prepare("SELECT etatconnexion FROM client WHERE etatconnexion= 1 ");
			$stmt->execute();
			
			return $stmt->rowCount() ;
			

			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}


	}
 }

