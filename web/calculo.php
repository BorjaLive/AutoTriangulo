<?php
	echo "<h1>Resultados</h1>";
	
	//recoger datos----------------------------------------------------------
	
	$anguloA = $_POST['anguloA'];
	$anguloB = $_POST['anguloB'];
	$anguloC = $_POST['anguloC'];
	$ladoA = $_POST['ladoA'];
	$ladoB = $_POST['ladoB'];
	$ladoC = $_POST['ladoC'];
	
	//Reyenar----------------------------------------------------------
	
	if(empty($anguloA)){
		$anguloA=0;
	}
	if(empty($anguloB)){
		$anguloB=0;
	}
	if(empty($anguloC)){
		$anguloC=0;
	}
	if(empty($ladoA)){
		$ladoA=0;
	}
	if(empty($ladoB)){
		$ladoB=0;
	}
	if(empty($ladoC)){
		$ladoC=0;
	}

	//Resolución--------------------------------------------------------------
	
	resolver();
	
	function resolver(){
		if(numeroAngulos() == 2){
            tercerAngulo();
        }
        if(solucionado()){
            comprobar();
        }else{
            //intentar teorema del seno   
            intentarSenos();
            if(solucionado()){
                comprobar();
            }else{
                if(numeroAngulos() == 2){
                    tercerAngulo();
                }
                intentarCosenos();
                if(solucionado()){
                    comprobar();
                }else{
                    if(numeroAngulos() == 2){
                        tercerAngulo();
                    }
                    intentarSenos();
                    if(solucionado()){
                        comprobar();
                    }else{
                        //imposible resolver
                        echo "irresoluble";
                    }
                }
            }
        }
	}
	
	function numeroLados(){
		
		global $ladoA;
		global $ladoB;
		global $ladoC;
		
        $numero = 0;
        if($ladoA != 0){
       		$numero++;
       	}
		if($ladoB != 0){
       		$numero++;
       	}
		if($ladoC != 0){
       		$numero++;
       	}
        return $numero;
    }
    
    function numeroAngulos(){
    	
		global $anguloA;
		global $anguloB;
		global $anguloC;
		
        $numero = 0;
        if($anguloA != 0){
       		$numero++;
       	}
		if($anguloB != 0){
       		$numero++;
       	}
		if($anguloC != 0){
       		$numero++;
       	}
        return $numero;
    }
	
	function solucionado(){
		if(numeroLados() == 3 && numeroAngulos() == 3){
			return true;
		}else{
			return false;
		}
	}
	
	function intentarCosenos(){
		
		global $anguloA;
		global $anguloB;
		global $anguloC;
		global $ladoA;
		global $ladoB;
		global $ladoC;
		
		if(numeroLados() == 3){
            if($anguloA == 0){
                $anguloA = teoremaCoseno($ladoA,$ladoB,$ladoC,$anguloA,4);
            }
            if($anguloB == 0){
                $anguloB = teoremaCoseno($ladoA,$ladoB,$ladoC,$anguloB,5);
            }
            if($anguloC == 0){
                $anguloC = teoremaCoseno($ladoA,$ladoB,$ladoC,$anguloC,6);
            }
        }else{
            if($ladoA ==0 && $anguloA != 0){
                $ladoA = teoremaCoseno($ladoA,$ladoB,$ladoC,$anguloA,1);
            }
            if($ladoB==0 && $anguloB != 0){
                $ladoB = teoremaCoseno($ladoA,$ladoB,$ladoC,$anguloB,2);
            }
            if($ladoC ==0 && $anguloC != 0){
                $ladoC = teoremaCoseno($ladoA,$ladoB,$ladoC,$anguloC,3);
            }
        }
	}
	
	
	function intentarSenos(){
		
		global $anguloA;
		global $anguloB;
		global $anguloC;
		global $ladoA;
		global $ladoB;
		global $ladoC;
		
		if(numeroAngulos() != 3){   //intentar sacar un angulo
            if($anguloA == 0 && $ladoA != 0){ // aungulo de A
                if($anguloB != 0 && $ladoB != 0){
                    $anguloA = teoremaSeno($ladoB,$anguloB,$ladoA,$anguloA,4);
                }else{
                    if($anguloC != 0 && $ladoC != 0){
                        $anguloA = teoremaSeno($ladoC,$anguloC,$ladoA,$anguloA,4);
                    }
                }
            }
            if($anguloB == 0 && $ladoB != 0){ //angulo de B
                if($anguloC != 0 && $ladoC != 0){
                    $anguloB = teoremaSeno($ladoC,$anguloC,$ladoB,$anguloB,4);
                }else{
                    if($anguloA != 0 && $ladoA != 0){
                        $anguloB = teoremaSeno($ladoA,$anguloA,$ladoB,$anguloB,4);
                    }
                }
            }
            if($anguloC == 0 && $ladoC != 0){ //angulo de C
                if($anguloB != 0 && $ladoB != 0){
                    $anguloC = teoremaSeno($ladoB,$anguloB,$ladoC,$anguloC,4);
                }else{
                    if($anguloA != 0 && $ladoA != 0){
                        $anguloC = teoremaSeno($ladoA,$anguloA,$ladoC,$anguloC,4);
                    }
                }
            } 
        }
        if(numeroLados() != 3){ // si desconocemos algun lado
            if($ladoA == 0 && $anguloA != 0){ // lado a
                if($anguloB != 0 && $ladoB != 0){
                    $ladoA = teoremaSeno($ladoB,$anguloB,$ladoA,$anguloA,3);
                }else{
                    if($anguloC != 0 && $ladoC != 0){
                        $ladoA = teoremaSeno($ladoC,$anguloC,$ladoA,$anguloA,3);
                    }
                }
            }
            if($ladoB == 0 && $anguloB != 0){ // lado b
                if($anguloA != 0 && $ladoA != 0){
                    $ladoB = teoremaSeno($ladoA,$anguloA,$ladoB,$anguloB,3);
                }else{
                    if($anguloC != 0 && $ladoC != 0){
                        $ladoB = teoremaSeno($ladoC,$anguloC,$ladoB,$anguloB,3);
                    }
                }
            }
            if($ladoC == 0 && $anguloC != 0){ // lado c
                if($anguloB != 0 && $ladoB != 0){
                    $ladoC = teoremaSeno($ladoB,$anguloB,$ladoC,$anguloC,3);
                }else{
                    if($anguloA != 0 && $ladoA != 0){
                        $ladoC = teoremaSeno($ladoA,$anguloA,$ladoC,$anguloC,3);
                    }
                }
            }
        }
	}
	
	function teoremaSeno($x,$X,$y,$Y,$incognita){
        switch($incognita){
            case 3:
                $resultado = ($x*sen($Y))/sen($X);
                break;
            case 4:
                $resultado = asen($y/($x/sen($X)));
                break;
            default:
                $resultado = 0;
                break;
        }
        return $resultado;
	}
	
	function teoremaCoseno($x,$y,$z,$X,$incognita){
		switch($incognita){
            case 1:
                $resultado = sqrt((pow($y, 2)+pow($z, 2))-(2*$y*$z*coos($X)));
                break;
            case 2:
                $resultado = sqrt((pow($x, 2)+pow($z, 2))-(2*$x*$z*coos($X)));
                break;
            case 3:
                $resultado = sqrt((pow($x, 2)+pow($y, 2))-(2*$x*$y*coos($X)));
                break;
            case 4:
                $resultado = acoos((pow($y, 2)+pow($z, 2)-pow($x, 2))/(2*$y*$z));
                break;
            case 5:
                $resultado = acoos((pow($x, 2)+pow($z, 2)-pow($y, 2))/(2*$x*$z));
                break;
            case 6:
                $resultado = acoos((pow($x, 2)+pow($y, 2)-pow($z, 2))/(2*$x*$y));
                break;
            default:
                $resultado = 0;
                break;
        }
        return $resultado;
	}
	
	function tercerAngulo(){
		
		global $anguloA;
		global $anguloB;
		global $anguloC;
		
		if($anguloA == 0){
            $anguloA = 180-($anguloB+$anguloC);
        }else{
            if($anguloB == 0){
                $anguloB = 180-($anguloA+$anguloC);
            }else{
                if($anguloC == 0){
                    $anguloC = 180-($anguloA+$anguloB);
                }
            }
        }
	}
	
	function comprobar(){
		
		global $anguloA;
		global $anguloB;
		global $anguloC;
		
		if(probarAngulos($anguloA,$anguloB,$anguloC)){
            terminar();
        }else{
            //probar las 12 conbinaorias
            if(probarAngulos(otroAnguloSeno($anguloA),$anguloB,$anguloC)){
                $anguloA = otroAnguloSeno($anguloA);
                terminar();
            }else{
                if(probarAngulos($anguloA,otroAnguloSeno($anguloB),$anguloC)){
                    $anguloB = otroAnguloSeno($anguloB);
                    terminar();
                }else{
                    if(probarAngulos($anguloA,$anguloB,otroAnguloSeno($anguloC))){
                        $anguloC = otroAnguloSeno($anguloC);
                        terminar();
                    }else{
                        if(probarAngulos(otroAnguloSeno($anguloA),otroAnguloSeno($anguloB),$anguloC)){
                            $anguloA = otroAnguloSeno($anguloA);
                            $anguloB = otroAnguloSeno($anguloB);
                            terminar();
                        }else{
                            if(probarAngulos(otroAnguloSeno($anguloA),$anguloB,otroAnguloSeno($anguloC))){
                                $anguloA = otroAnguloSeno($anguloA);
                                $anguloC = otroAnguloSeno($anguloC);
                                terminar();
                            }else{
                                if(probarAngulos($anguloA,otroAnguloSeno($anguloB),otroAnguloSeno($anguloC))){
                                    $anguloB = otroAnguloSeno($anguloB);
                                    $anguloC = otroAnguloSeno($anguloC);
                                    terminar();
                                }else{
                                    if(probarAngulos(otroAnguloCoseno($anguloA),$anguloB,$anguloC)){
                                        $anguloA = otroAnguloCoseno($anguloA);
                                        terminar();
                                    }else{
                                        if(probarAngulos($anguloA,otroAnguloCoseno($anguloB),$anguloC)){
                                            $anguloB = otroAnguloCoseno($anguloB);
                                            terminar();
                                        }else{
                                            if(probarAngulos($anguloA,$anguloB,otroAnguloCoseno($anguloC))){
                                                $anguloC = otroAnguloCoseno($anguloC);
                                                terminar();
                                            }else{
                                                if(probarAngulos(otroAnguloCoseno($anguloA),otroAnguloCoseno($anguloB),$anguloC)){
                                                    $anguloA = otroAnguloCoseno($anguloA);
                                                    $anguloB = otroAnguloCoseno($anguloB);
                                                    terminar();
                                                }else{
                                                    if(probarAngulos(otroAnguloCoseno($anguloA),$anguloB,otroAnguloCoseno($anguloC))){
                                                        $anguloA = otroAnguloCoseno($anguloA);
                                                        $anguloC = otroAnguloCoseno($anguloC);
                                                        terminar();
                                                    }else{
                                                        if(probarAngulos($anguloA,otroAnguloCoseno($anguloB),otroAnguloCoseno($anguloC))){
                                                            $anguloB = otroAnguloCoseno($anguloB);
                                                            $anguloC = otroAnguloCoseno($anguloC);
                                                            terminar();
                                                        }else{
                                                            if(probarAngulos(otroAnguloTangente($anguloA),$anguloB,$anguloC)){
                                                                $anguloA = otroAnguloTangente($anguloA);
                                                                terminar();
                                                            }else{
                                                                if(probarAngulos($anguloA,otroAnguloTangente($anguloB),$anguloC)){
                                                                    $anguloB = otroAnguloTangente($anguloB);
                                                                    terminar();
                                                                }else{
                                                                    if(probarAngulos($anguloA,$anguloB,otroAnguloTangente($anguloC))){
                                                                        $anguloC = otroAnguloTangente($anguloC);
                                                                        terminar();
                                                                    }else{
                                                                        if(probarAngulos(otroAnguloTangente($anguloA),otroAnguloTangente($anguloB),$anguloC)){
                                                                            $anguloA = otroAnguloTangente($anguloA);
                                                                            $anguloB = otroAnguloTangente($anguloB);
                                                                            terminar();
                                                                        }else{
                                                                            if(probarAngulos(otroAnguloTangente($anguloA),$anguloB,otroAnguloTangente($anguloC))){
                                                                                $anguloA = otroAnguloTangente($anguloA);
                                                                                $anguloC = otroAnguloTangente($anguloC);
                                                                                terminar();
                                                                            }else{
                                                                                if(probarAngulos($anguloA,otroAnguloTangente($anguloB),otroAnguloTangente($anguloC))){
                                                                                    $anguloB = otroAnguloTangente($anguloB);
                                                                                    $anguloC = otroAnguloTangente($anguloC);
                                                                                    terminar();
                                                                                }else{
                                                                                    if(probarAngulos(otroAnguloTangente($anguloA),otroAnguloTangente($anguloB),otroAnguloTangente($anguloC))){
                                                                                        $anguloA = otroAnguloTangente($anguloA);
                                                                                        $anguloB = otroAnguloTangente($anguloB);
                                                                                        $anguloC = otroAnguloTangente($anguloC);
                                                                                        terminar();
                                                                                    }else{
                                                                                        if(probarAngulos(otroAnguloSeno($anguloA),otroAnguloSeno($anguloB),otroAnguloSeno($anguloC))){
                                                                                            $anguloA = otroAnguloSeno($anguloA);
                                                                                            $anguloB = otroAnguloSeno($anguloB);
                                                                                            $anguloC = otroAnguloSeno($anguloC);
                                                                                            terminar();
                                                                                        }else{
                                                                                            if(probarAngulos(otroAnguloCoseno($anguloA),otroAnguloCoseno($anguloB),otroAnguloCoseno($anguloC))){
                                                                                                $anguloA = otroAnguloCoseno($anguloA);
                                                                                                $anguloB = otroAnguloCoseno($anguloB);
                                                                                                $anguloC = otroAnguloCoseno($anguloC);
                                                                                                terminar();
                                                                                            }else{
                                                                                                echo "Triangulo imposible.";
																								terminar();
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
	}
	
	function otroAnguloSeno($angulo){
        return arreglar(180-$angulo);
    }
    
    function otroAnguloCoseno($angulo){
        return arreglar(360-$angulo);
    }
    
    function otroAnguloTangente($angulo){
        return arreglar($angulo+180);
    }
    
    function arreglar($angulo){
        if($angulo > 360){
            return $angulo-360;
        }else{
            if($angulo < 0){
                return 360-$angulo;
            }else{
                return $angulo;
            }
        }
    }
    
    function probarAngulos($angulo1, $angulo2, $angulo3){
        if($angulo1+$angulo2+$angulo3 < 181 && $angulo1+$angulo2+$angulo3 > 179){
            return true;
        }else{
            return false;
        }
    }
    
    function terminar(){
    	
		global $anguloA;
		global $anguloB;
		global $anguloC;
		global $ladoA;
		global $ladoB;
		global $ladoC;
		
        echo "<br>--Estos son los datos resueltos--<br> Lados: a= " .$ladoA ."  b= " .$ladoB ."  c= " .$ladoC ."<br>Angulos: α= " .$anguloA ."  β= " .$anguloB ."  γ= " .$anguloC ."<br>" ;
        //fin
    }
    
   	function sen($angulo){
        return sin($angulo*(M_PI/180));
    }
    
    function coos($angulo){
        return cos($angulo*(M_PI/180));
    }
    
    function tg ($angulo){
        return tan($angulo*(M_PI/180));
    }
    
    function asen($angulo){
        return asin($angulo)/(M_PI/180);
    }
    
    function acoos($angulo){
        return acos($angulo)/(M_PI/180);
    }
    
    function abss($value){
        if($value < 0){
            return $value*-1;
        }else{
            return $value;
        }
    }
    
    function mostrar(){
    	
		global $anguloA;
		global $anguloB;
		global $anguloC;
		global $ladoA;
		global $ladoB;
		global $ladoC;
		
        echo "<br>--Estos son los datos que tenemos--<br> Lados: a=" .$ladoA ."  b= " .$ladoB ."  c= " .$ladoC ."<br>Angulos: α= " .$anguloA ."  β= " .$anguloB ."  γ= " .$anguloC ."<br>" ;
        menu();
    }
	
?>