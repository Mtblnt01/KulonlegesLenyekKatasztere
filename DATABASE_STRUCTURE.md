# Különleges Lények Katasztere - Adatbázis Struktúra

## Összefoglaló

✅ **7 tábla** létrehozva a MySQL adatbázisban (`kulonleges_lenyek_katasztere`)  
✅ **5 kapcsolat** implementálva az Eloquent modellekben  
✅ **12 API végpont** Laravel Sanctum authentikációval  
✅ **FormRequest validáció** minden bemenetre  

---

## Táblák

### 1. **users** (Laravel alap)
| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint | Elsődleges kulcs |
| name | string | Felhasználó neve |
| email | string | Email cím (unique) |
| password | string | Jelszó (hashed) |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

**Model:** `App\Models\User`  
**Kapcsolatok:** 
- `hasMany(Creature::class)` - Egy felhasználóhoz több lény tartozhat

---

### 2. **categories** (Kategóriák)
| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint | Elsődleges kulcs |
| name | string | Kategória neve |
| description | text | Leírás (nullable) |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

**Model:** `App\Models\Category`  
**Kapcsolatok:** 
- `hasMany(Creature::class)` - Egy kategóriához több lény tartozhat

**Seed adatok:**
- Mitológiai lények
- Mágikus lények
- Óriások
- Sárkányok
- Éjszakai lények

---

### 3. **creatures** (Lények)
| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint | Elsődleges kulcs |
| user_id | bigint | Felhasználó FK (nullable) |
| category_id | bigint | Kategória FK (nullable) |
| name | string | Lény neve |
| description | text | Leírás |
| origin | string | Származási hely |
| danger_level | integer | Veszélyességi szint (1-10) |
| is_magical | boolean | Mágikus-e |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

**Model:** `App\Models\Creature`  
**Kapcsolatok:** 
- `belongsTo(User::class)` - Melyik felhasználó hozta létre
- `belongsTo(Category::class)` - Melyik kategóriába tartozik
- `belongsToMany(Ability::class)` - Milyen képességekkel rendelkezik (N:N)
- `hasMany(GalleryImage::class)` - Galéria képei
- `hasMany(Event::class)` - Kapcsolódó események

---

### 4. **abilities** (Képességek)
| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint | Elsődleges kulcs |
| name | string | Képesség neve |
| description | text | Leírás |
| type | string | Típus (ofenzív/defenzív/támogató) |
| power_level | integer | Erősségi szint (1-10) |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

**Model:** `App\Models\Ability`  
**Kapcsolatok:** 
- `belongsToMany(Creature::class)` - Mely lények rendelkeznek ezzel (N:N)

**Seed adatok:** 8 képesség (Tűzlehelet, Láthatatlanság, Gyógyítás, stb.)

---

### 5. **ability_creature** (Pivot tábla)
| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint | Elsődleges kulcs |
| ability_id | bigint | Képesség FK |
| creature_id | bigint | Lény FK |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

**Kapcsolat:** Lények ↔ Képességek (N:N)

---

### 6. **events** (Események)
| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint | Elsődleges kulcs |
| creature_id | bigint | Lény FK (cascade) |
| name | string | Esemény neve |
| description | text | Leírás (nullable) |
| event_date | date | Esemény dátuma |
| location | string | Helyszín (nullable) |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

**Model:** `App\Models\Event`  
**Kapcsolatok:** 
- `belongsTo(Creature::class)` - Melyik lényhez tartozik

**Seed adatok:** ~7 esemény (Első megjelenés, Csata, Békés találkozás, stb.)

---

### 7. **gallery_images** (Galéria képek)
| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint | Elsődleges kulcs |
| creature_id | bigint | Lény FK (cascade) |
| image_path | string | Kép útvonala |
| title | string | Cím (nullable) |
| description | text | Leírás (nullable) |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

