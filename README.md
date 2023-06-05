# Report

## Badges

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/itsrobingtemp/mvc-report/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/itsrobingtemp/mvc-report/?branch=main)

[![Code Coverage](https://scrutinizer-ci.com/g/itsrobingtemp/mvc-report/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/itsrobingtemp/mvc-report/?branch=main)

[![Build Status](https://scrutinizer-ci.com/g/itsrobingtemp/mvc-report/badges/build.png?b=main)](https://scrutinizer-ci.com/g/itsrobingtemp/mvc-report/build-status/main)

[![Code Intelligence Status](https://scrutinizer-ci.com/g/itsrobingtemp/mvc-report/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)

## Repo

Detta repo innehåller all kod för hela min report-webbsida skapad för kursen MVC (objektorienterade webbteknologier). Webbsidan är utvecklad i PHP-ramverket Symfony tillsammans med ORM-verktyget doctrine och en liten databas genom SQLite.

Webbsidan har sidor som består av allt från ett kortspel till kursmomentsrapporter. Det senaste tillägget är sidan /proj, vilken består av en liten datavisualisering av indikatorer för hållbarhet, mer specifikt inom området hälsa och välbefinnande.

## Användning

### Klona repot

Öppna din terminal och kör följande kommando:

```
git clone https://github.com/itsrobingtemp/mvc-report.git
```

### Navigera

Gå in i mappen som klonats genom följande kommando:

```
cd mvc-report
```

### Installera dependencies

Använd composer för att installera allt som krävs för att köra webbplatsen. Kör följande kommando:

```
composer install
```

### Editera .env fil

För att databasen skall kunna användas behövs en .env-fil som inte följer med i repo-kloningen. Skapa en sån.

### Skapa env secret

En secret key behövs för att använda databasen. Kör följande kommando i terminalen:

```
php bin/console secret:generate
```

### Skapa databasen

Kör följande kommando för att skapa databasen:

```
php bin/console doctrine:database:create
```

### Kör migration

För att skapa tabeller i databasen behöver vi köra en migration med följande kommando:

```
php bin/console doctrine:migrations:migrate
```

### Kör PHP-servern

För att starta upp servern kör vi följande kommando i terminalen:

```
php -S localhost:8888 -t public
```

### Öppna webbläsaren

Öppna din webbläsare och gå till addressen "localhost:8888".
