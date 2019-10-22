//global variables
var api_url = 'https://powerstoveapp.herokuapp.com/'
var home_page = ''
var login_page = 'auth/login'
var forgot_password_page = 'auth/password/reset-link'
var reset_password_page = 'auth/password/reset'
var verify_email_page = 'auth/email/verify/:id'
var update_profile_page = 'user/profile/update'
var add_user_page = 'user/profile/users/signup'
var profile_page = 'user/profile'
var users_page = 'user/profile/users'
var user_details_page = 'user/profile/users/:id/user-details'
var lockscreen_page = 'user/profile/lock-screen'
var payment_page = 'user/payment'

// change page title
function changePageTitle(page_title){
 
    // change page title
    $('#panel-title').text(page_title);
 
    // change title tag
    document.title=page_title;
}

// if the user is logged in
function showLoggedInMenu(){
    // hide login and sign up from navbar & show logout button
    $("#login").hide();
    $("#logout, #update_profile, #signup").show();
}

// if the user is logged out
function showLoggedOutMenu(){
    // show login and sign up from navbar & hide logout button
    $("#login, #sign_up").show();
    $("#logout").hide();
}

// function to set cookie
function setCookie(cname, ctype, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays*1000);    // if in days then use *24*60*60*1000
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + ctype + " " + cvalue + ";" + expires + ";path=/";
}

// get or read cookie
function getCookie(cname){
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' '){
            c = c.substring(1);
        }

        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
 
// function to make form values to json format
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

// remove any prompt messages
function clearResponse(){
    $('#response').html('');
}

// $('document').on('load', function(){
//     router.updatePageLinks();
// })

/****************************
 * Template Codes           *
 ***************************/

function closeSideNav() {
    if(!$('body').hasClass('layout-fullwidth')) {
        $('body').addClass('layout-fullwidth');
    }
    if($('btn-toggle-fullwidth').find('lnr').hasClass('lnr-arrow-left-circle')) {
        $('btn-toggle-fullwidth').find('lnr').toggleClass('lnr-arrow-left-circle lnr-arrow-right-circle')
    }
    if($('body').hasClass('offcanvas-active')) {
        $('body').removeClass('offcanvas-active');
    }
}

function setAuthForm() {
    if($(window).innerWidth() < 1025) {
        $('.auth-box').height($('.form-auth').height() != null ? $('.form-auth').height()+155 : $('.form-auth-small').height()+155)
    } else {
        $('.auth-box').height($('.form-auth').height() != null ? $('.form-auth').height()+390 : $('.form-auth-small').height()+165)
    }
}
