<?php


function MakeTableWithClass($semaineThead=1, $ceQueJeFaisThead=false)
{
    $DAYSOFWEEK = array(
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi',
    'Samedi',
    'Dimanche');

    echo '<table class="ClassTableExo4">';

    echo '<thead>
                <tr>';

    if($semaineThead!=1) //add semaine in thead.
        echo '<th>Semaine</th>';

    echo '<th>Jour</th>';  //add jour in thead.

    if($ceQueJeFaisThead)
        echo '<th>Ce que je fais</th>';

    echo '  </tr>
              </thead>';


    echo '<tbody>';

    for($weekCount=1; $weekCount<=$semaineThead; $weekCount++) //for all week.
    {

        for($day=0; $day<7; $day++) // 7 jours de la semaine.
        {
            echo '<tr>';

            if($semaineThead!=1 && $day==0) //add semaine in tbody.
                echo '<td rowspan="7">'.$weekCount.'</td>';

            echo '<td>'.$DAYSOFWEEK[$day].'</td>';  //add jour in thead.

            if($ceQueJeFaisThead) //add qeQueJeFais in tbody.
            {
                if($day<=4) // vendredi and befor.
                    echo '<td>Ecole</td>';
                else  //after vendredi.
                    echo '<td>Maison</td>';
            }

            echo '</tr>';
        }

    }

    echo '</tbody>';

    echo '</table>';
}

?>
