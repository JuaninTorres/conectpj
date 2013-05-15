<?php

function getPrincipal($whereami='inicio')
{
    switch($whereami)
    {
        case 'inicio':
            $contenido .= getEventos(true);
            $contenido .= getNoticias(true);
            $contenido .= getNuevasCanciones(true);
            $contenido .= getVideos(true);
            break;
        case 'noticias':
            $contenido .= getNoticias();
            break;
        case 'cancionesnuevas':
            $contenido .= getNuevasCanciones();
            break;
        default:
            //Error 404
            $contenido = '<h2>Error 404</h2><p>Lo sientimos, pero no se encuentra disponible lo que nos está solicitando</p>';
    }
    return $contenido;
}

// Funciones de secciones
function getHead($whereami='inicio')
{
    $dondeEstoy=($whereami=='inicio')?'':' - '.ucfirst($whereami);
    $titulo = 'wWw.ConectPJ.cOm // La Radio Q\' Te Activa & Te Pone!!'.$dondeEstoy;

    $contenido = '  <meta charset="UTF-8" />
    <meta name="google-site-verification" content="f68MwMpNNEEOuAHcxGNUsFuf-QHgEaWg_MVjy8wytUs" />
    <meta property=og:image content="http://www.conectpj.com/imagenes/logos/logo.png"/>
    <meta name="description" content="Radio Online donde encontraras lo mejor de la musica, pop, electro, metal, cortavenas, y los mas divertidos locutores con sus ocurrencias y disparates pero siempre con el cariño y respeto que nuestro publico merece por que aquí en esta radio somos una familia, aunque nada de esto seria posible sin el esfuerzo de nuestros fundadores Phillip Mendoza Y Luis Rodriguez a los que se le debe un agradecimiento danos tu apoyo  se parte de esta familia que dia a dia crese y llega a ustedes con todo el cariño que se merecen xD!">
    <title>'.$titulo.'</title>
    <link href="http://fonts.googleapis.com/css?family=Titillium+Web:400italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Carrois+Gothic+SC" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="imagenes/logos/logo.ico" />
    <link rel="image_src" href="http://www.conectpj.com/imagenes/logos/logo.png" />
    <link rel="stylesheet" href="_js/normalize.css" />
    <link rel="stylesheet" href="_css/estilo.css" />
    <script src="_js/prefixfree.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
            // Carga del locutor online
            $(document).on("ready",contDinamico);
            function contDinamico () {
                var urlLocutorOnline = "../selectdj/_output/locutor_online_v2.php",
                urlAnuncioActual = "../selectdj/_output/anuncio_actual_v2.php";
                var locOnline = $.get( urlLocutorOnline, function(data){
                    $("#espacio_locutor_online").html(data);
                });
                var anuncioActual = $.get( urlAnuncioActual, function(data){
                    $("#anuncios").html(data);
                });
                setTimeout("contDinamico()",60000);
            }
            </script>
            <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(["_setAccount", "UA-35186695-1"]);
            _gaq.push(["_setDomainName", "conectpj.com"]);
            _gaq.push(["_trackPageview"]);

            (function() {
                var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
                ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
                var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
            })();

            </script>';
    return $contenido;
}

function getHeader($whereami='inicio')
{
    $contenido = '<div id="banner">'.getBanner().'</div>';
    $contenido .= getNav($whereami);
    return $contenido;
}

function getAside()
{
    $contenido  = getRedes();
    $contenido .= getAnunciosDinamicos();
    $contenido .= getChat();
    $contenido .= getModelo();
    return $contenido;
}

function getFooter()
{
    $contenido = '<div id="centro">';
    $contenido .= getFundador();
    $contenido .= getAdministradores();
    $contenido .= getAportadores();
    $contenido .= '<hr align="LEFT" size="1" width="100%" Max-width="100%" color="#D2D2D2" noshade>
                    <p>Todos Los Derechos Reservados Por www.ConectPJ.com - 2013 - | Diseñado Por Empresa : <a href="">CreativePMG</a> </p>
                </div ><!-- centro -->';
    return $contenido;
}

