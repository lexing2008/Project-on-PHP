function validation_field_surname(){
    field = $('#form_registration input[name=surname]');
    surname = $(field).val();
    if( surname.length == 0 ){
        $(field).parent().parent().addClass('field_error');
        add_message_error('surname', a(' - Поле "Фамилия" не должно быть пустым') );
    } else {
        $(field).parent().parent().removeClass('field_error');
        remove_message_error('surname');
    }
}

function validation_field_name(){
    field = $('#form_registration input[name=name]');
    name = $(field).val();
    if( name.length == 0 ){
        $(field).parent().parent().addClass('field_error');
        add_message_error('name', a(' - Поле "Имя" не должно быть пустым') );
    } else {
        $(field).parent().parent().removeClass('field_error');
        remove_message_error('name');
    }
}

function validation_field_phone(){
    field = $('#form_registration input[name=phone]');
    phone = $(field).val();
    if( phone.length == 0 ){
        $(field).parent().parent().addClass('field_error');
        add_message_error('phone', a(' - Поле "Телефон" не должно быть пустым') );
    } else {
        $(field).parent().parent().removeClass('field_error');
        remove_message_error('phone');
    }
}

function validation_field_email(){
    // EMAIL
    field = $('#form_registration input[name=email]');
    email = $(field).val();
    if( email.length == 0 ){
        $(field).parent().parent().addClass('field_error');
        add_message_error('email', a(' - Поле "Email" не должно быть пустым') );
    } else {
        if ( is_valid_email(email) ){
            $(field).parent().parent().removeClass('field_error');
            remove_message_error('email');
        } else {
            $(field).parent().parent().addClass('field_error');
            add_message_error('email', a(' - Поле "Email" некорректно') );
        }
    }
}

function validation_field_password(){
    // PASSWORD
    field = $('#form_registration input[name=password]');
    password = $(field).val();
    if( password.length == 0 ){
        $(field).parent().parent().addClass('field_error');
        add_message_error('password', a(' - Поле "Пароль" не должно быть пустым') );
    } else {
        if ( password.length >= 8 ){
            $(field).parent().parent().removeClass('field_error');
            remove_message_error('password');
        } else {
            $(field).parent().parent().addClass('field_error');
            add_message_error('password', a(' - Поле "Пароль" должно быть длиной 8 и более символов') );
        }
    }
}

function validation_field_password2(){
    // PASSWORD
    field = $('#form_registration input[name=password2]');
    password = $(field).val();
    if( password.length == 0 ){
        $(field).parent().parent().addClass('field_error');
        add_message_error('password2', a(' - Поле "Подтверждение пароля" не должно быть пустым') );
    } else {
        if ( password.length >= 8 ){
            $(field).parent().parent().removeClass('field_error');
            remove_message_error('password2');
        } else {
            $(field).parent().parent().addClass('field_error');
            add_message_error('password2', a(' - Поле "Подтверждение пароля" должно быть длиной 8 и более символов') );
        }
    }
}

function validation_form_registration(){
    validation_field_surname();
    validation_field_name();
    validation_field_phone();
    validation_field_email();
    validation_field_password();
    validation_field_password2();
    count_errors = $('#form_registration .field_error').length;
    return (count_errors == 0);
}

$(document).ready( function(){

    $('#form_registration input').attr('autocomplete', 'off');

    $('#form_registration input[name=submit]').click( function(){
        // не отправляем форму, если она не валидна
        if( !validation_form_registration() ){
            return false;
        }
    });

    $('#form_registration input[name=surname]').live('change keyup', function(e){
        validation_field_surname();
    });
    
    $('#form_registration input[name=name]').live('change keyup', function(e){
        validation_field_name();
    });

    $('#form_registration input[name=email]').live('change keyup', function(e){
        validation_field_email();
    });
    
    $('#form_registration input[name=phone]').live('change keyup', function(e){
        validation_field_phone();
    });
    
    $('#form_registration input[name=password]').live('change keyup', function(e){
        validation_field_password();
    });
    
    
    $('#form_registration input[name=password2]').live('change keyup', function(e){
        validation_field_password2();
    });

});