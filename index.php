<?php include_once 'header.php' ?>

<main>
    <section>

    <h1>
        Nos Pizzas
    </h1>

    <?php 
        $servername = 'localhost';
        $username = 'root';
        $password = '';
    
        try{
            $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
            //On définit le mode d'erreur de PDO sur Exception
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
            $bdd->query("SET NAMES utf8");
            $affiche_pizza = $bdd->prepare("
                SELECT * FROM pizzas
            ") ;
            $affiche_pizza->execute();
            $result = $affiche_pizza->fetchall(PDO::FETCH_ASSOC) ;
            $bdd = NULL ;
            foreach( $result as $pizza ) {
    ?>
    <div class="item">
        <h2>
            <?php echo $pizza['nom'] ?>
        </h2>
        <p>
            <?php echo $pizza['prix_vente'] ?> €
        </p>
        <div class="rate">
            <?php
                for( $i = 0 ; $i < $pizza['note_consommateur'] ; $i++ ) {
                    ?>
                        <svg xmlns="http://www.w3.org/2000/svg" height="16pt" viewBox="0 -10 511.98685 511" width="16pt"><path d="m510.652344 185.902344c-3.351563-10.367188-12.546875-17.730469-23.425782-18.710938l-147.773437-13.417968-58.433594-136.769532c-4.308593-10.023437-14.121093-16.511718-25.023437-16.511718s-20.714844 6.488281-25.023438 16.535156l-58.433594 136.746094-147.796874 13.417968c-10.859376 1.003906-20.03125 8.34375-23.402344 18.710938-3.371094 10.367187-.257813 21.738281 7.957031 28.90625l111.699219 97.960937-32.9375 145.089844c-2.410156 10.667969 1.730468 21.695313 10.582031 28.09375 4.757813 3.4375 10.324219 5.1875 15.9375 5.1875 4.839844 0 9.640625-1.304687 13.949219-3.882813l127.46875-76.183593 127.421875 76.183593c9.324219 5.609376 21.078125 5.097657 29.910156-1.304687 8.855469-6.417969 12.992187-17.449219 10.582031-28.09375l-32.9375-145.089844 111.699219-97.941406c8.214844-7.1875 11.351563-18.539063 7.980469-28.925781zm0 0" fill="#ffc107"/></svg>
                    <?php
                }
            ?>
        </div>
        <div class="update">
            <a class='up' href=<?php echo "update.php?type=pizza&nom=".str_replace(' ','_',$pizza['nom']) ?> >UP</a>
            <div class='del'>DEL</div>
        </div>

        
        <!-- The Modal -->
        <div class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <h2>Êtes-vous sûr de vouloir supprimer la pizza <?php echo $pizza['nom'] ?> ?</h2>
                <div>
                    <a class="oui" href=<?php echo "traitement.php?type=pizza&action=del&pizza=".str_replace(' ','_',$pizza['nom'])?>>Oui</a>
                    <div class="close">Non</div>
                </div>
            </div>

        </div>

    </div>
    <?php          }
            
        }
        
        /*On capture les exceptions si une exception est lancée et on affiche
         *les informations relatives à celle-ci*/
        catch(PDOException $e){
          echo "Erreur : " . $e->getMessage() ;
          die() ;
        }
    ?>
        <div class="add">
            <a href="add.php?type=pizza">
                +
            </a>
        </div>
    </section>

    <div class="separator">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160"><path fill="#f57e69" fill-opacity="1" d="M0,96L48,101.3C96,107,192,117,288,112C384,107,480,85,576,74.7C672,64,768,64,864,74.7C960,85,1056,107,1152,106.7C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 160"><path fill="#f57e69" fill-opacity="1" d="M0,96L48,101.3C96,107,192,117,288,112C384,107,480,85,576,74.7C672,64,768,64,864,74.7C960,85,1056,107,1152,106.7C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
    </div>

    <section>

        <h1>
            Nos produits
        </h1>

        <?php 
        try{
            $bdd = new PDO("mysql:host=$servername;dbname=pizzeria", $username, $password) ;
            //On définit le mode d'erreur de PDO sur Exception
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
            $bdd->query("SET NAMES utf8");
            $affiche_produit = $bdd->prepare("
                SELECT * FROM produits
            ") ;
            $affiche_produit->execute();
            $result = $affiche_produit->fetchall(PDO::FETCH_ASSOC) ;
            $bdd = NULL ;

            foreach ( $result as $produit ) {
        ?>
        
        <div class="item">
            
            <h2>
                <?php 
                echo $produit['nom']." " ;
                
                if($produit['allergene'] == 1){
                    echo "<img src='img/attention.png' alt='allergene'>" ;
                } ;
                
                ?>
            </h2>

            <p>
                <?php echo $produit['prix_kg'] ?> €/kg
            </p>

            <div class="update">
                <a class='up' href=<?php echo "update.php?type=produit&nom=".str_replace(' ','_',$produit['nom']) ?> >UP</a>
                <div class='del'>DEL</div>
            </div>
            
            <!-- The Modal -->
            <div class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <h2>Êtes-vous sûr de vouloir supprimer le produit <?php echo $produit['nom'] ?> ?</h2>
                    <div>
                        <a class="oui" href=<?php echo "traitement.php?type=produit&action=del&produit=".str_replace(' ','_',$produit['nom']) ?> >
                            Oui
                        </a>
                        <div class="close">Non</div>
                    </div>
                </div>

            </div>

        </div>

        <?php
            }
        }
        /*On capture les exceptions si une exception est lancée et on affiche
         *les informations relatives à celle-ci*/
        catch(PDOException $e){
          echo "Erreur : " . $e->getMessage() ;
          die() ;
        }
        ?>

        <div class="add">
            <a href="add.php?type=produit">
                +
            </a>
        </div>

    </section>

</main>
<script src="js/modal.js"></script>

<?php include_once 'footer.php' ?>