<?php 
    include_once "constants.php";

    // dataaccess.php can be included in all files that need access to the database
    // that way if we need to change anything it propagates to all of the other pages.

    // One global function to create a connection to the database
    function getConnection(){
        $connection = mysqli_connect("localhost", "admin", "", "test"); //host, username, pw, dbname
        if (mysqli_connect_errno())
        {
            header("Location: dataaccesserror.html");
        }
        return $connection;
    }
    // One and only one clean up of SQL resources
    function releaseSQLResource($result){
        mysqli_free_result($result);
    }
    // Create the blog which should be run from createBlog.php
    // Parameters: blogOwner (userid from the users table), title
    // Returns: blogID, or the constant $BLOG_OWNER_ALREADY_EXISTS
    function createBlog($blogOwner, $title){
        $sql = "INSERT INTO blogs (blogOwner, title) values ($blogOwner,'$title')";
        // if blog was already created and the values to create the blog are good
        if(runDML($sql) && !userAlreadyOwnsBlog($blogOwner)){
            $sql="select blogID from blogs where blogOwner=$blogOwner and title='$title'";
            $blogID = mysqli_fetch_array(runSelectSQL($sql));
            return $blogID["blogID"];
        }
        return $GLOBALS['BLOG_OWNER_ALREADY_EXISTS'];
    }
    // Create a post which should be run from createPost.php
    function createPost($blogID, $title, $content){
        $sql = "INSERT INTO posts (blogID, title, content) values ($blogID, '$title', '$content');"
        if(runDML($sql)){
            return $GLOBALS['POST_CREATED_SUCCESSFULLY'];
        }
        return $GLOBALS['POST_CREATION_FAILED'];
    }
    // Edit a post which should be run from editPost.php
    function editPost($postID, $content){
        $sql = "UPDATE posts SET content = '$content' WHERE postID = $postID;";
        if(runDML($sql)){
            return $GLOBALS['POST_EDITED_SUCCESSFULLY'];
        }
        return $GLOBALS['POST_EDIT_FAILED'];
    }
    // Delete a post which should be run from deletePost.php
    function deletePost($postID){
        $sql = "DELETE FROM posts WHERE postID = $postID;";
        if(runDML($sql)){
            return $GLOBALS['POST_DELETED_SUCCESSFULLY'];
        }
        return $GLOBALS['POST_DELETE_FAILED'];
    }
    // Delete a comment which should be run from deleteComment.php
    function deleteComment(){
    }
    // Add a comment which should be run from addComment.php
    function addComment(){
    }
    // Get a list of blogs available in the system
    function getBlogs(){
    }
    // Get a post the user selected which should be run from viewPost.php
    function viewPost(){
    }
    // Tests if user already has blog
    function userAlreadyOwnsBlog($blogOwner){
        $con = getConnection();
        $sql = "SELECT * FROM blogs where blogOwner=$blogOwner;";
        if(mysqli_num_rows(mysqli_query($con, $sql))>0){
            return true;
        }
        return false;
    }
    // Runs any Data Manipulation Language Query, a.k.a. Insert, Update or Delete
    function runDML($dml){
        $con = getConnection();
        if($result=mysqli_query($con, $dml)){
            return true;
        }
        return false;
    }
    // Runs any valid select statement
    function runSelectSQL($query){
        $con = getConnection();
        if($result=mysqli_query($con, $query)){
            return $result;
        }
        return mysqli_error($con);
    }
?>