<p align="center">
  <a href="https://laravel-simpleapi.onrender.com">
    <img src="https://raw.githubusercontent.com/Komodo2041/laravel_simpleapi/main/screenshot.png" width="700"/>
  </a>
</p>

<h1 align="center">Simple Todo API – Laravel 11</h1>

<p align="center">
  <strong>REST API | CRUD | MySQL | Docker | Live Demo</strong><br>
  <a href="https://laravel-simpleapi.onrender.com/api/todos">Live API</a> • 
  <a href="https://github.com/Komodo2041/laravel_simpleapi">GitHub</a>
</p>

<p align="center">
  <a href="https://github.com/Komodo2041"><img src="https://img.shields.io/badge/PHP-Laravel-red" alt="Laravel"></a>
  <a href="https://laravel-simpleapi.onrender.com"><img src="https://img.shields.io/badge/Live-Demo-brightgreen" alt="Live"></a>
</p>

---

## Funkcje
- CRUD zadań (GET, POST, PUT, DELETE)
- Walidacja danych
- REST API (JSON)
- MySQL + migracje

## Endpointy

| Metoda | URL | Opis |
|-------|-----|------|
| `GET` | `/api/todos` | Lista zadań |
| `POST` | `/api/todos` | `{ "title": "Zrobić zakupy" }` |
| `PUT` | `/api/todos/1` | Oznacz jako ukończone |
| `DELETE` | `/api/todos/1` | Usuń |

## Tech stack
- Laravel 11
- MySQL
- PHP 8.2
- Render.com (hosting)

## Uruchomienie lokalnie
```bash
git clone https://github.com/Komodo2041/laravel_simpleapi.git
cd laravel_simpleapi
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve