// Bad Ass Javascript by Bad Ass Blogs, Inc.
function validateCreateBlog(){
    var form = document.getElementById("createblog");
    if(form.blogname.value!=""){
        return true;
    }
    var notify = document.getElementById("notification");
    notify.innerHTML = "You must enter a name for your blog";
    return false;
}