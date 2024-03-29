let resetPassword = (url, params) =>{
    return new Promise((resolve, reject) =>{
        resetData = JSON.stringify(params.serializeObject());
        alert(resetData);
        $.ajax({
            url: url,
            type: "PUT",
            contentType: "application/json",
            Accept : "application/json",
            data: resetData
        })
        .done((response) =>{
            //this means the api call succeeded
            resolve(response);
        })
        .fail((xhr, resp, text) =>{
            reject(xhr);
        });
    });
};