<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        '/api/artists' => function () {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'artiesten'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'name' => $entry->naam,
                        'description' => $entry->beschrijving,
                        'image' => $entry->artiestAfbeelding->one() ? $entry->artiestAfbeelding->one()->getUrl() : null,
                        'jsonUrl' => UrlHelper::url("api/artists/{$entry->id}"),
                    ];
                },
            ];
        },
        '/api/artists/<entryId:\d+>' => function ($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'name' => $entry->naam,
                        'description' => $entry->beschrijving,
                        'image' => $entry->artiestAfbeelding->one() ? $entry->artiestAfbeelding->one()->getUrl() : null,
                    ];
                },
            ];
        },
        '/api/concerts' => function () {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'concerten'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $location = $entry->locatie->one();
                    $artists = $entry->artiesten->all();

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'description' => $entry->beschrijving,
                        'dateTime' => $entry->datumTijd,
                        'location' => $location ? $location->title : null,
                        'artists' => array_map(function ($artist) {
                            return [
                                'name' => $artist->title,
                                'jsonUrl' => UrlHelper::url("api/artists/{$artist->id}"),
                            ];
                        }, $artists),
                        'image' => $entry->concertAfbeelding->one() ? $entry->concertAfbeelding->one()->getUrl() : null,
                        'price' => $entry->prijs,
                        'jsonUrl' => UrlHelper::url("api/concerts/{$entry->id}"),
                    ];
                },
            ];
        },
        '/api/concerts/<entryId:\d+>' => function ($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    $location = $entry->locatie->one();
                    $artists = $entry->artiesten->all();

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'description' => $entry->beschrijving,
                        'dateTime' => $entry->datumTijd,
                        'location' => $location ? $location->title : null,
                        'artists' => array_map(function ($artist) {
                            return [
                                'name' => $artist->title,
                                'jsonUrl' => UrlHelper::url("api/artists/{$artist->id}"),
                            ];
                        }, $artists),
                        'image' => $entry->concertAfbeelding->one() ? $entry->concertAfbeelding->one()->getUrl() : null,
                        'price' => $entry->prijs,
                    ];
                },
            ];
        },
        '/api/locations' => function () {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'locaties'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'name' => $entry->naam,
                        'address' => $entry->adres,
                        'description' => $entry->beschrijving,
                        'image' => $entry->locatieAfbeelding->one() ? $entry->locatieAfbeelding->one()->getUrl() : null,
                        'jsonUrl' => UrlHelper::url("api/locations/{$entry->id}"),
                    ];
                },
            ];
        },
        '/api/locations/<entryId:\d+>' => function ($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function (Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'name' => $entry->naam,
                        'address' => $entry->adres,
                        'description' => $entry->beschrijving,
                        'image' => $entry->locatieAfbeelding->one() ? $entry->locatieAfbeelding->one()->getUrl() : null,
                    ];
                },
            ];
        },
    ]
];
