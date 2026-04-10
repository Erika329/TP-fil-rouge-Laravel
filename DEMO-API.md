# Test API Tickets

## 1. Login (sanctum cookie)
```
http://127.0.0.1:8000/login
erika@exemple.fr / password
```

## 2. Test API (F12 → Network)

**GET Liste**:
```
GET /api/v1/tickets
Cookie: session=...
```
Filtre `?status=en_cours`

**POST Create** (form-data or JSON):
```
POST /api/v1/tickets
Content-Type: application/json

{
  "titre": "Test API ticket",
  "projet": 1,
  "description": "Via API!",
  "type": "inclus", 
  "statut": "nouveau",
  "priorite": "moyenne",
  "estimation": 2.5
}
```

**Response**:
```
201 Created
{
  "id": 4,
  "title": "Test API ticket",
  ...
}
```

## curl (terminal)
```
curl -X POST http://127.0.0.1:8000/api/v1/tickets \
  -H "Content-Type: application/json" \
  -H "X-XSRF-TOKEN: [token from /sanctum/csrf-cookie]" \
  -b "laravel_session=..." \
  -d '{"titre":"Curl ticket","projet":1,"description":"Curl!","type":"inclus","statut":"nouveau"}'
```

**DevTools** → Network → tickets → voir AJAX!
