<section class="contenedor">
    <div class="titulo">
        <h2>Trabaja con nosotros</h2>
    </div>
    <div class="sectionblock-1c">

      
    <div class="card-container" style="padding: 10px;">
        <button class="prev-button" >&#8249;</button>
        <div class="cards">
            <div class="card">
                <img src="{{ route('recursos.show', ['img', 'disenoweb.png']) }}" alt="Imagen de ejemplo">
                <!--  -->
                <div class="card-text">
                <h2>Diseñador Web</h2>
                <p style="text-align: justify;">
                ¡Únete a nuestro equipo como diseñador web freelance! Estamos en busca de talentosos diseñadores web autónomos para colaborar con nosotros en emocionantes proyectos. Si buscas la flexibilidad del trabajo independiente y la oportunidad de contribuir a proyectos innovadores, ¡esperamos recibir tu portafolio y explorar futuras colaboraciones contigo!</p>
                </div>
                <!-- --> 
            </div>
            <div class="card">
                <img src="{{ route('recursos.show', ['img', 'desarrolladorweb.png']) }}" alt="Imagen de ejemplo">
                <div class="card-text">
                    <h2>Desarrollador Web</h2>
                    <p style="text-align: justify;">¡Únete a nuestro equipo como desarrollador web freelance! Si eres apasionado por la codificación, tienes experiencia en el desarrollo de sitios web robustos y estás listo para asumir desafíos creativos, ¡queremos contar contigo!</p>
                </div>
            </div>
            <div class="card">
                <img src="{{ route('recursos.show', ['img', 'desarrollomovil.png']) }}" alt="Imagen de ejemplo">
                <div class="card-text">
                <h2>Desarrollador Movil</h2>
                <p style="text-align: justify;">Buscamos habilidades sólidas en el desarrollo para plataformas iOS y Android, capacidad para trabajar en equipo y contribuir con ideas creativas, aportando tu experiencia al desarrollo de proyectos emocionantes. </p>
                </div> 
            </div>
            <div class="card">
                <img src="{{ route('recursos.show', ['img', 'asesoria.png']) }}" alt="Imagen de ejemplo">
                <div class="card-text">
                <h2><h2>Desarrollo Aplicaciones de Escritorio</h2></h2>
                <p style="text-align: justify;">Forma parte de nuestro equipo de desarrollo de escritorio en ADRICAST SYSTEM y trabaja en proyectos de software de alto rendimiento y funcionalidad.</p>
                </div>
            </div>         
      <!-- Repite el código HTML de la tarjeta para crear las otras 9 tarjetas -->
        </div>
        <button class="next-button">&#8250;</button>
    </div>
</div>

</section>


<script>  funciontarjeta();
</script>