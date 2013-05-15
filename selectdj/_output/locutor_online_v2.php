<?php

require_once('../class/connectPDO.php');
$connection = new connectPDO;

$data = $connection->getrow("SELECT 
    cpj_online.id_online, 
    NOW() BETWEEN tiempo_desde AND tiempo_hasta as vigente,cpj_users.*,
    CASE WHEN fecha_nacimiento IS NOT NULL THEN 
        CONCAT(CAST((YEAR(CURDATE())-YEAR(fecha_nacimiento)) - (RIGHT(CURDATE(),5)<RIGHT(fecha_nacimiento,5)) AS CHAR), ' años')
    ELSE '-' END as edad
FROM cpj_online,cpj_users
WHERE cpj_users.id_user = cpj_online.id_user AND id_online = (SELECT MAX(id_online) FROM cpj_online)");

$autoLocutor = ($data===PDOWARNING || $data['vigente']=='0')?true:false;
if($autoLocutor)
{

?>
<section id='locutor_online'>
    <article>
        <div class="foto_locutor">
            <img src="/selectdj/_images/classic_mic.jpg">
        </div>
    </article>
</section>

<?php

}
else
{

$facebook = ($data['url_facebook']=='')?'':"<a href='{$data['url_facebook']}' target='_blank'><img src='/selectdj/_images/facebook.png'></a>";
$twitter = ($data['url_twitter']=='')?'':"<a href='{$data['url_twitter']}' target='_blank'><img src='/selectdj/_images/twitter.png'></a>";
$googleplus = ($data['url_googleplus']=='')?'':"<a href='{$data['url_googleplus']}' target='_blank'><img src='/selectdj/_images/google.png'></a>";
$youtube = ($data['url_youtube']=='')?'':"<a href='{$data['url_youtube']}' target='_blank'><img src='/selectdj/_images/youtube.png'></a>";
$soundcloud = ($data['url_soundcloud']=='')?'':"<a href='{$data['url_soundcloud']}' target='_blank'><img src='/selectdj/_images/soundcloud.png'></a>";

?>
<div id="datos">
    <div class="tituloonline">Nombre : </div><!-- .tituloonline -->
    <div class="contenidoonline nombre_propio"><p><?php echo $data['first_name'].' '.$data['last_name']; ?></p></div><!-- .contenidoonline --> 
    <div class="tituloonline">Ciudad Donde Radica : </div><!-- .tituloonline -->
    <div class="contenidoonline"><p><?php echo $data['residencia']; ?></p></div><!-- .contenidoonline --> 
    <div class="tituloonline">Hobby : </div><!-- .tituloonline -->
    <div class="contenidoonline"><p><?php echo $data['hobbies']; ?></p></div><!-- .contenidoonline --> 
    <div class="tituloonline">Edad : </div><!-- .tituloonline -->
    <div class="contenidoonline"><p><?php echo $data['edad']; ?></p></div><!-- .contenidoonline --> 
</div>
<div id="imagenes" >
    <div id="foto"><img src="<?php echo $data['fotografia']; ?>"></div><!--foto -->
    <div id="logosfoto" style="margin-top:0.1px">
    <?php
        echo "{$facebook}\n";
        echo "{$twitter}\n";
        echo "{$googleplus}\n";
        echo "{$youtube}\n";
        echo "{$soundcloud}\n";
    ?>
    </div>
</div>
<?php
}
?>