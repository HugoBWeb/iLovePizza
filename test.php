<?php

$t1 = [1,2,3,4] ;
$t2 = [1,3,5] ;

echo 'valeurs de t1 <br>' ;
print_r($t1) ; 

echo '<br><br> valeurs de t2 <br>' ;
print_r($t2) ; 

echo '<br><br> valeurs de t1 pas dans t2 <br>' ;
print_r( array_diff($t1,$t2) ) ; 

echo '<br><br> valeurs de t2 pas dans t1 <br>' ;
print_r( array_diff($t2,$t1) ) ; 

?>