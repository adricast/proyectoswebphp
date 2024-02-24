<main class="main">


        <script src="{{ route('recursos.show', ['js/reiko', 'contactanos.js']) }}"></script>
        <script>
        var StoreUrl = "{{ route('contactanos.store') }}";   
        </script>
        <div class="contenido">
            <div class="imagen">
                <img src="{{ route('recursos.show', ['img', 'mail.png']) }}" alt="">
            </div>
            <div class="titulo">
                <h1>Contactanos</h1>
            </div>
            <div class="seccion">
                
                <h2><i class="fa fa-envelope" aria-hidden="true"></i></h2>
                <form action="{{route('contactanos.store')}}" id="miFormulario" method="post" enctype="multipart/form-data" novalidate>
            
                    @csrf

                    <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" value="{{ isset($datos['nombre']) ? $datos['nombre'] : '' }}" required>
                    
               
                    <input type="phone" id="telefono" name="telefono" placeholder="Ingrese su numero de telefono" value="{{ isset($datos['nombre']) ? $datos['nombre'] : '' }}" required>
                  
                 
                    <input type="text" id="asunto" name="asunto" placeholder="Ingrese asunto del tema a tratar" value="{{ isset($datos['nombre']) ? $datos['nombre'] : '' }}" required>

                
                    <input type="email" id="correo" name="correo" placeholder="Ingrese su correo electronico" value="{{ isset($datos['correo']) ? $datos['correo'] : '' }}" required>


                    <textarea id="mensaje" placeholder="Ingrese su mensaje" name="mensaje" rows="4" required>{{ isset($datos['mensaje']) ? $datos['mensaje'] : '' }}</textarea>
                    <button style="margin-right: 10px; background-color:blue; color:white; padding:5px; border:2px solid white;" type="submit" onclick="event.preventDefault(); guardarDatos();">Enviar</button>
            
                </form>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                
            </div>
        </div>

      
</main>