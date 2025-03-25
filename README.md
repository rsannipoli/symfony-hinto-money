# Hinto Money API

> API Symfony 7 + API Platform 3 per operazioni su valuta storica britannica (pound, shilling, pence) e gestione catalogo articoli.

---

## Requisiti

- [Docker](https://www.docker.com/) installato
- [Docker Compose](https://docs.docker.com/compose/)

---

## Avvio dell’ambiente

### 1. Clona il progetto

```bash
git clone https://github.com/rsannipoli/symfony-hinto-money.git
cd symfony-hinto-money
```

### 2. Inizializza docker

```bash
docker-compose up -d --build
```

### 3. Installa le dipendenze

```bash
cd ./api
composer install
```

### 4. Crea il database e lo schema

```bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
```
Per l'ambiente di test

```bash
php bin/console doctrine:database:create --env=test
php bin/console doctrine:schema:create --env=test
```

## API disponibili
- [Visita Swagger UI](http://localhost:8000/api)

### API Operazioni

Metodo | URI            | Descrizione                                                         
--- |----------------|---------------------------------------------------------------------|
POST | /api/operation | Operazioni su moneta.</br>op: "somma" - "sottrai" - "moltiplica" - "dividi"

### API Catalogo

 Metodo        | URI           | Descrizione 
 ---------------|---------------|---
GET | /api/catalogs | Recupera la lista di tutti gli articoli nel catalogo
GET | /api/catalogs/{id} | Recupera un articolo del catalogo
POST | /api/catalogs | Crea un nuovo articolo nel catalogo
PATCH | /api/catalogs/{id} | Aggiorna un articolo essitente del catalogo
DELETE | /api/catalogs/{id} | Cancella un articolo dal catalogo 

## Test

Per eseguire il test è necessario il database di test. 

Eseguire il seguente comando dalla cartella del progetto symfony /api 
```bash
php bin/phpunit
```

## Licenza
MIT © Riccardo Sannipoli