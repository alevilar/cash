<div class="content-white">
	<h3 class="center">

		<?php 
			$desde = $this->Time->format( "d-m-Y H:i",$fechas['desde']);

			$hasta = $this->Time->format( "d-m-Y H:i",$fechas['hasta']);
		
			echo __("Mostrando Cobros del Arqueo desde %s hasta %s", $desde, $hasta );
		?>
		
	</h3>
	<br>


<?php

echo $this->element("Mesa.cobros_table_list", array('mostrarBuscador'=>false));


?>

</div>