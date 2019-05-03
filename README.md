# Oxid 6 REST-Api auf Symfonybasis

## Vorwort

Diese API befindet sich im Aufbau, wenn ihr die API installiert, hat jeder Zugriff auf eure Artikel & Kategorien. Ich rate vom Live-Betrieb ab - auch wenn es funktionieren würde - <del>bis eine Authentifizierung mit nem Secret Key oder HTTP-Password möglich ist</del> Authentifizierung siehe weiter unten.

## Installation

```
composer req sioweb/oxid-api
```

Nach der Installation, müssen die Module `Sioweb | Oxid Kernel` und `Sioweb | Oxid Symfony API` im Backend von Oxid aktiviert werden.

## Was zum?

Ja genau. Eine REST-API auf Symfony-Basis mit echten Routen die Informationen als JSON ausgibt.

## Authentifizierung

Alle Routen sind nun über HTTP-Authentifizierung benutzbar. Dazu einfach den Oxid Benutzernamen und Passwort angeben.

Es fehlt nun noch, Routen einzeln zu schützen und ein Token-Login soll ebenfalls möglich werden.

## Routen

### Folgende `Routes` liefern ergebnisse:

Nach der Installation, wird in der Tabelle `oxuser` das Feld `APITOKEN` angelegt. Angenommen der User `max.mustermann@beispiel.tld` möchte die API verwenden:

```
UPDATE `oxuser` SET APITOKEN = 'THIS_IS_A_TOKEN' WHERE USERNAME = 'max.mustermann@beispiel.tld';
```

Danach kann in der Konsole die API mit CURL und dem eben angelegten Token verwendet werden:

```
curl -k -H "X-AUTH-TOKEN: THIS_IS_A_TOKEN" https://deine-url/api/v1/article/
```

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
