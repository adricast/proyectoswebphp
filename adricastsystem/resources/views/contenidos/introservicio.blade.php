<main class="main">
        @include('contenidos.slider')
        <section class="sectionblock-1c">

        
        <div class="card-container">
            <button class="prev-button">&#8249;</button>
            <div class="cards">
                <div class="card">
                    <img src="{{ route('recursos.show', ['img', 'desarrollosoftware.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text">
                    <h2>Desarrollo de Software</h2>
                    <p style="text-align: justify;">La empresa se especializa en el desarrollo de software a medida, ofreciendo soluciones personalizadas que abarcan aplicaciones web, móviles y sistemas empresariales. </p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{ route('recursos.show', ['img', 'domotica.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text">
                    <h2>Domotica</h2>
                    <p style="text-align: justify;">Ofrecemos servicios de domótica que permiten automatizar y controlar sistemas en hogares y edificios, mejorando la comodidad, la eficiencia energética y la seguridad a través de tecnologías inteligentes.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{ route('recursos.show', ['img', 'arduino.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text">
                    <h2>Electronica Arduino</h2>
                    <p style="text-align: justify;">Ofrecemos asesoramiento, diseño, prototipado y programación utilizando la plataforma Arduino, permitiendo a nuestros clientes implementar sistemas electrónicos a medida. </p>
                    </div> 
                </div>
                <div class="card">
                    <img src="{{ route('recursos.show', ['img', 'asesoria.png']) }}" alt="Imagen de ejemplo">
                    <div class="card-text">
                    <h2>Asesorias</h2>
                    <p style="text-align: justify;">Brindamos asistencia en la planificación, implementación y optimización de sistemas, software, seguridad informática y estrategias tecnológicas. </p>
                    </div>
                </div>         
              <!-- Repite el código HTML de la tarjeta para crear las otras 9 tarjetas -->
            </div>
            <button class="next-button">&#8250;</button>
          </div>
        </section>

       
        <script> 
           
            
            let scrollAmount = 0; 
            let prevButton; // Declarar prevButton en un alcance más amplio
            let nextButton; // Declarar nextButton en un alcance más amplio

           
            funciontarjeta();
        </script>
</main>