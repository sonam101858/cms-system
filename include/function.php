<?php
function Redirect_to($New_Location){
    header("Location".$New_Location);
}

function Redirect_to_self($New_Location){
    header("Location: ".$New_Location);
}
?>