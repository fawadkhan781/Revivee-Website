let modal = (function () {/*
<div id="background_fade" style="z-index:9999999; height: 100% !important; min-height: 100%; width: 100%; position: fixed; top: 0; background-color: rgba(0, 0, 0, 0.7);display:none;">
        <div id="processing" style="z-index:99999999;display: block; padding-right: 17px;" class="modal fade show" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ajax_modal modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal_title">Processing..</h4>
                        <button type="button" class="btn" onclick="$('#background_fade').fadeOut(function() { $(this).remove(); });" aria-hidden="true"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <div id="modal_data" style="padding: 5px 20px;">
                            <img style="margin: 0 auto;display: block;" src="data:image/gif;base64,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">
                            <p style="text-align: center;margin-top: 3px;">Please wait a while your request is being processed...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 */}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1];



/**
 * @param {string} response_div
 * @param {string} php_file
 * @param {Document | Blob | ArrayBufferView | ArrayBuffer | FormData | ReadableStream<Uint8Array> | string} form_data
 */
function call_ajax(response_div, php_file, form_data) {
    let request =  new XMLHttpRequest();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('#background_fade').fadeOut(function() {
                $(this).remove();
            });
            $('.btn').removeAttr('disabled');
            if(response_div == '') {
                if(request.responseText.toLowerCase().search('fail') != -1) {
                    swal("Failure", JSON.parse(request.responseText).result, "error");
                } else {
                    swal("Success", JSON.parse(request.responseText).result, "success");
                }
            } else {
                if(request.responseText != ""){
                    document.getElementById(response_div).innerHTML = request.responseText;
                }
            }
        }
    }
}

/**
 * @param {string} response_div
 * @param {string} php_file
 * @param {Document | Blob | ArrayBufferView | ArrayBuffer | FormData | ReadableStream<Uint8Array> | string} form_data
 * @param {a[]} functions
 */
function call_ajax_with_functions(response_div, php_file, form_data, functions) {
    let request =  new XMLHttpRequest();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            $('.btn').removeAttr('disabled');
            $('#background_fade').fadeOut(function() {
                $(this).remove();
            });
            if(response_div == '') {
                try {
                    json = JSON.parse(request.responseText);
                    if(json.status.toLowerCase()=="success") {
                      new swal("Success", json.result, "success");
                    } else {
                       new swal("Failure", json.result, "error");
                    }
                } catch (ex){
                    new swal("Failure", " Error! Unexpected Response", "error");
                    console.log(request.responseText);
                }
            } else {
                if(request.responseText.toLowerCase().search('failure') !== -1) {
                    new swal("Failure", "Unexpected Error", "error");
                } else {
                    document.getElementById(response_div).innerHTML = request.responseText;
                }
            }
            if(functions.length > 0) {
                if(request.responseText.toLowerCase().search('failure') !== -1) {
                } else {
                    try {
                        json = JSON.parse(request.responseText);
                        if(json.status.toLowerCase()=="success") {
                            while (functions.length) {
                                functions.shift().call();
                            }
                        }
                    } catch (ex){
                        while (functions.length) {
                            functions.shift().call();
                        }
                    }
                }
            }
        }
    }
}

/**
 * @param {string} method
 * @param {string|FormData} php_file
 * @param {string} form_data
 * @param {string} title
 */
function call_ajax_modal(method, php_file, form_data, title) {
    let request =  new XMLHttpRequest();
    request.open(method, php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('.btn').removeAttr('disabled');
            if(request.responseText != ""){
                document.getElementById('modal_title').innerHTML = title;
                document.getElementsByClassName('ajax_modal')[0].className = "modal-dialog ajax_modal modal-lg";
                document.getElementById('modal_data').innerHTML = request.responseText;
            } else {
                Swal.fire("Failure", "No Response..", "error");
                $('#background_fade').fadeOut(function() {
                    $(this).remove();
                });
            }
        }
    }
}

/**
 * @param {string} php_file
 * @param {Document | Blob | ArrayBufferView | ArrayBuffer | FormData | ReadableStream<Uint8Array> | string} form_data
 * @param {string} title
 * @param {a[]} functions
 */
function call_ajax_modal_with_functions(php_file, form_data, title, functions)
 {
    let request =  new XMLHttpRequest();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            $('.btn').removeAttr('disabled');
            if(request.responseText != ""){
                document.getElementById('modal_title').innerHTML = title;
                document.getElementById('modal_data').innerHTML = request.responseText;
            } else {
                Swal.fire("Failure", "No Responce..", "error");
                $('#background_fade').fadeOut(function() {
                    $(this).remove();
                });
            }
            if(functions.length > 0)
            {
                while (functions.length){
                    functions.shift().call();
                }
            }
        }
    }
}
function call_ajax_div_with_functions(response_div, php_file, form_data, functions) {
    let request =  new XMLHttpRequest();
    request.open("POST", php_file, true);
    request.send(form_data);
    $('body').append(modal);
    $('#background_fade').fadeIn();
    $('.btn').attr('disabled','disabled');
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            $('.btn').removeAttr('disabled');
            $('#background_fade').fadeOut(function() {
                $(this).remove();
            });
            if(response_div == '') {
                try {
                    json = JSON.parse(request.responseText);
                    if(json.status.toLowerCase()=="success") {
                        new swal("Success", json.result, "success");
                    } else {
                        new swal("Failure", json.result, "error");
                    }
                } catch (ex){
                    new swal("Failure", " Error! Unexpected Response", "error");
                    console.log(request.responseText);
                }
            } else {
                if(request.responseText.toLowerCase().search('doom') !== -1) {
                    new swal("Failure", "Unexpected Error", "error");
                } else {
                    document.getElementById(response_div).innerHTML = request.responseText;
                }
            }
            if(functions.length > 0) {
                if(request.responseText.toLowerCase().search('doom') !== -1) {
                } else {
                    try {
                        json = JSON.parse(request.responseText);
                        if(json.status.toLowerCase()=="success") {
                            while (functions.length) {
                                functions.shift().call();
                            }
                        }
                    } catch (ex){
                        while (functions.length) {
                            functions.shift().call();
                        }
                    }
                }
            }
        }
    }
}

function print_div(print_target) {
    let divElements = document.getElementById(print_target).innerHTML;
    newpage = window.open('', '_blank');
    data = "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css'>";
    let script = newpage.document.createElement('script');
    script.setAttribute('type', 'text/javascript');
    script.innerHTML = "setInterval(function(){ window.print(); window.close(); }, 2000);";
    newpage.document.body.innerHTML = data + divElements;
    newpage.document.body.appendChild(script);
    var $link = $(newpage.document.body).find('a');
    $($link).replaceWith(function(){
        return $("<span>" + $(this).html() + "</span>");
    });
}
