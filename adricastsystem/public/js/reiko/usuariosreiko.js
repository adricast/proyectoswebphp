function cerrarModal(){
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'none';
} 
function principal(){
    window.location.href = '/usuarios';
}
function eliminarDatos(id) {
    // Mostrar la alerta de confirmación
    Swal.fire({
      title: '¿Estás seguro?',
      text: 'Esta acción no se puede deshacer',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      // Si se hace clic en el botón de confirmación
      if (result.isConfirmed) {
        var token = $('meta[name="csrf-token"]').attr('content');
        // Realizar la solicitud AJAX para eliminar el registro
        $.ajax({
          url: '/usuariosdelete/' + id,
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': token
          },
          data: { id: id
          },
          success: function(response) {
            // Mostrar una alerta de éxito
            Swal.fire({
                title: 'respuesta', 
                text: JSON.stringify(response) , 
                icon: 'success',    
                timer: 3000,
            });    
            window.location.href = '/usuarios';
            // Realizar cualquier otra acción después de eliminar el registro (como actualizar la tabla)
            // ...
          },
          error: function(xhr, status, error) {
            // Mostrar una alerta de error si ocurre algún problema en la solicitud AJAX
            Swal.fire('Error', 'Se produjo un error al eliminar el registro', 'error');
          }
        });
      }
    });
  }
  function generarNombreUsuario() {
    // Obtener los valores de nombres y apellidos
    var nombres = document.getElementById('nombres').value;
    var apellidos = document.getElementById('apellidos').value;

    // Verificar que los valores no estén vacíos
    if (nombres.trim() !== '' && apellidos.trim() !== '') {
        // Obtener iniciales de nombres y apellidos
        const n1 = Math.floor(Math.random() * 4) + 1;
        const n2 = Math.floor(Math.random() * 4) + 1;
        const n3 = Math.floor(Math.random() * 4) + 1;
        const n4 = Math.floor(Math.random() * 4) + 1;
        var nombreIniciales = obtenerIniciales(nombres, [n1, n2]);
        var apellidoIniciales = obtenerIniciales(apellidos, [n3,n4]);

        // Unir las iniciales para formar el nombre de usuario
        var nombreUsuario = nombreIniciales.toLowerCase() + apellidoIniciales.toLowerCase();

        // Limitar el nombre de usuario a un máximo de 12 caracteres
        nombreUsuario = nombreUsuario.substring(0, 12);

        // Asignar el valor al campo de usuario
        document.getElementById('usuario').value = nombreUsuario;
    }
}

function obtenerIniciales(texto, cantidades) {
    // Dividir el texto por espacios
    var palabras = texto.trim().split(' ');

    // Inicializar las iniciales
    var iniciales = '';

    // Obtener las iniciales de cada palabra según las cantidades especificadas
    for (var i = 0; i < palabras.length && i < cantidades.length; i++) {
        iniciales += palabras[i].substring(0, cantidades[i]);
    }

    return iniciales;
}

