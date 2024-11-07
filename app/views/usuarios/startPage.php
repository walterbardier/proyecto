<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- <meta name="author" content="Devcrud"> -->
    <title>Río Negro Conectado</title>
    
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + LeadMark main styles -->
	<link rel="stylesheet" href="assets/css/leadmark.css?v=<?php echo(rand()); ?>">
    
    <link rel="stylesheet" href="assets/css/leadmark.css?v=<?php echo(rand()); ?>" />
    <!-- <script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script> -->


    <style>
        /* Estilos para el modal */
        .modal {
            display: none; /* Ocultar por defecto */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente */
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%; /* Tamaño del modal */
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


        .fade-out {
            animation: fadeOut 0.5s forwards; /* Duración de la animación */
        }

        @keyframes fadeOut {
            0% {
                opacity: 1; /* Visible */
            }
            100% {
                opacity: 0; /* Invisible */
            }
        }


    </style>
     


</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- page Navigation -->
    <nav class="navbar custom-navbar navbar-expand-md navbar-light fixed-top" data-spy="affix" data-offset-top="10">
        <div class="container">
            <a class="navbar-brand" href="startPage.php">
                <img src="assets/imgs/logoaqua3.png" alt="">
            </a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">                     
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#info">información</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#equipo">equipo</a>
                    </li> -->

                    &#160 <!-- esto es para dejar espacio -->
                    &#160 <!-- esto es para dejar espacio -->

                    <li class="nav-item">
                    <div class="dropdown dropleft"> <!-- btn-sm PARA TAMAÑO / rounded PARA REDONDEAR // esto va en la linea de abajo -->
                        <button class="btn btn-primary rounded dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a><img src="../../../public/imgs/perfil5.png" height="40" width="40"></a>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="perfilUsuario.php">Perfil</a>
                        <!-- <a class="dropdown-item" href="seleccionE.php">Editar estudiantes</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../../public/index.php" id="cerrarSesion">Cerrar sesión</a>
                        </div>
                    </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- End Of Second Navigation -->
    
    <!-- Page Header -->
    <header class="header">
    <img src="../../../public/imgs/fondo2.png" alt="Fondo" />
        <div class="overlay">
            <!-- <h1 class="title">pre-proyecto</h1>  
            <h1 class="subtitle">POO: parte II</h1> -->
            <h1>Bienvenido, <?php echo $_SESSION['usuario']['username']; ?></h1>
            <p>Envía tus preguntas y controla su estado en esta página.</p>
            <hr>
            <hr>

            <!-- <h1>Escribe una pregunta</h1> -->
            <hr>

            <form action="../../controllers/procesarPregunta.php" method="post">
                <!-- <h4 class="mb-4">Escribe un mail</h4> -->
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <input type="text" class="form-control text-white rounded-0 bg-transparent" id="nombre_usuario" name="nombre_usuario" value="<?php echo $_SESSION['usuario']['username']; ?>" readonly>
                        <!-- Con value carga el dato de usuario por POST -->
                    </div>
                    <div class="form-group col-sm-4">
                        <select class="form-control" id="ciudad" name="ciudad">
                            <option>Fray Bentos</option>
                            <option>Young</option>
                            <option>Nuevo Berlín</option>
                            <option>San Javier</option>
                            <option>Las Cañas</option>
                            <option>Algorta</option>
                            <option>Otra</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <select class="form-control" id="categoria" name="categoria">
                            <option value="Alumbrado">Alumbrado</option>
                            <option value="Arbolado">Arbolado</option>
                            <option value="Plantacion">Plantación</option>
                            <option value="Acoso sexual">Acoso sexual</option>
                            <option value="Limpieza de grafittis">Limpieza de grafittis</option>
                            <option value="Estado de los contenedores">Estado de los contenedores</option>
                            <option value="Problema de limpieza">Problema de limpieza</option>
                            <option value="Solicitud de poda, escombros o residuos">Solicitud de poda, escombros o residuos</option>
                            <option value="Saneamiento: Bocas de tormenta">Saneamiento: Bocas de tormenta</option>
                            <option value="Saneamiento: Conexiones y Colectores">Saneamiento: Conexiones y Colectores</option>
                            <option value="Tránsito: Semáforos">Tránsito: Semáforos</option>
                            <option value="Tránsito: Señalización">Tránsito: Señalización</option>
                            <option value="Quejas">Quejas</option>
                            <option value="Consultas: Trámite">Consultas: Trámite</option>
                            <option value="Consultas: Tributo">Consultas: Tributo</option>
                            <option value="Consultas: Otro">Consultas: Otro</option>
                        </select>

                    </div>
                    <div class="form-group col-12">
                        <textarea name="texto_pregunta" id="texto_pregunta" cols="30" rows="4" class="form-control text-white rounded-0 bg-transparent" placeholder="Mensaje"></textarea>
                    </div>
                    <div class="form-group col-12 mb-0">
                        <button type="submit" class="btn btn-primary rounded w-md mt-3">Enviar</button>
                    </div>                          
                </div>                          
            </form>
            <br><br>



        </div>  
        <div class="shape">
            <svg viewBox="0 0 1500 180">
                <path d="m 0,240 h 1500.4828 v -71.92164 c 0,0 -286.2763,-81.79324 -743.19024,-81.79324 C 300.37862,86.28512 0,168.07836 0,168.07836 Z"/>
            </svg>
        </div>  
        <div class="mouse-icon"><div class="wheel"></div></div>
    </header>
    <!-- End Of Page Header -->

    <!-- Info Section -->
    <section class="section" id="info">
        <div class="container">
            <div class="row justify-content-between">

                <!-- Sección izquierda con listado de preguntas -->
                <div class="col-md-6 pr-md-5 mb-4 mb-md-0">
                    <h6 class="section-title mb-0">Mis preguntas</h6>
                    <h6 class="section-subtitle mb-4">Ya enviadas y su estado</h6>
                    <br>

                    <?php
                    require_once '../../controllers/QuejaController.php';

                    // Instancia
                    $QuejaController = new QuejaController();

                    // Listo quejas
                    $QuejaController->index2(); // Cambia a index2 si eso es lo que necesitas
                    ?>
        
                </div>


                <div class="col-md-6 pl-md-5">
                    <div class="row">
                        <div class="col-6">
                            <img src="assets/imgs/about-1.jpg" alt="" class="w-100 shadow-sm">
                        </div>
                        <div class="col-6">
                            <img src="assets/imgs/about-2.jpg" alt="" class="w-100 shadow-sm">
                        </div>
                        <div class="col-12 mt-4">
                            <br>
                            <h6><b>Información</b><br></h6>

                            <p>Este es un sitio web oficial de la Intendencia de Río Negro, diseñado para permitir a los ciudadanos enviar preguntas, sugerencias, quejas o información relevante, las cuales serán revisadas por la Intendencia. Este sistema ha sido desarrollado para mejorar la eficiencia y la comunicación entre los habitantes y las autoridades.</p>
                            <p>Como usuario, tienes la posibilidad de enviarnos tus preguntas a través del formulario ubicado en la parte superior. Deberás seleccionar una categoría que se ajuste a tu necesidad y proporcionar el texto detallando tu consulta.</p>
                            <hr>
                            
                            <p><b>• Listado de preguntas:</b> Aquí puedes ver todas tus preguntas enviadas anteriormente y su estado específico indicando si ha sido respondida o pendiente.</p>

                            <p><b>• Estados:</b> Existen 2 tipos de estados: PENDIENTE o RESPONDIDO.</p>
                            <p>- PENDIENTE: se muestra en gris.</p>
                            <p>- RESPONDIDO: se muestra en verde.</p>

                            <p><b>• Ver respuestas:</b> Para ver la respuesta de una pregunta, debes de darle click encima.</p>
                        </div>
                    </div>
                </div>
            </div>              
        </div>
    </section>
    <!-- End OF Info Section -->

    

    <!-- Equipo Section -->
    <section class="section" id="equipo">
        <div class="container">
            <h6 class="section-title text-center mb-0">equipo</h6>
            <br>
            <!-- <h6 class="section-subtitle mb-5 text-center">uwu</h6> -->
            <div class="row">

                <div class="col-md-6 my-3 my-md-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-3" src="../../../public/imgs/walt2.jpg" alt="">
                                <div class="media-body">
                                    <h6 class="mt-1 mb-0">Walter Bardier</h6>
                                    <small class="text-muted mb-0">Programador y diseñador</small>      
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-6 my-3 my-md-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="media align-items-center mb-3">
                                <img class="mr-3" src="../../../public/imgs/lu2.jpg" alt="">
                                <div class="media-body">
                                    <h6 class="mt-1 mb-0">Lucía Stagi</h6>
                                    <small class="text-muted mb-0">Documentación y testing</small>      
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End of Creator Section -->

    <!-- Contact Section -->
    <section id="contact" class="section has-img-bg pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 my-3">
                    <h6 class="mb-0">Teléfono</h6>
                    <p class="mb-4">+ 123-456-7890</p>

                    <h6 class="mb-0">Dirección</h6>
                    <p class="mb-4">2110 Space Club, The Moon</p>

                    <h6 class="mb-0">Email</h6>
                    <p class="mb-0">info@rionegroconectado.com</p>
                    <p></p>
                </div>
                <div class="col-md-7">
                    <form>
                        <!-- <h4 class="mb-4">Escribe un mail</h4> -->
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <input type="text" class="form-control text-white rounded-0 bg-transparent" name="name" placeholder="Nombre">
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="email" class="form-control text-white rounded-0 bg-transparent" name="Email" placeholder="Email">
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="text" class="form-control text-white rounded-0 bg-transparent" name="subject" placeholder="Asunto">
                            </div>
                            <div class="form-group col-12">
                                <textarea name="message" id="" cols="30" rows="4" class="form-control text-white rounded-0 bg-transparent" placeholder="Mensaje"></textarea>

                            </div>
                            <div class="form-group col-12 mb-0">
                                <button type="submit" class="btn btn-primary rounded w-md mt-3">Enviar</button>
                            </div>                          
                        </div>                          
                    </form>
                </div>
            </div>
            <!-- Page Footer -->
            <footer class="mt-5 py-4 border-top border-secondary">
                <p class="mb-0 small">&copy; <script>document.write(new Date().getFullYear())</script>, Created By <a href="" target="_blank">Walter Bardier.</a>  All rights reserved.</p>   
                
            </footer>
            <!-- End of Page Footer -->  
        </div>
    </section>
	
	<!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap 3 affix -->
	<script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- Isotope -->
    <script src="assets/vendors/isotope/isotope.pkgd.js"></script>

    <!-- LeadMark js -->
    <script src="assets/js/leadmark.js"></script>


    <!-- Scrips para el movimiento del header -->
    <script>
        const header = document.querySelector('.header');
        const img = header.querySelector('img'); // Asegúrate de que la imagen esté en el header

        header.addEventListener('mousemove', (e) => {
            const { clientX, clientY } = e;
            const { clientWidth, clientHeight } = header;
            
            // Calcular el movimiento en relación al centro del header
            const x = (clientX / clientWidth) - 0.5; // Normalizado entre -0.5 y 0.5
            const y = (clientY / clientHeight) - 0.5; // Normalizado entre -0.5 y 0.5
            
            // Aplicar la transformación 3D
            img.style.transform = `translateX(-50%) translateZ(-50px) rotateY(${x * 20}deg) rotateX(${-y * 20}deg)`;
        });
    </script>

    <script>
    window.addEventListener('scroll', function() {
        const img = document.querySelector('.header img');
        const scrollY = window.scrollY; // Obtiene la posición de desplazamiento vertical

        // Ajusta el valor de translateY para mover la imagen según el scroll
        const translateValue = scrollY * 0.2; // Cambia 0.2 para más o menos movimiento
        img.style.transform = `translateX(-50%) translateY(-${translateValue}px)`;
    });
    </script>


    <script>
        document.getElementById('cerrarSesion').addEventListener('click', function(e) {
            e.preventDefault(); // Evita la acción predeterminada del enlace
            const body = document.body;

            // Añade la clase de animación
            body.classList.add('fade-out');

            // Espera a que termine la animación antes de redirigir
            setTimeout(function() {
                window.location.href = '../../../public/index.php'; // Redirige a index.php
            }, 500); // El tiempo debe coincidir con la duración de la animación
        });
    </script>




</body>
</html>
