/** Функция проверяет, является ли email валидным
 * 
 * @param {string} email
 * @returns {Boolean}
 */ 
function is_valid_email(email){	
    return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/).test(email);
}

/**
 * Добавляет сообщение об ошибке заполнения поля
 * @param string class_name
 * @param string message
 */
function add_message_error( class_name, message ){
    remove_message_error( class_name );
    $('#form_errors').append('<div class="' + class_name + '">' + message + '</div>');
}

/**
 * Удаляет сообщение об ошибке заполнения формы
 * @param string class_name
 */
function remove_message_error( class_name ){
    $('#form_errors .' + class_name).remove();
}

function a( word ){
    language = $.cookie('LANG');
    ret = word;
    if( LANG.hasOwnProperty(language) ){
        if( LANG[language].hasOwnProperty(word) ){
            ret = LANG[ language ][ word ];
        } else {
            ret = word;
        }
    }
    return ret;
}