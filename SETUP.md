# KÜLKAT - Különleges Lények Katasztere - Setup Guide

## 🚀 Gyors Telepítés

### 1. Navigálj a projekt mappába
```powershell
cd C:\xampp\htdocs\kulonlegesLenyekKatasztere\kulonlegesLenyekKatasztere
```

### 2. Seedek futtatása (már migráltunk!)
```powershell
php artisan db:seed
```

### 3. Storage link (képfeltöltéshez)
```powershell
php artisan storage:link
```

### 4. Szerver indítása
```powershell
php artisan serve
```

## ✅ Mit csináltunk?

- ✅ **7 migráció** létrehozva és futtatva
- ✅ **5 model** készült (User, Creature, Ability, GalleryImage, Contact)
- ✅ **6 FormRequest** validációs osztály
- ✅ **5 controller** (Auth, Creature, Gallery, Contact + ability methods)
- ✅ **12 API végpont** regisztrálva
- ✅ **Sanctum auth** beállítva
- ✅ **Seederek** (1 user, 5 creatures, 8 abilities)

## 🔑 Teszt Bejelentkezés

**Email:** `admin@example.com`  
**Jelszó:** `password123`

## 📋 API Végpontok (12 db)

### Auth (2)
- `POST /api/login` - Bejelentkezés
- `POST /api/logout` - Kijelentkezés ✅

### Creatures CRUD (5)
- `GET /api/creatures` - Lista ✅
- `GET /api/creatures/{id}` - Részletek ✅
- `POST /api/creatures` - Létrehozás ✅
- `PUT /api/creatures/{id}` - Módosítás ✅
- `DELETE /api/creatures/{id}` - Törlés ✅

### Képességek (2)
- `POST /api/creatures/{id}/abilities` - Hozzárendelés ✅
- `DELETE /api/creatures/{id}/abilities/{abilityId}` - Eltávolítás ✅

### Galéria (2)
- `GET /api/creatures/{id}/gallery` - Lista ✅
- `POST /api/creatures/{id}/gallery` - Feltöltés ✅

### Kapcsolat (1)
- `POST /api/contact` - Üzenet küldése

## 📖 Részletes Dokumentáció

Lásd: `API_DOCUMENTATION.md`

## 🎯 Következő lépés

Indítsd el a szervert és teszteld az endpointokat Postman-nel vagy a frontend Angular alkalmazással!

```powershell
php artisan serve
# Server: http://localhost:8000
```
