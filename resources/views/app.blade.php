<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Wicke Jeroen - Uw aannemer voor totaalrenovaties, terrassen, vloeren, badkamers en algemene bouwwerken in regio Ieper en West-Vlaanderen.">

    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.wickejeroen.be">
    <meta property="og:title" content="Wicke Jeroen - Algemene Bouwwerken & Renovaties">
    <meta property="og:description"
        content="Specialist in totaalrenovaties, terrassen, vloeren en badkamers. Van kleine werken tot grote projecten in regio Ieper.">
    <meta property="og:image" content="https://www.wickejeroen.be/images/flow-menu/totaalrenovaties.jpg">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Structured Data (JSON-LD) for Local SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "GeneralContractor",
      "name": "Wicke Jeroen",
      "image": "https://www.wickejeroen.be/images/flow-menu/totaalrenovaties.jpg",
      "description": "Uw partner voor totaalrenovaties, terrassen, vloeren, badkamers en algemene bouwwerken in regio Ieper.",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Koolmeeslaan 15",
        "addressLocality": "Ieper",
        "postalCode": "8900",
        "addressCountry": "BE"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 50.8503,
        "longitude": 2.8846
      },
      "url": "https://www.wickejeroen.be",
      "telephone": "+32479856409",
      "areaServed": "West-Vlaanderen",
      "priceRange": "$$"
    }
    </script>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800;900&amp;family=Montserrat:wght@400;700&amp;family=Oswald:wght@700&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    @routes
    @vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-body antialiased">
    @inertia
</body>

</html>