<?php
$pageTitle = 'Browse by Type';
$activePage = 'types';
$pageDescription = 'Choose a Pokémon type and display matching Pokémon from the API.';
require_once '_header.php';

$selectedType = isset($_GET['type']) ? strtolower(trim($_GET['type'])) : 'electric';
$safeType = preg_replace('/[^a-z\-]/', '', $selectedType);
$typeData = apiGetJson('https://pokeapi.co/api/v2/type/' . urlencode($safeType));
$availableTypes = ['normal','fire','water','electric','grass','ice','fighting','poison','ground','flying','psychic','bug','rock','ghost','dragon','dark','steel','fairy'];
?>

<main class="container my-5">
    <section class="card border-0 shadow-sm p-4 mb-4">
        <h2 class="fw-bold">Browse Pokémon Types</h2>
        <p>Select a type to send a user-selected request to PokéAPI.</p>

        <form class="row g-2" action="types.php" method="get">
            <div class="col-md-9">
                <label for="type" class="form-label">Type</label>
                <select id="type" name="type" class="form-select form-select-lg">
                    <?php foreach ($availableTypes as $type): ?>
                        <option value="<?php echo esc($type); ?>" <?php echo $type === $safeType ? 'selected' : ''; ?>>
                            <?php echo esc(formatName($type)); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary btn-lg w-100" type="submit">Filter</button>
            </div>
        </form>
    </section>

    <?php if ($typeData === null): ?>
        <div class="alert alert-warning">That type could not be loaded. Please choose a different type.</div>
    <?php else: ?>
        <?php $pokemonList = array_slice($typeData['pokemon'] ?? [], 0, 24); ?>
        <section>
            <h2 class="fw-bold mb-3"><?php echo esc(formatName($safeType)); ?> Type Pokémon</h2>
            <div class="row g-3">
                <?php foreach ($pokemonList as $entry): ?>
                    <?php
                        $pokemonName = $entry['pokemon']['name'] ?? '';
                    ?>
                    <div class="col-sm-6 col-lg-3">
                        <a class="type-result-card text-decoration-none" href="details.php?pokemon=<?php echo urlencode($pokemonName); ?>">
                            <?php echo esc(formatName($pokemonName)); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php require_once '_footer.php'; ?>
