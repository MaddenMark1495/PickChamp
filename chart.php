<?php
$link = mysqli_connect("#", "#", "#", "#") or die("Connect Error ". mysqli_error($link));

$leagues = array();

$sql = "SELECT * FROM pick";
$pick_fields = array('pick1','pick2','pick3','pick4','pick5');

$leaguesSql = "SELECT DISTINCT leagueName FROM pick";
if ($res = mysqli_query($link, $leaguesSql)) {
    while ($row = mysqli_fetch_assoc($res)) {
        $leagues[$row['leagueName']] = array('A' => 0,'B' => 0);
    }
}

if ($res = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_assoc($res)) {
        foreach ($row as $colName => $value)
        {
            
            if(in_array($colName, $pick_fields)) {
                $leagues[$row['leagueName']][$value]++;
            }
            
        }
    }
}

$result = array();
foreach ($leagues as $league => $l_data)
{
    foreach ($l_data as $variant => $summa)
    {
        $obj = new stdClass();
        $obj->name = $variant;
        $obj->y = round($summa / array_sum(array_values($l_data)), 2, PHP_ROUND_HALF_DOWN);
        $result[$league][$variant] = $obj;
        
    }
}
echo json_encode($result);
exit;
