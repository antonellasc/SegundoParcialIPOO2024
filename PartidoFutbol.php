<?php

class PartidoFutbol extends Partido{

    // Constructor 
    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
        parent :: __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
    }

    

    // to String
    public function __toString(){
        return parent :: __toString() . "\n";
    }

    //
    public function coeficientePartido(){
        $coeficiente = parent :: coeficientePartido();
        $objEquipo1 = $this->getObjEquipo1();
        $objEquipo2 = $this->getObjEquipo2();
        $categoriaE1 = $objEquipo1->getObjCategoria();
        $categoriaE2 = $objEquipo2->getObjCategoria();
        if(($categoriaE1->getDescripcion() && $categoriaE2->getDescripcion()) === "Coef_Menores"){
            $coeficiente = $coeficiente * 0.13;
        }elseif(($categoriaE1->getDescripcion() && $categoriaE2->getDescripcion()) === "Coef_Juveniles"){
            $coeficiente = $coeficiente * 0.19;
        }elseif(($categoriaE1->getDescripcion() && $categoriaE2->getDescripcion()) === "Coef_Mayores"){
            $coeficiente = $coeficiente * 0.27;
        }
        return $coeficiente;
    }
}