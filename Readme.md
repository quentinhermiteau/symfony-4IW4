# Symfony commands

Start docker containers

```console
make start
```

Stop docker containers

```console
make stop
```

Start symfony server

```
symfony server:start
```

Update doctrine schema

```
symfony console doctrine:schema:update --force
symfony console d:s:u --force
```

Créer une entité

```
symfony console make:entity
```

Créer un CRUD

```
symfony console make:crud
```

Créer un utilisateur

```
symfony console make:user
```

Générer le formulaire de création de compte

```
symfony console make:registration-form
```
