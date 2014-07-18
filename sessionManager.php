<?php
// Because we have to use sessions we can use this and include it in every file
// such that all session variables are in one place and can be propagated across
// all of the site functionality

session_start();

// AUTHENTICATION_TICKET after login this ticket will be passed around as
//                       the credential that verifies the authenticity of the user
$_SESSION["AUTHENTICATION_TICKET"] = "";

?>