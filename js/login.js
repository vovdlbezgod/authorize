/*function showLoginBox() {
    alert("Переход на Логин");
    document.getElementById("Login").style.display = 'block';
    document.getElementById("Registration").style.display = 'none';
    regRequest.email = document.getElementById('email');
    regRequest.password = document.getElementById('password');
    regRequest.result = document.getElementById('loginResult');
}*/

/*function showRegBox() {
    alert("Переход на Регистрацию");
    document.getElementById("Registration").style.display = 'block';
    document.getElementById("Login").style.display = 'none';
}*/

/*onload = function () {
    //alert("huypizda");
    document.getElementById("Registration").style.display = 'block';
    //document.getElementById('regButton').onclick = showLoginBox; //при нажатии на спан - показываем формочку
    //document.getElementById('logButton').onclick = showRegBox; //при нажатии на спан - показываем формочку
}*/

$(document).ready(function(){
    var request;
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
                    if (jsonData.success == "0"){
                        $('#Registration').css("display", "none");
                        $('#msgReg').css("display", "block");
                        $('#UploadPicture').css("display", "block");
                    }
                    else{
                        $('#msgUsr').css("display", "block");
                    }
                });
                /*request.done(function (response, textStatus, jqXHR){
                    console.log("Hooray, it worked!");

                });
                request.fail(function (jqXHR, textStatus, errorThrown){
                    console.error(
                        "The following error occurred: "+
                        textStatus, errorThrown
                    );
                });
                request.always(function () {
                    $inputs.prop("disabled", false);
                });*/
            }
        }else {
            $('#msgPass').css("display", "block");
        }
    });
    function showError(error){
        $('#error').html(error);
    };
    $('#logButton').click(function(){
        $('#Registration').css("display", "block");
        $('#Login').css("display", "none");
        /*var login = $('#nickname').val(),
            password = $('#password').val();
        if(login && password){
            $.post('login', {'login': login, 'password': password}, function(data){
                console.log(data);
                if (data.error){
                    showError(data.error);
                }else{
                    window.location.href = "";
                }
            });
        }else{
            showError('Please fill all fields');
        }*/
    });
});
