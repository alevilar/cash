<?php


class Arqueo extends CashAppModel {

	public $name = 'Arqueo';
	public $validate = array(
		'caja_id' => array('numeric'),
                'datetime' => array(
                    'rule'    => array('datetime', 'ymd'),
                    'message' => 'La fecha y la hora no es un formato válido.'
                ),
                'importe_inicial' => array('numeric', 'notBlank'),
                'importe_final' => array('numeric', 'notBlank'),
	);
        
        public $order = array('Arqueo.datetime DESC');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
            'Cash.Caja', 
	);
        
    public $hasOne = array(
        'Cash.Zeta',
    );

    public function beforeSave($options = array())
    {
        parent::beforeSave($options);
        /*
        if (strlen( $this->data['Arqueo']['datetime'] ) == '16') {
            $this->data['Arqueo']['datetime'] = $this->data['Arqueo']['datetime'].':59';
        }
        */
        return true;
    }


    public function verifyExist($id) {
        if (!is_null($id) ) {
            if ( !$this->exists($id) ) {
                throw new NotFoundException("El arqueo no existe");
                return false;
            }
            return true;
        }
    }


    /**
     * 
     * Me devuelve la fecha desde hasta de un arqueo dado
     * 
     * Busca en el arqueo anterior para determinar la fecha "desde"
     * 
     * @param integer $id del arqueo
     * @return array 
     *                  datetime $fecha['desde']
     *                  datetime $fecha['hasta'] si existe un arqueo anterior
     **/
    public function getFechaDesdeHasta ($id) {
        if ( !is_null($id) ) {
            $arqueo = $this->read(null, $id);
            $fechaCreacion = $arqueo['Arqueo']['datetime'];
        } else {
            $fechaCreacion = Cache::read("fecha_arqueo_creacion");
        }
        
        $arqueoAnterior = $this->find('first', array(
            'conditions' => array(
                'Arqueo.datetime <' => $fechaCreacion
                ),
            'order' => array("Arqueo.datetime" => 'DESC')
            ));

        $fecha = array(
            'hasta' => $fechaCreacion
            );

        if ( $arqueoAnterior ) {
            $fecha['desde'] = $arqueoAnterior['Arqueo']['datetime'];
        }

        return $fecha;

    }

  
}
