<?php

function ListeLine1($min, $max)
{
    for ($i = $min; $i <= $max; $i++) {
        echo 'Ceci est la ligne n°' . $i . '</br>';
    }
}


function ListeLine2($min, $max)
{
    echo '<ul>';
    for ($i = $min; $i <= $max; $i++) {
        echo '<li>Ceci est la ligne n°' . $i . '</li>';
    }
    echo '</ul>';
}


function ListeLine3($min, $max, $Libellé)
{
    echo '<table class="table3">
              <thead>
                <tr>
                  <th>#</th>
                  <th>' . $Libellé . '</th>
                </tr>
              </thead>
                <tbody>';
    for ($i = $min; $i <= $max; $i++) {
        echo '<tr>
                  <td>' . $i . '</td>
                  <td>Ceci est la ligne n°' . $i . '</td>
                </tr>';
    }
    echo '
                </tbody>
              </table>';
}

function RedBluePaire($num)
{
    if ($num % 2 == 0)
        return 'red';
    else
        return 'blue';
}

function ListeLine4($min, $max, $Libellé)
{
    echo '<table class="table3">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>' . $Libellé . '</th>
                  </tr>
                </thead>
                <tbody>';
    for ($i = $min; $i <= $max; $i++) {
        echo '<tr style="color: ' .
            RedBluePaire($i)
            . ';">
                  <td>' . $i . '</td>
                  <td>Ceci est la ligne n°' . $i . '</td>
                </tr>';
    }
    echo '
                </tbody>
              </table>';
}

?>
