# cinetic
Projet. Premier reseau social pour les cinéphile

# pour demarrer le projet:

etape 1:

1- dans le repertoire du projet taper la cmd : docker-compose up

2- acceder aux services :
    - application: http://localhost:3000
    - phpmyadmin: http://localhost:3001

3- dump database (export base de données) : 

    -   docker container list

    -   docker exec -i CONTAINER_SQL_ID mysqldump -u root --password=1234 cineticbd > backup_cineticbd.sql