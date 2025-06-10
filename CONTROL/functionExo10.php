<?php

function connectMaBase(){
    $base = //mysql_connect(’localhost’, ’root’, ’’);
            mysqli_connect('localhost' , 'root', '', 'db_exo10');
    mysqli_select_db($base, 'db_exo10') ;

    return $base; //doubt.
}

?>