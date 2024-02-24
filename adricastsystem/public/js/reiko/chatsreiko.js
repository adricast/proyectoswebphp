function cerrarModal(){
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'none';
} 
function principal(){
    window.location.href = '/chat';
}
function addChat() {
    editmodal= document.getElementById('editmodal');
    username = document.getElementById('username');
    username.value = '';
    mensaje = document.getElementById('mensaje');
    mensaje.value = '';
    editmodal.style.display = 'block';
}
function guardarDatos() {
    var token = $('meta[name="csrf-token"]').attr('content');

    // Obtener los datos del formulario modal
    var formData = new FormData($('#miFormulario')[0]);

    console.log(formData);

    // Enviar la solicitud AJAX
    $.ajax({
        url: StoreUrl,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            // Manejar la respuesta exitosa aquí
            console.log(response);
            if (response.success) {
                // Si la respuesta indica éxito, mostrar un mensaje exitoso
                Swal.fire('Éxito', response.message, 'success');
            } else {
                // Si la respuesta indica un error, mostrar un mensaje de error
                Swal.fire('Error', response.message, 'error');
            }
            // Redireccionar a la página de chats
            window.location.href = '/chats';
        },
        error: function(xhr, status, error) {
            // Manejar errores aquí
            if (xhr.status === 422) {
                // El servidor respondió con un error de validación (422 Unprocessable Entity)
                var responseErrors = xhr.responseJSON.errors;
                var errorMessage = 'Los datos proporcionados no son válidos.';

                // Recorre los errores y construye el mensaje de error
                for (var key in responseErrors) {
                    if (responseErrors.hasOwnProperty(key)) {
                        errorMessage += '<br>' + responseErrors[key][0];
                    }
                }

                Swal.fire('Error', errorMessage, 'error');
            } else {
                // Otros errores de la solicitud AJAX
                console.error(error);
                Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
                console.error('Error en la solicitud AJAX:', xhr, status, error);
            }
        }
    });
}
function cargarMensajes(userId) {
    // Aquí puedes hacer una solicitud AJAX para cargar los mensajes relacionados con el usuario
    // Puedes enviar el ID de usuario como parámetro en la solicitud y recuperar los mensajes del backend

    // Ejemplo de solicitud AJAX
    $.ajax({
        url: '/chats/show/' + userId, // URL para cargar los mensajes del usuario con el ID correspondiente
        type: 'GET',
        success: function(response) {
            // Manejar la respuesta exitosa aquí
            console.log(response);
            actualizarInterfaz(response,userId);
            // Aquí puedes actualizar la interfaz de usuario con los mensajes cargados
        },
        error: function(xhr, status, error) {
            // Manejar errores aquí
            console.error(error);
        }
    });
}
function actualizarInterfaz(mensajes, userId    ) {
    // Obtener el contenedor de chat
    var chatbox = $('#chatbox');

    // Limpiar el contenido actual del chatbox
    chatbox.empty();

    // Iterar sobre los mensajes recibidos y actualizar la interfaz de usuario
    mensajes.forEach(function(mensaje) {
        var messageClass = (mensaje.tipo === 'enviado') ? 'sent' : 'received';
               
        var status = mensaje.status === 'Visto' ? '<span class="status">Visto</span>' : '';
        var timestamp = mensaje.sent_at;

        // Construir el HTML para el mensaje
        var messageHTML = '<div class="message ' + messageClass + '">';
        messageHTML += '<p>' + mensaje.message + '</p>';
        messageHTML += status;
        messageHTML += '<span class="timestamp">' + timestamp + '</span>';
        messageHTML += '</div>';

        // Agregar el mensaje al chatbox
        chatbox.append(messageHTML);
    });
}
function enviarMensaje() {
    var token = $('meta[name="csrf-token"]').attr('content');
    var mensaje = $('#mensaje').val(); // Obtener el mensaje del campo de texto
    var nombreUsuario = $('#headerchat').text();

    // Comprobar si se ha seleccionado un usuario de destino
    if (nombreUsuario) {
        // Crear un objeto con los datos del mensaje
        var data = {
            username: nombreUsuario, // Enviar el ID del usuario de destino
            mensaje: mensaje // Enviar el mensaje
        };

        // Enviar la solicitud AJAX para guardar el mensaje
        $.ajax({
            url: StoreUrl, // URL para enviar el mensaje
            type: "POST",
            data: data, // Datos del mensaje
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function(response) {
                // Manejar la respuesta exitosa aquí
               
                if (response.success) {
                    // Si la respuesta indica éxito, mostrar un mensaje exitoso
                    var userId = $('#headerchat').data('userid');
                    cargarMensajes(userId);
                    $('#mensaje').val('');
                } else {
                    // Si la respuesta indica un error, mostrar un mensaje de error
                    Swal.fire('Error', response.message, 'error');
                }
                // Redireccionar a la página de chats
                
            },
            error: function(xhr, status, error) {
                // Manejar errores aquí
                if (xhr.status === 422) {
                    // El servidor respondió con un error de validación (422 Unprocessable Entity)
                    var responseErrors = xhr.responseJSON.errors;
                    var errorMessage = 'Los datos proporcionados no son válidos.';

                    // Recorre los errores y construye el mensaje de error
                    for (var key in responseErrors) {
                        if (responseErrors.hasOwnProperty(key)) {
                            errorMessage += '<br>' + responseErrors[key][0];
                        }
                    }

                    Swal.fire('Error', errorMessage, 'error');
                } else {
                    // Otros errores de la solicitud AJAX
                    console.error(error);
                    Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
                    console.error('Error en la solicitud AJAX:', xhr, status, error);
                }
            }
        });
    } else {
        // Si no se ha seleccionado un usuario de destino, mostrar un mensaje de error
        Swal.fire('Error', 'Por favor, selecciona un usuario de destino.', 'error');
    }
}