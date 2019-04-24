# Oxid 6 REST-Api auf Symfonybasis

## Vorwort

Diese API befindet sich im Aufbau, wenn ihr die API installiert, hat jeder Zugriff auf eure Artikel & Kategorien. Ich rate vom Live-Betrieb ab - auch wenn es funktionieren würde - bis eine Authentifizierung mit nem Secret Key oder HTTP-Password möglich ist.

## Installation

```
composer req sioweb/oxid-api
```

Nach der Installation, müssen die Module `Sioweb | Oxid Kernel` und `Sioweb | Oxid Symfony API` im Backend von Oxid aktiviert werden.

## Was zum?

Ja genau. Eine REST-API auf Symfony-Basis mit echten Routen.

## Routen

### Folgende `Routes` liefern ergebnisse:

#### Artikel

- https://deine-domain.tld/api/v1/article/ [GET]
- https://deine-domain.tld/api/v1/article/{item}/ [GET]

#### Kategorien

- https://deine-domain.tld/api/v1/category/ [GET]
- https://deine-domain.tld/api/v1/category/{item}/ [GET]

### Folgende `Routes` werden irgendwann funktionieren:

- https://deine-domain.tld/api/v1/article/ [POST]
- https://deine-domain.tld/api/v1/article/{item}/ [PUT]
- https://deine-domain.tld/api/v1/article/{item}/ [DELETE]
- https://deine-domain.tld/api/v1/category/ [POST]
- https://deine-domain.tld/api/v1/category/{item}/ [PUT]
- https://deine-domain.tld/api/v1/category/{item}/ [DELETE]
- https://deine-domain.tld/api/v1/order/ [GET]
- https://deine-domain.tld/api/v1/order/ [POST]
- https://deine-domain.tld/api/v1/order/{item}/ [GET]
- https://deine-domain.tld/api/v1/order/{item}/ [PUT]
- https://deine-domain.tld/api/v1/order/{item}/ [DELETE]
- https://deine-domain.tld/api/v1/user/ [GET]
- https://deine-domain.tld/api/v1/user/ [POST]
- https://deine-domain.tld/api/v1/user/{item}/ [GET]
- https://deine-domain.tld/api/v1/user/{item}/ [PUT]
- https://deine-domain.tld/api/v1/user/{item}/ [DELETE]
- https://deine-domain.tld/api/v1/{_url_fragment}
