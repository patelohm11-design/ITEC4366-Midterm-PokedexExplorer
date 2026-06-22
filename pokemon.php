<?php
$pageTitle = 'Pokémon Search';
$activePage = 'pokemon';
$pageDescription = 'Search for a Pokémon by name and retrieve live JSON data from PokéAPI.';
require_once '_header.php';

$query = isset($_GET['pokemon']) ? strtolower(trim($_GET['pokemon'])) : '';
$pokemon = null;
$error = '';

if ($query !== '') {
    $safeQuery = preg_replace('/[^a-z0-9\-]/', '', $query);
    if ($safeQuery === '') {
        $error = 'Please enter a valid Pokémon name.';
    } else {
        $pokemon = apiGetJson('https://pokeapi.co/api/v2/pokemon/' . urlencode($safeQuery));
        if ($pokemon === null) {
            $error = 'No Pokémon found with that name. Try pikachu, charizard, or eevee.';
        }
    }
}
?>

<main class="container my-5">
    <section class="card border-0 shadow-sm p-4 mb-4">
        <h2 class="fw-bold">Search the Pokédex</h2>
        <p>Enter a Pokémon name to request JSON data from PokéAPI and display selected fields.</p>

        <form class="row g-2" action="pokemon.php" method="get">
            <div class="col-md-9">
                <label class="form-label" for="pokemon">Pokémon name</label>
                <input class="form-control form-control-lg" id="pokemon" name="pokemon" value="<?php echo esc($query); ?>" placeholder="Example: pikachu">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary btn-lg w-100" type="submit">Search</button>
            </div>
        </form>
    </section>

    <?php if ($error): ?>
        <div class="alert alert-warning"><?php echo esc($error); ?></div>
    <?php endif; ?>

    <?php if ($pokemon !== null): ?>
        <?php
            $name = formatName($pokemon['name'] ?? 'Unknown');
            $image = $pokemon['sprites']['other']['official-artwork']['front_default'] ?? $pokemon['sprites']['front_default'] ?? '';
            $types = array_map(fn($t) => formatName($t['type']['name'] ?? ''), $pokemon['types'] ?? []);
            $abilities = array_map(fn($a) => formatName($a['ability']['name'] ?? ''), $pokemon['abilities'] ?? []);
        ?>

        <section class="card border-0 shadow-sm overflow-hidden">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 text-center bg-light p-4">
                    <?php if ($image): ?>
                        <img class="img-fluid detail-img" src="<?php echo esc($image); ?>" alt="Official artwork of <?php echo esc($name); ?>">
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <div class="card-body p-4">
                        <h2 class="fw-bold"><?php echo esc($name); ?></h2>
                        <div class="mb-3">
                            <?php foreach ($types as $type): ?>
                                <span class="badge text-bg-primary me-1"><?php echo esc($type); ?></span>
                            <?php endforeach; ?>
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6"><strong>Pokédex ID:</strong> <?php echo esc($pokemon['id'] ?? 'N/A'); ?></div>
                            <div class="col-sm-6"><strong>Base Experience:</strong> <?php echo esc($pokemon['base_experience'] ?? 'N/A'); ?></div>
                            <div class="col-sm-6"><strong>Height:</strong> <?php echo esc($pokemon['height'] ?? 'N/A'); ?></div>
                            <div class="col-sm-6"><strong>Weight:</strong> <?php echo esc($pokemon['weight'] ?? 'N/A'); ?></div>
                            <div class="col-12"><strong>Abilities:</strong> <?php echo esc(implode(', ', $abilities)); ?></div>
                        </div>

                        <a class="btn btn-outline-primary mt-4" href="details.php?pokemon=<?php echo urlencode($pokemon['name']); ?>">Open Full Details</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php require_once '_footer.php'; ?>
