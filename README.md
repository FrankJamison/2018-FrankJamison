# Frank Jamison Portfolio (2018)

A PHP-based personal portfolio site with a single-page layout (section navigation) and an email contact form.

## What this project includes

- **Single-page portfolio site** with section-based navigation (Home, About, Skills, Portfolio, Goals, Contact)
- **Responsive layout** using a popular CSS framework and common front-end libraries
- **Contact form** that validates user input and sends submissions via PHP’s `mail()` function
- **Portfolio examples** embedded as static pages/apps under the `portfolio/` area

## Tech stack

- **PHP** for server-side rendering and form handling
- **HTML/CSS/JavaScript** for the front end
- **CDN dependencies** for framework styling and icons (loaded from external providers in the page `<head>`)

## Requirements

- A web server capable of running PHP (for example, Apache or IIS)
- PHP with `mail()` enabled and configured (or an equivalent mail transport configured for your server)

> The site can be viewed as plain HTML, but the contact form requires PHP.

## Getting started (local development)

1. Point your web server’s document root at this project folder.
2. Ensure PHP is enabled and the server can execute `index.php`.
3. Load the site using whatever hostname/port your web server is configured to serve.

## Contact form configuration

### Where the recipient is set

The contact form recipient and subject are configured near the top of:

- `index.php`

Look for variables similar to:

- `$emailTo`
- `$emailSubject`

Update `$emailTo` to the destination address you want to receive form submissions.

### How it works

- When the form is submitted, `index.php` validates:
  - first name
  - last name
  - email address
  - comment/message
- On success, the server sends an email using `mail()`.

### Mail delivery notes

Mail delivery depends on your hosting environment:

- On many shared hosts, `mail()` works out of the box.
- On a typical Windows dev setup, you may need to configure PHP mail transport (SMTP) for emails to send successfully.

If submissions appear to “work” but no email arrives, confirm:

- server mail transport configuration
- spam filtering/quarantine
- `From`/`Reply-To` policies on your host (some hosts require a domain-owned sender)

## Content updates

Common edits you may want to make:

- **Page title / SEO**: update the `<title>` and meta tags in `index.php`.
- **Section copy**: edit the relevant section markup in `index.php`.
- **Portfolio entries**: update links and content under `portfolio/`.

## Deployment

1. Upload the project to a PHP-capable hosting environment.
2. Point your domain/document root at the project folder.
3. Verify:
   - page loads correctly
   - navigation scrolls to sections
   - contact form submits and email is received

## Security considerations

- Input is validated and basic header-injection strings are stripped.
- Consider adding a CAPTCHA or rate limiting if deploying publicly, to reduce spam.

