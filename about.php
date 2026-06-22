<?php
$pageTitle = 'About the Project';
$activePage = 'about';
$pageDescription = 'Learn about the project purpose, API source, PHP structure, and AI-assisted development process.';
require_once '_header.php';
?>

<main class="container my-5">
    <section class="card border-0 shadow-sm p-4 mb-4">
        <h2 class="fw-bold">Project Purpose</h2>
        <p>
            Pokédex Explorer was created for the ITEC 4366 Advanced Web Development midterm project.
            The purpose is to show how a PHP website can retrieve JSON data from an external API,
            decode it, process it, and display it in a clean Bootstrap interface.
        </p>
        <p>
            The intended audience is casual Pokémon fans and students who want to see how API data
            can power a small web application.
        </p>
    </section>

    <section class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h2 class="fw-bold">API Used</h2>
                <p>
                    This project uses PokéAPI, a free public API that provides Pokémon names, sprites,
                    types, abilities, stats, and other data. No API key is required.
                </p>
                <p>
                    PHP retrieves the JSON using <code>file_get_contents()</code> and converts it into
                    associative arrays using <code>json_decode()</code>.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h2 class="fw-bold">Reusable Templates</h2>
                <p>
                    The website uses <code>_header.php</code> and <code>_footer.php</code> so the navigation,
                    Bootstrap links, page header, footer, and helper functions are not repeated manually
                    across every page.
                </p>
            </div>
        </div>
    </section>

    <section class="card border-0 shadow-sm p-4 mt-4">
        <h2 class="fw-bold">AI Use</h2>
        <p>
            AI was used to brainstorm the project idea, generate starter PHP and Bootstrap structure,
            and help organize the video presentation plan. I still had to test the API requests,
            check the page output, understand the PHP include structure, and make sure the project
            met the assignment requirements.
        </p>
    </section>
</main>

<?php require_once '_footer.php'; ?>
