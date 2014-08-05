<?php
// Because we have to use sessions we can use this and include it in every file
// such that all session variables are in one place and can be propagated across
// all of the site functionality    

session_start();

// AUTHENTICATION_TICKET after login this ticket will be passed around as
//                       the credential that verifies the authenticity of the user
if(!isset($_SESSION["AUTHENTICATION_TICKET"]))  $_SESSION["AUTHENTICATION_TICKET"] = FALSE;

// AUTHENTICATED_USER is the name of the user after login is verified   
if(!isset($_SESSION["AUTHENTICATED_USER"]))  $_SESSION["AUTHENTICATED_USER"] = "";

// AUTHENTICATED_BLOGID is the blogid of the user if they already have a blog after they login
if(!isset($_SESSION["AUTHENTICATED_BLOGID"]))  $_SESSION["AUTHENTICATED_BLOGID"] = "";

// POSTID is the postid used by the database to retrieve a  specific post
if(!isset($_SESSION["POSTID"]))
    $_SESSION["POSTID"] = "";

if(!isset($_SESSION["USERID"]))
    $_SESSION["USERID"] = "";

?>