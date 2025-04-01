<?php

session_start();
session_destroy();

// Initialisation du tableau en session si non défini
if (!isset($_SESSION['data'])) {
    $jsonobj = '{
    "pistes":
    [
        {
            "id": "1",
            "name": "super piste",
            "color": "noir",
            "start": "10:00:00",
            "end": "18:00:00",
            "open": true
        },

        {
            "id": "2",
            "name": "deuxième piste",
            "color": "bleu",
            "start": "14:00:00",
            "end": "15:00:00",
            "open": true
        }
    ],

    "restaurant":
    [
        {
            "id": "3",
            "name": "Chez JF",
            "start": "10:00:00",
            "end": "18:00:00"
        },

        {
            "id": "4",
            "name": "Mon resto",
            "start": "14:00:00",
            "end": "15:00:00"
        }
    ],

    "parking":
    [
        {
            "id": "5",
            "name": "Grand parking",
            "start": "10:00:00",
            "end": "18:00:00",
            "open": true
        },

        {
            "id": "6",
            "name": "petit parking",
            "start": "14:00:00",
            "end": "15:00:00",
            "open": false
        }
    ],

    "tire-fesse":
    [
        {
            "id": "5",
            "name": "Bonjour",
            "start": "10:00:00",
            "end": "18:00:00",
            "open": true
        },

        {
            "id": "6",
            "name": "Au revoir",
            "start": "14:00:00",
            "end": "15:00:00",
            "open": false
        }
    ]
    
}';

    $_SESSION['data'] = json_decode($jsonobj);
}
?>