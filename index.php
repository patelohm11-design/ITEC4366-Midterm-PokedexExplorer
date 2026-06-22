<?php
$pageTitle = 'Pokédex Explorer';
$activePage = 'home';
$pageDescription = 'Search Pokémon, explore types, and view API-driven details using PHP and Bootstrap.';
require_once '_header.php';

$featuredNames = ['pikachu', 'charizard', 'bulbasaur'];
$featuredPokemon = [];

foreach ($featuredNames as $name) {
    $data = apiGetJson('https://pokeapi.co/api/v2/pokemon/' . urlencode($name));
    if ($data !== null) {
        $featuredPokemon[] = $data;
    }
}
?>

<main class="container my-5">
    <section class="row align-items-center g-4 mb-5">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <h2 class="fw-bold">A simple API-driven Pokémon guide</h2>
                <p>
                    Pokédex Explorer is a small PHP website that retrieves live JSON data from PokéAPI.
                    It demonstrates server-side API requests, JSON decoding, Bootstrap layout, reusable
                    PHP template files, and user interaction through search and query strings.
                </p>
                <p>
                    Use the search page to look up a Pokémon by name, visit the type page to browse Pokémon
                    by category, or open a details page to see stats, abilities, height, weight, and official artwork.
                </p>
                <a class="btn btn-primary btn-lg" href="pokemon.php">Search Pokémon</a>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="info-panel shadow-sm">
                <h3>Project Features</h3>
                <ul class="mb-0">
                    <li>External JSON API integration</li>
                    <li>PHP reusable header and footer</li>
                    <li>Search and query-string details</li>
                    <li>Bootstrap responsive cards</li>
                    <li>Safe output using htmlspecialchars()</li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold mb-0">Featured Pokémon</h2>
            <a href="pokemon.php" class="btn btn-outline-primary">View Search</a>
        </div>

        <div class="row g-4">
            <?php foreach ($featuredPokemon as $pokemon): ?>
                <?php
                    $name = formatName($pokemon['name'] ?? 'Unknown');
                    $image = $pokemon['sprites']['other']['official-artwork']['front_default'] ?? $pokemon['sprites']['front_default'] ?? '';
                    $types = array_map(fn($t) => formatName($t['type']['name'] ?? ''), $pokemon['types'] ?? []);
                ?>
                <div class="col-md-4">
                    <article class="card h-100 shadow-sm pokemon-card">
                        <?php if ($image): ?>
                            <img src="<?php echo esc($image); ?>" class="card-img-top pokemon-img" alt="Official artwork of <?php echo esc($name); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo esc($name); ?></h3>
                            <p class="card-text">Type: <?php echo esc(implode(', ', $types)); ?></p>
                            <a class="btn btn-primary" href="details.php?pokemon=<?php echo urlencode($pokemon['name']); ?>">View Details</a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require_once '_footer.php'; ?>
