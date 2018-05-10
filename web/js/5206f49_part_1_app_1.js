
/**POPUPS LOGIN/REGISTER/RESETTING MDP*********/
/*appel le popup*/
$(document).ready(function () {
    $('#modal-action').click(function(){
        $("#modalForms").modal();
    });
});

$(function() {
    /*appel le formulaire login*/
    $("#modal-action").click(function() {
        $(".modal-title").text('Se connecter' );
        $("#user_login").show();
        $("#user_resetting_mdp").hide();
        $("#user_register").hide();
        return false;
    });

    /* Appel le formulaire  du register */
    $("#register_form").click(function() {
        $("#user_register").show();
        $(".modal-title").text('S\'inscrire' );
        $("#user_resetting_mdp").hide();
        $("#user_login").hide();
        return false;
    });

    /* Appel le formulaire Resetting */
    $("#resetting_form").click(function() {
        $("#user_resetting_mdp").show();
        $(".modal-title").text('Se connecter ');
        $("#user_register").hide();
        return false;
    });

    /*revenir en arriere sur le formulaire du login */
    $(".btn-back").click(function() {
        $("#user_login").show();
        $(".modal-title").text('Se connecter');
        $("#user_register").hide();
        $("#user_resetting_mdp").hide();
        return false;
    });


});

/*appel la page register depuis le modal /login*/
/*$(function() { {
    $('#register_form').click(function () {
        window.location.replace("/register");
    });
}});*/


/**HIDE /SHOW PASSWORD*****************/

$('.hide-password').on('click', function(){
    var $this= $(this),
        $password_field = $this.prev('input');

     //observer les types et contenu texte correspondants sous conditions ternaires
    ( 'password' === $password_field.attr('type') ) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
    ( 'Hide' === $this.text() ) ? $this.text('Show') : $this.text('Hide');

    //avec ou sans focus sur le champs password.
    $password_field.putCursorAtEnd();
});



/*$("#logout').click(function(){
    var action ="logout";
    $.ajax({
         url:"action.php",
         method:"POST",
         dataType: "json",
         data:{action:action},
         success:function(data){
             location.reload();
         }
    })
})
});*!/*/




/**LOGIN MODAL AJAX************/
/*
$(document).ready(function () {
    $('#login_submit').click(function () {
        var username = $('#_username').val();
        var password = $('#_password').val();
        var remember = $('#_remember_me').val();

        if (username !== '' && password !== '' && remember !== ''){
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),

                success: function(data) {
                    console.log(data);
                    $target.html(data);
                },
                error: (function (jqXHR, textStatus, errorThrown) {
                    if (typeof jqXHR.responseJSON !== 'undefined') {
                        if (jqXHR.responseJSON.hasOwnProperty('form')) {
                            $('#form_body').html(jqXHR.responseJSON.form);
                        }

                        $('.error').html(jqXHR.responseJSON.message);

                    } else {
                        alert(errorThrown);
                    }

                })
             });
        }else{
            alert("Les deux champs doivent être renseignés.");
        }

    });
});


jQuery(function($) {

    $('form[data-async]').on('submit', function(event) {
        var $form = $(this);
        var $target = $($form.attr('data-target'));

        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),

            success: function(data) {
                console.log(data);
                $target.html(data);
            },
            error: (function (jqXHR, textStatus, errorThrown) {
                if (typeof jqXHR.responseJSON !== 'undefined') {
                    if (jqXHR.responseJSON.hasOwnProperty('form')) {
                        $('#form_body').html(jqXHR.responseJSON.form);
                    }

                    $('.error').html(jqXHR.responseJSON.message);

                } else {
                    alert(errorThrown);
                }

            })

        });
        event.preventDefault();
        alert("Les deux champs doivent être renseignés.");
    });
});
*/



/*
$('#register_submit').submit(function() {
    $this = $(this);
    $.post($(this).attr('action'), $(this).serialize(), function(data) {
        if(data.status === 1) {
            window.location.href = data.targetUrl;
        }
        else {
            var divErrors = $this.find('.errors');
            divErrors.html('');

            for(var e in data.errors) {
                if(data.errors[e] === 'user.username.already_used') {
                    divErrors.append("L'adresse e-mail est déjà utilisée !<br />");
                }
                else if(data.errors[e] === 'password.mismatch') {
                    divErrors.append("Les mots de passe ne correspondent pas !<br />");
                }
                else {
                    divErrors.append("Une erreur inconnue est survenue !<br />");
                }
            }
            console.log(data.errors);
        }
    });

    return false;
});

$('#login_submit').submit(function() {
    $this = $(this);
    $.post($(this).attr('action'), $(this).serialize(), function(data) {
        if(data.status === 1) {
            console.log(data.message);
            console.log('data');
            console.log('.user_login');

            // var expiry = new Date();
            // expiry.setDate(expiry.getDate() + 30);
            // console.log("setting cookie", "usb_is_logged_in=1;expires=" + expiry.toGMTString() + ";path=/");
            // document.cookie = "usb_is_logged_in=1;expires=" + expiry.toGMTString() + ";path=/";
            location.href = data.url; //  + '?logged_in=1';
        }
        else {
            var divErrors = $this.find('.errors');
            divErrors.html(data.error);
            console.log(data.error);
        }
    });
    return false;
});




*/

