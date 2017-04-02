<div class="content-white">
	<h3 class="center">

		<?php 

		if ( !empty($fechas['desde']) && !empty($fechas['hasta'])) {
			$desde = $this->Time->format( "d-m-Y H:i",$fechas['desde']);
			$hasta = $this->Time->format( "d-m-Y H:i",$fechas['hasta']);
			echo __("Mostrando Pagos del Arqueo desde %s hasta %s", $desde, $hasta );
		} else {
			$hasta = $this->Time->format( "d-m-Y H:i",$fechas['hasta']);
			echo __("Mostrando Pagos del Arqueo hasta %s", $hasta );
		}

		?>
		
	</h3>
	<br>


<?php

echo $this->element("Account.egresos_table_list", array('mostrarBuscador'=>false));


?>

</div>