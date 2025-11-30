#include <LiquidCrystal.h>
#include <ArduinoJson.h>

LiquidCrystal lcd(12, 11, 10, 13, A4,A5);

const int RED = 0;
const int GRN = 1;
const int BLE = 2;
const int YLW = 3;

const int LED_YLW = 8;
const int LED_BLE = 6;
const int LED_GRN = 4;
const int LED_RED = 2;
const int LEDS[] = {LED_YLW, LED_BLE,  LED_GRN, LED_RED};

const int BTN_YLW = 9;
const int BTN_BLE = 7;
const int BTN_GRN = 5;
const int BTN_RED = 3;
const int BUTTONS[] = {BTN_YLW, BTN_BLE, BTN_GRN, BTN_RED};

const int SIZE = 4;
const int ROUNDS = 100;

int sequence[ROUNDS];
int n = 0;
bool ok = true;

void enviar_dados_nodered(int rodadas_completas, bool vitoria_maxima) {
  StaticJsonDocument<200> doc; 

  doc["app_id"] = "Memomind";
  doc["rodadas"] = rodadas_completas;
  doc["max_rounds"] = ROUNDS;
  doc["vitoria_maxima"] = vitoria_maxima;

  serializeJson(doc, Serial);
  Serial.println();
}

void flashAllLeds(int duration, int numFlashes) {
  for (int i = 0; i < numFlashes; i++) {
    for (int j = 0; j < SIZE; j++) {
      digitalWrite(LEDS[j], HIGH);
    }
    delay(duration);
    for (int j = 0; j < SIZE; j++) {
      digitalWrite(LEDS[j], LOW);
    }
    delay(duration);
  }
}

void printLed(int inX){
  digitalWrite(LEDS[inX], HIGH);
  delay(400);
  digitalWrite(LEDS[inX], LOW);
  delay(150);
}

void printWin(){
  flashAllLeds(50, 8);
}

void printFail(){
  lcd.clear();
  lcd.print("VOCE PERDEU!");
  lcd.setCursor(0, 1);
  lcd.print("Rodada: ");
  lcd.print(n - 1); 
  
  flashAllLeds(150, 3);
}

void randomSequence(){
  for (int i=0; i<ROUNDS; i++){
    sequence[i] = random(0,SIZE);
  }
  n = 1;
  delay(1000);
}

void printSequence(){
  delay(500);
  
  lcd.print("   RODADA: ");
  lcd.print(n);
  lcd.setCursor(0, 1);
  lcd.print("   MEMORIZE!!");
  delay(1000);
  lcd.clear();
  
  flashAllLeds(100, 1);
  delay(500); 
  
  for(int i=0; i<n; i++){
    printLed(sequence[i]);
  }
}

bool readButtons(){
  lcd.setCursor(0, 1);
  lcd.print("    SUA VEZ!");
  
  for (int j=0; j<n && ok; j++){
    int input[]={0,0,0,0};
    bool buttonPressed = false;
    
    while(!buttonPressed){
      for(int i=0; i<SIZE; i++){
        input[i] = digitalRead(BUTTONS[i]);
        if(input[i]){
          printLed(i);
          buttonPressed = true;
          
          if(i != sequence[j]){
            ok=false;
          }
          while(digitalRead(BUTTONS[i]));
          delay(100); 
          break;
        } 
      }
    }
    if(!ok) break; 
  }
  return ok;
}


void setup() {
    Serial.begin(9600); 

  lcd.begin(16, 2);
  lcd.clear();
  lcd.print(" JOGO COMECOU!");
  delay(2000);
  
  randomSeed(analogRead(0));
  for(int i=0; i<SIZE; i++){
    pinMode(LEDS[i], OUTPUT);
    pinMode(BUTTONS[i], INPUT);
  }
  
  lcd.clear();
  lcd.print("  PREPARAR... ");
  flashAllLeds(150, 3); 
  delay(1000);
}

void loop() {
  lcd.clear();
  delay(1000);
  
  ok = true;
  randomSequence(); 
  
  while(ok && n<=ROUNDS){
    printSequence();
    
    if(readButtons()){
      n++;
      lcd.clear();
      lcd.print("BEM FEITO!");
      lcd.setCursor(0, 1);
      lcd.clear();
      lcd.print("Prox. rodada...");
      lcd.clear();
      delay(1000);
    }else{
      ok=false; 
    }
  }
  
  
  if(ok){
        enviar_dados_nodered(ROUNDS, true);
    lcd.clear();
    lcd.print("VITÓRIA MÁXIMA!");
    lcd.setCursor(0, 1);
    lcd.print("100 RODADAS ");
    printWin();
    delay(4000);
  }
  else{
    enviar_dados_nodered(n - 1, false);

    printFail(); 
    delay(3000); 
  }
  
  lcd.clear();
  lcd.print("DE NOVO? "); 
  lcd.setCursor(0, 1);
  lcd.print("APERTE JOGAR");
  
  while(true) {
    delay(500); 
  }
}