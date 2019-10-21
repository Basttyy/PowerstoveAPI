<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">


        <title>Powerstove Admin Portal</title>

        <!-- CSS -->
        <link rel="stylesheet" href="app/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="app/assets/css/vendor/icon-sets.css">
        <link rel="stylesheet" href="app/assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="app/assets/vendor/linearicons/style.css">
        <link rel="stylesheet" href="app/assets/css/main.css">
	    <link rel="stylesheet" href="app/assets/vendor/chartist/css/chartist-custom.css">
        <!--<link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">-->
        <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
        <!--<link rel="stylesheet" href="app/assets/css/demo.css">-->
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
        <!-- ICONS -->
        <link rel="apple-touch-icon" sizes="76x76" href="app/assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="app/assets/img/favicon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="app/assets/img/company_img/powerstove-logo.png">
    </head>
    <body>
        <!--Begin Wrapper-->
        <div id="wrapper">
            <!--Begin Hide Nav View-->
            <div id="hide-nav-view">

            </div>
            <!--End hide Navs-->
            <div class="clearfix"></div>
        </div>
        <!--End Wrapper-->
                <!--Javascript-->
        <!-- jQuery & Bootstrap 4 JavaScript libraries -->
        <script type="text/javascript" src="/app/assets/js/jquery/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="/app/assets/js/jquery/jquery-2.1.0.js"></script>
        <!-- bootbox for confirm pop up -->
        <script type="text/javascript" src="app/assets/js/bootbox.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script type="text/javascript" src="/app/assets/js/bootstrap/bootstrap.min.js"></script>  
        <script type="text/javascript" src="/app/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script type="text/javascript" src="/app/assets/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
        <script type="text/javascript" src="/app/assets/js/klorofil.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>            
        <script type="text/javascript" src="app/app.js"></script>
        <!--Model Scripts-->
        <script type="text/javascript" src="/app/models/default_model.js"></script>
        <script type="text/javascript" src="/app/models/auth/login_model.js"></script>
        <script type="text/javascript" src="/app/models/auth/update_profile_model.js"></script>
        <script type="text/javascript" src="/app/models/auth/signup_model.js"></script>
        <script type="text/javascript" src="/app/models/auth/forgot_password_model.js"></script>
        <script type="text/javascript" src="/app/models/auth/reset_password_model.js"></script>
        <script type="text/javascript" src="/app/models/auth/verify_account_model.js"></script>
        <script type="text/javascript" src="/app/models/auth/lock_screen_model.js"></script>
        <script type="text/javascript" src="/app/models/user/profile_model.js"></script>
        <script type="text/javascript" src="/app/models/error_model.js"></script>
        <!--ViewModel Scripts-->
        <script type="text/javascript" src="/app/viewmodels/default_vmodel.js"></script>
        <script type="text/javascript" src="/app/viewmodels/auth/login_vmodel.js"></script>
        <script type="text/javascript" src="/app/viewmodels/auth/update_profile_vmodel.js"></script>
        <script type="text/javascript" src="/app/viewmodels/auth/signup_vmodel.js"></script>
        <script type="text/javascript" src="/app/viewmodels/auth/forgot_password_vmodel.js"></script>
        <script type="text/javascript" src="/app/viewmodels/auth/reset_password_vmodel.js"></script>
        <script type="text/javascript" src="/app/viewmodels/auth/verify_account_vmodel.js"></script>
        <script type="text/javascript" src="/app/viewmodels/auth/lock_screen_vmodel.js"></script>        
        <script type="text/javascript" src="/app/viewmodels/user/profile_vmodel.js"></script>
        <script type="text/javascript" src="/app/viewmodels/error_vmodel.js"></script>
        <!--Library Scripts-->
        <script type="text/javascript" src="/app/lib/navigo.js"></script>
        <script type="text/javascript" src="/app/lib/router.js"></script>
        <script>
            router.updatePageLinks();
            if((window.location.href == api_url)||(window.location.href == api_url+'#')){
                loadHTML('./app/views/nav-template.html', 'hide-nav-view');
                setTimeout(() => {
                    router.navigate(home_page+'#')
                }, 20);
            }
            urls = ['#'+update_profile_page, '#'+add_user_page, '#'+profile_page, '#'+users_page, '#'+user_details_page, '#'+payment_page]
            curr = window.location.hash
            val = true
            $.each(urls, function(index, value) {
                val &= curr != value
            })
            if(!val){
                loadHTML('./app/views/nav-template.html', 'hide-nav-view');
            }
        </script>
    </body>
</html>