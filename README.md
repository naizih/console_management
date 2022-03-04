<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<hr>



# Application Serveur managment
c'est un simple application de gerér les données reçu de application cryptolocker, et on a utilisé MySQL comme base de données pour cette application.



## Installation d'application
On a utilisé l'Os ubuntu pour cette application.
Et cette application est devloppé dans le framwork Laravel.


## installation de serveur web (apache)
```
sudo apt-get install apache2
sudo systemctl enable apache2
sudo systemctl start apache2

```

## Installation de php et dépendancies
```
sudo apt install php7.4-cli php7.4-curl phpunit libapache2-mod-php7.4

```

# installation et configuration de BDD MySQL
Dans cette étap on install serveur mysql et on crée une BDD et une utilisateur dans ce serveur.
```
sudo apt-get install mysql-server
sudo mysql -u root
CREATE DATABASE serveur_management;
CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'Password@312';
GRANT ALL PRIVILEGES ON serveur_management.* TO 'laravel'@'localhost' WITH GRANT OPTION;
```


##### installation de driver pour mysql
Dans cette étap on installe le dépendance pour connecter le code php avec serveur SQL.
```
sudo apt-get install php-mysql
```

## Installation composer et passé au Version 2

par défaut le dossier ** /var/www/html ** n'a pas de permission d'ecriteur, alors soit donner le permission à ce dossier soit aller dans le repértoire /home et finir cette étap.
```
sudo apt install composer
sudo curl -s https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
cd /var/www/html/cryptolocker
sudo composer update
```

## Installation des dépendance de base et clonner le projet
```
sudo apt-get install git curl
cd /var/www/html
sudo git clone --branch v1.4 https://github.com/naizih/console_management.git
```




## Configuration de serveur apache2 pour laravel
Aller dans le fichier ** /etc/apache2/sites-available/000-default.conf ** et modifier la ligne suivant DocumentRoot:
```
DocumentRoot /var/www/html/console_management/public
```

ajouter le code suivant à la fin de fichier ** /etc/apache2/apache2.conf **  
```
<Directory /var/www/html/console_management>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```

et puis executer les commande suivant.
```
sudo a2enmod rewrite
sudo systemctl restart apache2
```


## Generer le clé s'il n'existe pas par défault
```
sudo php artisan key:generate
```

## Droit
```
cd /var/www/html/
sudo chown -R www-data:www-data console_management
```


## Migrate
```
sudo php artisan migrate
```


## Create role
Crée un régle avant de crée le premier utilisateur, car l'utilisateur a un foreign key qui fait le lien avec la table roles.
```
sudo mysql -u root
use serveur_management;
INSERT INTO roles(name, slug) VALUES ('administrateur', 'admin');
exit

```
















