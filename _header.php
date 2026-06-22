<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Pokédex Explorer';
}
if (!isset($activePage)) {
    $activePage = '';
}
if (!isset($pageDescription)) {
    $pageDescription = 'A Bootstrap and PHP website powered by PokéAPI JSON data.';
}

function esc($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function activeClass($page, $activePage) {
    return $page === $activePage ? ' active' : '';
}

function apiGetJson($url) {
    $context = stream_context_create([
        'http' => [
            'timeout' => 8,
            'header' => "User-Agent: PatelMidterm-PokedexExplorer/1.0\r\n"
        ]
    ]);

    $json = @file_get_contents($url, false, $context);

    if ($json === false) {
        return null;
    }

    $data = json_decode($json, true);
    return is_array($data) ? $data : null;
}

function formatName($name) {
    return ucwords(str_replace('-', ' ', (string)$name));
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc($pageTitle); ?> | Pokédex Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Pokédex Explorer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="mainNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link<?php echo activeClass('home', $activePage); ?>" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link<?php echo activeClass('pokemon', $activePage); ?>" href="pokemon.php">Search</a></li>
                <li class="nav-item"><a class="nav-link<?php echo activeClass('types', $activePage); ?>" href="types.php">Types</a></li>
                <li class="nav-item"><a class="nav-link<?php echo activeClass('about', $activePage); ?>" href="about.php">About</a></li>
            </ul>
        </div>
    </div>
</nav>

<header class="hero-section text-white">
    <div class="container py-5">
        <p class="text-uppercase fw-bold small mb-2">ITEC 4366 Midterm Project</p>
        <h1 class="display-5 fw-bold"><?php echo esc($pageTitle); ?></h1>
        <p class="lead col-lg-8"><?php echo esc($pageDescription); ?></p>
    </div>
</header>
