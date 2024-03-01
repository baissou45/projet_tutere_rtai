## Installation des dépendaces
```
composer install ou composer update
```

## Configuration de la base de données
- Vous dupliquez le fichier .env.exemple et le renommé en .env
- A la ligne 14 du fichier .env, changer le nom de la base de données
- Aux lignes 15 et 16 fichier .env, configurer les accès à votre base de données


## Générer les tables et les remplir

```
php artisan migrate:fresh --seed
```


## Lancer le projet

```
php artisan serv
```

Le projet peut être consulter suivant le lien ci-après

```
http://localhost:8000/
```


## API

L'api peut être consulter suivant le lien ci-après

```
http://localhost:8000/docs/api
```