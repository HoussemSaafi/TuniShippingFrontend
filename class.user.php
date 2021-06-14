<?php

require_once('ConnexionBD.php');

class USER
{		
//The variable $stmt holds an object of type mysqli_stmt class, which represents a prepared statement. avoid sql injection

	private $conn;
	
	public function __construct()
	{
        $this->conn= ConnexionBD::getInstance();

    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($uname,$umail,$unom,$uprenom,$upass,$ucin,$utelephone,$uadresse,$uage,$urepquestion,$uquestion)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO client (username,email,nom,prenom,mdp,CIN,telephone,adresse,age,Repquestion,question) VALUES(:uname, :umail, :unom, :uprenom, :upass, :ucin, :utelephone, :uadresse, :uage, :urepquestion,:uquestion)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":unom", $unom);
			$stmt->bindparam(":uprenom", $uprenom);
			$stmt->bindparam(":upass", $new_password);
			$stmt->bindparam(":ucin", $ucin);
			$stmt->bindparam(":utelephone", $utelephone);
			$stmt->bindparam(":uadresse", $uadresse);
			$stmt->bindparam(":uage", $uage);
			$stmt->bindparam(":urepquestion", $urepquestion);
			$stmt->bindparam(":uquestion", $uquestion);													  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}

	public function modifier_utilisateur($uid,$uname,$umail,$unom,$uprenom,$ucin,$utelephone,$uadresse,$uage)
	{
		try
		{   
		/*
			$stmt = $this->conn->prepare(" UPDATE users SET 
			username = :uname, 
            email = :umail, 
            nom = :unom,  
            prenom = :uprenom,  
            CIN  = :ucin ,
            telephone =: utelephone,
            adresse =: uadresse,
            age =: uage
            WHERE IDclient  =".$uid."");
			
			
			$stmt->bindparam(':uname', $uname, PDO::PARAM_STR);
			$stmt->bindparam(':umail', $umail, PDO::PARAM_STR);
			$stmt->bindparam(':unom', $unom, PDO::PARAM_STR);
			$stmt->bindparam(':uprenom', $uprenom, PDO::PARAM_STR);
			$stmt->bindparam(':ucin', $ucin, PDO::PARAM_STR);
			$stmt->bindparam(':utelephone', $utelephone, PDO::PARAM_STR);
			$stmt->bindparam(':uadresse', $uadresse, PDO::PARAM_STR);
			$stmt->bindparam(':uage', $uage, PDO::PARAM_INT);*/

				$stmt = $this->conn->query("UPDATE client SET username = '".$uname."' , email ='".$umail."', nom = '".$unom."', prenom = '".$uprenom."', CIN    ='".$ucin."', telephone ='".$utelephone."', adresse ='".$uadresse."', age  ='".$uage."' WHERE IDclient = ".$uid);

			$stmt->execute(); 
			

												  
		
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}			
	}



		public function affichertouslesclient()
 		{
 			try
			{   
				$res=$this->conn->query("SELECT IDclient,username,email,nom,prenom,CIN,telephone,adresse,age,etatCompte,date_inscription FROM client");

	          return  $liste=$res->fetchall();
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}	
 			
 		}


	
	public function changermotdepasse($user_id,$unewpass)
	{
		try
		{   
			$new_password = password_hash($unewpass, PASSWORD_DEFAULT);
		
			$stmt = $this->conn->query("UPDATE client SET  mdp = '".$new_password."' WHERE IDclient = ".$user_id);
												  
		
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				

	}

	public function excistencecompte($uname,$umail)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT IDclient, username, email  FROM client WHERE username=:uname OR email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{   
			return true;
			}
			else
			{
			return false;
			}	
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}


	}


	public function statusducompte($uname,$umail)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT IDclient, username, email, etatCompte FROM client WHERE username=:uname OR email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{   if($userRow['etatCompte']==1)
					{
						return true;
					}
					else
					{
						return false;
					}	
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}


	}
 	
 	public function validiter_username($uid,$uname)
 	{
 		try
		{
			$stmt = $this->conn->prepare("SELECT username FROM client WHERE IDclient !=:uid and username=:uname ");
			$stmt->execute(array(':uid'=>$uid, ':uname'=>$uname));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 0)
			{   
						return true;
								
			}
			else
			{
						return false;
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}

 	}



 	public function validiter_email($uid,$umail)
 	{
 		try
		{
			$stmt = $this->conn->prepare("SELECT email FROM client WHERE IDclient !=:uid and email=:umail ");
			$stmt->execute(array(':uid'=>$uid, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 0)
			{   
						return true;
								
			}
			else
			{
						return false;
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}





 	}

 	public function validiter_cin($uid,$ucin)
 	{
 		try
		{
			$stmt = $this->conn->prepare("SELECT CIN FROM client WHERE IDclient !=:uid and CIN=:ucin ");
			$stmt->execute(array(':uid'=>$uid, ':ucin'=>$ucin));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 0)
			{   
						return true;
								
			}
			else
			{
						return false;
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}





 	}



	
	
	
	public function doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT IDclient, username, email, mdp,etatCompte FROM client WHERE username=:uname OR email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{   
				if(password_verify($upass, $userRow['mdp']))
				{
					$_SESSION['user_session'] = $userRow['IDclient'];
					return true;
				}
				else
				{
					return false;
				}
				
				
			}

			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function autentification($uname,$umail)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT IDclient, username, email FROM client WHERE username=:uname OR email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{   
					$_SESSION['user_session'] = $userRow['IDclient'];
					return true;
			}
			else
			{
					return false;
			}
				
				
			

			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function desactivercompte($user_id)
	{
       try
		{   
		
			$stmt = $this->conn->query("UPDATE client SET  etatCompte  = 0 WHERE IDclient = ".$user_id);
												  
		
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}			

	}

	public function User_connecte($user_id)
	{
			try
		{   
		
			$stmt = $this->conn->query("UPDATE client SET  etatconnexion  = 1 WHERE IDclient = ".$user_id);
												  
		
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}			


	}

	public function User_deconnecte($user_id)
	{
			try
		{   
		
			$stmt = $this->conn->query("UPDATE client SET  etatconnexion  = 0 WHERE IDclient = ".$user_id);
												  
		
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}			


	}




	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>