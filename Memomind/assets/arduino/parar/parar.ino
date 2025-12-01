#include <LiquidCrystal.h>

LiquidCrystal lcd(12, 11, 10, 13, A4, A5);

void setup() {
  for (int i = 0; i <= 9; i++) {
    pinMode(i, OUTPUT);
    digitalWrite(i, LOW);
  }

  lcd.begin(16, 2);
  lcd.clear();
  lcd.print("      JOGO      ");
  lcd.setCursor(0, 1);
  lcd.print("  INTERROMPIDO  ");
}

void loop() { 
}
