# Haus Suche

## Daten

Die Daten müssen in `data.json` in folgenden Format abgelegt sein:

```json
{
    "list": [
        {
            "streetname": "Müllerstraße 1",
            "note": "Das sieht interessant aus",
            "link": "https://example.org",
            "lat": 50.12345,
            "lng": 10.12345
        }
    ]
}
```

Das Feld `link` ist optional.

### Geocode

Falls man sich den Aufwand der Geocodierung nicht selbst machen will gibt es ein kleines Tools, welches den Straßennamen via MapQuest API zu einer Koordinate auflöst. Dieses Tool findet sich in `tools/`. Dort einmal `composer install` ausführen und den MapQuest API Token eintragen. Anschließend kann man `php tools/geocode.php` aufrufen und die Datei `data.json` wird mit Koordinaten für die Einträge gefüllt, die keine `lat` und `lng` Schlüssel haben. Dazu wird der Straßenname an `Chemnitz, ` angehangen und nachgeschlagen.

## Deployment

* MapBox Token in `index.html` setzen
* `index.html` und `data.json` auf einen Webserver legen und öffnen