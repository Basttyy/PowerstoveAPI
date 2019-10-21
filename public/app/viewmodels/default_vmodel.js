$(document).ready(function(){

})

function showDefaultPage(url){
    authenticateDefault("api/v1/auth/profile")
        .then(
            function(response){
                // if valid, show homepage

                loadHTML(url, 'content');
                showLoggedInMenu();
                if($(window).innerWidth() < 1025) {
                    closeSideNav()
                }
                //populate the page
                setTimeout(() => {
                    var data, options
                    // headline charts
                    data = {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        series: [
                            [23, 29, 24, 40, 25, 24, 35],
                            [14, 25, 18, 34, 29, 38, 44],
                        ]
                    };
            
                    options = {
                        height: 300,
                        showArea: true,
                        showLine: false,
                        showPoint: false,
                        fullWidth: true,
                        axisX: {
                            showGrid: false
                        },
                        lineSmooth: false,
                    };
            
                    new Chartist.Line('#headline-chart', data, options);
                    $("#username").html(response.name)
                    $("#useravatar").attr("src", response.avatar)
                }, 25);
            }
        ).catch(
            function(xhr, resp, text){
                alert(xhr.responseJSON.message);
                router.navigate(login_page);
                //$('#response').html("<div class='alert alert-danger'>Please login to access the home page.</div>");
            }
        )
}
