<?php
$ingresoEfectivo = $egresoEfectivo = null;

echo $this->Html->css('/cash/css/style_cash');

?>

<script type="text/javascript">
    Risto={};
    Risto.printerFiscal = <?php echo json_encode( $printer, JSON_NUMERIC_CHECK )?>;

    Risto.PRECISION_COMA = "<?php echo Configure::read('Restaurante.precision')?>";
</script>
<div class="content-white">
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading center">
                <?php
                $cajaName = 'Caja';
                if (!empty($caja) && !empty($caja['Caja']) && !empty($caja['Caja']['name'])) {
                    $cajaName = $caja['Caja']['name'];
                }


                    if ( !empty($desde) && !empty($hasta) ) {
                        $desde = $this->Time->format( "d-m-Y H:i",$desde);
                        $hasta = $this->Time->format( "d-m-Y H:i",$hasta);
                        echo __("Tablas de datos con información desde: <b>%s</b> hasta <b>%s</b>", $desde, $hasta );
                    } else if ( !empty($hasta) && empty($desde)  ) {
                        $hasta = $this->Time->format( "d-m-Y H:i",$hasta);
                        echo __("Tablas de datos con información hasta <b>%s</b>", $hasta );
                    } else if ( !empty($desde) && empty($hasta) ) {
                        $desde = $this->Time->format( "d-m-Y H:i",$desde);
                        echo __("Tablas de datos con información desde: <b>%s</b>", $desde );
                    }

                ?>


            </div>

            <div class="panel-body">
                <div class="col-sm-6">
                    <?php if (!empty($ingresosList)) { ?>
                    <?php $totalVentas = array_pop( $ingresosList) ?>

                        <?php 

                        $linkMesasInvolucradas = array('action' => 'listar_mesas');
                        $linkCobros = array('action' => 'listar_cobros');
                        $linkPagos = array('action' => 'listar_pagos');

                        if ( !empty($this->request->data['Arqueo']['id']) ) {
                            $arqueoId = $this->request->data['Arqueo']['id'];

                            $linkMesasInvolucradas[] = $arqueoId;
                            $linkCobros[] = $arqueoId;
                            $linkPagos[] = $arqueoId;
                        }
                        $mesaTitle = Inflector::pluralize( Configure::read('Mesa.tituloMesa'));
                        echo $this->Html->link(__('Ver %s involucradas', $mesaTitle), $linkMesasInvolucradas, array('target'=>'_blank')); ?>

                        <br>
                        <?php echo $this->Html->link('Ver Cobros involucrados', $linkCobros , array('target'=>'_blank')); ?>

                        <table class="table table-condensed table-bordered mini">
                            <caption>Ventas <b><?php echo $this->Number->currency($totalVentas[0]["total"])?></b></caption>

                            <tbody>
                                <tr>
                                    <?php foreach ($ingresosList as $ing) { ;?>
                                        <th>
                                            <?php echo $ing['TipoDePago']['name'] ?>
                                        </th>
                                       
                                <?php } ?>   
                                </tr>
                                <tr>
                                <?php foreach ($ingresosList as $ing) { ;?>
                                        <td>
                                            <?php echo "(".$ing[0]['cant'].") ".$this->Number->currency($ing[0]['total']); ?>
                                        </td>
                                <?php } ?>   
                                </tr>
                            </tbody>
                        </table>
                <?php } ?>
                </div>

                <div class="col-sm-6">
                    <?php if (!empty($egresosList)) { ?>
                    <br>
                        <?php echo $this->Html->link('Ver Pagos involucrados', $linkPagos, array('target'=>'_blank')); ?>


                        <?php $totalCompras = array_pop( $egresosList );?>
                        <table class="table table-condensed table-bordered mini">
                            <caption>Pagos (Módulo contable) <b><?php echo $this->Number->currency($totalCompras[0]["total"])?></b></caption>
                            <tbody>
                                <tr>
                                    <?php foreach ($egresosList as $eg) { ?>
                                        <td>
                                            <?php echo $eg['TipoDePago']['name'] ?>
                                        </td>
                                <?php } ?>  
                                </tr>
                                <tr>
                                <?php foreach ($egresosList as $eg) { ?>
                                        <td>
                                            <?php echo "(".$eg[0]['cant'].") ".$this->Number->currency($eg[0]['total']); ?>
                                        </td>
                                <?php } ?>    
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php echo $this->Form->button('Guardar Arqueo', array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'id' => 'btn-submit', "form" => "ArqueoAddForm")); ?>
    </div>

     <div class="col-sm-3">
            <div id="billetines">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <p class="muted">Ingresar cantidades de cada billete</p>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="BilletesB500" class="col-sm-3 control-label">$500</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesB500" data-value="500">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BilletesB100" class="col-sm-3 control-label">$100</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesB100" data-value="100">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BilletesB50" class="col-sm-3 control-label">$50</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesB50" data-value="50">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BilletesB20" class="col-sm-3 control-label">$20</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesB20" data-value="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BilletesB10" class="col-sm-3 control-label">$10</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesB10" data-value="10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BilletesB5" class="col-sm-3 control-label">$5</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesB5" data-value="5">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BilletesB2" class="col-sm-3 control-label">$2</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesB2" data-value="2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BilletesB1" class="col-sm-3 control-label">$1</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesB1" data-value="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BilletesB0" class="col-sm-3 control-label">0.5c</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesB0" data-value="0.5">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="BilletesBA" class="col-sm-3 control-label">Otros</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control billete-value" id="BilletesBA" data-value="1">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

     </div>

