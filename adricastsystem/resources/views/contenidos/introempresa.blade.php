<main class="main">
        @include('contenidos.slider')
        <div class="contenido">
            <div class="imagen">
                <img src="{{ route('recursos.show', ['img', 'min.png']) }}" alt="">
            </div>
            <div class="titulo">
                <h1>Acerca de Nosotros</h1>
            </div>
            <div class="seccion">
                <h2>Misión</h2>
                <p>Nuestra misión es proporcionar soluciones tecnológicas de alta calidad que impulsen la transformación digital de nuestros clientes y mejoren su eficiencia.</p>
            </div>
            <div class="seccion">
                <h2>Visión</h2>
                <p>Nuestra visión es convertirnos en líderes en el desarrollo de software y servicios tecnológicos, ofreciendo innovación constante y excelencia en todo lo que hacemos.</p>
            </div>
            <div class="imagen2">
                <img src="{{ route('recursos.show', ['img', 'estrategia.png']) }}" alt="">
            </div>
            <div class="seccion">
                <h2>Estrategia</h2>
                <p>Nuestra estrategia se basa en la creatividad, la colaboración y la ética para proporcionar soluciones tecnológicas excepcionales a nuestros clientes.</p>
            </div>
            <div class="seccion">
                <h2>Constitución</h2>
                <p>Adricast System fue fundada por un equipo de expertos en tecnología con un compromiso inquebrantable con la integridad y la responsabilidad en el trabajo.</p>
            </div>
            <div class="seccion">
                <h2>Valores</h2>
                <ul>
                    <li>Compromiso con la Calidad</li>
                    <li>Creatividad e Innovación</li>
                    <li>Colaboración</li>
                    <li>Ética y Responsabilidad</li>
                </ul>
            </div>
        </div>
        <script> 
           
           var slideIndex = 0;
          
           funcionslider();
         
       </script>
</main>