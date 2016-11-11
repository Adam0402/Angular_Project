<?php

return [
    'domain' => 'http://picclaim-.local',
         'sessionTimeoutSeconds' => 604800,
    'communication' =>
    [
        'from' => 'Loss Capture',
        'from-email' => 'steve@landexcorp.com',
        'sales' => '888-678-3784',
        'tollfree' => '877-841-7239',
    ],
    'media' =>
    [
      'coconutAPI' => 'k-00b126bcbb8317126875ef75e044cc58',  
    ],
    'google-cloud' =>
    [
      'api' => 'AIzaSyDdTjyHTkD_zeEuWpEqH6TRGFLfj-XQcZs',  
        'client-secret' => 'm12nHTAXzwi-RhtqReU0Qb6R',
        'client-id' => '730156922073-pnmlu66ev1es3lupr956o4treprm2doh.apps.googleusercontent.com',
        'access-key' => 'GOOG5WLTVEJH2FOKXVHJ',
        'secret' => '9PHOoP/TJtSKknPkgwXFudtURKtHJqZr1mSa7SMF',
        'public' => 'https://storage.googleapis.com/loss-capture-claim-data/',
    ],
    'aws-cloud' =>
    [
        'public' => 'https://s3-us-west-2.amazonaws.com/loss-capture/',
    ],
    'vinquery' => '4017370d-d6de-4699-a6ab-08217604bccf',
    'encryption' =>
    [
        'mode' => 'AES-256-CBC',
        'secret' => 'l0ssC@pture',
        'iv' => '1234567890123456', // probably not the best way to do this..
    ],
    'operationsManager' =>
    [
        NULL => 'No Suggestion',
        31 => 'Suggests Process',
        32 => 'Suggests Deny',
    ],
    'files' =>
    [
        'image' =>
        [
            'width' => 1024,
            'height' => 768,
            'quality' => 80
        ],
        'thumbnail' =>
        [
            'width' => 200,
            'height' => 150,
            'quality' => 80
        ],
        'urlTo' => '/claimfiles/',
        'pathTo' => '/static/UserFiles/',
    ],
    'fees' =>
    [
        'claimCreation' => 16.80,
        'claimEstimate' => 89.25,
    ],
    'claimType' => [
        1 => "Damage - Vehicle",
        2 => "Theft - Vehicle",
        3 => "Theft - Other",
        4 => "Property Damage",
        5 => "Lost Keys",
        6 => "Rental Car",
        7 => "Third Party Fault",
    ],
    'damageBasic' => [
        1 => "Front Bumper",
        2 => "Driver's Side Fender",
        3 => "Hood",
        4 => "Passenger's Side Fender",
        5 => "Driver's Side Front Door",
        6 => "Roof",
        7 => "Passenger's Side Front Door",
        8 => "Driver's Side Rear Door",
        9 => "Passenger's Side Rear Door",
        10 => "Driver's Side Quarter",
        11 => "Trunk",
        12 => "Passenger's Side Quarter",
        13 => "Rear Bumper",
        14 => "Glass",
        15 => "Passenger's Side Mirror",
        16 => "Driver's Side Mirror",
        17 => "Passenger's Side Head Light",
        18 => "Driver's Side Head Light",
        19 => "Passenger's Side Tail Light",
        20 => "Left Tail Light",
        21 => "Wheels",
        22 => "Interior",
        23 => "Driver's Side Panels",
        24 => "Passenger's Side Panels",
    ]
];
