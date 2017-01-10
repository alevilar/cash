<div class="content-white">
	<?php $mesaTitle = Inflector::pluralize( Configure::read('Mesa.tituloMesa') ); ?>
	<h3 class="center">Mostrando <?php echo $mesaTitle?> del Arqueo desde <?php echo $this->Time->format( "d-m-Y H:i",$arqueoAnterior['Arqueo']['created'] ) ?>
		
		hasta <?php echo $this->Time->format( "d-m-Y H:i",$arqueo['Arqueo']['created'] ) ?>
	</h3>
	<br>
	<?php if ( empty($mesas)) { ?>
		<div class="alert alert-warning center"><?php echo __("No tiene %s", $mesaTitle )?></div>
	<?php }	else { ?>
	<div id="mesas-index">

		<?php echo $this->element('Mesa.listado_tabla'); ?>

	</div>
	<?php } ?>

</div>

