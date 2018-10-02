package triangulos;

import java.util.Scanner;

public class Triangulos {
    
    static Scanner scaner = new Scanner(System.in);
    
    //variables
    static double[] lado = new double[3];      //0=a,1=b,2=c
    static double[] angulo = new double[3];    //0=α,1=β,2=γ

    public static void main(String[] args) {
        
        for (int i = 0; i < 3; i++) {
            lado[i] = 0;
            angulo[i] = 0;
        }
        
        System.out.println("---------------Resolutor de triangulos---------------\n");
        menu();
        
    }
    
    
    private static int numeroLados(){
        int numero = 0;
        for (int i = 0; i < 3; i++) {
            if(lado[i] != 0){
                numero++;
            }
        }
        return numero;
    }
    
    private static int numeroAngulos(){
        int numero = 0;
        for (int i = 0; i < 3; i++) {
            if(angulo[i] != 0){
                numero++;
            }
        }
        return numero;
    }
    
    private static void menu(){
        System.out.print("--Menú--\n"
                + "1) Definir un lado o angulo.\n"
                + "2) Mostrar todo datos introducidos.\n"
                + "3) Intentar resolver.\n\n"
                + "Introduce tu acción: ");
        
        switch(scaner.nextInt()){
            case 1:
                definir();
                break;
            case 2:
                mostrar();
                break;
            case 3:
                resolver();
                break;
            default:
                menu();
                break;
        }
    }
    
    private static void definir(){
        System.out.print("--¿Que lado/angulo quieres definir?--\n"
                + "A = angulo α  B = angulo β  C = angulo γ   a = lado a  b = lado b  c = lado c: ");
        switch(scaner.next()){
            case "a":
                System.out.print("Introduce el lado a: ");
                lado[0] = scaner.nextDouble();
                menu();
                    break;
            case "b":
                System.out.print("Introduce el lado b: ");
                lado[1] = scaner.nextDouble();
                menu();
                    break;
            case "c":
                System.out.print("Introduce el lado c: ");
                lado[2] = scaner.nextDouble();
                menu();
                    break;
            case "A":
                System.out.print("Introduce el angulo α: ");
                angulo[0] = scaner.nextDouble();
                menu();
                    break;
            case "B":
                System.out.print("Introduce el angulo β: ");
                angulo[1] = scaner.nextDouble();
                menu();
                    break;
            case "C":
                System.out.print("Introduce el angulo γ: ");
                angulo[2] = scaner.nextDouble();
                menu();
                    break;
            default:
                definir();
                        break;
            
        }
    }
    
    private static void resolver(){
        
        //si tenemos 2 angulos, sacamos el tercero
        if(numeroAngulos() == 2){
            tercerAngulo();
        }
        if(solucionado()){
            //final
            mostrar();
        }else{
            //intentar teorema del seno   
            intentarTodosSenos();
            if(solucionado()){
                //final
                mostrar();
            }else{
                System.out.println("intentar todos los cosenos");
                intentarTodosCosenos();
                if(solucionado()){
                    //final
                    mostrar();
                }else{
                    intentarTodosSenos();
                    if(solucionado()){
                        //final
                        mostrar();
                    }else{
                        //imposible resolver
                        System.out.println("irresoluble");
                    }
                }
            }
        }
    }
    
    private static boolean solucionado(){
        if(numeroLados() == 3 && numeroAngulos() == 3){
                return true;
            }
            return false;
    }
    
    private static void intentarTodosCosenos(){
        
        if(numeroLados() == 3){
            if(angulo[0] == 0){
                lado[0] = teoremaCoseno(lado[0],lado[1],lado[2],angulo[0],4);
            }
            if(angulo[1] == 0){
                lado[1] = teoremaCoseno(lado[0],lado[1],lado[2],angulo[1],4);
            }
            if(angulo[2] == 0){
                lado[2] = teoremaCoseno(lado[0],lado[1],lado[2],angulo[2],4);
            }
        }else{
            if(lado[0]==0 && angulo[0] != 0){
                lado[0] = teoremaCoseno(lado[0],lado[1],lado[2],angulo[0],1);
            }
            if(lado[1]==0 && angulo[1] != 0){
                lado[1] = teoremaCoseno(lado[0],lado[1],lado[2],angulo[1],2);
            }
            if(lado[2]==0 && angulo[2] != 0){
                lado[2] = teoremaCoseno(lado[0],lado[1],lado[2],angulo[2],3);
            }
        }
    }
    
