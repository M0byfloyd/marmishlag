# Wordpress W3

Voilà la codebase du cours WP pour les W3

```shell
docker-compose up -d
```

Rendez vous sur http://localhost:2345

Commande de génération du dump:
```shell
docker exec db mysqldump -umarmishuse -p'marmishpass' marmishmish > marmishmish-database-backup.sql
```