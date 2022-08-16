<?php
session_start();


 
function ErrorMessage(){
    if(isset($_SESSION["ErrorMessage"])){
        $Output = "<div class=\"alert alert-danger\">";
        $Output .= htmlentities($_SESSION["ErrorMessage"]);
        $Output .="</div>";
        $_SESSION["ErrorMessage"] = null;
        return $Output;
    } 
}

function successMessage(){
    if(isset($_SESSION["successMessage"])){
        $Output = "<div class=\"alert alert-success\">";
        $Output .= htmlentities($_SESSION["successMessage"]);
        $Output .="</div>";
        $_SESSION["successMessage"] = null;
        return $Output;
    } 
}


?>