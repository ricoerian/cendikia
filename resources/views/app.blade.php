<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">

        <meta name="description"
            content="Selamat datang di SMK Purnawarman Purwakarta. Kami menawarkan program keahlian unggulan untuk mencetak lulusan yang mandiri, antusias, jujur, dan ulet, siap menghadapi dunia kerja.">
        <meta name="keywords"
            content="SMK Purnawarman, sekolah kejuruan purwakarta, smk di purwakarta, pendaftaran smk, jurusan pplg, jurusan pemasaran, jurusan akuntansi, jurusan pariwisata, jurusan manajemen perkantoran">
        <meta name="author" content="SMK Purnawarman">
        <link rel="canonical" href="https://smkpn.ricoeri.my.id/">
        <meta name="robots" content="index, follow">
        <meta property="og:title" content="SMK Purnawarman Purwakarta - Sekolah Kejuruan Unggulan">
        <meta property="og:description"
            content="Bergabunglah dengan SMK Purnawarman untuk masa depan gemilang dengan program keahlian yang relevan dengan industri.">
        <meta property="og:image"
            content="https://smkpurnawarman.org/wp-content/uploads/2025/07/Gambar-WhatsApp-2025-05-28-pukul-13.58.59_07ff4530.jpg">
        <meta property="og:url" content="https://smkpn.ricoeri.my.id/">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="SMK Purnawarman Purwakarta">
        <meta property="og:locale" content="id_ID">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="SMK Purnawarman Purwakarta - Sekolah Kejuruan Unggulan">
        <meta name="twitter:description"
            content="Bergabunglah dengan SMK Purnawarman untuk masa depan gemilang dengan program keahlian yang relevan dengan industri.">
        <meta name="twitter:image"
            content="https://smkpurnawarman.org/wp-content/uploads/2025/07/Gambar-WhatsApp-2025-05-28-pukul-13.58.59_07ff4530.jpg">
        

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @viteReactRefresh
        @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
