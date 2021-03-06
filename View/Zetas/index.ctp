<div class="content-white">


<div class="row">
    
    <div class="col-sm-6">
        <h1>Listado de Cierres Zetas</h1>  
    </div>

    <div class="col-sm-6">
            <br>
            <?php
            echo $this->Form->create('Zeta', array('type' => 'get', 'class' => 'form-inline', 'role' => "form"));
      
            echo $this->Form->input('fecha_desde', array(
                        'label' => array(
                            'text' => 'Desde',
                            'class' => 'sr-only',
                        ),
                        'placeholder' => 'Desde',
                        'type' => 'date',
                    ));
                
                
            echo  $this->Form->input('fecha_hasta', array(
                        'label' => array(
                            'text' => 'Hasta',
                            'class' => 'sr-only',
                        ),
                        'placeholder' => 'Hasta',
                        'type' => 'date',
                    ));

            ?>
            <button type="submit" class="btn btn-primary"><i class='fa fa-search' aria-hidden='true'></i><div class="sr-only">Buscar</div></button>

       

            
    </div>


    <div class="clearfix"></div>

        <?php if (count($zetas) ) { ?>
        <div class="col-sm-12">
            <br><br>
            <p class="center">
            <?php
                echo $this->Html->link('Descargar Excel', $this->here . '.xls' . strstr($_SERVER['REQUEST_URI'], '?'), array(
                    'class' => 'btn btn-success'
                ));
                ?>
            </p>
            <br>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Total Ventas</th>
                        <th>#Comprobante</th>
                        <th>Monto Iva</th>
                        <th>Monto Neto</th>
                        <th>Nota de Crédito IVA</th>
                        <th>Nota de Crédito Neto</th>
                        <th>Observación de las Tarjetas</th>
                        <th>Observación del Zeta</th>
                        <th>Creado</th>
                        <th>Modificado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($zetas as $z) { ?>
                        <tr>
                            <td><?php echo $this->Number->currency($z['Zeta']['total_ventas']) ?></td>
                            <td class="center"><?php echo $z['Zeta']['numero_comprobante'] ?></td>
                            <td><?php echo $this->Number->currency($z['Zeta']['monto_iva']) ?></td>
                            <td><?php echo $this->Number->currency($z['Zeta']['monto_neto']) ?></td>
                            <td><?php echo $this->Number->currency($z['Zeta']['nota_credito_iva']) ?></td>
                            <td><?php echo $this->Number->currency($z['Zeta']['nota_credito_neto']) ?></td>
                            <td><?php echo $z['Zeta']['observacion_comprobante_tarjeta'] ?></td>
                            <td><?php echo $z['Zeta']['observacion'] ?></td>
                            <td><?php echo $z['Zeta']['created'] ?></td>
                            <td><?php echo $z['Zeta']['modified'] ?></td>
                            <td><?php echo $this->Html->link('arqueo', array('controller' => 'arqueos', 'action' => 'edit', $z['Zeta']['arqueo_id'])); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div>
        
        <div class="col-sm-12">
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Página {:page} de {:pages}, mostrando {:current} elementos de {:count}', true)
                ));
                ?>
            </p>
<?php echo $this->element('Risto.pagination'); ?>
        </div>


        <?php } else { ?>

            <p class="alert alert-info col-sm-8 col-sm-offset-2">
                
                Aún no tienes ningún Zeta creado. Los comprobantes "Zeta", son comprobantes fiscales y se crean al realizar un Arqueo de Caja.
            </p>
        <?php } ?>

   

</div>