# How to start

In order to start this project, follow these steps:

```
docker compose up -d
```

```
docker compose exec php composer install
```

```
docker compose exec php drush site:install --existing-config --account-pass=1234
```

```
docker compose exec php drush cim
```

Then follow the link: http://devjobs.docker.localhost:8000/

# Sign in as admin:

follow the link: http://devjobs.docker.localhost:8000/user

username: admin
password: 1234
