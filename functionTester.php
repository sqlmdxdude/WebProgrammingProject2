<?php 
    include_once "dataaccess.php";
    include_once "constants.php";
// Raw blog creation tested and ok.
// Need to handle checking if blog already exists for the given user
// because the user can only have 1 blog.
// Tested to assure the user can only have 1 blog. If they already own a blog the constant is returned
/*
    $createBlog = createBlog(3, "Test blog");
    echo "The blog id is " . ($createBlog!=$GLOBALS['BLOG_OWNER_ALREADY_EXISTS']?$createBlog:$GLOBALS['BLOG_OWNER_ALREADY_EXISTS'] . " so the blog already exists");
*/

// tested if blog owner has a blog. Returns 1 if any rows are found, returned false otherwise 
/*
    $blogOwnerYet = userAlreadyOwnsBlog(3);
    echo "Does user 1 have a blog? " . $blogOwnerYet
*/
?>