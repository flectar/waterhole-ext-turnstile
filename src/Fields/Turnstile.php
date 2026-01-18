<?php

namespace Flectar\Turnstile\Fields;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Validator;
use Waterhole\Forms\Field;

class Turnstile extends Field
{
    public function render(): string
    {
        $siteKey = config("waterhole.turnstile.site_key");

        if (!$siteKey) {
            return "";
        }

        $widgetId = "turnstile-" . \Illuminate\Support\Str::random(8);

        return <<<blade
            <div id="{$widgetId}" class="mb-4"></div>

            <script>
                (function() {
                    const widgetId = '{$widgetId}';
                    const siteKey = @json(config('waterhole.turnstile.site_key'));

                    function renderWidget() {
                        const container = document.getElementById(widgetId);

                        if (container && !container.innerHTML && typeof turnstile !== 'undefined') {
                            try {
                                turnstile.render('#' + widgetId, {
                                    sitekey: siteKey,
                                    theme: 'auto',
                                    size: 'flexible',
                                });
                            } catch (e) {
                                console.error('Turnstile render error:', e);
                            }
                        }
                    }

                    window.onWaterholeTurnstileLoad = function() {
                        renderWidget();
                    };

                    if (typeof turnstile !== 'undefined') {
                        renderWidget();
                    }

                    document.addEventListener('turbo:load', function() {
                        renderWidget();
                    }, { once: true });
                })();
            </script>

            <script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit&onload=onWaterholeTurnstileLoad" async defer></script>
        blade;
    }

    public function validating(Validator $validator): void
    {
        if (
            !config("waterhole.turnstile.site_key") ||
            !config("waterhole.turnstile.secret_key")
        ) {
            return;
        }

        $validator->after(function (Validator $validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $response = request()->input("cf-turnstile-response");

            if (!$response) {
                $validator
                    ->errors()
                    ->add(
                        "turnstile",
                        __("waterhole-turnstile::messages.failed"),
                    );
                return;
            }

            $json = Http::asForm()
                ->post(
                    "https://challenges.cloudflare.com/turnstile/v0/siteverify",
                    [
                        "secret" => config("waterhole.turnstile.secret_key"),
                        "response" => $response,
                        "remoteip" => request()->ip(),
                    ],
                )
                ->json();

            if (empty($json["success"])) {
                $validator
                    ->errors()
                    ->add(
                        "turnstile",
                        __("waterhole-turnstile::messages.failed"),
                    );
            }
        });
    }
}
