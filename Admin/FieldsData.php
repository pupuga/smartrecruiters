<?php

namespace Smartrecruiters\Admin;

final class FieldsData
{
    private static $instance;
    private $fields = array(
        'general' => array(
            //5a980e2b-560a-42d7-a324-bd81248b95a2
            'companies' => array(
                'type' => 'text',
                'title' => 'Firmen',
                'description' => 'Mehrere IDs bitte mit Komma trennen.'
            ),
            'slug' => array(
                'type' => 'text',
                'title' => 'Permalink',
                'default' => 'job-angebot',
                'description' => 'default: job-angebot'
            )
        ),
        'table' => array(
            'table-full-time' => array(
                'type' => 'text',
                'title' => 'Text für Vollzeitstelle',
                'default' => 'Vollzeit',
                'description' => 'default: Vollzeit'
            ),
            'table-part-time' => array(
                'type' => 'text',
                'title' => 'Text für Teilzeitstelle',
                'default' => 'Teilzeit',
                'description' => 'default: Teilzeit'
            ),
            'table-color' => array(
                'type' => 'text',
                'title' => 'Hintergrundfarbe der Zeile bei Mausover',
                'default' => '#c00719',
                'description' => 'default: #c00719'
            ),
            'table-text-hover-color' => array(
                'type' => 'text',
                'title' => 'Textfarbe bei Mausover',
                'default' => '#ffffff',
                'description' => 'default: #ffffff'
            ),
            'table-name-title' => array(
                'type' => 'text',
                'title' => 'Überschrift der Spalte der Stellenbezeichnung',
                'default' => 'Bezeichnung',
                'description' => 'default: Bezeichnung'

            ),
            'table-type-title' => array(
                'type' => 'text',
                'title' => 'Überschrift der Spalte Beschäftigungsart',
                'default' => 'Beschäftigungsart',
                'description' => 'default: Beschäftigungsart'
            ),
            'table-category-title' => array(
                'type' => 'text',
                'title' => 'Überschrift der Spalte Abteilung',
                'default' => 'Abteilung',
                'description' => 'default: Abteilung'
            ),
            'table-search-placeholder' => array(
                'type' => 'text',
                'title' => 'Suche Feld Beschriftung',
                'default' => 'Suchbegriff eingeben',
                'description' => 'default: Suchbegriff eingeben'
            ),
            'table-default-filter' => array(
                'type' => 'text',
                'title' => 'Standard Filtereinstellung',
                'default' => 'Alle Abteilungen',
                'description' => 'default: Alle Abteilungen'
            ),
        ),
        'map' => array(
            'map-color' => array(
                'type' => 'text',
                'title' => 'Farbe für Marker',
                'default' => '#c00719',
                'description' => 'default: #c00719'
            ),
            'map-marker-text-color' => array(
                'type' => 'text',
                'title' => 'Textfarbe für Marker',
                'default' => '#ffffff',
                'description' => 'default: #ffffff'
            ),
            'map-marker-text-single' => array(
                'type' => 'text',
                'title' => 'Marker Bezeichnung (eine Stelle)',
                'default' => 'Stelle',
                'description' => 'default: Stelle'
            ),
            'map-marker-text-many' => array(
                'type' => 'text',
                'title' => 'Marker Bezeichnung (mehrere Stellen)',
                'default' => 'Stellen',
                'description' => 'default: Stellen'
            ),
            'map-alert' => array(
                'type' => 'text',
                'title' => 'Einwilligungsnachricht beim Betreten der Seite',
                'default' => 'Durch das Aktivieren der Kartendarstellung, werden Daten von OpenStreetMap abgerufen. Es werde keine Cookies auf Ihrem Rechner gespeichert.',
                'description' => 'default: Durch das Aktivieren der Kartendarstellung, werden Daten von OpenStreetMap abgerufen. Es werde keine Cookies auf Ihrem Rechner gespeichert.'
            ),
            'map-style' => array(
                'type' => 'select',
                'title' => 'Kartenstyle',
                'options' => array(
                    'default' => array(
                        'provider' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                        'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                        'subdomains' => array('a','b','c')
                    ),
                    'osmde' => array(
                        'provider' => 'https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png',
                        'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                        'subdomains' => array('a','b','c')
                    ),
                    'osmfr' => array(
                        'provider' => 'http://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png',
                        'attribution' => '&copy; OpenStreetMap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                        'subdomains' => array('a','b','c')
                    ),
                    'hot' => array(
                        'provider' => 'http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
                        'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>',
                        'subdomains' => array('a','b','c')
                    ),
                    'opentopomap' => array(
                        'provider' => 'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
                        'attribution' => 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
                        'subdomains' => array('a','b','c')
                    ),
                    'World_Topo_Map' => array(
                        'provider' => 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}',
                        'attribution' => 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community',
                        'subdomains' => array('a','b','c')
                    ),
                    'World_Street_Map' => array(
                        'provider' => 'http://services.arcgisonline.com/arcgis/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
                        'attribution' => 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community',
                        'subdomains' => array('a','c','b')
                    ),
                    'light_all' => array(
                        'provider' => 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
                        'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>',
                        'subdomains' => 'abcd',
                    ),
                    'voyager' => array(
                        'provider' => 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',
                        'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>',
                        'subdomains' => 'abcd',
                    ),
                    'hikebike' => array(
                        'provider' => 'https://tiles.wmflabs.org/hikebike/{z}/{x}/{y}.png',
                        'attribution' => '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                        'subdomains' => array('a','b','c')
                    ),
                    'terrain' => array(
                        'provider' => 'http://tile.stamen.com/terrain/{z}/{x}/{y}.png',
                        'attribution' => 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://www.openstreetmap.org/copyright">ODbL</a>.',
                        'subdomains' => array('a','b','c')
                    )
                )
            ),
            'map-gray' => array(
                'type' => 'checkbox',
                'title' => 'Graustufen'
            )
        ),
        'job' => array(
            'job-color' => array(
                'type' => 'text',
                'title' => 'Akzentfarbe Text und Bewerbungs-Button',
                'default' => '#c00719',
                'description' => 'default: #c00719'
            ),
            'job-description-title' => array(
                'type' => 'text',
                'title' => 'Titel Text für Stellenbeschreibung',
                'default' => 'Stellenbeschreibung',
                'description' => 'default: Stellenbeschreibung'
            ),
            'job-qualifications-title' => array(
                'type' => 'text',
                'title' => 'Titel Text für Dein Profil',
                'default' => 'Dein Profil',
                'description' => 'default: Dein Profil'
            ),
            'job-info-title' => array(
                'type' => 'text',
                'title' => 'Titel Text für Unser Angebot',
                'default' => 'Unser Angebot',
                'description' => 'default: Unser Angebot'
            ),
            'job-link-title' => array(
                'type' => 'text',
                'title' => 'Text für Bewerbungs-Button',
                'default' => 'Jetzt bewerben!',
                'description' => 'default: Jetzt bewerben!'
            ),
            'job-alert' => array(
                'type' => 'text',
                'title' => 'Nachrichtentext vor Weiterleitung zur SmartRecruiters Website',
                'default' => 'Wir leiten Sie nun weiter auf unser Bewerbungsportal.',
                'description' => 'default: Wir leiten Sie nun weiter auf unser Bewerbungsportal'
            ),
            'job-empty' => array(
                'type' => 'text',
                'title' => 'No Result Text',
                'default' => 'Oh, diesen Job haben wir leider nicht.',
                'description' => 'default: Oh, diesen Job haben wir leider nicht.'
            ),
            //custom button
            'job-custom-button-on' => array(
                'type' => 'checkbox',
                'title' => 'Zweiten Button aktivieren',
            ),
            'job-custom-button-color' => array(
                'type' => 'text',
                'title' => 'Hintergrundfarbe',
                'default' => '#46C514',
                'description' => 'default: #46C514'
            ),
            'job-custom-button-text-color' => array(
                'type' => 'text',
                'title' => 'Textfarbe',
                'default' => '#ffffff',
                'description' => 'default: #ffffff'
            ),
            'job-custom-button-text' => array(
                'type' => 'text',
                'title' => 'Button-Text (Pflichtfeld)',
            ),
            'job-custom-button-link' => array(
                'type' => 'text',
                'title' => 'Button-Link (Pflichtfeld)',
            ),
            'job-custom-button-target-blank' => array(
                'type' => 'checkbox',
                'title' => 'Linkziel in neuem Tab öffnen',
            ),
        ),
        'cache' => array(
            'reset-items' => array(
                'type' => 'checkbox',
                'title' => 'Job-Angebote neu laden',
            ),
            'reset-markers' => array(
                'type' => 'checkbox',
                'title' => 'Marker neu setzen',
            )
        )
    );

    /**
     * @return $this
     */
    public static function app(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get(): array
    {
        return $this->fields;
    }
}