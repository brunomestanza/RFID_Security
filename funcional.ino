   //Bibliotecas
#include <SPI.h>
#include <MFRC522.h>
#include <Servo.h>
#include <Ethernet.h>

byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};
char servidor [] = "192.168.0.8";
EthernetClient clienteArduino;

String teste = "b584dd1b";
 
//Pinos
#define SERVO 3
#define LED_AMARELO 5
#define LED_VERDE 6
#define LED_VERMELHO 7
#define SS_PIN 8
#define RST_PIN 9

Servo servo;

String IDtag = ""; //Variável que armazenará o ID da Tag
bool Permitido = false; //Variável que verifica a permissão 
 
//Vetor responsável por armazenar os ID's das Tag's cadastradas

String TagsCadastradas[] = {"67322e83", 
                            "b584dd1b"};

MFRC522 LeitorRFID(SS_PIN, RST_PIN);    // Cria uma nova instância para o leitor e passa os pinos como parâmetro
 
 
void setup() {
        Serial.begin(9600);             // Inicializa a comunicação Serial
        SPI.begin();                    // Inicializa comunicacao SPI 
        servo.attach(SERVO);
        LeitorRFID.PCD_Init();          // Inicializa o leitor RFID
        pinMode(LED_VERDE, OUTPUT);     // Declara o pino do led verde como saída
        pinMode(LED_VERMELHO, OUTPUT);  // Declara o pino do led vermelho como saída
        pinMode(LED_AMARELO, OUTPUT);        // Declara o pino do buzzer como saída
        servo.write(0);
        Ethernet.begin(mac);
}
 
void loop() {  
  if(clienteArduino.available()){
    char dadosRetornados = clienteArduino.read();
    Serial.print(dadosRetornados);
  }
   if(!clienteArduino.connected()){
    clienteArduino.stop();
  }
  digitalWrite(LED_AMARELO, HIGH);
  Leitura();  //Chama a função responsável por fazer a leitura das Tag's
}
 
void Leitura(){
 
        IDtag = ""; //Inicialmente IDtag deve estar vazia.
        
        // Verifica se existe uma Tag presente
        if ( !LeitorRFID.PICC_IsNewCardPresent() || !LeitorRFID.PICC_ReadCardSerial() ) {
            delay(50);
            return;
        } 
        // Pega o ID da Tag através da função LeitorRFID.uid e Armazena o ID na variável IDtag        
        for (byte i = 0; i < LeitorRFID.uid.size; i++) {        
            IDtag.concat(String(LeitorRFID.uid.uidByte[i], HEX));
        }
        
        //Compara o valor do ID lido com os IDs armazenados no vetor TagsCadastradas[]
        for (int i = 0; i < (sizeof(TagsCadastradas)/sizeof(String)); i++) {
          if(  IDtag.equalsIgnoreCase(TagsCadastradas[i])  ){
              Permitido = true; //Variável Permitido assume valor verdadeiro caso o ID Lido esteja cadastrado
          }
        }       
 
        if(Permitido == true) acessoLiberado(); //Se a variável Permitido for verdadeira será chamada a função acessoLiberado()        
        else acessoNegado(); //Se não será chamada a função acessoNegado()
 
        delay(2000); //aguarda 2 segundos para efetuar uma nova leitura
}
 
void acessoLiberado(){
  Serial.println("Tag Cadastrada: " + IDtag); //Exibe a mensagem "Tag Cadastrada" e o ID da tag não cadastrada
  Permitido = false;  //Seta a variável Permitido como false novamente
    if(clienteArduino.connect(servidor, 80)){
      clienteArduino.print("GET /projeto-tcc/request.php?");
      clienteArduino.print("request=");
      clienteArduino.print(IDtag);
      clienteArduino.println();
      clienteArduino.println("HTTP/1.1");
      clienteArduino.println("Host: 192.168.0.8");
      clienteArduino.println("Connection: close");
      clienteArduino.println();
    }
    efeitoPermitido();  //Chama a função efeitoPermitido()
}
 
void acessoNegado(){
  Serial.println("Tag NAO Cadastrada: " + IDtag); //Exibe a mensagem "Tag NAO Cadastrada" e o ID da tag cadastrada
  if(clienteArduino.connect(servidor, 80)){
    clienteArduino.print("GET /projeto-tcc/request.php?");
    clienteArduino.print("request=");
    clienteArduino.print(IDtag);
    clienteArduino.println();
    clienteArduino.println("HTTP/1.1");
    clienteArduino.println("Host: 192.168.0.8");
    clienteArduino.println("Connection: close");
    clienteArduino.println();
  }
  efeitoNegado(); //Chama a função efeitoNegado()
}
 
void efeitoPermitido(){  
    digitalWrite(LED_AMARELO, LOW);
    digitalWrite(LED_VERDE, HIGH);   
    servo.write(90);
    delay(2000);   
    digitalWrite(LED_VERDE, LOW);
    digitalWrite(LED_AMARELO, HIGH);
    servo.write(0);
    
  }
 
void efeitoNegado(){ 
    digitalWrite(LED_AMARELO, LOW);  
    digitalWrite(LED_VERMELHO, HIGH);   
    delay(1000); 
    digitalWrite(LED_VERMELHO, LOW);
    digitalWrite(LED_AMARELO, HIGH);
    
  }
