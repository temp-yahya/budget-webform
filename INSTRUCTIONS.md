Go into the `budget-webform/` folder in VS Code, open terminal, and run:

```sh
docker run --name myXampp -p 41061:22 -p 41062:80 -d -v .:/www tomsik68/xampp:7
```

Run the following command and copy the container ID:

```sh
docker ps
```

Access the running container's shell:

```sh
docker exec -it CONTAINER_ID /bin/bash
```

Create a symlink to the `php` binary:

```sh
ln -s /opt/lampp/bin/php /usr/bin/php
```

Install CA certificates:

```sh
apt-get update && apt-get install -y ca-certificates
```

Install Composer:

```sh
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
```

Change directory to `www/`, and run:

```sh
composer update
```
