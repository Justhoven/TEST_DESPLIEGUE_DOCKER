# PASOS PARA DESPLIEGUE AUTOMÁTICO CON DOCKER:

1. Hacemos la estructura:

    
    /docker_cine
        |-- /.github
            |-- /workflows
                |-- deploy.yml
        |-- /mysql
            |-- cine.sql
            |-- Dockerfile
        |-- /php
            |-- Dockerfile
            |-- index.php
        |-- compose.yml
        |-- -gitignore


    ## APUNTES:
    - cine.sql puede ser un archivo que ya me den o un codigo a copiar, en cuyo caso, sí crearía cine.sql y copio el código.

    - index.php es la conexión mysqli a la BD y la aplicación.


2. Creamos un repositorio GitHub. Ponemos los secretos:

    - DOCKER_PASSWORD --> Contraseña de DockerHub (8cen456,D)
    - DOCKER_USERNAME --> Usuario de DockerHub (justhoven)
    - REMOTE_HOST --> IP de la instancia
    - REMOTE_KEY --> Clave PEM
    - REMOTE_USER --> Usuario de la MV EC2 (ubuntu)


3. Creamos instancia AWS con IP elástica y claves vockey (si no la tenemos ya creada)

    ## IMPORTANTE, GRUPOS DE SEGURIDAD. 
    Debemos permitir que se pueda acceder desde el puerto 8080 y 8081 (para Docker y phpMyAdmin)


4. Instalamos Docker y Docker Compose en la MV:

    ### DOCKER:

    - sudo apt-get update
    - sudo apt-get upgrade
    - sudo apt-get install apt-transport-https ca-certificates curl software-properties-common
    - curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
    - sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
    - sudo apt-get update
    - sudo apt-get install docker-ce
    - sudo systemctl status docker      (este comando verifica que funciona, 'q' para salir)

    ### DOCKER COMPOSE:

    - sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    - sudo chmod +x /usr/local/bin/docker-compose
    - docker-compose --version          (verificar instalación)

    ### RECOMENDADO
    Para usar Docker por comando sin SUDO:

    - sudo usermod -aG docker ubuntu


5. Rellenamos deploy.yml, los Dockerfiles y el compose.yml

    - Copiar de aquí y hacer los cambios pertinentes.
    - Cambiar también los correos, si no, la imagen se sube al DockerHub de Roberto!


6. Add, Commit y Push. Si quiero renombrar rama de master a main:

    - git branch -m main


7. Accedo a:

    - IP:8080/mi_app_cine   (en este caso).
    - IP:8081               (phpMyAdmin)


## POSIBLES FALLOS

Si al hacer un despliegue automático da error porque no tengo suficiente espacio en el dispositivo (MV), debido a que me he equivocado y he subido a la MV con la cuenta DockerHub del profe, ir a la terminal de la MV y poner:

- docker images                                 (para ver las imágenes)
- docker rmi usuario_dockerhub/aplicación:v1    (borramos las que no interesen)

