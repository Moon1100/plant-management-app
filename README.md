# plant-management-app

An internal plant management application built on Laravel + Livewire. This README covers setup, common developer tasks, and how to use the project-level features added here (Types/tags, Plant updates with observations, and Livewire UI pieces).

## Quick start (developer)

Requirements
- PHP 8.x (use the same PHP version configured for the project)
- Composer
- Node.js + npm (for frontend assets)
- SQLite / MySQL configured via `.env`

Steps

1. Copy environment and install dependencies

	 cp .env.example .env
	 composer install
	 npm install

2. Configure .env

	 - Set DB_CONNECTION, DB_DATABASE (or other DB config) in `.env`.
	 - Set APP_URL if you plan to scan QR codes linking back to this app.

3. Storage and key

	 php artisan key:generate
	 php artisan storage:link

4. Run migrations and seeders

	 php artisan migrate
	 php artisan db:seed --class=DatabaseSeeder

	 The DatabaseSeeder will also call the project Type seeder and attach sample types to existing plants. If you need only types:

	 php artisan db:seed --class=Database\Seeders\TypeSeeder

5. Build assets and serve

	 npm run dev
	 php artisan serve

6. Visit the app in your browser (default http://127.0.0.1:8000).

## Main features (what I added / where to look)

- Types (tags) — Many-to-many with Plant
	- Model: `app/Models/Type.php`
	- DB: `types` table + pivot `plant_type` (migrations in `database/migrations/2025_10_22_*`)
	- Seeder: `database/seeders/TypeSeeder.php` (creates 10 sample types)

- Searchable pill-style Type selector (create-if-missing)
	- Livewire component: `app/Livewire/TypeSelector.php`
	- Blade view: `resources/views/livewire/type-selector.blade.php`
	- Used by: `resources/views/livewire/plant-create-form.blade.php` and `resources/views/livewire/plant-edit-form.blade.php`
	- Behavior: search types, click pill to select/deselect, or add a new type inline. The selector emits selected type IDs to the parent component.

- Plant create/edit
	- Create: Livewire component `app/Livewire/PlantCreateForm.php` and view `resources/views/livewire/plant-create-form.blade.php`.
	- Edit: Livewire component `app/Livewire/PlantEditForm.php` and view `resources/views/livewire/plant-edit-form.blade.php`. This page replaces the previous empty edit view so editing is now interactive.

- Plant updates (notes/observations) — CRUD + List / Calendar view
	- Livewire manager: `app/Livewire/PlantUpdateManager.php`
	- View: `resources/views/livewire/plant-update-manager.blade.php`
	- DB: `plant_updates` table (migrations extended with title, description, height, pests, diseases)
	- Usage: On the plant show page the updates manager allows creating, editing and deleting updates and toggling between a list view and a simple calendar-grouped view.

## How to use the Type selector

 - On plant create or edit screens type into the "Search types..." box to filter types.
 - Click a pill to toggle selection — selected pills are green.
 - If the type doesn't exist, type the name in the small input and press "Add" to create and automatically select it.

## Plant updates / observations

 - On the plant show page (owner view) open the Updates area.
 - Use the form at the bottom to add observation notes: title, description, height, pests, diseases, and photos.
 - Use Edit/Delete buttons on each update to modify or remove it.
 - Toggle between List and Calendar view for different visualizations.

## Development notes & tips

- Livewire: components live in `app/Livewire` and their blades under `resources/views/livewire`.
- When adding new Livewire components, remember to clear compiled views and assets if needed:

	php artisan view:clear
	php artisan route:clear

- If images do not show up after upload, ensure `php artisan storage:link` was run and your filesystem disk is configured correctly in `config/filesystems.php`.

## Troubleshooting

- Migration errors: if migrations fail due to existing schema differences (this repo has migrations added while developing), you can reset local DB (careful - destructive):

	php artisan migrate:reset
	php artisan migrate

- Seeder parse errors: If you see parse errors in seeders, open the seeder and ensure there are no stray control characters or emoji in array literals (use plain ASCII strings for safety in environments with different encodings).

## Next improvements (ideas)

- Add full admin UI for Types (edit/delete) and validation to prevent duplicate names/codes.
- Replace the simple calendar with an interactive calendar (FullCalendar) for drag/drop scheduling and better UX.
- Add per-photo delete controls for PlantUpdate photos.

## Where to get help

 - Read Livewire docs: https://laravel-livewire.com/docs
 - Read Laravel docs: https://laravel.com/docs

If you'd like I can add quick gifs/screenshots for the Type selector and Update manager UI.

