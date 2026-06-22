# Pokédex Explorer — ITEC 4366 Midterm Project

## Project Purpose
Pokédex Explorer is a multi-page PHP website that uses live JSON data from PokéAPI. The site allows users to search for Pokémon, view detailed stats, and browse Pokémon by type.

## API Used
This project uses [PokéAPI](https://pokeapi.co/). No API key is required.

Example endpoints used:
- `https://pokeapi.co/api/v2/pokemon/pikachu`
- `https://pokeapi.co/api/v2/type/electric`

## Major Features
- Multi-page PHP website
- Reusable `_header.php` and `_footer.php` template files
- Bootstrap 5 responsive design
- Search form using query string values
- Detail page using `details.php?pokemon=name`
- Type filtering using `types.php?type=electric`
- JSON retrieval with `file_get_contents()`
- JSON parsing with `json_decode()`
- Safe output using `htmlspecialchars()`

## Setup Instructions
1. Place the project folder in your local server folder, such as:
   `/Applications/XAMPP/xamppfiles/htdocs/PatelMidterm`
2. Start Apache in XAMPP.
3. Open the site at:
   `http://localhost/PatelMidterm/`

## Project Structure
- `index.php` — homepage with featured Pokémon
- `pokemon.php` — search page
- `details.php` — detail page for one Pokémon
- `types.php` — browse Pokémon by type
- `about.php` — project explanation
- `_header.php` — shared metadata, navigation, helper functions
- `_footer.php` — shared footer and Bootstrap script
- `style.css` — custom styling

