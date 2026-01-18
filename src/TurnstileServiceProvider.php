<?php

namespace Flectar\Turnstile;

use Waterhole\Extend;
use Flectar\Turnstile\Fields\Turnstile;

class TurnstileServiceProvider extends Extend\ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . "/../config/turnstile.php",
            "waterhole.turnstile",
        );

        $this->extend(function (Extend\Forms\RegistrationForm $form) {
            $form->add(Turnstile::class, "turnstile");
        });
    }

    public function boot(): void
    {
        $this->loadTranslationsFrom(
            __DIR__ . "/../resources/lang",
            "waterhole-turnstile",
        );

        $this->publishes(
            [
                __DIR__ . "/../config/turnstile.php" => config_path(
                    "waterhole/turnstile.php",
                ),
            ],
            "waterhole-turnstile-config",
        );
    }
}