<div class="col-sm-9">
    <div class="row">
        <?php
        echo $this->Form->create('Arqueo', array('id' => 'ArqueoAddForm'));

        echo $this->Form->input('id');

        $classArqueoContainer = 'panel-default';
        if (isset($this->data['Arqueo']['saldo'])) {
            if (abs($this->data['Arqueo']['saldo']) == 0) {
                $classArqueoContainer = 'panel-success';
            } elseif (abs($this->data['Arqueo']['saldo']) < 11) {
                $classArqueoContainer = 'panel-warning';
            } else {
                $classArqueoContainer = 'panel-danger';
            }
        }
        ?>

        <div class="col-sm-7">
            <div class="panel <?php echo $classArqueoContainer; ?>" id='arqueoContainer'>
                <div class="panel-heading">
                    <h2>Arqueo de <?php echo $cajaName ?></h2>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            if (empty($this->data['Arqueo']['caja_id'])) {
                                echo $this->Form->input('caja_id');
                            } else {
                                echo $this->Form->hidden('caja_id');
                            }
                            echo $this->Form->input('datetime', array('class' => "form-control muted", 'type' => 'datetime', 'label' => 'Fecha y Hora'));
                            echo $this->Form->input('importe_final', array('required' => true));
                            echo $this->Form->input('saldo', array('disabled' => true));
                            echo $this->Form->input('observacion', array('label' => 'Obs. del Arqueo'));
                            ?>
                        </div>

                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->input('importe_inicial', array('class' => 'form-control muted'));
                            if (!empty($this->data['Arqueo']['ingreso']) || (!empty($caja) && !empty($caja['Caja']['name']) && !empty($caja['Caja']['computa_ingresos']) )) {
                                echo $this->Form->input('ingreso', array('label' => 'Ventas en efectivo', 'class' => 'form-control muted'));
                            } else {
                                echo $this->Form->hidden('ingreso');
                            }

                            if (!empty($this->data['Arqueo']['egreso']) || (!empty($caja) && !empty($caja['Caja']['name']) && !empty($caja['Caja']['computa_egresos']) )) {
                                echo $this->Form->input('egreso', array('label' => 'Pagos en efectivo', 'class' => 'form-control muted'));
                            } else {
                                echo $this->Form->hidden('egreso');
                            }
                            echo $this->Form->input('otros_ingresos', array('class' => 'form-control muted'));
                            echo $this->Form->input('otros_egresos', array('class' => 'form-control muted'));
                            ?>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    $display = "";
                    if (empty($this->data['Arqueo']['hacer_cierre_zeta'])) {
                        $display = 'display: none';
                    }
                    echo $this->Form->input('hacer_cierre_zeta', array('type' => 'checkbox', 'class' => '', 'label' => array('escape' => false, 'text' => '<h2>Hacer Cierre Z</h2>'), 'id' => 'ArqueoHacerCierreZeta'));
                    echo $this->Form->hidden('Zeta.id');
                    ?>

                </div>

                <div class="panel-body mostrar_zeta" style="<?php echo $display ?>">
                    <div class="row">
                        <p class="text-center">
                        <?php 
                        echo $this->Html->link("Imprimir Z"
                            , array('plugin'=>'printers', 'controller'=>'printers', 'action'=>'cierre', 'Z')
                            , array(
                                'id'=>'btn-imprimir-z', 
                                'class'=>'btn btn-success', 
                                'role'=>'buton'
                                )
                            );
                        ?>
                        </p>
                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->input('Zeta.total_ventas', array(
                                'label' => 'Ventas del Día',
                                'class' => 'form-control muted', 
                                'required' => false,                                 
                                )
                            );
                            echo $this->Form->input('Zeta.monto_neto', array('required' => false, 'id'=>'zeta-monto-neto'));
                            echo $this->Form->input('Zeta.nota_credito_neto', array('id'=>'zeta-nc-neto'));
                            echo $this->Form->input('Zeta.observacion', array('label' => 'Obs. General Z'));
                            ?>
                        </div>

                        <div class="col-sm-6">
                            <?php
                            echo $this->Form->input('Zeta.numero_comprobante', array(
                                'step' => '1',
                                'label' => '#Comprobante',
                                'class' => 'form-control muted', 
                                'required' => false,
                                'id'=>'zeta-numero',
                                )
                            );
                            echo $this->Form->input('Zeta.monto_iva', array('id'=>'zeta-monto-iva'));
                            echo $this->Form->input('Zeta.nota_credito_iva', array('id'=>'zeta-nc-iva'));
                            echo $this->Form->input('Zeta.observacion_comprobante_tarjeta', array('label' => 'Obs. Tarjetas'));
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
        echo $this->Form->end(null);
        ?>
    </div>
</div>



<?php echo $this->Html->script( array(
            '/cash/js/arqueos_add',
            '/aditions/js/fiscalberry',
            '/aditions/js/printer_driver',
            )); ?>

</div>
 </div>