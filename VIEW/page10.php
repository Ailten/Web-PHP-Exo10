<?php

echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
echo '<script type="text/javascript" src="../VIEW/js/jsExo10.js"></script>';

$myForm = new Form2('FORM', 'post', '#');
$myForm->setText('* Pseudo', 'PSEUDO', 'MonPseudo', true);
$myForm->setDropListe('* Sexe', 'SEXE',
    array("G", "Garçon",
          "F", "Fille",
          "A", "Autre"), true);
$myForm->setInt('* Age', 'AGE', '', 0, 199, true);
//$myForm->setEmail('* Email', 'EMAIL', 'mon@email.com', true);

echo '<section>
        <h2>Formulaire + DB</h2>
        
        <article>
          <h3>Inscription</h3>
          ';

if (isset($_POST) && count($_POST)!=0)
{
    //-------------------------->>>>>> insert DB.

    $pseudo = $_POST['PSEUDO'];
    $sexe = $_POST['SEXE'];
    $age = $_POST['AGE'];
    $dateInscription = date("d.m.y");

    if(!preg_match('/^[a-z0-9-]{3,15}$/i', $pseudo) ||
       !preg_match('/^[GFA]$/i', $sexe) ||
       !preg_match('/^[1]?[0-9]{1,2}$/i', $age))
    {
        //champs invalide.
        echo '<p>Inscription refusée : champs invalide !</p>';
    }
    else
    {
        $base = connectMaBase();

        $sql = 'INSERT INTO 
            `user` (`pseudo`,      `sexe`,      `age`,      `date_inscription`)
            VALUES ("'.$pseudo.'", "'.$sexe.'", "'.$age.'", "'.$dateInscription.'")';

        mysqli_query ($base, $sql) or die ('Erreur SQL !'.$sql.'<br />'.mysqli_error($base));

        mysqli_close($base);
    }

    //-------------------------->>>>>>

    echo '<p>Inscription envoyée</p>';

}
else
{
    echo $myForm->getForm();
}

echo '  </article>
        
        <article>
          <h3>Liste inscription</h3>
        ';

//-------------------------->>>>>> select DB.

$base = connectMaBase();
$sql = 'SELECT * FROM user';
$req = mysqli_query($base, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($base));

echo '<table class="table3">
        <thead>
          <tr>
            <th>pseudo</th>
            <th>sexe</th>
            <th>age</th>
            <th>date d\'inscription</th>
          </tr>
        </thead>
        <tbody>';
while ($data = mysqli_fetch_array($req)) {
    echo '<tr>
            <td>'.$data['pseudo'].'</td>
            <td>'.(($data['sexe'] == 'G') ? 'Garçon' :
                  (($data['sexe'] == 'F') ? 'Fille' :
                                            'Autre')).'</td>
            <td>'.$data['age'].' ans</td>
            <td>'.$data['date_inscription'].'</td>
          </tr>';
}
echo '  </tbody>
      </table>';

mysqli_free_result ($req);
mysqli_close ($base);

//-------------------------->>>>>>

echo '  </article>
        
      </section>';

?>
