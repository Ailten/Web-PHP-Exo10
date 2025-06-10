<?php

//echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
echo '<script type="text/javascript" src="../VIEW/js/jsExo9.js"></script>';

$perso1 = new Personnage(50,20,100, "personnage 1");
$perso2 = new Personnage(100,30,100, "personnage 2");

$myForm = new Form();
$myForm->setText('* Nom', 'NOM', 'NOM', 'Thomas');
$myForm->setEmail('* Email', 'EMAIL', 'EMAIL', 'mon@email.com');

echo '<section>
        <h2>Classe PHP</h2>
        
        <article>
          <h3>info</h3>
          <p>
          '.
    $perso1->presente()
          .
    $perso2->presente()
          .'
          </p>
        </article>
        
        <article>
          <h3>combat</h3>
          <p>
          '.$perso1->combat($perso2).'
          </p>
        </article>
        
        <article>
          <h3>Nous contactez</h3>
          '.$myForm->getForm().'
        </article>
        
      </section>';

?>
