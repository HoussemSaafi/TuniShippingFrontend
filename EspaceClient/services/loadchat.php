  <?php 

  include('../cruds/crudChat.php');
  ?>

		<ul class="chat"  >
                        

                       <?php
                       $Chat= new crudChat();
                       $reponse=$Chat->loadchat();
                       
                   
                     // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                    while ($donnees = $reponse->fetch())
                    {?>
                    
                    <li class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="../assets/images/users/avatar.jpg" alt="U" class="img-circle" />
                            </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                   <strong class="primary-font"></strong> <?php  echo htmlspecialchars($donnees['Pseudo'])  ?>
                                      <small class="pull-right text-muted">
                                          <div style="font-size: 10px;" .><span class="glyphicon glyphicon-time"><?php  echo htmlspecialchars($donnees['datechat'])  ?></span></div>
                                      </small>

                                        
                                </div>
                                    <p>
                                         <?php  echo htmlspecialchars($donnees['message']) ?>  
                                    </p>
                                    <?php
                                      }

                                      $reponse->closeCursor();

                                      ?>
                                </div>
                    </li>
                            
                     
                      
        </ul>