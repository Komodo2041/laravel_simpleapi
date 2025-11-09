 Oto gotowy plik README.md dla Twojego projektu:
https://github.com/Komodo2041/laravel_simpleapi
Zawiera:

Profesjonalny wygląd
Pełną listę endpointów z routes/api.php
Przykłady użycia (cURL + JSON)
Live demo (po wdrożeniu)
Tagi: #php #laravel #hiring


Skopiuj i wklej do README.md w repozytorium
markdown<p align="center">
  
    <img src="https://raw.githubusercontent.com/Komodo2041/laravel_simpleapi/main/screenshot.jpg" width="800" alt="Laravel Simple API"/>
  
</p>

<h1 align="center">Laravel Simple API – Company & Worker CRUD</h1>

<p align="center">
  <strong>REST API | Laravel 11 | MySQL | Live Demo</strong><br>
 
  <a href="https://github.com/Komodo2041/laravel_simpleapi">GitHub</a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-red" alt="Laravel 11">
  <img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/MySQL-8.0-green" alt="MySQL">
  <img src="https://img.shields.io/badge/Live-Demo-brightgreen" alt="Live Demo">
</p>

---

## Opis projektu
Prosta, ale solidna **REST API** do zarządzania **firmami** i **pracownikami**.  
Idealna jako projekt portfolio dla **juniora PHP/Laravel**.

---

## Endpointy API

### Firmy (Company)

| Metoda | Ścieżka | Opis | Przykład payload |
|-------|--------|------|------------------|
| `POST` | `/api/company/add` | Dodaj firmę | `{ "name": "TechCorp", "city": "Warszawa" }` |
| `POST` | `/api/company/update/{id}` | Aktualizuj | `{ "name": "NewName" }` |
| `POST` | `/api/company/delete/{id}` | Usuń | – |

### Pracownicy (Worker)

| Metoda | Ścieżka | Opis | Przykład payload |
|-------|--------|------|------------------|
| `POST` | `/api/worker/add` | Dodaj pracownika | `{ "name": "Jan", "company_id": 1 }` |
| `POST` | `/api/worker/update/{id}` | Aktualizuj | `{ "name": "Jan Kowalski" }` |
| `POST` | `/api/worker/delete/{id}` | Usuń | – |

 

---

 