{* Le modèle de la page *}
{extends file="modele/main.tpl"}


{* Le contenu de la page *}
{block name=content}
    <div id="page-resultats-recherche">
        <h2>resultats recherche</h2>    
            <?php
            echo "fuck";
            ?>
            <?php
            $sql = "SELECT *
                FROM produit
                WHERE nomProd LIKE '%".$rech."%'";
                            
            $req = mysql_query($sql) or die();
            
             $req = mysql_query($sql) or die();
            echo"lololol";
            while($rep = mysql_fetch_array($req)
            {
            
            }
 ?>
            
    </div>
{/block}