// Funciones generales
function getNav($actualSeccion='inicio')
{
    $current['inicio']          =($actualSeccion=='inicio')?'actual':'';
    $current['noticias']        =($actualSeccion=='noticias')?'actual':'';
    $current['cancionesnuevas'] =($actualSeccion=='cancionesnuevas')?'actual':'';
    $current['videos']          =($actualSeccion=='videos')?'actual':'';
    $current['eventos']         =($actualSeccion=='eventos')?'actual':'';
    $current['contacto']        =($actualSeccion=='contacto')?'actual':'';
    $variablesCurrent = array(
            'inicio'          => '_[CURRENT_INICIO]_',
            'noticias'        => '_[CURRENT_NOTICIAS]_',
            'cancionesnuevas' => '_[CURRENT_CANCIONESNUEVAS]_',
            'videos'          => '_[CURRENT_VIDEOS]_',
            'eventos'         => '_[CURRENT_EVENTOS]_',
            'contacto'        => '_[CURRENT_CONTACTO]_',
            );

    $nav = '
    <nav id="nav">
        <ul>
            <li class="_[CURRENT_INICIO]_ sobrecaja"><a href="inicio">INICIO</a></li>
            <li class="_[CURRENT_NOTICIAS]_ sobrecaja"><a href="noticias">NOTICIAS</a></li>
            <li class="_[CURRENT_CANCIONESNUEVAS]_ sobrecaja"><a href="cancionesnuevas">CANCIONES NUEVAS</a></li>
            <li class="_[CURRENT_VIDEOS]_ sobrecaja"><a href="videos">VIDEOS</a></li>
            <li class="_[CURRENT_EVENTOS]_ sobrecaja"><a href="eventos">EVENTOS</a></li>
            <li class="_[CURRENT_CONTACTO]_ sobrecaja"><a href="contacto">CONTACTANOS</a></li>
        </ul>
    </nav>
    ';
    return str_replace($variablesCurrent, $current, $nav);
}

function getBanner()
{
    return '<iframe src="slider.html" align="center" style="border:none; max-width:100%; overflow:hidden; width:1020px;margin:0 ; height:185px;" scrolling="no" frameborder="0" allowfullscreen></iframe>';
}

function getRadio()
{
    $contenido = '<div id="radio">
                        <div id="repro">
                            <iframe frameborder="0" src="http://conectpj.com/proyecto/1.swf"></iframe>
                        </div><!-- #espacio -->
                        <div id="escuchanos">
                            <a href="#"><img src="imagenes/BLACK BERRY.png"></a>
                            <a href="#"><img src="imagenes/APLE.png"></a>
                            <a href="#"><img src="imagenes/ANDROID.png"></a>
                            <a href="#"><img src="imagenes/TUNEIN.png"></a>
                            <a href="#"><img src="imagenes/FACE.png"></a>
                        </div>  <!-- #escuchanos -->
                    </div><!-- #repro -->
                    <div id="online">
                        <div id="espacio_locutor_online"></div>
                    </div><!--online -->';
    return $contenido;
}

function getEventos($soloUltimo=false)
{
    global $configuracion;
    $contenido = '<div class="name">
                        <a href="'.$configuracion['prefijoURL'].'/noticias">EVENTOS :</a>
                    </div>
                    <section class="contenido">
                        <div class="logo">
                            <a href="" ><img src="imagenes/cotempologo.jpg"></a>
                        </div><!-- logo-->
                        <div class="texto">
                            Contempo Event\'s Realizando los mejores eventos en Lima Norte.</br>
                            <== Click para Ver nuestros Eventos... Goooo...
                        </div><!-- texto -->
                    </section><!-- contenido-->';
    return $contenido;
}

function getNoticias($soloUltimo=false)
{
    global $connectPDO;
    global $configuracion;
    $array_variables = array(
        '_[TITULO]_',
        '_[FECHA]_',
        '_[IMAGEN]_',
        '_[TEXTO]_'
        );
    $templateNoticia .= '<div class="name">
                        <a href="'.$configuracion['prefijoURL'].'/noticias">NOTICIAS :</a>
                    </div>
                    <div class="contenido">
                        <div class="tituloT">
                            _[TITULO]_
                        </div><!-- titulo T -->
                        <div class="fecha">
                            <p>_[FECHA]_</p>
                        </div><!-- .fecha -->
                        <div class="img">
                            <img src="_[IMAGEN]_" align="center">
                        </div><!-- img -->
                        <div class="datos">
                            <p>_[TEXTO]_</p>
                        </div><!-- .datos -->
                    </div>';
    $limit = ($soloUltimo)?'LIMIT 1':'';
    $dataEx = $connectPDO->Execute("SELECT titulo,CONCAT(ucfirst(DATE_FORMAT(fecha,'%M')),DATE_FORMAT(fecha,' %e, %Y')) as fecha,imagen,texto FROM cpj_noticias ORDER BY fecha,id_noticia DESC {$limit}");
    while($data = $dataEx->fetch())
    {
        $contenido .= str_replace($array_variables, $data, $templateNoticia);
    }
    return $contenido;
}

