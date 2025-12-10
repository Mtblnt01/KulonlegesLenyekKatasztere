# Különleges Lények Katasztere - API Documentation

## Alap URL
```
http://localhost:8000/api
```

## Authentikáció

A védett végpontokhoz Bearer tokent kell használni:
```
Authorization: Bearer {your-token}
```

---

## 1. AUTH Végpontok

### POST /api/login
Bejelentkezés és token generálás.

**Request:**
```json
{
  "email": "admin@example.com",
  "password": "password123"
}
```

**Response (200):**
```json
{
  "message": "Login successful",
  "access_token": "1|xxxxxxxx",
  "token_type": "Bearer",
  "user": {
    "id": 1,
    "name": "Admin User",
    "email": "admin@example.com"
  }
}
```

### POST /api/logout
Kijelentkezés és token érvénytelenítése. **[Védett]**

**Headers:**
```
Authorization: Bearer {token}
```

**Response (200):**
```json
{
  "message": "Logout successful"
}
```

---

## 2. CREATURES (Lények) CRUD

### GET /api/creatures
Összes lény listázása. **[Védett]**

**Response (200):**
```json
{
  "message": "Creatures retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Tűzsárkány",
      "category": "Sárkány",
      "description": "Egy ősi, tűzokádó sárkány...",
      "origin": "Kárpátok",
      "danger_level": 10,
      "is_magical": true,
      "abilities": [...],
      "gallery_images": [...]
    }
  ]
}
```

### GET /api/creatures/{id}
Egy konkrét lény részletei. **[Védett]**

**Response (200):**
```json
{
  "message": "Creature retrieved successfully",
  "data": {
    "id": 1,
    "name": "Tűzsárkány",
    "category": "Sárkány",
    "description": "...",
    "abilities": [...],
    "gallery_images": [...]
  }
}
```

### POST /api/creatures
Új lény létrehozása. **[Védett]**

**Request:**
```json
{
  "name": "Kristályfarkascska",
  "category": "Farkas",
  "description": "Kristályos szőrzetű farkas",
  "origin": "Bükk hegység",
  "danger_level": 5,
  "is_magical": true
}
```

**Response (201):**
```json
{
  "message": "Creature created successfully",
  "data": {
    "id": 6,
    "name": "Kristályfarkascska",
    ...
  }
}
```

### PUT /api/creatures/{id}
Lény módosítása. **[Védett]**

**Request:**
```json
{
  "name": "Módosított név",
  "danger_level": 7
}
```

**Response (200):**
```json
{
  "message": "Creature updated successfully",
  "data": {...}
}
```

### DELETE /api/creatures/{id}
Lény törlése. **[Védett]**

**Response (200):**
```json
{
  "message": "Creature deleted successfully"
}
```

---

## 3. ABILITIES (Képességek)

### POST /api/creatures/{id}/abilities
Képesség hozzárendelése lényhez. **[Védett]**

**Request:**
```json
{
  "ability_id": 3
}
```

**Response (200):**
```json
{
  "message": "Ability attached successfully",
  "data": {
    "id": 1,
    "name": "Tűzsárkány",
    "abilities": [...]
  }
}
```

### DELETE /api/creatures/{id}/abilities/{abilityId}
Képesség eltávolítása lénytől. **[Védett]**

**Response (200):**
```json
{
  "message": "Ability detached successfully"
}
```

---

## 4. GALLERY (Galéria)

### GET /api/creatures/{id}/gallery
Lény galéria képeinek listázása. **[Védett]**

**Response (200):**
```json
{
  "message": "Gallery images retrieved successfully",
  "data": [
    {
      "id": 1,
      "creature_id": 1,
      "image_path": "gallery/xyz.jpg",
      "title": "Tűzlehelet",
      "description": "Akció közben"
    }
  ]
}
```

### POST /api/creatures/{id}/gallery
Kép feltöltése a lény galériájába. **[Védett]**

**Request (multipart/form-data):**
```
image: [file]
title: "Új kép címe"
description: "Leírás"
```

**Response (201):**
```json
{
  "message": "Image uploaded successfully",
  "data": {
    "id": 5,
    "creature_id": 1,
    "image_path": "gallery/abc123.jpg",
    "image_url": "http://localhost:8000/storage/gallery/abc123.jpg",
    "title": "Új kép címe"
  }
}
```

---

## 5. CONTACT (Kapcsolat)

### POST /api/contact
Kapcsolati üzenet mentése. **[Nyilvános]**

**Request:**
```json
{
  "name": "Kiss János",
  "email": "janos@example.com",
  "subject": "Kérdés",
  "message": "Szeretnék többet tudni a tűzsárkányról."
}
```

**Response (201):**
```json
{
  "message": "Contact message saved successfully",
  "data": {
    "id": 1,
    "name": "Kiss János",
    "email": "janos@example.com",
    "subject": "Kérdés",
    "message": "...",
    "is_read": false
  }
}
```

---

## API Végpontok Összegzése

### Authentikáció (2)
- ✅ POST /api/login
- ✅ POST /api/logout

### Creatures CRUD (5)
- ✅ GET /api/creatures
- ✅ GET /api/creatures/{id}
- ✅ POST /api/creatures
- ✅ PUT /api/creatures/{id}
- ✅ DELETE /api/creatures/{id}

### Képességek (2)
- ✅ POST /api/creatures/{id}/abilities
- ✅ DELETE /api/creatures/{id}/abilities/{abilityId}

### Galéria (2)
- ✅ GET /api/creatures/{id}/gallery
- ✅ POST /api/creatures/{id}/gallery

### Kapcsolat (1)
- ✅ POST /api/contact

**Összesen: 12 API végpont**

---

## Tesztelés lépései

1. **Indítsd el a szervert:**
```bash
php artisan serve
```

2. **Login és token megszerzése:**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"password123"}'
```

3. **Használd a tokent a védett végpontokhoz:**
```bash
curl -X GET http://localhost:8000/api/creatures \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

---

## Teszt adatok

**Felhasználó:**
- Email: `admin@example.com`
- Password: `password123`

**Lények:** 5 különleges lény (Tűzsárkány, Árnyékkígyó, stb.)

**Képességek:** 8 különböző képesség (Tűzlehelet, Láthatatlanság, stb.)
