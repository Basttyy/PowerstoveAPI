$(document).ready(function(){

})

function showDefaultPage(url){
    authenticateDefault("api/v1/auth/profile")
        .then(
            function(response){
                // if valid, show homepage
                loadHTML(url, 'content');
                showLoggedInMenu();
            }
        ).catch(
            function(xhr, resp, text){
                alert(xhr.responseJSON.message);
                router.navigate(login_page);
                //$('#response').html("<div class='alert alert-danger'>Please login to access the home page.</div>");
            }
        )
}