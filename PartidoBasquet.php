<?php

class PartidoBasquet extends Partido{
    private $cantInfracciones;

    // Constructor
    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $cantInfracciones){
        parent :: __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->cantInfracciones = $cantInfracciones;
    }

    // GET
    public function getCantInfracciones(){
        return $this->cantInfracciones;
    }

    // SET
    public function setCantInfracciones($cantInfracciones){
        $this->cantInfracciones = $cantInfracciones;
    }

    // to String
    public function __toString(){
        return parent :: __toString() . "\n" . 
        "Cant. de infracciones: " . $this->getCantInfracciones() . "\n";
    }

    // 
    public function coeficientePartido(){
        $coeficiente = parent :: coeficientePartido();
        $objEquipo1 = $this->getObjEquipo1();
        $objEquipo2 = $this->getObjEquipo2();
        $cantInfraccionesE1 = $objEquipo1->getCantInfracciones();
        $cantInfraccionesE2 = $objEquipo2->getCantInfracciones();
        $coef_penalizacion = 0.75;
        $coeficiente = $coeficiente - ($coef_penalizacion * ($cantInfraccionesE1 + $cantInfraccionesE2));
        return $coeficiente;
    }
}