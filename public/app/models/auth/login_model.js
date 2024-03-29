//make login https request to api
let login = (path, form_data) =>{
    return new Promise((resolve, reject) => {
        //serialize the form data
        form_data = JSON.stringify(form_data.serializeObject());
    
        // submit form data to api
        $.ajax({
            url: api_url + path,
            type : "POST",
            contentType : 'application/json',
            Accept : "application/json",
            data : form_data
        }).done((response) =>{
            //this means the api call suceeded, so resolve the response
            resolve(response);
        }).fail((error, resp, text) =>{
            //this means the api call failed, so reject on the error
            reject(error);
        });
    });
}

let prepareLogin = (url) => {
    // remove jwt
    setCookie("jwt", "", 86400000);
    loadHTML(url, 'hide-nav-view');
    setTimeout(() => {
        setAuthForm()
    }, 200);
};