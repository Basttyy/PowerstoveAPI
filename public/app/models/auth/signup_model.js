let signup = (url, sign_up_form_obj) =>{
    return new Promise((resolve, reject) =>{
        var form_data=JSON.stringify(sign_up_form_obj);
        alert(form_data);
        // submit form data to api
        $.ajax({
            url: url,
            type : "POST",
            contentType : 'application/json',
            data : form_data
        }).done((response) =>{
            resolve(response);
        }).fail((xhr, resp, text) =>{
            reject(xhr);
        });
    });
}

let authenticateSignup = (path) => {
    return new Promise((resolve, reject) =>{
        var jwt = getCookie('jwt');
        var settings = {
            "url" : api_url + path,
            "method" : "GET",
            "timeout" : 0,
            "headers" : {
                "Accept" : "application/json",
                "Content-Type" : "application/json",
                "Authorization" : jwt
            },
        };

        $.ajax(settings)
            .done((response) =>{
                //if authentication successful
                resolve(response);
                // if valid, show homepage
            })
            .fail((xhr, resp, text) =>{
                //reject if authentication failed
                reject(xhr);
            });
    });
}