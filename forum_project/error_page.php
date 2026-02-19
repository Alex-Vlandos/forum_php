<?php
    $errorMessage=empty($_SESSION["Error_Message"])
    ? "Unknown error!"
    : $_SESSION["Error_Message"];
    echo $errorMessage;
?>