
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Mail Banking/Clients</title>
        
             <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
             <link rel="stylesheet"   href="styles/bootstrap.css">
             <link rel="stylesheet"   href="styles/bootstrap.min.css">
             <link rel="stylesheet"   href="styles/ui-lightness/jquery-ui.css">
             <link rel="stylesheet"   href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
             <style type="text/css">
                    .footer {
                        position:relative; 
                        bottom: 0;
                        height: 60px;
                        width: 100%;
                        background: #000000;
                        color: #FFFFFF;
                    }
             </style>

    </head>
    <body id="body">
        
        <div class="container">
           
            <div id="onglets">
                <ul>
                    <li title="onlet-0"><a href="#onglet-0">Importer Entreprise</a></li>
                    <li title="onlet-2" name="liste"><a href="#onglet-2">liste Entreprise</a></li>
                    <li title="onlet-3"><a href="#onglet-3" name="corbeille">Corbeille</a></li>
                    <li title="onlet-4"><a href="#onglet-4" name="sms">Mail</a></li>
                    <li title="onlet-5"><a href="#onglet-5" name="bord">Tableau de bord</a></li>
                </ul>

                <div id="onglet-2">
                    
                    <table name="tab_customer" class="table">
                        
                        <thead  class="thead-dark">
                              <tr>
                                <th>Account</th>
                                <th>Nom</th>
                                <th>Telephone</th>
                                <th>Desouscrire</th>
                              </tr>
                        </thead>

                       <tbody name="container_tab">

                       </tbody>

                    </table>

                    <div id="pagination">
                        
                        <ul class="pagination justify-content-end" style="margin:20px 0" name="pagination">
                            
                        </ul>

                    </div>
                   
                </div>

                <div id="onglet-0" class="col-md-6 offset-3">
                    
                      <img src="images/clients_sms_import_model.JPG" width="400px" height="300px" />
                  
                    <p></p>

                      <ol>
                        <li>Ouvrez Miscrosoft Excel (xls,xlsx,csv). </li>
                        <li>Remplissez le fichier en respectant l'ordre des champs.</li>
                        <li>Une fois rempli, cliquer sur le boutton et importer le.</li>
    
                      </ol>

                      <div>
                           <button class="btn btn-secondary mb-2" name="importer">Cliquez pour importer</button>
                      </div>

                      <form name="excel" method="POST" style="visibility: hidden;" enctype="multipart/form-data">
                                 <input type="file" name="fichier" class="form-control">
                      </form>

                </div>

                <div id="onglet-3">
                    
                    <table name="tab_customer_corbeille" class="table">
                        
                        <thead  class="thead-dark">
                              <tr>
                                <th>Account</th>
                                <th>Nom</th>
                                <th>Telephone</th>
                                <th>Restaurer</th>
                                <th>Supprimer</th>
                              </tr>
                        </thead>

                       <tbody name="container_tab_corbeille">

                       </tbody>

                    </table>

                     <div id="paginatione">
                        
                        <ul class="pagination justify-content-end" name="pagination_corbeille" style="margin:20px 0">
                            
                        </ul>

                    </div>

                </div>

                <div id="onglet-4" class="col-md-6 offset-3">
                    
                     <div class="alert alert-warning">
                           <strong>Warning!</strong> Rassurez-vous que l'exportation a ete faite.
                     </div>
                       <div class="form-group">
                        <label for="nom">Selectionner la date :</label>
                        <input type="text" class="form-control" id="datePicker">
                      </div>

                      <button  class="btn btn-primary offset-8" disabled="true" name="envoyer_sms">Envoyer les sms</button>

                </div>

                <div id="onglet-5" class="col-md-6 offset-3">
                    
                     
                       <div class="form-group">
                        <label for="nom">Selectionner une date pour avoir le Rapport:</label>
                        <input type="text" class="form-control" name="datePicker">
                      </div>

                      <button  class="btn btn-primary offset-8" name="rechercher_rapport">Rechercher</button>

                      <div class="container" name="div_bord">

                          <table name="tab_rapport" class="table">

                          </table>

                      </div>

                       <div class="col-md-3 offset-9" id="btn_excel">
                         
                        </div>

                </div>

            </div> <!-- fin des onglets -->

            <footer class="footer">
               
                     <div class="col-md-10"><br>     
                       Copyright © 2018 Silifor. Tous droits réservés. Developped by Petito Tapondjou(Laravel Advisor)
                     </div>
                 
            </footer>
            
        </div>

		 
         <script type="text/javascript" src="scripts/jquery-3.3.1.js"></script>
         <script type="text/javascript" src="scripts/jquery-ui.js"></script>
         <script type="text/javascript" src="scripts/banking.js"></script>
         <script type="text/javascript" src="scripts/Xhttp_ActiveX.js"></script>
		     <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
         
    </body>
</html>