**Model:** `App\Models\GalleryImage`  
**Kapcsolatok:** 
- `belongsTo(Creature::class)` - Melyik lényhez tartozik

---

### 8. **contacts** (Kapcsolat üzenetek)
| Mező | Típus | Leírás |
|------|-------|--------|
| id | bigint | Elsődleges kulcs |
| name | string | Feladó neve |
| email | string | Email cím |
| subject | string | Tárgy |
| message | text | Üzenet |
| is_read | boolean | Olvasott-e |
| created_at | timestamp | Létrehozás |
| updated_at | timestamp | Módosítás |

**Model:** `App\Models\Contact`  
**Kapcsolatok:** Nincs

---

## Kapcsolatok (Relationships)

### 1. **User → Creature (1:N)**
- Egy felhasználó több lényt is létrehozhat
- Creature táblában: `user_id` foreign key
- Laravel: `User::hasMany(Creature::class)` és `Creature::belongsTo(User::class)`

### 2. **Category → Creature (1:N)** 
- Egy kategóriába több lény tartozhat
- Creature táblában: `category_id` foreign key
- Laravel: `Category::hasMany(Creature::class)` és `Creature::belongsTo(Category::class)`

### 3. **Creature ↔ Ability (N:N)**
- Egy lénynek több képessége lehet
- Egy képességgel több lény is rendelkezhet
- Pivot tábla: `ability_creature`
- Laravel: `belongsToMany` mindkét irányban

### 4. **Creature → Event (1:N)**
- Egy lényhez több esemény tartozhat
- Event táblában: `creature_id` foreign key (cascade delete)
- Laravel: `Creature::hasMany(Event::class)` és `Event::belongsTo(Creature::class)`

### 5. **Creature → GalleryImage (1:N)**
- Egy lényhez több galéria kép tartozhat
- GalleryImage táblában: `creature_id` foreign key (cascade delete)
- Laravel: `Creature::hasMany(GalleryImage::class)` és `GalleryImage::belongsTo(Creature::class)`

---

## API Végpontok

### Authentikáció
1. `POST /api/login` - Bejelentkezés (publikus)
2. `POST /api/logout` - Kijelentkezés (védett)

### Lények (Creatures)
3. `GET /api/creatures` - Lista (védett)
4. `GET /api/creatures/{id}` - Részletek (védett)
5. `POST /api/creatures` - Létrehozás (védett)
6. `PUT /api/creatures/{id}` - Módosítás (védett)
7. `DELETE /api/creatures/{id}` - Törlés (védett)

### Képességek
8. `POST /api/creatures/{id}/abilities` - Képesség hozzárendelése (védett)
9. `DELETE /api/creatures/{id}/abilities/{abilityId}` - Képesség eltávolítása (védett)

### Galéria
10. `GET /api/creatures/{id}/gallery` - Galéria képek listája (védett)
11. `POST /api/creatures/{id}/gallery` - Kép feltöltése (védett)

### Kapcsolat
12. `POST /api/contact` - Kapcsolat üzenet küldése (publikus)

---

## Környezeti beállítások (.env)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kulonleges_lenyek_katasztere
DB_USERNAME=root
DB_PASSWORD=
```

---

## Migráció és Seed parancsok

```bash
# Adatbázis létrehozása (PHP script)
php create_database.php

# Migráció futtatása (fresh - összes tábla újralétrehozása)
php artisan migrate:fresh

# Seed adatok betöltése
php artisan db:seed

# Vagy mindkettő egyben
php artisan migrate:fresh --seed

# Adatbázis ellenőrzése
php check_database.php
```

---

## Tesztelés

**Teszt felhasználó:**
- Email: `admin@example.com`
- Jelszó: `password123`

**cURL példa - Login:**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"password123"}'
```

**cURL példa - Lények listázása:**
```bash
curl -X GET http://localhost:8000/api/creatures \
  -H "Authorization: Bearer {token}"
```
