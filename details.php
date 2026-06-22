<?php
$pageTitle = 'Pokémon Details';
$activePage = 'pokemon';
$pageDescription = 'View detailed Pokémon stats, abilities, types, and artwork from the API.';
require_once '_header.php';

$nameQuery = isset($_GET['pokemon']) ? strtolower(trim($_GET['pokemon'])) : 'pikachu';
$safeName = preg_replace('/[^a-z0-9\-]/', '', $nameQuery);
$pokemon = apiGetJson('https://pokeapi.co/api/v2/pokemon/' . urlencode($safeName));
?>

<main class="container my-5">
    <?php if ($pokemon === null): ?>
        <section class="alert alert-warning">
            <h2>Pokémon Not Found</h2>
            <p>The selected Pokémon could not be loaded. Try searching again.</p>
            <a class="btn btn-primary" href="pokemon.php">Back to Search</a>
        </section>
    <?php else: ?>
        <?php
            $displayName = formatName($pokemon['name'] ?? 'Unknown');
            $image = $pokemon['sprites']['other']['official-artwork']['front_default'] ?? $pokemon['sprites']['front_default'] ?? '';
            $types = array_map(fn($t) => formatName($t['type']['name'] ?? ''), $pokemon['types'] ?? []);
            $abilities = array_map(fn($a) => formatName($a['ability']['name'] ?? ''), $pokemon['abilities'] ?? []);
        ?>

        <section class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 text-center">
                    <?php if ($image): ?>
                        <img class="img-fluid detail-img" src="<?php echo esc($image); ?>" alt="Official artwork of <?php echo esc($displayName); ?>">
                    <?php endif; ?>
                    <h2 class="fw-bold mt-3"><?php echo esc($displayName); ?></h2>
                    <p class="text-muted mb-1">Pokédex #<?php echo esc($pokemon['id'] ?? 'N/A'); ?></p>
                    <div>
                        <?php foreach ($types as $type): ?>
                            <a class="badge text-bg-primary text-decoration-none me-1" href="types.php?type=<?php echo urlencode(strtolower($type)); ?>"><?php echo esc($type); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h2 class="fw-bold">API Data Summary</h2>
                    <div class="row g-3">
                        <div class="col-md-6"><div class="data-box"><strong>Height:</strong> <?php echo esc($pokemon['height'] ?? 'N/A'); ?></div></div>
                        <div class="col-md-6"><div class="data-box"><strong>Weight:</strong> <?php echo esc($pokemon['weight'] ?? 'N/A'); ?></div></div>
                        <div class="col-md-6"><div class="data-box"><strong>Base Experience:</strong> <?php echo esc($pokemon['base_experience'] ?? 'N/A'); ?></div></div>
                        <div class="col-md-6"><div class="data-box"><strong>Abilities:</strong> <?php echo esc(implode(', ', $abilities)); ?></div></div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm p-4">
                    <h2 class="fw-bold">Base Stats</h2>
                    <?php foreach (($pokemon['stats'] ?? []) as $stat): ?>
                        <?php
                            $statName = formatName($stat['stat']['name'] ?? 'Unknown');
                            $value = (int)($stat['base_stat'] ?? 0);
                            $percent = min(100, $value);
                        ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <strong><?php echo esc($statName); ?></strong>
                                <span><?php echo esc($value); ?></span>
                            </div>
                            <div class="progress" role="progressbar" aria-label="<?php echo esc($statName); ?>" aria-valuenow="<?php echo esc($value); ?>" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: <?php echo esc($percent); ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php require_once '_footer.php'; ?>
