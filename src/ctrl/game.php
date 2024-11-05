<?php

function setNumber(){

    $_SESSION["number"] = GenerateCode(4);
    $_SESSION["check_count"] = 0;
    $_SESSION["result_hit"] = 0;
    $_SESSION["result_blow"] = 0;
}

function getNumber(){

    return $_SESSION["number"];
}
function checkNumber($number) {

    $res = array();
    $res["hit"] = 0;
    $res["blow"] = 0;

    
    if( isset($_SESSION["number"]) ){

        $correct = str_split($_SESSION["number"]);
        $guess = str_split($number);

        // Hitチェック
        for ($i = 0; $i < count($guess); $i++) {
            if ($guess[$i] === $correct[$i]) {
                $res["hit"]++;
                $correct[$i] = null;
                $guess[$i] = null;
            }
        }

        // Blowチェック
        foreach ($guess as $i => $g) {
            if ($g !== null && in_array($g, $correct)) {
                $res["blow"]++;
                $index = array_search($g, $correct);
                $correct[$index] = null;
            }
        }

        $_SESSION["result_hit"] += $res["hit"];
        $_SESSION["result_blow"] += $res["blow"];

        $_SESSION["check_count"]++;
    }

    return $res;
}


?>