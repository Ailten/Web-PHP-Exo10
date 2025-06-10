<?php

echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
echo '<script type="text/javascript" src="../VIEW/js/jsExo8.js"></script>';

 /* //send POST to JS.
if(isset($_POST)){
    echo '<script> var POST = [];';
    foreach($_POST as $index => $value)
        echo 'POST.push({index:"'.$index.'", value:"'.$value.'"});';
    echo 'console.log(POST);</script>';
}
// */

 /* //save NOM in localStorage JS.
if(isset($_POST)){
    echo '<script> 
              TrySaveName("'.$_POST['NOM'].'"); 
          </script>';
}
// */

echo '<section>
        <h2>Nous contacter</h2>
        
        <form id="MyFormTest" action="#" method="post">
        
          <h3 id="titleForm">Formulaire de contact</h3>
        
          '.
    ((isset($_POST) && isset($_POST['UTILISATEUR_OK']) && $_POST['UTILISATEUR_OK']=='on')?
        '<p>Bienvenue '.$_POST['UTILISATEUR_NOM'].'</p>':
        '')
          .'
        
          <p>
          <label for="NOM">*Nom : <span></span></label>'.
    ((isset($_POST) && isset($_POST['NOM']))?
          '<input type="text" palceholder="Nom, Prénom" name="NOM" id="NOM" value="'.$_POST['NOM'].'"/>':
          '<input type="text" palceholder="Nom, Prénom" name="NOM" id="NOM"/>')
          .
    ((isset($_POST) && isset($_POST['NOM']) && preg_match('/^[a-z]{2,}(,|, )[a-z]{2,}$/i', $_POST['NOM']))?
          '<input type="text" name="UTILISATEUR_NOM" id="UTILISATEUR_NOM" class="hidden" value="'.$_POST['NOM'].'"/>
           <input type="checkbox" name="UTILISATEUR_OK" id="UTILISATEUR_OK" class="hidden" checked>':
          '<input type="text" name="UTILISATEUR_NOM" id="UTILISATEUR_NOM" class="hidden"/>
           <input type="checkbox" name="UTILISATEUR_OK" id="UTILISATEUR_OK" class="hidden">')
          .
    ((isset($_POST) && isset($_POST['NOM']))?
        '<input name="POST_OK" id="POST_OK" type="button" class="hidden" checked/>':
        '')
          .'</p>
          
          <p>
          <label for="EMAIL">*Email : <span></span></label>'.
    ((isset($_POST) && isset($_POST['EMAIL']))?
          '<input type="email" palceholder="Email@monfournisseur.com" name="EMAIL" id="EMAIL" value="'.$_POST['EMAIL'].'"/>':
          '<input type="email" palceholder="Email@monfournisseur.com" name="EMAIL" id="EMAIL"/>')
          .'</p>
          
          <p>
          <label for="JESUIS">*Je suis : <span></span></label>'.
    ((isset($_POST) && isset($_POST['JESUIS']) && $_POST['JESUIS']=='PROF')?
          '<select name="JESUIS" id="JESUIS">
             <option value="PARTIC">Particulier</option>
             <option value="PROF" selected>Professionnel</option>
           </select>':
          '<select name="JESUIS" id="JESUIS">
             <option value="PARTIC" selected>Particulier</option>
             <option value="PROF">Professionnel</option>
           </select>')
          .'</p>
          
          <p>
          <label for="MESSAGE">*Votre message : <span></span></label>
          <textarea id="MESSAGE" name="MESSAGE" rows="4" cols="50">'.
    ((isset($_POST) && isset($_POST['MESSAGE']))?
          $_POST['MESSAGE']:
          '')
          .'</textarea>
          </p>
          
          <p>
          <input type="checkbox" name="NEWSLETTER" name="NEWSLETTER"'.
    ((isset($_POST) && isset($_POST['NEWSLETTER']) && $_POST['NEWSLETTER']=='on')?
        ' checked':
        '')
          .'/>
          <label for="NEWSLETTER" class="inline">Je veux recevoir la newsletter <span></span></label>
          </p>
          
          <input id="SUBMIT" type="submit" value="Envoyer"/>
          '.
    ((isset($_POST) && isset($_POST['UTILISATEUR_OK']) && $_POST['UTILISATEUR_OK']=='on')?
          '<input type="button" id="DECO" value="se déconnecter"/>':
          '')
          .'
          
        </form>
        
      </section>';

?>
