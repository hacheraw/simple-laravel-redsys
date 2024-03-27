<?php

return [
  'home' => [
    'active' => env('HOME_ACTIVE', true),
    'redirect_url' => env('HOME_REDIRECT_URL', 'https://jorgeff.com'),
  ],
  'design' => [
    'logo' => env('APP_LOGO', 'https://placehold.co/400x120?text=Simple+Laravel+Redsys'),
    'background' => env('BACKGROUND_IMAGE', 'https://placehold.co/1920x1080')
  ]
];