<?php
include("../Backrubs/config.php");

$sql = $con->prepare("SELECT title, url, score, MATCH (title,url) AGAINST ('+apple' IN BOOLEAN MODE) AS tfWeight FROM sites ");
$sql->execute();

$order_results = array();

if($sql->rowCount()>0){
    foreach($sql as $search){
        
        //Pesos = 1.0 * frequenciaScore + 1.0 * PagerankScore
        $freqenciaScore = $search['tfWeight'];
        $pagerankScore = $search['score'];
        $url = $search['url'];
        
        $Pesos = $freqenciaScore * 1.0 + $pagerankScore * 1.0;
        
        $order_results[] = array($Pesos, $url);
        
    }
    
    arsort($order_results);
    
    echo '<pre>';
    var_dump($order_results);
    echo '</pre>';
    
//    arsort($order_results);
//    
//    foreach($order_results as $key => $value){
//                                     
//         unset($value[0]);
//         echo implode($value,' ');
//         echo PHP_EOL;
//
//
//    }

}

?>