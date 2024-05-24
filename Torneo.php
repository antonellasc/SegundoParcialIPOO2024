<?php

class Torneo{
    private $colPartido;
    private $importePremio;

    // Constructor clase torneo
    public function __construct($coleccionPartido, $importeXPremio){
        $this->colPartido = $coleccionPartido;
        $this->importePremio = $importeXPremio;
    }

    // Método de acceso : GET
    public function getColPartido(){
        return $this->colPartido;
    }

    public function getImportePremio(){
        return $this->importePremio;
    }

    // SET de la clase torneo
    public function setColPartido($coleccionPartido){
        $this->colPartido = $coleccionPartido;
    }

    public function setImportePremio($importeXPremio){
        $this->importePremio = $importeXPremio;
    }

    // __toString clase Torneo
    public function __toString(){
        return "Partidos del torneo: \n" . $this->mostrarPartidos() . "\n" . 
        "Valor del premio: $" . $this->getImportePremio() . "\n";

    }


    // Otros métodos
    public function mostrarPartidos(){
        // Método para mostrar la colección de partidos
        $colPartidos = $this->getColPartido();
        $partidoNro = 0;
        $unaCadenaPartidos = "";
        for($i = 0; $i < count($colPartidos); $i++){
            $partidoNro++;
            $unPartido = $colPartidos[$i];
            $unaCadenaPartidos = $unaCadenaPartidos . "Partido " . $partidoNro . ": \n" . $unPartido . "\n";
        }
        return $unaCadenaPartidos;

    }

    public function verificarIgualCategoria($OBJEquipo1, $OBJEquipo2){
        $verifica = false;
        if($OBJEquipo1->getObjCategoria() === $OBJEquipo2->getObjCategoria()){
            $verifica = true;
        }
        return $verifica;
    }

    public function verificarIgualCantJugadores($OBJEquipo1, $OBJEquipo2){
        $verificaJug = false;
        if($OBJEquipo1->getCantJugadores() === $OBJEquipo2->getCantJugadores()){
            $verificaJug = true;
        }
        return $verificaJug;
    }

    // 4. Implementar el método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) en la  clase Torneo el cual 
    // recibe por parámetro 2 equipos, la fecha en la que se realizará el partido y si se trata de un partido de futbol 
    // o basquetbol . El método debe -crear y retornar la instancia de la clase Partido que corresponda- y -almacenarla 
    // en la colección de partidos del Torneo-. Se debe chequear que los --2 equipos tengan la misma categoría-- e --igual 
    //cantidad de jugadores--, caso contrario no podrá ser registrado ese partido en el torneo. 
    public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido){
        $idPartido = count($this->getColPartido()) + 1;
        $coleccionPartidos = $this->getColPartido();
        $verificaCategoria = $this->verificarIgualCategoria($OBJEquipo1, $OBJEquipo2);
        $verificaCantJugadores = $this->verificarIgualCantJugadores($OBJEquipo1, $OBJEquipo2);
        $objPartido = null;
        if($verificaCategoria && $verificaCantJugadores && ($OBJEquipo1 !== $OBJEquipo2)){
            if($tipoPartido == strtolower("futbol")){
                $objPartido = new PartidoFutbol($idPartido, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0);
            }else{
                $objPartido = new PartidoBasquet($idPartido, $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0, 0);
            }
        }
        if($objPartido !== null){
            $coleccionPartidos[] = $objPartido;
            $this->setColPartido($coleccionPartidos);
        }
        return $objPartido;
        
    }

    // 6. Implementar el método darGanadores($deporte) en la clase Torneo que recibe por parámetro 
    //si se trata de un partido de fútbol o de básquetbol y en  base  al parámetro busca entre esos 
    //partidos los equipos ganadores ( equipo con mayor cantidad de goles). El método retorna una colección
    // con los objetos de los equipos encontrados.
    public function darGanadores($deporte){
        $colPartidos = $this->getColPartido();
        $colObjEquipoGanador = [];
        for($i=0 ; $i < count($colPartidos) ; $i++){
            $unPartido = $colPartidos[$i];
            if($unPartido instanceof PartidoFutbol && $deporte == strtolower("futbol")){
                $equipoGanador = $unPartido->darEquipoGanador();
                $colObjEquipoGanador[] = $equipoGanador;
            }elseif($unPartido instanceof PartidoBasquet == strtolower("basquet")){
                $equipoGanador = $unPartido->darEquipoGanador();
                $colObjEquipoGanador[] = $equipoGanador;
            }

            return $colObjEquipoGanador;

    }
}

    // Implementar el método calcularPremioPartido($OBJPartido) que debe retornar un arreglo 
    // asociativo donde una de sus claves es ‘equipoGanador’  y contiene la referencia al equipo ganador; 
    //y la otra clave es ‘premioPartido’ que contiene el valor obtenido del coeficiente del Partido por el 
    // importe configurado para el torneo. (premioPartido = Coef_partido * ImportePremio)
    public function calcularPremioPartido($OBJPartido){
        $premioDelPartido = ['equipoGanador' => null, 'premioPartido' => 0];
        if($OBJPartido !== null){
        $ganador = $OBJPartido->darEquipoGanador();
        $premio = $OBJPartido->coeficientePartido() * $this->getImportePremio();
        $premioDelPartido['equipoGanador'] = $ganador;
        $premioDelPartido['premioPartido'] = $premio;
        }
        

        return $premioDelPartido;
    }


}