function guardarDatos() {
    var token = $('meta[name="csrf-token"]').attr('content');

    // Obtener los datos del formulario modal
    var formData = new FormData($('#miFormulario')[0]);

  
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
            Swal.fire('Éxito', 'Datos de usuarios guardados correctamente', 'success');
            window.location.href = '/usuarios';
            
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

function modificarDatos(id){
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'block';
    dataidbtn= document.getElementById('modificarbtn').setAttribute('data-id', id);
    var miFormulario = document.getElementById('miFormulario');
    miFormulario.action = miFormulario.action.replace('__ID__', id);
    obtenerDatos(id)
  }
  function obtenerDatos(id) {
    var miformulario = document.getElementById('miFormulario');
   
    var nombres = document.getElementById('nombres');
    var apellidos = document.getElementById('apellidos');
    var direccion = document.getElementById('direccion');
    var telefono = document.getElementById('telefono');
    var email = document.getElementById('email');
    var imagenPreview = document.getElementById('imagen-preview');
    
    var token = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
        url: '/usuarios/show/' + id,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            // Mostrar una alerta de éxito
  
            console.log(response);
            nombres.value = response.nombres;
            apellidos.value = response.apellidos;
            direccion.value = response.direccion;
            telefono.value = response.telefono;
            email.value = response.email;
            imagenPreview.src = '/img/perfiles/' + response.foto;
            imagenPreview.style.width = '100px';  // Establece el ancho de la imagen
            imagenPreview.style.height = '100px'; 
            imagenPreview.style.display = 'block';
  
            
        },
        error: function(xhr, status, error) {
            // Mostrar una alerta de error si ocurre algún problema en la solicitud AJAX
            Swal.fire('Error', 'Se produjo un error al consultar el registro', 'error');
        }
    });
  }
  function actualizarDatos(){
    var dataId = modificarbtn.getAttribute('data-id');
    var formData = new FormData($('#miFormulario')[0]);
    // Verificar si hay cambios en el formulario
    var cambios = false;
    formData.forEach(function(field) {
      if (field !== '') {
        cambios = true;
        return false; // Romper el bucle forEach
      }
    });
  
    if (!cambios) {
      Swal.fire('Atención', 'No se realizaron modificaciones', 'warning');
      return;
    }
  
    $.ajax({
      url: '/usuarios/update/' + dataId,
      type: 'POST',
      processData: false,
      contentType: false,
      data: formData,
      success: function(response) {
          // Mostrar una alerta de éxito
          Swal.fire('Éxito', 'Datos de usuarios actualizados correctamente', 'success');
          window.location.href = '/usuarios';
      },
      error: function(xhr, status, error) {
          // Mostrar una alerta de error si ocurre algún problema en la solicitud AJAX
          Swal.fire('Error', 'Se produjo un error al actualizar el registro', 'error');
      } 
  });
  
  
  }
  function consultaDatos() {
    // Obtener el campo de entrada y el tbody de la tabla
    var inputBusqueda = document.getElementById('busqueda');
    var contenedorModulos = document.getElementById('contenedorelemento');

    // Agregar el evento keyup al campo de entrada
    inputBusqueda.addEventListener('keyup', function() {
        var termino = inputBusqueda.value.trim();

        $.ajax({
            url: '/usuariosbuscar',
            method: 'GET',
            data: { termino: termino },
            success: function(response) {
                contenedorModulos.innerHTML = ''; // Limpiar el contenido existente en el contenedor antes de actualizar con los nuevos resultados

                response.forEach(function(usuario) {
                    var aElement = document.createElement('a');
                    aElement.href = '#';

                    var divTarget = document.createElement('div');
                    divTarget.className = 'target';

                    var imgElement = document.createElement('img');
                    imgElement.src = '/img/perfiles/' + usuario.foto;
                    imgElement.alt = usuario.username;

                    var pElement = document.createElement('p');
                    pElement.textContent = usuario.username;

                    var divBotones = document.createElement('div');
                    divBotones.className = 'botones';

                    var buttonEliminar = document.createElement('button');
                    buttonEliminar.addEventListener('click', function() {
                        eliminarDatos(usuario.id);
                    });
                    var iEliminar = document.createElement('i');
                    iEliminar.className = 'fas fa-trash';
                    buttonEliminar.appendChild(iEliminar);

                    var buttonModificar = document.createElement('button');
                    buttonModificar.className = 'btneditar';
                    buttonModificar.addEventListener('click', function() {
                        modificarDatos(usuario.id);
                    });
                    var spanModificar = document.createElement('span');
                    spanModificar.className = 'fa fa-edit';
                    buttonModificar.appendChild(spanModificar);

                    divBotones.appendChild(buttonEliminar);
                    divBotones.appendChild(buttonModificar);

                    divTarget.appendChild(imgElement);
                    divTarget.appendChild(pElement);
                    divTarget.appendChild(divBotones);

                    aElement.appendChild(divTarget);

                    contenedorModulos.appendChild(aElement);
                });
            }
        });
    });
}
  