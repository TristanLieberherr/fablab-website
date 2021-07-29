## Guide de déploiement
1. Installer MySql-server puis gérer les permissions des utilisateurs :
     - https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04-fr
    ```sh
    sudo apt install mysql-server
    mysql
    ```
    ```
    use mysql;
    CREATE USER 'distant'@'127.0.0.1' IDENTIFIED BY 'password';
    GRANT ALL PRIVILEGES ON *.* TO 'distant'@'127.0.0.1';
    GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost';
    UPDATE user SET plugin='mysql_native_password' WHERE User='root';
    CREATE DATABASE db;
    exit;
    ```
    ```sh
    service mysql restart
    ```

2. Configurer la connection à distance avec MySQL Workbench :
     - Connection method : Standard TCP/IP over SSH
     - SSH Hostname : 161.35.217.7 (ipv4)
     - SSH Username : root
     - SSH Keyfile : le fichier qui contient la clé SSH privée
     - MySQL Hostname : 127.0.0.1
     - MySQL port : 3306
     - Username : distant (le nom d'utilisateur créé plus haut)
  
3. Clonage du repo (git est déjà installé) : 
     - Aller dans le repo Github et copier le lien HTTPS
    ```sh
    cd /var/www
    git clone https://github.com/TristanLieberherr/fablab-website.git
    ```

4. Configurer VS Code pour pouvoir accéder au projet à distance :
    - Installer l'extension "Remote - SSH"
    - Ajouter un SSH Target, dans le terminal du dessus utiliser la commande pour se connecter
    ```sh
    ssh root@161.35.217.7  #user@ip_address
    ```
    - Sélectionner la plateforme Linux après avoir établi la connexion

5. Installation de Composer et des dépendances du projet :
   ```sh
    sudo apt update
    sudo apt-get install php-curl
    sudo apt install php-mbstring php-xml php-bcmath
    sudo apt-get install php libapache2-mod-php php-mysql
    sudo apt-get install composer

    composer install  #ne pas oublier de se mettre dans le dossier du projet !
    ```

6. Configuration de l'environnement Laravel : 
    ```sh
    cp .env.example .env
    ```
    - Dans le .env doit ressembler à ça :
    ```
    APP_NAME=Laravel
    APP_ENV=production
    APP_KEY=base64:haxsOwGikvOc0ZK2Qazqd2WNXK569UBWpMsNgbYs44U=
    APP_DEBUG=false
    APP_URL=tb21-lieberherr.heig-vd.ch

    LOG_CHANNEL=stack
    LOG_LEVEL=debug

    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=db
    DB_USERNAME="root"
    DB_PASSWORD=""

    BROADCAST_DRIVER=pusher
    CACHE_DRIVER=file
    QUEUE_CONNECTION=database
    SESSION_DRIVER=file
    SESSION_LIFETIME=120

    MEMCACHED_HOST=127.0.0.1

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.heig-vd.ch
    MAIL_PORT=25
    MAIL_USERNAME=
    MAIL_PASSWORD=
    MAIL_ENCRYPTION=
    MAIL_FROM_ADDRESS=service-fablab@heig-vd.ch
    MAIL_FROM_NAME="Service Travaux FabLab"

    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=

    PUSHER_APP_ID="1191165"
    PUSHER_APP_KEY="23d1749ad2b7bf6d3315"
    PUSHER_APP_SECRET="c97b9e73b31a0a1331ad"
    PUSHER_APP_CLUSTER="eu"

    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

    LARAVEL_WEBSOCKETS_PORT=6001
    LARAVEL_WEBSOCKETS_SSL_LOCAL_CERT="/etc/letsencrypt/live/tb21-lieberherr.heig-vd.ch/cert.pem"
    LARAVEL_WEBSOCKETS_SSL_LOCAL_PK="/etc/letsencrypt/live/tb21-lieberherr.heig-vd.ch/privkey.pem"
    ```
    ```sh
    php artisan migrate --seed
    php artisan config:clear
    ```

7. Installation et configuration d'Apache (pour la version finale) : https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-14-04-lts
    ```sh
    sudo apt update
    sudo apt install apache2

    sudo chmod -R 755 /var/www/fablab-website
    #cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/fablab-website.conf
    nano 000-default.conf
    ```
    - Ajouter/modifier les lignes suivantes : 
    ```
    DocumentRoot /var/www/fablab-website/public
    ServerName tb21-lieberherr.heig-vd.ch
    ```
    ```sh
    nano /etc/apache2/mods-enabled/dir.conf

    <IfModule mod_dir.c>
      DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm  #mettre le index.php en premier
    </IfModule>

    a2ensite 000-default.conf
    a2enmod rewrite
    systemctl reload apache2
    ```
    - Ajouter dans public/.htaccess :
    php_value upload_max_filesize 5M

8. Installation et mise en route de Supervisor
    ```sh
    sudo apt-get install supervisor

    sudo nano /etc/supervisor/conf.d/laravel-queue.conf #pour le queue worker
    #Texte à mettre dans le fichier :
    [program:laravel-queue]
    process_name=%(program_name)s_%(process_num)02d
    command=php /var/www/fablab-website/artisan queue:work
    user=root
    autostart=true
    autorestart=true
    numprocs=1
    redirect_stderr=true
    stdout_logfile=/var/www/fablab-website/storage/logs/worker.log
    #endfile
    sudo nano /etc/supervisor/conf.d/laravel-websocket.conf #pour le serveur websocket
    #Texte à mettre dans le fichier :
    [program:laravel-websocket]
    process_name=%(program_name)s_%(process_num)02d
    command=php /var/www/fablab-website/artisan websockets:serve
    user=root
    autostart=true
    autorestart=true
    numprocs=1
    #endfile

    supervisorctl reread
    supervisorctl update
    supervisorctl status
    ```

9. Sécurisation HTTPS avec SSL : https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-20-04
    ```sh
    sudo apt install certbot python3-certbot-apache
    sudo certbot --apache

    a2enmod ssl
    service apache2 restart 
    ```
    - Dans le .env :
    LARAVEL_WEBSOCKETS_SSL_LOCAL_CERT="/etc/letsencrypt/live/tb21-lieberherr.heig-vd.ch/fullchain.pem"
    LARAVEL_WEBSOCKETS_SSL_LOCAL_PK="/etc/letsencrypt/live/tb21-lieberherr.heig-vd.ch/privkey.pem"
    - Dans config/broadcasting.php : 
    'scheme' => 'https'
    'curl_options' => [
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
    ],
    - Dans config/websocket.php dans 'ssl' => [] :
    'verify_peer' => false,

10. Serveur NTP : https://vitux.com/how-to-install-ntp-server-and-client-on-ubuntu/
    ```sh
    sudo apt-get install ntp
    sudo nano /etc/ntp.conf
    ```
    - Remplacer les serveurs par défauts par ceux en Suisse : https://www.pool.ntp.org/zone/ch
    ```
    server 0.ch.pool.ntp.org
	  server 1.ch.pool.ntp.org
	  server 2.ch.pool.ntp.org
	  server 3.ch.pool.ntp.org
    ```
    ```sh
    sudo service ntp restart
    ```

11. Shibboleth : https://www.switch.ch/aai/guides/sp/installation/?os=ubuntu20
    ```sh
    sudo curl --fail --remote-name https://pkg.switch.ch/switchaai/ubuntu/dists/focal/main/binary-all/misc/switchaai-apt-source_1.0.0~ubuntu20.04.1_all.deb
    sudo apt install ./switchaai-apt-source_1.0.0~ubuntu20.04.1_all.deb
    sudo apt update
    sudo apt install --install-recommends shibboleth
    sudo apt full-upgrade
    sudo apt autoremove

    sudo shib-keygen -f -u _shibd -h tb21-lieberherr.heig-vd.ch -y 10 -e https://tb21-lieberherr.heig-vd.ch/shibboleth -o /etc/shibboleth/
    sudo curl --output /etc/shibboleth/shibboleth2.xml 'https://www.switch.ch/aai/docs/shibboleth/SWITCH/3.2/sp/deployment/download/customize.php/shibboleth2.xml?osType=nonwindows&hostname=tb21-lieberherr.heig-vd.ch&targetURL=https%3A%2F%2Ftb21-lieberherr.heig-vd.ch%2FShibboleth.sso%2FSession&keyPath=%2Fetc%2Fshibboleth%2Fsp-key.pem&certPath=%2Fetc%2Fshibboleth%2Fsp-cert.pem&federation=AAI%20Test&supportEmail=tristan.lieberherr%40heig-vd.ch&wayfURL=https%3A%2F%2Fwayf-test.switch.ch%2Faaitest%2FWAYF&metadataURL=http%3A%2F%2Fmetadata.aai.switch.ch%2Fmetadata.aaitest%2Bidp.xml&metadataFile=metadata.aaitest%2Bidp.xml&eduIDEntityID=https%3A%2F%2Ftest.eduid.ch%2Fidp%2Fshibboleth&hide=windows-only,metadataattributespart1,metadataattributespart2,eduid-only,interfederation,'
    sudo curl --output /etc/shibboleth/attribute-map.xml 'https://www.switch.ch/aai/docs/shibboleth/SWITCH/3.2/sp/deployment/download/customize.php/attribute-map.xml?osType=nonwindows&hide=eduid-only,'
    sudo curl --output /etc/shibboleth/attribute-policy.xml 'https://www.switch.ch/aai/docs/shibboleth/SWITCH/3.2/sp/deployment/download/customize.php/attribute-policy.xml?osType=nonwindows&hide='
    sudo curl --output /etc/shibboleth/SWITCHaaiRootCA.crt.pem http://ca.aai.switch.ch/SWITCHaaiRootCA.crt.pem
    openssl x509 -in /etc/shibboleth/SWITCHaaiRootCA.crt.pem -noout -fingerprint -sha256

    ```
    - Ajouter dans public/.htaccess avant le "RewriteRule ^ index.php [L]" :
    ```
      RewriteCond %{REQUEST_URI} !^(/Shibboleth.sso)
    ```
    - Ajouter dans /etc/apache2/sites-available/000-default-le-ssl.conf
    ```
    <Location /Shibboleth.sso>
    SetHandler shib
    </Location>
    <Location />
    AuthType Shibboleth
    ShibRequestSetting requireSession false
    Require shibboleth
    </Location>
    ```
    https://www.switch.ch/aai/guides/sp/access-rules/
    - Installer laravel-shibboleth et suivre les consignes : https://github.com/uabookstores/laravel-shibboleth
    - Vérifier les choses suivantes dans shibboleth.php :
    ```
    'idp_login' => '/Shibboleth.sso/Login',
    'idp_logout' => '/Shibboleth.sso/Logout',
    'authenticated' => '/',

    'entitlement' => 'uniqueID',

    'user' => [
      'email' => 'mail',
      'name' => 'givenName',
      'surname' => 'surname',
    ],

    'user_authentication_field' => 'email',

    'add_new_users' => true,
    ```
    - Vérifier les choses suivantes dans auth.php :
    ```
    'providers' => [
      'users' => [
        'driver' => 'shibboleth',
        'model' => App\Models\User::class,
      ],
    ],
    ```