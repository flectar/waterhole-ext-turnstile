[![Latest Stable Version](https://poser.pugx.org/flectar/waterhole-turnstile/v)](https://packagist.org/packages/flectar/waterhole-turnstile) [![Total Downloads](https://poser.pugx.org/flectar/waterhole-turnstile/downloads)](https://packagist.org/packages/flectar/waterhole-turnstile)  [![License](https://poser.pugx.org/flectar/waterhole-turnstile/license)](https://packagist.org/packages/flectar/waterhole-turnstile)

# Cloudflare Turnstile for Waterhole

Secure your [Waterhole](https://waterhole.dev) community with Cloudflare Turnstile, a privacy-focused, CAPTCHA alternative. This extension adds a Turnstile widget to your registration form to prevent bot signups.

---

### 🚀 Features

- Smart protection: Blocks bots while letting real users through (often without clicking anything).
- Privacy first: No cookies, no tracking.
- Turbo compatible: Works perfectly with Waterhole.
- Flexible design: Automatically adjusts to the full width of your form.

---

### 📦 Installation

Install via Composer. Run the following command in your Waterhole root directory:

```bash
composer require flectar/waterhole-turnstile
```

---

### ♻️ Updating

To update the extension, simply run:

```bash
composer update flectar/waterhole-turnstile:"*"
php artisan cache:clear
```

---

### ⚙️ Usage

1. Get your keys: Go to the [Cloudflare Dashboard](https://dash.cloudflare.com/) and create a Turnstile widget.
2. Update your `.env`: Add your Site Key and Secret Key to the `.env` file in your Waterhole root directory:

```bash
TURNSTILE_SITE_KEY=0x4AAAAAA...
TURNSTILE_SECRET_KEY=0x4AAAAAA...
```

```bash
php artisan config:clear
php artisan optimize
php artisan cache:clear
```

---

### 📄 License

- Open-sourced under the [MIT License](https://github.com/flectar/flarum-ext-turnstile/blob/main/LICENSE).

---

### 🔗 Useful Links

- [Flectar](https://flectar.com/)
- [Packagist - flectar/waterhole-turnstile](https://packagist.org/packages/flectar/waterhole-turnstile)
- [GitHub Repo](https://github.com/flectar/waterhole-turnstile)
- [Composer](https://getcomposer.org/)
- [Waterhole](https://waterhole.dev/)
