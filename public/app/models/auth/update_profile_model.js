let updateProfile = (url, form_data_obj) => {
    return new Promise((resolve, reject) =>{
        
        // convert object to json string
        var json_form_data=JSON.stringify(form_data_obj);
        alert(json_form_data);

        // submit form data to api
        $.ajax({
            url: url,
            type : "POST",
            contentType : 'application/json',
            data : json_form_data
        }).done((response) =>{
            //this means the api call suceeded, so resolve the response
            alert('profile updated');
            resolve(response);
        }).fail((xhr, resp, text) =>{
            //this means the api call failed, so reject on the error
            alert('profile udate failed');
            reject(xhr);
        });
    });
}

let populateUpdateForm = (path) =>{
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