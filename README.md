## Spustenie aplikácie
V tomto návode pre názov aplikácie použijeme NameDayApp. Ak pre aplikáciu na miesto NameDayApp použijete iný názov, 
všetky výskyty NameDayApp v tomto návode si nahraďte vašim názvom.

Pre beh aplikácie je nutné mať nainštalovaný web server (Apache, Nginx) s PHP 7.2+ a databázou MySQL.

Je nutné mať nainšatolvaný php composer. Postup nájdete v dokumentácii: https://getcomposer.org/doc/00-intro.md

Tento návod predpokladá, že vo vašom web serveri máte vytvorený virtual host s referenciou na adresár aplikácie 
NameDayApp, prístupný z web prehliadača na url podľa vášho výberu.

1. ### Naklonujte repozitár z github 
    V termináli sa nastavte do adresára, kde chcete mat túto aplikáciu a spustite príkaz:
   
        git clone https://github.com/lukas-habaj/NameDayApp.git NameDayApp
    
    Vytvorí sa nový adresár NameDayApp s obsahom repozitára.

2. ### Doinštalujte závislosti pomocou composera
    V termináli sa nastavte do adresára NameDayApp a spustite príkaz
        
        composer install

    Počkajte, kým composer dokončí inštaláciu. Trvá to max. 5 minút.
   
3. ### Lokálne prostredie
    - premenujte súbor NameDayApp/.env.example na NameDayApp/.env
    
    - zmete hodnotu premennej APP_URL na url, na ktorej je dostupny virtual host tejto aplikácie, napr.:
        
            APP_URL=http://namedayapp.localhost

    - vygenerovanie šifrovacieho kľúča - v termináli, v adresári NameDayApp spustite príkaz:
        
            php artisan key:generate

    - vo vašej MySQL databáze si vytvorte novú databázu pre NameDay aplikáciu.
    
    - v NameDayApp/.env si nastavte hodnoty premenných začínajúcich DB_ podľa prístupových údajov k vašej databáze. 
      Pravdepodobne budete musiet zmenit iba

            DB_DATABASE=name_day_app

      kde name_day_app je názov databázy. Nahraďte ho vaším názvom.

4. ### Migrácie a import mien

    - v termináli sa nastavte do adresára aplikácie NameDayApp a spustite príkaz
    
            php artisan migrate
    
    - teraz by ste už aplikáciu mali vedieť zobrazit v prehliadači
    
    - ďalej treba spustiť príkaz na import mien do databázy; trvá to asi 2 minuty
    
            php artisan name-days:update
    
    - s importovanými dátami by už aplikácia mala byť plne funkčná

