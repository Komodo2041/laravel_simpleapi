 
 

<h1 align="center">Laravel Simple API – Company & Worker CRUD</h1>

<p align="center">
  <strong>REST API | Laravel 11 | MySQL | Vue.js </strong><br>
 
  <a href="https://github.com/Komodo2041/laravel_simpleapi">GitHub</a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-red" alt="Laravel 11">
  <img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/MySQL-8.0-green" alt="MySQL">
  
</p>

---

## Opis projektu
Prosta, ale solidna **REST API** do zarządzania **firmami** i **pracownikami**.  
Na froncie użyteo Vue.js w połączeniu z Laravelem na backendzie 

---

## Endpointy API

### Firmy (Company)

| Metoda | Ścieżka | Opis | Przykład payload |
|-------|--------|------|------------------|
| `GET` | `/api/company` | Pobierz firmy | - |
| `POST` | `/api/company/add` | Dodaj firmę | `{ "name": "TechCorp", "city": "Warszawa" }` |
| `POST` | `/api/company/update/{id}` | Aktualizuj | `{ "name": "NewName" }` |
| `DELETE` | `/api/company/delete/{id}` | Usuń | – |

### Pracownicy (Worker)

| Metoda | Ścieżka | Opis | Przykład payload |
|-------|--------|------|------------------|
| `POST` | `/api/worker/add` | Dodaj pracownika | `{ "name": "Jan", "company_id": 1 }` |
| `POST` | `/api/worker/update/{id}` | Aktualizuj | `{ "name": "Jan Kowalski" }` |
| `DELETE` | `/api/worker/delete/{id}` | Usuń | – |

 

---

 