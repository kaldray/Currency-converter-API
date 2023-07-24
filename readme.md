# 1. Concurrency API

## 1.1. Commencer {#commencer}

Afin de lancer démarrer le projet il faudra installer les dépendances.

### 1.1.1. Pré-requis

- Avoir docker sur sa machine : **wefashion**

### 1.1.2. Installation

A la racine du projet

```
pnpm dev
```

Une fois les dépendances installer :

```

docker compose exec api php artisan migrate:fresh --seed

```

### 1.1.3. Lancer le projet

```
ADMIN : http://localhost:5173
API : http://localhost:8000
```

## 1.2. Usage

le compte administrateur est : test@test.com
le mot de passe est : test