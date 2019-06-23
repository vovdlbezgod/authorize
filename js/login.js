$(document).ready(function(){
    var request;
    var files;
    $('input[type=file]').change(function(){
        files = this.files;
    });

    $('#Registration').css("display","block");
    $('#regButton').click(function(){
        if (request) {
            request.abort();
        }
        var email = $('#emailReg').val(),
            pass = $('#passReg').val(),
            passRepeat = $('#passRepReg').val();
        $('#msgUsr').css("display", "none");
        $('#msgPass').css("display", "none");
        if(pass === passRepeat){
            if(email){
                var serializedData = {'email': email, 'password': pass};
                $.post('reg.php', serializedData, function (response) {
                    console.log("Response: "+response);
                    var jsonData = JSON.parse(response);
                    console.log("JsonData: "+jsonData);
                    if (jsonData.success == "0"){
                        $('#Registration').css("display", "none");
                        $('#msgReg').css("display", "block");
                        $('#UploadPicture').css("display", "block");
                    }
                    else{
                        $('#msgUsr').css("display", "block");
                    }
                });
            }
        }else {
            $('#msgPass').css("display", "block");
        }
    });
    function showError(error){
        $('#error').html(error);
    };
    $('#sendPicture').click(function (event) {
        $('#msgReg').css("display", "none");
        if(request){
            request.abort();
        }
        event.stopPropagation();
        event.preventDefault();

        var data = new FormData();
        $.each( files, function( key, value ){
            data.append( key, value );
        });

        $.ajax({
            url: 'sendPic.php?uploadfiles',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function( respond, textStatus, jqXHR ){

                if( typeof respond.error === 'undefined' ){
                    console.log("Успешно");
                    console.log("JsonData: "+respond.files);
                    $('#msgAvatar').css("display", "block");
                    $('#UploadPicture').css("display", "none");
                    $('#Login').css("display", "block");
                }
                else{
                    console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log('ОШИБКИ AJAX запроса: ' + textStatus );
            }
        });

    });
    $('#showLogButton').click(function(){
        $('#msgAvatar').css("display", "none");
        $('#msgReg').css("display", "none");
        $('#msgPass').css("display", "none");
        $('#msgUsr').css("display", "none");
        $('#UploadPicture').css("display", "none");
        $('#Registration').css("display", "none");
        $('#Login').css("display", "block");
    });
    $('#logButton').click(function(event){
        $('#Registration').css("display", "none");
        $('#msgAvatar').css("display", "none");
        $('#msgUsrEmpty').css("display", "none");
        if(request){
            request.abort();
        }
        event.stopPropagation();
        event.preventDefault();

        var email = $('#emailLog').val(),
            pass = $('#passLog').val();

        if(email && pass){
            var serializedData = {'email': email, 'password': pass};
            $.post('login.php', serializedData, function (response) {
                console.log("Response: "+response);
                var jsonData = JSON.parse(response);
                console.log("JsonData: "+jsonData);
                if (jsonData.success == "0"){
                    $('#Login').css("display", "none");
                    $('#User').css("display", "block");
                    var session_id = jsonData.session_id,
                        email = jsonData.email,
                        dir_img = jsonData.image_dir;
                    $('#session_id').text("Сессия: " + session_id);
                    $('#user_email').text("E-mail: " + email);
                    $('#user_dir').text("Директория: " + dir_img);
                }
                else{
                    $('#msgUsrEmpty').css("display", "block");
                }
            });
        }


    });
    $('#logOutButton').click(function () {
        $.get('logout.php', function( data ) {
            console.log(data);
        });
    });
});
