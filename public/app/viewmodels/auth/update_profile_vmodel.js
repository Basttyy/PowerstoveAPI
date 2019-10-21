$(document).ready(function(){
    //trigger when signup form is submitted
    $(document).on('submit', '#update_account_form', function(){
        //get the form data
        var signup_form = $(this);
        var jwt = getCookie('jwt');
        var signup_form_obj = signup_form.serializeObject();
        signup_form_obj.jwt = jwt;

        updateProfile(api_url + 'api/users/update_user.php', signup_form_obj)
            .then(
                function(response){
                    //$('#response').html("<div class='alert alert-success'>"+ response + ".</div>");
                    // store new jwt to coookie
                    alert('success');
                    alert(response.message);
                    setCookie("jwt", response.jwt, 1);
                    //signup_form.find('input').val('');
                }
            )
            .catch(
                function(xhr, resp, text){
                    alert('fail');
                    if(xhr.responseJSON.message=="Unable to update user."){
                        alert("Unable to update account.");
                    }
                
                    else if(xhr.responseJSON.message=="Access denied."){
                        alert('Expired Session, please login again');
                        router.navigate(login_page);
                    }
                }
            );
        return false;
    });
    $(document.body).on('change', '#update_country', function(e){
        $('#update_state').empty();
        $('#update_state').append($('<option default="true"></option>').html("State"));
        if($('#update_country option:selected').val() != '1'){
            var jsonurl = "app/assets/data/states/" + $('#update_country option:selected').val() + ".json";
            $.getJSON(jsonurl, function(data){
                $.each(data.states, function(i, val){
                    $('#update_state').append($('<option></option>').val(val.toLowerCase()).html(val));
                });
            });
        }
    });
    $(document.body).on('change', '#update_state', function(){        
        $('#update_postal_code').empty();
        $('#update_postal_code').append($('<option default="true"></option>').html("Postal Code"));
        if($('#update_state option:selected').val() != '1'){
            var jsonurl = "app/assets/data/states/codes/" + $('#update_state option:selected').val() + ".json";
            $.getJSON(jsonurl, function(data){
                $.each(data.codes, function(i, val){
                    $('#update_postal_code').append($('<option></option>').val(val.toLowerCase()).html(val));
                });
            });
        }
    });
    // $(document.body).on('mouseenter', '#update_country', function(){
    //     $('#update_country').val(obj.country).change();
    // });
    // $(document.body).on('mouseenter', '#update_state', function(){
    //     $('#update_state').val(obj.state).change();
    // });
    // $(document.body).on('mouseenter', '#update_postal_code', function(){
    //     $('#update_postal_code').val(obj.postalCode).change();
    // });
    $(document.body).on('click', "#userimage", async function(){
        const { value: file } = await Swal.fire({
            title: 'Select Profile Picture',
            input: 'file',
            inputAttributes: {
              accept: 'image/*',
              'aria-label': 'Upload your profile picture'
            }
          })
          
          if (file) {
            const reader = new FileReader()
            reader.onload = (e) => {
              Swal.fire({
                title: 'Your uploaded picture',
                imageUrl: e.target.result,
                imageAlt: 'The uploaded picture'
              })
            }
            reader.readAsDataURL(file)
          }
    })
})

var obj = {
    firstname : "",
    lastname : "",
    email : "",
    country : "",
    state : "",
    postalCode : "",
    streetAddress : "",
    phone : ""
};

function showUpdateProfilePage(updateUrl){
    //link to authenticate
    var path = "api/v1/auth/profile";
    populateUpdateForm(path)
        .then(
            function(response){
                obj.name = response.name
                //obj.lastname = response.data.lastname;
                obj.email = response.email
                obj.country = response.country
                obj.state = response.state
                //obj.postalCode = response.data.postal_code;
                obj.streetAddress = response.address
                obj.phone = response.phone_num
                obj.avatar = response.avatar
                names = obj.name.split(" ")     // slit to firstname and last name
                loadHTML(updateUrl, 'content')
                setTimeout(function(){
                    setAuthForm()
                    // Everything will have rendered here                    
                    $('#firstname').val(names[0]);
                    $('#lastname').val(names[1]);
                    $('#email').val(obj.email);
                    $('#address').val(obj.streetAddress);
                    $('#contact_number').val(obj.phone);
                    $.getJSON("app/assets/data/countries.json", function(data){
                        $.each(data.countries, function(i, val){
                            $('#update_country').append($('<option></option>').val(val.toLowerCase()).html(val));
                        });
                    });
                    $("#username").html(response.name)
                    $("#useravatar").attr("src", obj.avatar)
                    $("#userimage").attr("src", obj.avatar)
                }, 25);
            }
        )
        .catch(
            function(xhr, resp, text){
                //alert(xhr.responseJSON.message)
                router.navigate(login_page);
            }
        );
}