    private static void intentarTodosSenos(){
        if(numeroAngulos() != 3){   //intentar sacar un angulo
            if(angulo[0] == 0 && lado[0] != 0){ // aungulo de A
                if(angulo[1] != 0 && lado[1] != 0){
                    angulo[0] = teoremaSeno(lado[1],angulo[1],lado[0],angulo[0],4);
                }else{
                    if(angulo[2] != 0 && lado[2] != 0){
                        angulo[0] = teoremaSeno(lado[2],angulo[2],lado[0],angulo[0],4);
                    }
                }
            }
            if(angulo[1] == 0 && lado[1] != 0){ //angulo de B
                if(angulo[2] != 0 && lado[2] != 0){
                    angulo[1] = teoremaSeno(lado[2],angulo[2],lado[1],angulo[1],4);
                }else{
                    if(angulo[0] != 0 && lado[0] != 0){
                        angulo[1] = teoremaSeno(lado[0],angulo[0],lado[1],angulo[1],4);
                    }
                }
            }
            if(angulo[2] == 0 && lado[2] != 0){ //angulo de C
                if(angulo[1] != 0 && lado[1] != 0){
                    angulo[2] = teoremaSeno(lado[1],angulo[1],lado[2],angulo[2],4);
                }else{
                    if(angulo[0] != 0 && lado[0] != 0){
                        angulo[2] = teoremaSeno(lado[0],angulo[0],lado[2],angulo[2],4);
                    }
                }
            } 
        }
        if(numeroLados() != 3){ // si desconocemos algun lado
            if(lado[0] == 0 && angulo[0] != 0){ // lado a
                if(angulo[1] != 0 && lado[1] != 0){
                    lado[0] = teoremaSeno(lado[1],angulo[1],lado[0],angulo[0],3);
                }else{
                    if(angulo[2] != 0 && lado[2] != 0){
                        lado[0] = teoremaSeno(lado[2],angulo[2],lado[0],angulo[0],3);
                    }
                }
            }
            if(lado[1] == 0 && angulo[1] != 0){ // lado b
                if(angulo[0] != 0 && lado[0] != 0){
                    lado[1] = teoremaSeno(lado[0],angulo[0],lado[1],angulo[1],3);
                }else{
                    if(angulo[2] != 0 && lado[2] != 0){
                        lado[1] = teoremaSeno(lado[2],angulo[2],lado[1],angulo[1],3);
                    }
                }
            }
            if(lado[2] == 0 && angulo[2] != 0){ // lado c
                if(angulo[1] != 0 && lado[1] != 0){
                    lado[2] = teoremaSeno(lado[1],angulo[1],lado[2],angulo[2],3);
                }else{
                    if(angulo[0] != 0 && lado[0] != 0){
                        lado[2] = teoremaSeno(lado[0],angulo[0],lado[2],angulo[2],3);
                    }
                }
            }
            
            
        }
    }
    
    private static double teoremaSeno(double x,double X,double y, double Y, int incognita){
        double resultado;
        switch(incognita){
            case 3:
                resultado = (x*sen(Y))/sen(X);
                break;
            case 4:
                System.out.println("x="+Double.toString(x)+"  X="+Double.toString(X)+"  y="+Double.toString(y)+"  Y="+Double.toString(Y));
                resultado = asen(y/(x/sen(X)));
                break;
            default:
                resultado = 0;
                break;
        }
        return resultado;
    }
    
    private static double teoremaCoseno(double x,double y,double z, double X, int incognita){
        double resultado;
        switch(incognita){
            case 1:
                System.out.println("coseno1");
                resultado = Math.sqrt((Math.pow(y, 2)+Math.pow(z, 2))-(2*y*z*cos(X)));
                break;
            case 2:
                resultado = Math.sqrt((Math.pow(x, 2)+Math.pow(z, 2))-(2*x*z*cos(X)));
                break;
            case 3:
                resultado = Math.sqrt((Math.pow(x, 2)+Math.pow(y, 2))-(2*x*y*cos(X)));
                break;
            case 4:
                resultado = acos((Math.pow(y, 2)+Math.pow(z, 2)-Math.pow(x, 2))/(2*y*z));
                break;
            case 5:
                resultado = acos((Math.pow(x, 2)+Math.pow(z, 2)-Math.pow(y, 2))/(2*x*z));
                break;
            case 6:
                resultado = acos((Math.pow(x, 2)+Math.pow(y, 2)-Math.pow(z, 2))/(2*x*y));
                break;
            default:
                resultado = 0;
                break;
        }
        return resultado;
    }
    
    private static void tercerAngulo(){
        if(angulo[0] == 0){
            angulo[0] = 180-(angulo[1]+angulo[2]);
        }else{
            if(angulo[1] == 0){
                angulo[1] = 180-(angulo[0]+angulo[2]);
            }else{
                if(angulo[2] == 0){
                    angulo[2] = 180-(angulo[0]+angulo[1]);
                }
            }
        }
    }
    
    private static double sen(double angulo){
        return Math.sin(angulo*(Math.PI/180));
    }
    
    private static double cos(double angulo){
        return Math.cos(angulo*(Math.PI/180));
    }
    
    private static double asen(double angulo){
        return Math.asin(angulo)/(Math.PI/180);
    }
    
    private static double acos(double angulo){
        return Math.acos(angulo)/(Math.PI/180);
    }
    
    private static void mostrar(){
        System.out.println("\n--Estos son los datos que tenemos--\n Lados: a="+lado[0]+"  b="+lado[1]+"  c="+lado[2] + "\nAngulos: α="+angulo[0]+"  β="+angulo[1]+"  γ="+angulo[2]+"\n\n");
        menu();
    }
    
}
