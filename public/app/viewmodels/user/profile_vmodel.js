function showProfilePage(updateUrl){
    //link to authenticate
    var path = "api/v1/auth/profile";
    populateProfilePage(path)
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