function getNuevasCanciones($soloUltimo=false)
{
    global $connectPDO;
    global $configuracion;
    $array_variables = array(
        '_[TITULO]_',
        '_[URLIMAGEN]_',
        '_[URLDESCARGA]_',
        );
    $templateNuevasCanciones = '<div class="contenido">
                        <div class="tituloT">
                            _[TITULO]_
                        </div><!-- titulo T -->
                        <div class="img">
                        <img  src="_[URLIMAGEN]_" align="center" />
                        </div><!-- img -->
                        <div class="descarga">
                            <a href="_[URLDESCARGA]_" target="_blank"><img src="imagenes/canciones/descarga.jpg"></a>
                        </div><!-- .descarga -->
                    </div>';

    $limit = ($soloUltimo)?'LIMIT 1':'';
    $dataEx = $connectPDO->Execute("SELECT titulo,url_imagen,url_descarga FROM cpj_nuevas_canciones WHERE publicada ORDER BY id_cancion DESC {$limit}");
    while($data = $dataEx->fetch())
    {
        $contenido .= str_replace($array_variables, $data, $templateNuevasCanciones);
    }

    return $contenido;
}

function getVideos($soloUltimo=false)
{
    $contenido = '<div class="name">
                        <a href="videos.html">VIDEOS :</a>
                    </div>
                    <div class="contenido">
                        <div class="tituloT">
                            (Video Preview) Recuerdo Aquella Vez – KonsuL The Genius Boy Ft Yolvin & Kalitozh (Prod. DJ KonsuL El Beatroniko)
                        </div><!-- titulo T -->
                        <div class="img">
                            <iframe  src="http://www.youtube-nocookie.com/v/o3ak2t3cGAw?hl=es_MX&amp;version=3&amp;rel=0" align="center"  scrolling="no" frameborder="0" allowfullscreen></iframe>
                        </div><!-- img -->
                    </div>';
    return $contenido;
}

function getRedes()
{
    $contenido = '<div class="redes">
                            <iframe frameborder="0" src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fradioconectpj&width=00&height=258&show_faces=true&colorscheme=light&stream=false&border_color=white&header=false&appId=334775653285723"></iframe>
                        </div> <!-- .redes -->
                        <div class="redes">
                            <iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/follow_button.1366232305.html#_=1366414885311&amp;id=twitter-widget-0&amp;lang=es&amp;screen_name=conectpj&amp;show_count=true&amp;show_screen_name=true&amp;size=l" class="twitter-follow-button twitter-follow-button" style="width: 02px; height: 28px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe>
                        </div> <!-- .redes -->';
    return $contenido;
}

function getAnunciosDinamicos()
{
    $contenido = '<div id="eventos">
                        <div id="anuncios"></div>
                    </div>';
    return $contenido;
}

function getChat()
{
    $contenido = '<div id="chat">
                    <div class="titulo">
                        <p>Chat ConectPJ</p>
                    </div> <!-- .titulo -->
                    <div id="espaciochat">
                        <iframe name="chat" width="02" allowtransparency="true" border="0px" style="border:none; max-width:100%;" scrolling="no" src="1chat.html"></iframe>
                    </div>
                </div><!-- chat-->';

    return $contenido;
}

function getModelo()
{
    $contenido = '<div id="modelo">
                        <div class="titulo">
                            <p>Modelo Conectpj</p>
                        </div> <!-- .titulo -->
                        <div id="imagenmodelo">
                            <a href="#" target="_blank"><img src="imagenes/zing.jpg"></a>
                        </div><!-- #imagenmodelo -->

                    </div><!-- #modelo -->';
    return $contenido;
}

function getFundador()
{
    $contenido = '<div id="fundador">
                        <div class="titulofoot">
                            Fundador:
                        </div><!--titulofoot -->
                        <div class="lista">
                            <a href="">- Phillip Mendoza Gonzales.</a>
                        </div><!-- #lista -->
                    </div><!--dueño -->';
    return $contenido;
}

function getAdministradores()
{
    $contenido = '<div id="admin">
                        <div class="titulofoot">
                            Administradores:
                        </div><!--titulofoot -->
                        <div class="lista">
                            <a href="">- Carlos Saavedra Flores(DjKonsul)</a></br>
                            <a href="">- Jhonnii Sandoval Giove</a></br>
                        </div><!-- #lista -->
                    </div><!--admin -->';
    return $contenido;
}

function getAportadores()
{
    $contenido = '<div id="aportadores">
                        <div class="titulofoot">
                            Patrocinadores/publicidad:
                        </div><!--titulofoot -->
                        <div class="lista">
                            <a href="">- CreativePMG</a></br>
                            <a href="">- Quimica Music</a></br>
                            <a href="">- Reality Contra Todo</a></br>
                        </div><!-- #lista -->
                    </div><!--aportadores -->';
    return $contenido;
}
?>