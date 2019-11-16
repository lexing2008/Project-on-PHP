function validation_field_email(){
    // EMAIL
    field = $('#form_entrance input[name=email]');
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
    field = $('#form_entrance input[name=password]');
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
            add_message_error('password', a(' - Поле "Пароль" некорректно') );
        }
    }
}

function validation_form_entrance(){
    validation_field_email();
    validation_field_password();
    count_errors = $('#form_entrance .field_error').length;
    return count_errors == 0;
}

$(document).ready( function(){
    $('#form_entrance input').attr('autocomplete', 'off');

    $('#form_entrance input[name=submit]').click( function(){
        // не отправляем форму, если она не валидна
        if( !validation_form_entrance() ){
            return false;
        }
    });

    $('#form_entrance input[name=email]').live('change keyup', function(e){
        validation_field_email();
    });
    
    $('#form_entrance input[name=password]').live('change keyup', function(e){
        validation_field_password();
    });

});