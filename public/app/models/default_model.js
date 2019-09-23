let authenticateDefault = (path) =>{
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
            .done(function (response){
                resolve(response);
            })
            // show login page on error
            .fail(function (xhr, resp, text) {
                reject(xhr);
            });
    })
}