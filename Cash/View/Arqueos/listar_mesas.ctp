<div class="content-white">
	<?php $mesaTitle = Inflector::pluralize( Configure::read('Mesa.tituloMesa') ); ?>
	<h3 class="center">
	<?php 

		$mesaTitle = Inflector::pluralize( Configure::read('Mesa.tituloMesa') );
		if ( !empty($fechas['desde']) && !empty($fechas['hasta']) ) {
			$desde = $this->Time->format( "d-m-Y H:i",$fechas['desde']);
			$hasta = $this->Time->format( "d-m-Y H:i",$fechas['hasta']);
			echo __("Mostrando %s del Arqueo desde %s hasta %s", $mesaTitle, $desde, $hasta );
		} else if ( !empty($fechas['hasta']) && empty($fechas['desde'])  ) {
			$hasta = $this->Time->format( "d-m-Y H:i",$fechas['hasta']);
			echo __("Mostrando %s del Arqueo hasta %s", $mesaTitle, $hasta );
		} else if ( !empty($fechas['desde']) && empty($fechas['hasta']) ) {
			$desde = $this->Time->format( "d-m-Y H:i",$fechas['desde']);
			echo __("Mostrando %s del Arqueo desde %s", $mesaTitle, $desde );
		}

	?>
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

