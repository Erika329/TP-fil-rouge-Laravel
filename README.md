# TP Fil Rouge - Gestion Ticketing 

## Installation & Lancement

```
git clone <repo>
cd TP-fil-rouge
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

**Accès:**
```
Créer un compte ou:
Admin: admin@ticketing.local / password
Collaborateur: erika@exemple.fr / password 
Client: contact@nova.fr / password
```

## Fonctionnalités 

### CRUD + BDD
- Tickets (create/read/update/delete/time entries)
- Projets/clients/contrats
- Rôles DB (admin/collaborateur/client)

### API REST Sanctum
```
localhost:8000/api/v1/tickets (auth:sanctum)
GET/POST/PUT tickets JSON
F12 → login → /tickets → filtre → Network api/tickets 200 OK
```

### Rôles & Sécurité
- Middleware `role:admin`
- Client: tickets projets propres
- Dashboard role-based


## Architecture
```
Models: User/Ticket/Project/Client/Contract/TimeEntry
Controllers: TicketController (CRUD + API)
Routes: web.php + api.php (v1)
Middleware: RoleMiddleware
Auth: Session + Sanctum SPA
```


