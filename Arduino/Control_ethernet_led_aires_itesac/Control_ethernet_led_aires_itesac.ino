  
  #include <SPI.h>
  #include <Ethernet.h>
  
  // MAC address del Ethernet shield calcamonia  que esta debajo de la board
  byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
  IPAddress ip(192, 168, 1, 5); // IP address, se modifica dependiendo de la red 
  // Direccion de puerta de enlace: 
  byte gateway[] = { 192, 168, 1, 254 };
  // La subred: 
  byte subnet[] = { 255, 255, 255, 0 }; 
   
  EthernetServer server(80);  // creacion del sevidor en el puerto 80
  
  String HTTP_req;          // Almacena la peticion (HTTP request)
  boolean LED_status = 0;   // Predetermina el estado del led a Apagado
  int Pin;
  int numero;
  int timer = 1000;
  int pinCount;
  int Planta[4];
  String respuesta;
  const int led1 = 2;
const int led2 = 3;
const int led3 = 4;
const int led4 = 5;
// Some stuff for responding to the request
char* on = "ON";
char* off = "OFF";
char* statusLabel;
char* buttonLabel;
EthernetClient client;
  void setup()
  {
      //Ethernet.begin(mac, ip);  // inicializa el dispositivo Ethernet
      //Inicializacion con puerta de enlace y subred
      Ethernet.begin(mac, ip, gateway, subnet); 
      server.begin();           // listo para la recepcion de clientes
      Serial.begin(9600);       // Inicializa el puerto serial para diagnostico
      pinMode(2, OUTPUT);       // Salida del LED en pin 2 
      pinMode(3, OUTPUT);
      pinMode(4, OUTPUT);
      pinMode(5, OUTPUT);
      delay(1000);
  }
  
  void loop()
  {
    client = server.available();  // intenta obtener cliente
  
      if (client) {  // se conecto un cliente?
          boolean currentLineIsBlank = true;
          while (client.connected()) {
            Serial.println("connected cliente");
              if (client.available()) {   // si cliente puede leer datos
                  char c = client.read(); // leer 1 byte (caracter) del cliente
                  HTTP_req += c;  // Guarda la peticion HTTP caracter por caracter
                  // La ultima linea de la peticion del cliente es nula y 
                  // termina con \n, responde solo despues de recibir una linea
                  if (c == '\n' && currentLineIsBlank) {
                    String var = HTTP_req;
                      // Envia un standard http response header
                      /*client.println("HTTP/1.1 200 OK");
                      client.println("Content-Type: text/html");
                      client.println("Connection: close");
                      client.println();
                      // Envia la pagina web
                      client.println("<!DOCTYPE html>");
                      client.println("<html>");
                      client.println("<head>");
                      client.println("<title>Arduino LED Control</title>");
                      client.println("</head>");
                      client.println("<body>");*/
                      accion(client);
                      /*client.println("</body>");
                      client.println("</html>");
                      Serial.print(HTTP_req);*/
                      HTTP_req = "";    // Finaliza la peticion, borrandola
                      break;
                  }
                  // Toda linea del texto recibido desde el cliente termina con \r\n                
                  if (c == '\n') {
                      // es el ultimo caracter de la linea recibido
                      // Inicia la nueva linea con la lectura del nuevo caracter
                      currentLineIsBlank = true;
                  } 
                  else if (c != '\r') {
                      // un caracter de texto ha sido recibido del cliente
                      currentLineIsBlank = false;
                  }
              } // end if (client.available())
              
          } // end while (client.connected())
          delay(1);      // retraso para poder que el navegador reciba los datos.        
          client.stop(); // Cierra la conexion 
      } // end if (client)
  }
  
  
  void accion(EthernetClient cl)
  {
    //cl.println(HTTP_req); Muestra la cabecera
      if (HTTP_req.indexOf("pass=do") > -1) {  // observa si da la password
          // contraseña correcta, evalua
          
          if (HTTP_req.indexOf("check") > -1) {  
          // check
          check(getpin(),cl);
          }
        else  if (HTTP_req.indexOf("turnon") > -1) {  
          // contraseña correcta, evalua
          turnon(getpin(),cl);
          }
        else  if (HTTP_req.indexOf("turnoff") > -1) {  
          // contraseña correcta, evalua
          turnoff(getpin(),cl);
          }
      }
  }
 
 int getpin (){
   if (HTTP_req.indexOf("LED13") > -1) {
         return 13;
      }
     else if (HTTP_req.indexOf("LED2") > -1) {
         return 2;
      }
      else if (HTTP_req.indexOf("LED3") > -1) {
         return 3;
      }
      else if (HTTP_req.indexOf("LED4") > -1) {
         return 4;
      }
      else if (HTTP_req.indexOf("LED5") > -1) {
         return 5;
      }
      else if (HTTP_req.indexOf("LED6") > -1) {
          return 6;
      }
      else if (HTTP_req.indexOf("LED7") > -1) {
          return 7;
      }
      else if (HTTP_req.indexOf("LED8") > -1) {
          return 8;
      }
      else if (HTTP_req.indexOf("LED9") > -1) {
          return 9;
      }
      else if (HTTP_req.indexOf("LED10") > -1) {
          return 10;
      }
      else if (HTTP_req.indexOf("LED11") > -1) {
          return 11;
      }
      else if (HTTP_req.indexOf("LED12") > -1) {
          return 12;
      }
      else if (HTTP_req.indexOf("LED1") > -1) {
          return 1;
      }
 }
 
 void turn(int Pin){
       int estado=0;
       estado = digitalRead(Pin); 
	if(estado==HIGH){
		digitalWrite(Pin,LOW); //donde estado= HIGH o LOW
	}
	else{
		digitalWrite(Pin,HIGH);
	}
       }

      void turnon(int PIN, EthernetClient cl){
		digitalWrite(PIN,HIGH);
                sendresponse(cl,"true");
       }
       
       void turnoff(int PIN, EthernetClient cl){
		digitalWrite(PIN,LOW);
                sendresponse(cl,"true");
       }
         

        void check(int pin, EthernetClient cl){
            int airestate=0;
            airestate = digitalRead(pin);
		if(airestate == HIGH)  {
      		    //Serial.print(true);
                    sendresponse(cl,"true");
  		    }
		else {
			//Serial.print(false);
                        sendresponse(cl,"false");
                        
		    }
            }
            
         void sendresponse(EthernetClient client,String response) {
         client.println("HTTP/1.1 200 OK");
         client.println("Content-Type: text/plain");
         client.println("Connnection: close");
         client.println();
         client.println(response);
         }
