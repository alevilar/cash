<?php


class Zeta extends CashAppModel {

	public $name = 'Zeta';

	public $validate = array(
                'numero_comprobante' => array('numeric'),
                'total_ventas' => array('numeric'),
	);
        
  public $order = array('Zeta.numero_comprobante' => 'DESC');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
            'Cash.Arqueo'
	);


  public $actsAs = array(
        'Risto.DiaBuscable' => array(
                'fechaField' => 'created',
                'fieldsParaSumatoria' => array(
                     //   "total_ventas",
                        "monto_iva",
                        "monto_neto",
                        "nota_credito_iva",
                        "nota_credito_neto",
                ),
            ),
        );

        
  public function beforeSave($options = array())
        {
            if (empty($this->data['Zeta']['total_ventas'])){
                $this->data['Zeta']['total_ventas'] = 0;
            }
            if (empty($this->data['Zeta']['monto_iva'])){
                $this->data['Zeta']['monto_iva'] = 0;
            }
            if (empty($this->data['Zeta']['nota_credito_iva'])){
                $this->data['Zeta']['nota_credito_iva'] = 0;
            }
            if (empty($this->data['Zeta']['monto_neto'])){
                $this->data['Zeta']['monto_neto'] = 0;
            }
            if (empty($this->data['Zeta']['nota_credito_neto'])){
                $this->data['Zeta']['nota_credito_neto'] = 0;
            }
            return parent::beforeSave($options);
        }
        

}
