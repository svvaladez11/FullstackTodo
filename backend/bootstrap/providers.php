<?php

return [
    App\Ship\Providers\ShipServiceProvider::class,
    (new \App\Ship\Core\Loaders\ProvidersLoader()->loadProviders())
];
