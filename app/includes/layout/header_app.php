<?php 
    if (!isset($_SESSION["cinetic"])) {
        header("location:?p=sign-in");
    }