<?php

require_once('class/connectPDO.php');
$connectPDO = new connectPDO;

$configuracion['prefijoURL'] = '';
$REQUEST_URI = str_replace($configuracion['prefijoURL'] , '', $_SERVER['REQUEST_URI']);
$parametrosURL = explode('/', trim($REQUEST_URI,'/'));

// El primer parametro lo tomo como la seccion solicitada
$seccionActual = addslashes(array_shift($parametrosURL));
$seccionActual = ($seccionActual=='')?'inicio':$seccionActual;



require_once('_template/_funciones.php');
?><!DOCTYPE html>
<html lang="es">
<head>
	<?php echo getHead($seccionActual); ?>
</head>
<body>
	<section id="web">
		<header>
			<?php echo getHeader($seccionActual); ?>
		</header>
		<section id="total">
			<section id="izquierda">
				<div id="columna">
					<div id="primero">
						<?php echo getRadio(); ?>
					</div> <!-- #primero -->

					<div id="segundo">
						<?php echo getPrincipal($seccionActual); ?>
					</div> <!-- #segundo -->
				</div> <!-- #columna -->
			</section><!-- section #izquierda -->
			<section id="derecha">
				<?php echo getAside(); ?>
			</section>	<!-- section #derecha -->
		</section><!--total -->
	</section><!-- section web -->
	<section id="foot">
		<?php echo getFooter(); ?>
	</section><!-- foot -->
</body>
</html>