# Különleges Lények Katasztere

Egy Laravel 12 alapú REST API projekt különleges lények nyilvántartására és kezelésére.

## 🎯 Projekt Összefoglaló

Ez egy teljes értékű backend API Laravel Sanctum authentikációval, amely lehetővé teszi különleges lények, képességeik, eseményeik és galéria képeik kezelését.

### ✨ Főbb jellemzők

- ✅ **7 adatbázis tábla** MySQL-ben
- ✅ **5 kapcsolat (relationship)** az Eloquent ORM-ben
- ✅ **12 API végpont** Sanctum Bearer token authentikációval
- ✅ **FormRequest validáció** minden bemenetre
- ✅ **Seed adatok** gyors teszteléshez
- ✅ **RESTful API design**

## 📊 Adatbázis Struktúra

### Táblák:
1. **users** - Felhasználók (Laravel Sanctum)
2. **categories** - Lény kategóriák (pl. Sárkányok, Mágikus lények)
3. **creatures** - Lények (főtábla)
4. **abilities** - Képességek (pl. Tűzlehelet, Láthatatlanság)
5. **ability_creature** - Pivot tábla (N:N kapcsolat)
6. **events** - Események (lényekhez kapcsolódva)
7. **gallery_images** - Galéria képek (lényekhez kapcsolódva)
8. **contacts** - Kapcsolat form üzenetek

### Kapcsolatok:
1. **User → Creature (1:N)** - Egy felhasználó több lényt hoz létre
2. **Category → Creature (1:N)** - Kategóriák csoportosítása
3. **Creature ↔ Ability (N:N)** - Lények több képességgel rendelkeznek
4. **Creature → Event (1:N)** - Lényekhez kapcsolódó események
5. **Creature → GalleryImage (1:N)** - Lényekhez tartozó képek

## 🚀 Gyors Telepítés

### Követelmények:
- PHP 8.2+
- Composer
- MySQL (XAMPP ajánlott Windows-on)
- Laravel 12

### Telepítési lépések:

```bash
# 1. Függőségek telepítése
composer install

# 2. Környezeti fájl másolása
cp .env.example .env

# 3. App key generálása
php artisan key:generate

# 4. MySQL adatbázis létrehozása
php create_database.php

# 5. Migráció és seed adatok
php artisan migrate:fresh --seed

# 6. Storage link létrehozása (képfeltöltéshez)
php artisan storage:link

# 7. Szerver indítása
php artisan serve
```

Az API elérhető: `http://localhost:8000/api`

## 📚 Dokumentáció

- **[API_DOCUMENTATION.md](API_DOCUMENTATION.md)** - Teljes API referencia minden végponthoz
- **[DATABASE_STRUCTURE.md](DATABASE_STRUCTURE.md)** - Részletes adatbázis struktúra
- **[SETUP.md](SETUP.md)** - Gyors telepítési útmutató

## 🔐 Authentikáció

Laravel Sanctum Bearer token alapú authentikáció.

**Teszt felhasználó:**
- Email: `admin@example.com`
- Jelszó: `password123`

**Login példa:**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"password123"}'
```

## 🛠️ API Végpontok

### Auth (2)
- `POST /api/login` - Bejelentkezés
- `POST /api/logout` - Kijelentkezés

### Creatures - Lények (5)
- `GET /api/creatures` - Lista
- `GET /api/creatures/{id}` - Részletek
- `POST /api/creatures` - Létrehozás
- `PUT /api/creatures/{id}` - Módosítás
- `DELETE /api/creatures/{id}` - Törlés

### Abilities - Képességek (2)
- `POST /api/creatures/{id}/abilities` - Képesség hozzárendelése
- `DELETE /api/creatures/{id}/abilities/{abilityId}` - Képesség eltávolítása

### Gallery - Galéria (2)
- `GET /api/creatures/{id}/gallery` - Képek listája
- `POST /api/creatures/{id}/gallery` - Kép feltöltése

### Contact - Kapcsolat (1)
- `POST /api/contact` - Kapcsolat form

## 🧪 Tesztelés

```bash
# Adatbázis ellenőrzése
php check_database.php

# Unit tesztek (ha vannak)
php artisan test
```

## 📦 Seed Adatok

Az adatbázis a következő tesztadatokat tartalmazza:

- **1 felhasználó** (Admin User)
- **5 kategória** (Mitológiai lények, Mágikus lények, stb.)
- **5 lény** (Tűzsárkány, Árnyékkígyó, Kristálymanó, stb.)
- **8 képesség** (Tűzlehelet, Láthatatlanság, Gyógyítás, stb.)
- **~7 esemény** (Első megjelenés, Csata, stb.)

## 🔧 Technológiák

- **Laravel 12** - PHP framework
- **Laravel Sanctum** - API authentikáció
- **MySQL** - Adatbázis
- **Eloquent ORM** - Adatbázis kapcsolatok
- **FormRequest** - Validáció

## 📁 Projekt Struktúra

```
app/
├── Http/
│   ├── Controllers/Api/
│   │   ├── AuthController.php
│   │   ├── CreatureController.php
│   │   ├── GalleryController.php
│   │   └── ContactController.php
│   └── Requests/
│       ├── LoginRequest.php
│       ├── StoreCreatureRequest.php
│       ├── UpdateCreatureRequest.php
│       ├── AttachAbilityRequest.php
│       ├── UploadGalleryRequest.php
│       └── StoreContactRequest.php
├── Models/
│   ├── User.php
│   ├── Category.php
│   ├── Creature.php
│   ├── Ability.php
│   ├── Event.php
│   ├── GalleryImage.php
│   └── Contact.php
database/
├── migrations/
│   ├── 2025_12_10_080944_create_categories_table.php
│   ├── 2025_12_10_075238_create_creatures_table.php
│   ├── 2025_12_10_075240_create_abilities_table.php
│   ├── 2025_12_10_075241_create_ability_creature_table.php
│   ├── 2025_12_10_081131_create_events_table.php
│   ├── 2025_12_10_075243_create_gallery_images_table.php
│   └── ...
└── seeders/
    ├── CategorySeeder.php
    ├── AbilitySeeder.php
    ├── CreatureSeeder.php
    ├── EventSeeder.php
    └── DatabaseSeeder.php
routes/
└── api.php
```

## 💡 About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
