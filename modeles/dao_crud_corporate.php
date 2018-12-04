<?php

    include_once("../entites/clients.php");
    include_once("../modeles/connexion_to_bd.php") ;
    
    
class dao_crud_clients extends clients {
   
    
    private $req; public $resultat; private $donnees;
    private $req1; public $resultat1; private $donnees1;
    private $req4; public $resultat4; private $donnees4;
    private $req5;

    private $bd_connection1  ; 



    public function ajouter_corporate()
      {


        $bd_connection = new connexion_to_bd() ;  $bd_connection->etablir_connection();

        if($this->controleChamps($this->getAccountID())){
            
         $this->req = " select * from t_clients_corporate where AccountID = '" .$this->getAccountID(). "' OR email = '" .$this->getEmail()."' ";
  
         $this->resultat = $bd_connection->getConnexion()->query($this->req)  or die( print_r($bd_connection->getConnexion()->errorInfo()));
          
         if($this->resultat->rowCount() == 0){

              $this->req = $bd_connection->getConnexion()->prepare('INSERT INTO t_clients_corporate(AccountID, nom, phone, branch, email , status) 
                 VALUES(:ACCOUNT, :NOM, :PHONE, :BRANCH, :MAIL , :STATUS)') or die(print_r($this->connexion->errorInfo()));

                $this->ligne = $this->req->execute(array(
                 'ACCOUNT' => $this->getAccountID(),
                 'NOM' => $this->getNom(),
                 'PHONE' => $this->getPhone(),
                 'BRANCH' => $this->getBranch(),
                 'MAIL' => $this->getEmail(),
                 'STATUS' => $this->getStatus() ));


               if($this->ligne == 1)
               {
                  $this->sms_welcome($this->getPhone(), $this->getBranch());
                
               }else
               {
                 echo 'echec';
               }

         }else
         {

            echo 'existe';
         }
        
         }else
         {
           echo 'champ_error';
         }
         
        }
        
        
        
        public function liste_clients($taille)
        {
           $bd_connection = new connexion_to_bd() ;  $bd_connection->etablir_connection();
           
           $this->req = "select * from t_client_sms where status = 1 order by nom limit ".($taille * 35).",35";
           
           $this->resultat = $bd_connection->getConnexion()->query($this->req)  or die( print_r($bd_connection->getConnexion()->errorInfo()));

           $json =  '{ "clients":
                             [';
           
                                while($this->donnees = $this->resultat->fetch())
                                {
	       
                                    $account = $this->donnees['AccountID'];
                                    $nom = $this->donnees['nom'];
                                    $phone = $this->donnees['phone'];
                                    $status = $this->donnees['status'];
                                    $id = $this->donnees['id'];


                                    $json  .=   '{"item" : {"account" : "'.$account.'" , "nom" : "'.$nom.'" , "phone" : "'.$phone.'" , "status" : "'.$status.'", "id" : "'.$id.'" , }} ,';
                                }

                                $json .= ']}';
                                echo $json;
                         
            
        }


        public function liste_clients_corbeille($taille)
        {
           $bd_connection = new connexion_to_bd() ;  $bd_connection->etablir_connection();
           
           $this->req = "select * from t_client_sms where status = 0 order by nom limit ".($taille * 35).",35";
           
           $this->resultat = $bd_connection->getConnexion()->query($this->req)  or die( print_r($bd_connection->getConnexion()->errorInfo()));

           $json =  '{ "clients":
                             [';
           
                                while($this->donnees = $this->resultat->fetch())
                                {
         
                                    $account = $this->donnees['AccountID'];
                                    $nom = $this->donnees['nom'];
                                    $phone = $this->donnees['phone'];
                                    $status = $this->donnees['status'];
                                    $id = $this->donnees['id'];


                                    $json  .=   '{"item" : {"account" : "'.$account.'" , "nom" : "'.$nom.'" ,"phone" : "'.$phone.'" , "status" : "'.$status.'", "id" : "'.$id.'" , }} ,';
                                }

                                $json .= ']}';
                                echo $json;
              
              
            
        }
        
        
        
        public function desouscrire_client(){
            
            $bd_connection = new connexion_to_bd() ; $bd_connection->etablir_connection();
        
            $this->req = $bd_connection->getConnexion()->prepare("UPDATE t_client_sms set status = 0  where id = '".$this->getId()."'") ;
	  
            $this->ligne = $this->req->execute();

            if($this->ligne == 1) echo "bien";
            else echo "bad";
         
        }
        
        public function activer_client(){
            
            $bd_connection = new connexion_to_bd() ;  $bd_connection->etablir_connection();
        
            $this->req = $bd_connection->getConnexion()->prepare("UPDATE t_client_sms set status = 1  where id = '".$this->getId()."'") ;
	  
            $this->ligne = $this->req->execute();
            if($this->ligne == 1) echo "bien";
            else echo "bad";
         
        }

         public function supprimer_client(){
            
            $bd_connection = new connexion_to_bd() ;  $bd_connection->etablir_connection();
        
            $this->req = $bd_connection->getConnexion()->prepare("DELETE t_client_sms  where id = '".$this->getId()."'") ;
    
            $this->ligne = $this->req->execute();
            if($this->ligne == 1) echo "bien";
            else echo "bad";
         
        }


        public function controleChamps($account)
        {
            $bool = 1;

            if (!preg_match("#^[0-9]{16}$#", $account)) 
            {
                 $bool = 0;
            }
             

            return $bool;
        }

       


        public function compte_clients()
        {
            $bd_connection = new connexion_to_bd() ;  
            $bd_connection->etablir_connection();
            
            $this->req = " select count(AccountID) as nbre_clients from t_client_sms where status = 1 " ;
            $this->resultat = $bd_connection->getConnexion()->query($this->req)  or die( print_r($bd_connection->getConnexion()->errorInfo()));
            $this->donnees = $this->resultat->fetch();
            
            $nbre_ligne = $this->donnees['nbre_clients'] ;
            $resultat = $nbre_ligne / 35 ;
            $partie_entiere = intval($resultat) ;
             
               
              if( $resultat > $partie_entiere )
              {
                $page = $partie_entiere + 1 ;  
              }

              if( $resultat == $partie_entiere)
              {
                $page = $partie_entiere ;

              }

              echo $page;
        }


        public function compter_clients_corbeille()
        {
            $bd_connection = new connexion_to_bd() ;  
            $bd_connection->etablir_connection();
            
            $this->req = " select count(AccountID) as nbre_clients from t_client_sms where status = 0 " ;
            $this->resultat = $bd_connection->getConnexion()->query($this->req)  or die( print_r($bd_connection->getConnexion()->errorInfo()));
            $this->donnees = $this->resultat->fetch();
            
            $nbre_ligne = $this->donnees['nbre_clients'] ;
            $resultat = $nbre_ligne / 35 ;
            $partie_entiere = intval($resultat) ;
             
               
              if( $resultat > $partie_entiere )
              {
                $page = $partie_entiere + 1 ;  
              }

              if( $resultat == $partie_entiere)
              {
                $page = $partie_entiere ;

              }

              echo $page;
        }


        public function sms($date)
        {
         
              
           $this->bd_connection1 = new connexion_to_bd() ;  $this->bd_connection1->etablir_connection();

           
           $this->req = "select * from t_client_sms where status = 1";
           
           $this->resultat = $this->bd_connection1->getConnexion()->query($this->req)  or die( print_r($this->bd_connection1->getConnexion()->errorInfo()));
                             
                             
                             while($this->donnees = $this->resultat->fetch())
                                {
         
                                    $account = $this->donnees['AccountID'];
                                    $nom = $this->donnees['nom'];
                                    $phone = $this->donnees['phone'];
                                    $trxArray = '';
                                    $dateArray = '';
                                    $amountArray = '';
                                   
                                     
                                    $this->req1 = " select * from t_accounttrx where AccountID = '".$account."'  AND TrxDate = '".$date."' ";

                                    $this->resultat1 = $this->bd_connection1->getConnexion()->query($this->req1)  or die( print_r($this->bd_connection1->getConnexion()->errorInfo()));
                                    
                                    if($this->resultat1->rowCount() > 0){

                                     
                                    $i = 0;
                                    while($this->donnees1 = $this->resultat1->fetch())
                                     { 
                                          $compteur = $this->resultat1->rowCount();
                                          $trx = $this->donnees1['TrxDescription'];
                                          $amount = $this->donnees1['Amount'];
                                          $date = $this->donnees1['TrxDate'];

                                          $trxArray .= $trx . '_';
                                          $dateArray .= $date . '_';
                                          $amountArray .= $amount . '_';

                                          $this->req2 = " select * from t_accountcustomer where AccountID = '" .$account. "'";

                                          $this->resultat2 = $this->bd_connection1->getConnexion()->query($this->req2)  or die( print_r($this->bd_connection1->getConnexion()->errorInfo()));

                                          $this->donnees2 = $this->resultat2->fetch();
                                          $solde = $this->donnees2['ClearBalance'];
                                          $i++;

                                          if($i == $compteur)
                                          {
                                            $this->trx_sms($amountArray,$trxArray,$dateArray,$phone,$solde,$date);
                                            
                                          } 

                                          
                                     }   
                                   }
                                }

                               
      
        }


        private function sms_welcome($number,$branch)
        {
           $text = '';

           if($branch == '01')
           {
                $text = "Dear customer, In the coming days you will be closer to your account via our SMS Banking for an exceptional price ----- Your Agency APESA -----";
               
           }else
           {
                 $text = "Cher client, Dans les prochains jours vous serez plus proche de votre compte via notre SMS Banking, pour un prix exceptionnel -----Votre Agence APESA-----";
           }

          
        }


       


        public function rapport($date)
        {

          $bd_connection = new connexion_to_bd() ;  $bd_connection->etablir_connection();

          $this->req = " select * from t_etat_sms where etat_date = '".$date."' ";

            $this->resultat = $bd_connection->getConnexion()->query($this->req)  or die( print_r($bd_connection->getConnexion()->errorInfo()));
                                    
              $json =  '{ "rapport":
                             [';   

              while($this->donnees = $this->resultat->fetch())
                   { 
                      $count = $this->donnees['message_count'];
                      $nom = $this->donnees['nom'];
                      $phone = $this->donnees['phone'];
                      $price = $this->donnees['message_price'];
                      $solde = $this->donnees['solde'];
                      $ladate = $this->donnees['etat_date'];
                      $etat = $this->donnees['etat'];

                     $json  .=   '{"item" : {"count" : "'.$count.'" , "nom" : "'.$nom.'" ,"phone" : "'.$phone.'" , "price" : "'.$price.'", "solde" : "'.$solde.'" , "ladate" : "'.$date.'", "etat" : "'.$etat.'" , }} ,';

                   }

              $json .= ']}';
              echo $json;


        }


}

?>
