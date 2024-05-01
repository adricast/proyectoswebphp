function cerrarModal(){
    editmodal= document.getElementById('editmodal');
    editmodal.style.display = 'none';
} 
function principal(){
    window.location.href = '/productos';
}


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
                url:  'productosdelete/' + id,
                type: "DELETE",
                data: {
                    "_token": token,
                },
                success: function(response) {
                    // Manejar la respuesta exitosa aquí
                    console.log(response);
                    Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
                    // Redireccionamos después de eliminar el contacto
                    window.location.href = '/productos';
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
                    url:  'productosdelete/' + id,
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
                window.location.href = '/productos';
            });
        }
    });
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
            Swal.fire('Éxito', 'Datos de usuarios guardados correctamente', 'success');
            window.location.href = '/productos';
            
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
    var nombre = document.getElementById('nombre');
    var categoria_id = document.getElementById('id_categoria');
    var tipo_producto_id = document.getElementById('id_tipo_producto');
    var marca_id = document.getElementById('id_marca');

    var descripcion = document.getElementById('descripcion');
    var precio = document.getElementById('precio');
    var stock = document.getElementById('stock');
    var codigo = document.getElementById('codigo');
    var en_stock = document.getElementById('en_stock');
    var precio_oferta = document.getElementById('precio_oferta'); 
    var en_oferta = document.getElementById('en_oferta');
   
    var marcaSelect = document.getElementById('id_marca');
   
    var publicar_web = document.getElementById('publicar_web');
    var link_compra = document.getElementById('linkcompra');

    var imagenPreview = document.getElementById('imagen-preview');
    
    var token = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
        url: '/productos/show/' + id,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            // Mostrar una alerta de éxito
  
            console.log(response);
            
            nombre.value = response.nombre;
            descripcion.value = response.descripcion;
            precio.value = response.precio;
            stock.value = response.stock;
            codigo.value = response.codigo;
            precio_oferta.value = response.precio_oferta;
            
        
            if (response.publicar_web === 1) {
                publicar_web.checked = true;
            } else {
                publicar_web.checked = false;
            }
            if (response.en_oferta === 1) {
                en_oferta.checked = true;
            } else {
                en_oferta.checked = false;
            }
            if (response.en_stock === 1) {
                en_stock.checked = true;
            }
            else {
                en_stock.checked = false;
            }
            marcaSelect.value = response.marca_id;
            link_compra.value = response.linkdecompra;
            console.log(response.foto);
            imagenPreview.src = '/img/productos/' + response.foto;
            imagenPreview.style.width = '100px';  // Establece el ancho de la imagen
            imagenPreview.style.height = '100px'; 
            imagenPreview.style.display = 'block';
            categoria_id.value = response.categoria_id;
            tipo_producto_id.value = response.tipo_producto_id;
            marca_id.value = response.marca_id;

            
        },
        error: function(xhr, status, error) {
            // Mostrar una alerta de error si ocurre algún problema en la solicitud AJAX
            Swal.fire('Error', 'Se produjo un error al consultar el registro', 'error');
        }
    });
  }

  function actualizarDatos() {  
    var token = $('meta[name="csrf-token"]').attr('content');
    var id = document.getElementById('modificarbtn').getAttribute('data-id');
    var formData = new FormData($('#miFormulario')[0]);
    $.ajax({
        url: '/productos/update/' + id,
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function(response) {
            // Mostrar una alerta de éxito
            Swal.fire('Éxito', 'Datos de productos actualizados correctamente', 'success');
            window.location.href = '/productos';
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
            url: '/productosbuscar',
            method: 'GET',
            data: { termino: termino },
            success: function(response) {
                contenedorModulos.innerHTML = ''; // Limpiar el contenido existente en el contenedor antes de actualizar con los nuevos resultados

                response.forEach(function(producto) {
                    var aElement = document.createElement('a');
                    aElement.href = '#';

                    var divTarget = document.createElement('div');
                    divTarget.className = 'target';

                    var imgElement = document.createElement('img');
                    imgElement.src = '/img/productos/' + producto.foto;
                    imgElement.alt = producto.nombre;

                    var pElement = document.createElement('p');
                    pElement.textContent = producto.nombre;

                    var divBotones = document.createElement('div');
                    divBotones.className = 'botones';

                    var buttonEliminar = document.createElement('button');
                    buttonEliminar.addEventListener('click', function() {
                        eliminarDatos(producto.id);
                    });
                    var iEliminar = document.createElement('i');
                    iEliminar.className = 'fas fa-trash';
                    buttonEliminar.appendChild(iEliminar);

                    var buttonModificar = document.createElement('button');
                    buttonModificar.className = 'btneditar';
                    buttonModificar.addEventListener('click', function() {
                        modificarDatos(producto.id);
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
function obtenerProductosSeleccionados() {
    var productosSeleccionados = [];
    $("input[name='productos_seleccionados[]']:checked").each(function () {
        productosSeleccionados.push($(this).val());
    });
    return productosSeleccionados;
  }
  
  
  function actualizarVisibilidadBotonEliminar() {
    var productosSeleccionados = obtenerProductosSeleccionados();
    if (productosSeleccionados.length > 0) {
        $('#btnEliminarSeleccionados').show();
    } else {
        $('#btnEliminarSeleccionados').hide();
    }
  }
  
  // Llamar a la función al cargar la página
  $(document).ready(function() {
    actualizarVisibilidadBotonEliminar();
    
    // Llamar a la función cuando se cambia el estado de un checkbox
    $("input[name='modulos_seleccionados[]']").change(function() {
        actualizarVisibilidadBotonEliminar();
    });
  });
  