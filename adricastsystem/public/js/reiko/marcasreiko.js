
  function eliminarDato(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:  'marcasdelete/' + id,
                type: "DELETE",
                data: {
                    "_token": token,
                },
                success: function(response) {
                    // Manejar la respuesta exitosa aquí
                    console.log(response);
                    Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
                    // Redireccionamos después de eliminar el contacto
                    window.location.href = '/marcas';
                },
                error: function(xhr, status, error) {
                    // Manejar errores aquí
                    console.error('Error en la solicitud AJAX:', xhr, status, error);
                    Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
                }
            });
        }
    });
}

function eliminarDatos(ids) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminarlos!'
    }).then((result) => {
        if (result.isConfirmed) {
            var token = $('meta[name="csrf-token"]').attr('content');
            // Recorremos los IDs y enviamos una solicitud AJAX para eliminar cada uno
            ids.forEach(id => {
                $.ajax({
                    url:  'marcasdelete/' + id,
                    type: "DELETE",
                    data: {
                        "_token": token,
                    },
                    success: function(response) {
                        // Manejar la respuesta exitosa aquí (puedes eliminar el console.log si no lo necesitas)
                        console.log(response);
                        // No redireccionamos aquí, ya que estamos eliminando varios contactos y no queremos redireccionar hasta que se completen todas las eliminaciones
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores aquí
                        console.error('Error en la solicitud AJAX:', xhr, status, error);
                        Swal.fire('Error', 'Se produjo un error en el servidor.', 'error');
                    }
                });
            });
            // Una vez que se hayan enviado todas las solicitudes de eliminación, mostramos un mensaje y redireccionamos
            Swal.fire('Eliminados!', 'Los registros han sido eliminados.', 'success').then(() => {
                window.location.href = '/marcas';
            });
        }
    });
}
  function guardarDatos() {
    var token = $('meta[name="csrf-token"]').attr('content');

    // Obtener los datos del formulario modal
    var formData = new FormData($('#miFormulario')[0]);

    // Obtener el elemento input de la imagen
    const moduloImagen = document.getElementById('file-input');

    // Agregar la imagen al formData si está presente
    if (moduloImagen.files.length > 0) {
        const fileSizeMB = moduloImagen.files[0].size / (1024 * 1024);
        const maxSizeMB = 5;  // Ajusta este valor según tus necesidades

        if (fileSizeMB > maxSizeMB) {
            alert('La imagen es demasiado grande. Se permite un tamaño máximo de ' + maxSizeMB + ' MB.');
            moduloImagen.value = '';  // Limpiar el input
            return;  // Detener la ejecución si la imagen es demasiado grande
        }
    }

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
            window.location.href = '/marcas';
            
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
  obtenerDatos(id);
}

function obtenerDatos(id) {
  var miformulario = document.getElementById('miFormulario');
  var nombre = document.getElementById('nombre');
  var descripcion = document.getElementById('descripcion');

  var imagenPreview = document.getElementById('imagen-preview');
  
  var token = $('meta[name="csrf-token"]').attr('content');
  
  $.ajax({
      url: '/marcas/show/' + id,
      method: 'GET',
      headers: {
          'X-CSRF-TOKEN': token
      },
      success: function(response) {
          // Mostrar una alerta de éxito

          console.log(response);
          nombre.value = response.nombre;
          descripcion.value = response.descripcion;
          if (response.foto && response.foto.trim() !== '') {
            // Si hay una foto en response, cargar esa foto
            imagenPreview.src = '/img/marcas/' + response.foto;
            imagenPreview.style.width = '100px';  // Establece el ancho de la imagen
            imagenPreview.style.height = '100px'; 
            imagenPreview.style.display = 'block';
  
          } else {
              // Si response.foto está vacío, cargar una imagen de respaldo
              imagenPreview.src = '/img/marcas/marcas.png';  // Reemplaza 'imagen_de_respaldo.jpg' con el nombre de tu imagen de respaldo
          }
       
          
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
    url: '/marcas/update/' + dataId,
    type: 'POST',
    processData: false,
    contentType: false,
    data: formData,
    success: function(response) {
        // Mostrar una alerta de éxito
        Swal.fire('Éxito', 'Datos de marca actualizados correctamente', 'success');
        window.location.href = '/marcas';
    },
    error: function(xhr, status, error) {
        // Mostrar una alerta de error si ocurre algún problema en la solicitud AJAX
        Swal.fire('Error', 'Se produjo un error al actualizar el registro', 'error');
    } 
});


}


function cerrarModal(){
  editmodal= document.getElementById('editmodal');
  editmodal.style.display = 'none';
} 
function principal(){
  window.location.href = '/marcas';
}
function consultaDatos() {
  // Obtener el campo de entrada y el tbody de la tabla
  var inputBusqueda = document.getElementById('busqueda');
  var contenedorModulos = document.getElementById('contenedorelemento');

  // Agregar el evento keyup al campo de entrada
  inputBusqueda.addEventListener('keyup', function() {
      var termino = inputBusqueda.value.trim();

      $.ajax({
          url: '/marcasbuscar',
          method: 'GET',
          data: { termino: termino },
          success: function(response) {
              contenedorModulos.innerHTML = ''; // Limpiar el contenido existente en el contenedor antes de actualizar con los nuevos resultados

              response.forEach(function(marca) {
                  var aElement = document.createElement('a');
                  aElement.href = '#';

                  var divTarget = document.createElement('div');
                  divTarget.className = 'target';

                  var imgElement = document.createElement('img');
                  imgElement.src = '/img/marcas/' + marca.foto;
                  imgElement.alt = marca.nombre;

                  var pElement = document.createElement('p');
                  pElement.textContent = marca.nombre;

                  var divBotones = document.createElement('div');
                  divBotones.className = 'botones';

                  var buttonEliminar = document.createElement('button');
                  buttonEliminar.addEventListener('click', function() {
                      eliminarDatos(marca.id);
                  });
                  var iEliminar = document.createElement('i');
                  iEliminar.className = 'fas fa-trash';
                  buttonEliminar.appendChild(iEliminar);

                  var buttonModificar = document.createElement('button');
                  buttonModificar.className = 'btneditar';
                  buttonModificar.addEventListener('click', function() {
                      modificarDatos(marca.id);
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
function obtenerMarcasSeleccionadas() {
  var marcasSeleccionadas = [];
  $("input[name='marcas_seleccionadas[]']:checked").each(function () {
    marcasSeleccionadas.push($(this).val());
  });
  return marcasSeleccionadas;
}


function actualizarVisibilidadBotonEliminar() {
  var marcasSeleccionadas = obtenerMarcasSeleccionadas();
  if (marcasSeleccionadas.length > 0) {
      $('#btnEliminarSeleccionados').show();
  } else {
      $('#btnEliminarSeleccionados').hide();
  }
}

// Llamar a la función al cargar la página
$(document).ready(function() {
  actualizarVisibilidadBotonEliminar();
  
  // Llamar a la función cuando se cambia el estado de un checkbox
  $("input[name='marcas_seleccionadas[]']").change(function() {
      actualizarVisibilidadBotonEliminar();
  });
});
