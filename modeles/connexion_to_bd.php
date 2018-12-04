<?php

       
        class connexion_to_bd 
        {
            private $connexion ;
            
            public function etablir_connection()
            {
              try
                {
                   $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                   $this->connexion = new PDO('mysql:host=localhost;dbname=apesaonlinetest', 'root', '');
                  
                }catch (Exception $e)
                {
                   die('Erreur : ' . $e->getMessage());
                   
                }
            }
          
            public function getConnexion() 
            {
                return $this->connexion;
            }

            public function setConnexion($connexion) {
                $this->connexion = $connexion;
            }
            
            
          

        }

?>
