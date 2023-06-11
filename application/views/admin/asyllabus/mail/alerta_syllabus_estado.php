
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="x-apple-disable-message-reformatting">
	<title></title>
	<style>
		table, td, div, h1, p {font-family: Arial, sans-serif;}
	</style>
</head>
<body style="margin:0;padding:0;">
	<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
		<tr>
			<td align="center" style="padding:0;">
				<table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
					<tr>
						<td align="center">
							<img  src='cid:logo_1' alt="" width="100%"/>
						</td>
					</tr>
					<tr>
						<td >
							<table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
								<tr>
									<td style="padding:0 0 36px 0;color:#153643;">
										<h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;" align="center">
											<?php echo 'Cambio de estado de Syllabus'; ?>
										</h1>
										<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-align: center;">
											<?php echo 'El syllabus '.$nom_syll.' '.$periodo.' perteneciente al plan de estudios '.$plan_estudios.' de la carrera '.$nom_carrera.'  cambio su estado a '; ?> <b> <?php echo $nom_est_syllabus; ?> </b> <br>
											<br>
										</p>

										<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-align: center;">
											<?php 
											
											if($estado==2){
												echo 'Se agregará el archivo a la lista de versiones   ';
											}else{
												echo 'Debe rectificar errores para la aprobación  ';
											}
											?>
										</p>


										<br>

										<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-align: center;">
											<?php echo 'La revisión estuvo a cargo de '.$nom_usu_estado; ?>  <br>
											<?php echo 'El usuario '.$nom_usu_registro.' creo el syllabus'; ?> 
											
										</p>

										<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-align: center;">
											<?php 
											if($estado==2){
												echo 'Tiempo que conllevó lograr aprobación    ' ;
												echo '</br>';
												echo '<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-align: center;">'.$fech_diferencia.'</p>';

											}else{
												echo 'Tiempo que ha transcurrido desde que se creo el syllabus   ';
												echo '<p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-align: center;">'.$fech_diferencia.'</p>';

											}
											
											?>

										</p>

										

										<?php if($estado==2){	?>

											
										
											<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-align: center;">
												<a href="<?php echo $url_pdf; ?>" style="color:#1d8ceb;text-decoration:underline;">
													Ver el syllabus aqui
												</a>
											</p>

											<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-align: center;">
															<a href="<?php echo $url_lista; ?>" style="color:#1d8ceb;text-decoration:underline;">
																Ir a lista de syllabus</a>
											</p>


										<?php  }else{  ?>


											<p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;text-align: center;">
												<a href="<?php echo $url_comentarios; ?>" style="color:#1d8ceb;text-decoration:underline;">
													Ver los comentarios syllabus
												</a>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="<?php echo $url_comentarios_ficha; ?>" style="color:#1d8ceb;text-decoration:underline;">
													Ver los comentarios  ficha de evaluación
												</a>
											</p>

										<?php  } ?>




										
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						
									<td  align="center" >

										<img src='cid:logo_2'  alt="" width="100%" />
									</td>
						
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>