<?php 

function setSession(string $nameSession, string $valueSession){
   $_SESSION["{$nameSession}"] = "{$valueSession}";
   return $_SESSION["{$nameSession}"];
}

function setSessions(array $sessions){
    foreach($sessions as $nameSession => $valueSession){
        $_SESSION["{$nameSession}"] = "{$valueSession}";
    }

    return $_SESSION;
}

function getSession(string $nameSession){
    return $_SESSION["{$nameSession}"];
}

function putSession(string $nameSession, string $newValue){
    $_SESSION["{$nameSession}"] = "{$newValue}";
    return $_SESSION["{$nameSession}"];
}

function unsetSession(string $nameSession){
    unset($_SESSION["{$nameSession}"]);
}

function viewSession(string $nameSession){
    echo $_SESSION["{$nameSession}"];
}

function viewSessionSelect(string $nameSession){

    if(isset($_SESSION["{$nameSession}"])){
        echo "<option value='".$_SESSION["{$nameSession}"]."' selected>".$_SESSION["{$nameSession}"]."</option>";
        unsetSession("{$nameSession}");
    }
}

function validateSession(string $nameSession, string $outroValor = null){
   if(isset($_SESSION["{$nameSession}"])){
      viewSession("{$nameSession}");
      unsetSession("{$nameSession}");
   }else{
      echo $outroValor;
   }
}

function issetSession(string $nameSession){
  isset($_SESSION["{$nameSession}"]);
}