let verifyAccount = (url) =>{
    return new Promise((resolve, reject) =>{
        //alert(resetData);
        $.ajax({
            url: url,
            type: "GET",
            contentType: "application/json"
        })
        .done((response) =>{
            //alert('done');
            //this means the api call succeeded
            resolve(response);
        })
        .fail((xhr, resp, text) =>{
            //alert('fail');
            reject(xhr);
        });
    });
}