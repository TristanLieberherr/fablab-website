## Journal

# 23/03
- Installation de l'écosystème
- Tutoriel
  
# 24/03
- Visionnage et essais de tutoriels
- Implémentation test dans Piaf : succès !

# 30/03
 - Installation de l'écosystème sur mon PC fixe

# 01/04
- Travail sur le formulaire de demande de travaux, ajout de modèles dans la DB
  - Utilisation du vuejs-datepicker, b-modal

# 05/04
- Ajout des alertes pour le formulaire de demande

# 06/04
- Amélioration des tables de demandes, ajout de routes backend & frontend, tutos sur l'authentification, amélioration de certains composants

# 11/04
- Ajout du modèle Notification dans la DB et dans le front-end
 
 # 13/04
 - Authentification : possibilité de s'authentifier manuellement depuis le navigateur mais pas depuis axios...

# 14/04
- Authentification : Chevallier a trouvé : il fallait passer par un proxy depuis le frontend
```js 
proxy: {  //A modifier dans vue.config.js
      "/api": {
          target: 'http://localhost:8000',
          secure: false
      }
    },
```
```v
'api' => [
            'throttle:api',
            \Illuminate\Session\Middleware\StartSession::class, //A rajouter dans Kernel.php
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
```

# 15/04
- Avancement dans le système de notifications, changements inportants : une seule notification par job et par conversation, qui indique le nombre de commandes modifiées/nouveaux messages
- v-badge avec un "!" pour les jobs qui ont été modifiés, puisque désormais la notification dit combien de jobs ont changé, pas lesquels

# 20/04
- Migration du code dans le store Vuex, surtout les requêtes axios
- Essais avec pusher, premier petit succès

# 21/04
- Migration du code dans le store Vuex
- Implémentation de pusher : ça fonctionne
- Protection de la route et du menu "all-jobs" contre les clients

# 22/04
- Essais avec le transfert de fichiers : perdu ~2h à dépanner alors que ça a toujours fonctionné, juste moi qui vérifiais mal...
- Upload des fichiers fonctionnel, changement de la soumission de job pour inclure les fichiers dans la requête

# 27/04
- Diagramme de relations de la DB
- Adaptation des tables, ajout de clés étrangères, changements du code en conséquence
- Nouvelles vues pour afficher un job : chat, timeline, fichiers déposés et ajout de fichiers sur une seule page, accessible depuis la liste des jobs

# 28/04
- Vue du nouveau chat terminée
- Ajout du modèle "TimelineEvent", ce qui entraine une remise en question du modèle "Notification"
- Ajout de nouvelles routes "spécialisées" (par ex. /job/update-status et /job/update-status_alert au lieu de juste /job/update) pour simplifier les fonctions du backend
- Adaptation du code dans le frontend pour refléter les changements mentionnés dessus, ajout d'actions "spécialisées" dans Vuex
- Chaque job du tableau de jobs de Vuex contient désormais ses messages et ses évènements : plus besoin du tableau de messages

# 29/04
- Regroupement des modules de Vuex dans le fichier index de base : plus facile à m'y retrouver et plus propre, par rapport à la petite quantité de code qu'il y a dedans
- Remise en marche des alertes de Pusher : ça fonctionne de nouveau
- Nouveau système de notifications : le modèle Notification n'existe plus, au lieu de ça les notifications sont directement synthétisées à partir des jobs

# 03/05
- Mise au clair de l'interaction client <=> backend <=> technicien, des données retournées par les requêtes axios et Pusher
- Ajout de colonnes pour les jobs et les timeline events : notify_technician et notify_client pour gérer les notifications correctement

# 04/05
- Avancement sur le composant "jobInfo", amélioration, mis en place de l'ajout de fichiers : tout fonctionne
- Résolution du problème avec les v-dialog qui étaient en dessous de la top nav : assets/css/vendor/bootstrap.min.scss, ligne "fixed-top{position:fixed;top:0;right:0;left:0;z-index:1030}" => remplacer "1030" par une valeur plus petite
- Tentative de résoudre le problème de la scrollbar tout le temps visible, causé par le v-app

# 05/05
- "technicianMyJobs" et "clientMyJobs" ont été fusionnés et mis dans la page "myJobs.vue" pour n'avoir qu'une seule page
- "jobInfo" amélioré, mis en forme et testé : les notifications/alertes fonctionnent comme il faut
- Résolution de bugs, ajout de code pour corriger des défauts concernant l'interaction avec l'API
- Ajout du téléchargement des fichiers : ça fonctionne
- Début du remplacement des composants Bootstrap par des équivalents Vuetify

# 06/05
- Suppression de modèles, events et controlleurs inutiles dans le backend
- Ajout de la route et des fonctions pour assigner un job à un technicien
- Amélioration de "jobInfo" pour masquer le chat et la timeline si le job n'est pas assigné

# 11/05
- Passage du formulaire de nouvelle demande sur Vuetify, ajout de la vérification avant l'envoi

# 12/05
- Première ébauche de la liste de travaux disponibles : manque les vraies infos mais la présentation est bonne
- Ajout du channel et du code pour informer tous les techniciens de l'ajout et de l'assignation d'un travail : ça fonctionne
- Les tabs inutiles ont été retirés, ce qui a engendré des bugs que j'ai pu corriger (problèmes de positionnement dans le HTML), ajout d'icônes dans les tabs
- Ajout de la page "profil", pas encore remplie

# 18/05
- Filtrage des statuts disponibles pour le select de changement de statut
- Mise à jour de vuetify à 2.5.0 suite à un problème avec les progress bar qui n'étaient pas animées
- Résolution du "bug" de la scrollbar : il y avait un padding-bot de 90px dans le body, il a fallu le mettre à 0 et ajouter overflow-y:auto pour html

# 19/05
- Gros conflit pour essayer de mettre certains boutons en position:sticky : finalement je les laisse en position:fixed. Il a fallu du temps pour tout expérimenter, mais au moins les boutons sont bons
- Implémentation du système d'attribution multiple. Il a fallu retoucher sommairement le frontend, c'est surtout le backend qui a changé. Le front end peut reçevoir des arrays désormais, ce qui est plus polyvalent
- Essais du nouveau système : pour l'instant à cause du store persistant il a y parfois des soucis mais à terme, ils devront disparaître
- Essais de concurrence de l'attribution, i.e si plus de 2 techniciens veulent s'assigner le même job

# 25/05
- Réalisation de la page des paramètres : il manque encore des fonctionnalités et de l'affichage, mais la forme est là, ne manque qu'à rajouter du contenu
- Implémentation du système de changement de paramètres : ça fonctionne
- Ajout dans le backend de routes pour changer les paramètres 
- Essais avec l'ajout du fichier "dist" dans Laravel pour que le backend puisse servir la page

# 26/05
- Amélioration et simplification du code pour la page des paramètres et essais après changements : ça fonctionne toujours aussi bien que hier
- Découverte et essais du système de messagerie : il y a désormais tout ce qu'il faut pour envoyer des emails ! Possibilité de délayer l'envoi des messages et de récupérer les données de la DB au moment d'envoyer le mail, pour avoir des données à jour. Il faut encore paramétrer cette histoire de "serveur SMTP" pour l'envoi et gérer la mise en forme (HTML ou text) des messages

# 01/06
- Résolution du problème avec pusher : les broadcasts étaient mis dans la file d'envoi, comme les mails. Il a fallu remplacer l'interface "ShouldBroadcast" par "ShouldBroadcastNow"
- Quelques améliorations graphiques dans le frontend
- Problème avec composer : j'ai raté une mise à jour accidentelle et il a fallu 2h pour résoudre le problème
- Essais pour déployer le site sur OceanDigital : rien qui marche, déjà il y a un souci avec les certificats ssh

# 02/06
- Chevallier m'a dépanné pour cette histoire de certificats. J'ai pu créer un droplet et installer ce qu'il faut dessus. Marche à suivre :
  
1. Créer un droplet avec Ubuntu, authentification avec ssh
   
2. Depuis le terminal local, se connecter sur le droplet :
    ```sh
    ssh root@161.35.217.7  #root@{ipv4}
    ```
- La suite est dans le guide de déploiement au début du fichier

# 08/06
- Préparation du prototype pour la démonstration : changement du code pour gérer la bannière qui indique les nouveaux messages et ajout de code pour s'assurer que les alertes sur les jobs soient correctement mises à jour. Avant ça, il y avait parfois un bug qui faisait qu'un message ou qu'un timeline event étaient tout le temps en alerte. Désormais, il y a une vérification systématique lors de la fermeture de JobInfo
- Avancement sur la présentation intermédiaire Powerpoint

# 14/06
- Mise en place du système de "queue worker" avec Supervisor pour l'envoi différé des mails : https://ekn.me/2019/11/05/how-to-use-laravel-queue-worker-with-supervisor/
    ```sh
    sudo apt-get install supervisor
    sudo nano /etc/supervisor/conf.d/laravel-worker.conf

    #Texte à mettre dans le fichier :
    [program:laravel-worker]
    process_name=%(program_name)s_%(process_num)02d
    command=php /var/www/fablab-website/artisan queue:work
    user=root
    autostart=true
    autorestart=true
    numprocs=1
    redirect_stderr=true
    stdout_logfile=/var/www/fablab-website/storage/logs/worker.log
    #endfile

    supervisorctl reread
    supervisorctl update
    supervisorctl status
    ```
- Le système d'envoi est fonctionnel, toutes les données qui doivent êtres affichées le sont. Il ne manque plus qu'à appeller le dispatcher là où il le faut, à travailler la présentation du email et à utiliser un vrai service de messagerie (au lieu d'envoyer les messages dans un log).

# 16/06
- Correction de quelques soucis pour la version mobile, surtout avec les scrollbars

# 19/06
- Mise en place de Laravel Websocket pour ne plus passer par les serveurs Pusher : https://beyondco.de/docs/laravel-websockets/getting-started/installation
  ```sh
    composer require pusher/pusher-php-server ^5.0
    composer require beyondcode/laravel-websockets

    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
    php artisan migrate
    php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"
  ```
  Désormais, plus besoin de passer par les serveurs de Pusher. On peut envoyer autant de messages que l'on veut !

# 21/06
- Adaptation de l'interface pour mobile

# 22/06
- Adaptation d'un file dropzone trouvé sur GitHub : https://gist.github.com/sploders101/f1a3bb46ed4b8a5897d2153a846addc9
- Adaptation de l'interface pour mobile : la majorité des fonctionnalités sont OK, reste encore à tester

# 23/06
- Ajout de 4 colonnes dans le modèle job : les noms et prénoms du client et du technician. Côté frontend, ajout de colonnes dans les datatables pour ajouter des infos importantes, comme le nom de la personne et un identifiant unique du job
- Mise en forme du code HTML du mail de notification avec un template en ligne avec unlayer.com
- Ajout du bouton pour uploader les fichiers
- Correction d'un oubli dans FileController : oublié faire un TimelineEvent::find(), du coup il manquait des propriétés vitales pour le frontend

# 24/06
- Mise en forme du template mail HTML : bordures de statut comme dans le site
- Travail sur la topnav : il faut réussir à mettre le logo sans tout casser sur mobile
- Essais et amélioration de l'envoi de fichiers : ajout de verrous pour ne pas spammer les envois, ajout d'un vérificateur de la taille
- Parametrage du serveur nginx pour accepter jusqu'à 5MB de données par requête (fichiers)
- Correction d'un bug qui des scrollbars qui ne descendaient pas dans "mounted"

# 25/06
- Réunion avec le prof :
  #### Guides pour l'authentification AAI :
  - https://www.switch.ch/aai/guides/sp/
  - https://www.switch.ch/aai/guides/sp/installation/?os=ubuntu20
  - https://www.switch.ch/aai/guides/sp/configuration/
  - https://rr.aai.switch.ch/
  #### Petites fonctionnalités sympas à implémenter :
  - mettre un rating à la fin d'une demande
  - mettre un visualiseur de dxf
  - ajouter le style de couleur pour les nouveaux statuts de la timeline
  - améliorer les timelinevents des fichiers : icône, version, lien, ...
  - aller voir ce qui se fait ailleurs pour les systèmes de demandes centralisés
  - rapport : commencer en outline (les titres)

# 28/06
- Ajout et essais du système de suppresion des demandes terminées : soft-delete des jobs, timelineEvents et messages. Les files sont supprimés, et si il n'y a pas d'autres files qui pointent sur le fichier, il est supprimé.
- Ajout d'un petit système d'évaluation du travail
- Ajout de la description des statuts pour le technicien qui doit les changer
- Fermeture du jobInfo si le job est retiré
- Ajout du logo, mise en forme : ça marche sur mobile et sur PC

# 29/06
- Vérification de certaines fonctionnalités ajoutées le 18/06 : tout à l'air en ordre
- Ajout et essais des options de tri dans la data table de myJobs : c'est impeccable, l'occasion aussi de me familiariser un peu avec les fonctions de tri de Vuetify
- Modifications du template du email
- Début du rapport : titres

# 30/06
- Suppression du code inutile dans le front-end et essais pour s'assurer que rien d'important n'ait été retiré
- Rapport : amélioration du BPMN d'utilisation, mise en forme de l'étude préliminaire
- Lecture et analyse du rapport de Mathieu Schnegg : il est de bonne pratique de lire d'autres rapport, pour me faire des avis critiques réutilisables pour mon rapport
- Discussion vite fait avec Chevallier : découverte du template de rapport de TB en LaTeX
- Correction rapide de la timeline qui était disponible sur la version mobile alors que la demande n'était pas encore assignée

# 01/07
- Travail sur la liste des travaux : liste des 4 travaux disponibles avec une petite description et un lien vers le site du fabriquant
- Suppression d'encore plus de code inutile : normalement, rien n'a été épargné. 
- Vérification des fichiers soumis dans le formulaire de demande
- Limitation à 10 demandes simultanées par compte : c'est largement suffisant et c'est pour éviter les abus/griefing
- Amélioration du système de téléchargement : les images et les pdf sont ouverts dans un nouvel onglet, le reste est téléchargé

# 02/07
- Lecture partielle du rapport de Stephane Selim
- Commentaires dans le code : API dans les contrôleurs backend, API dans Vuex
- Retouches rapides de quelques routes, mise au propre des fichiers importants (contrôleurs backend, Vuex)
- Correction d'un bug qui faisait que quand un job était supprimé, la fermeture de jobInfo envoyait un update-notify pour un job inexistant
- Changement sur la politique de soft delete : désormais, les timeline events et les messages sont aussi supprimés
- Implémentation du système d'envoi par mail sans passer par une route test : il faut encore faire les essais
- Déploiement sur la VM de l'école

- Demande d'inscription chez AAI 
- Installer apache 2
- Générer des certificats autosignés SSL (faire marcher le ssl en autosigné sur serveur web : )
- Faire fonctionner apache avec SSL (port 443)
- Installer Shibboleth (suivre la procédure AAI)
- Générer les certificats pour AAI
- Déployer l'application Laravel 

# 05/07
#### Guides pour l'authentification AAI :
  - https://www.switch.ch/aai/guides/sp/
  - https://www.switch.ch/aai/guides/sp/installation/?os=ubuntu20
  - https://www.switch.ch/aai/guides/sp/configuration/
  - https://rr.aai.switch.ch/
- Mise à jour des composants en français
- Installation et mise en marche de Docker et Unbuntu 2 pour pouvoir utiliser le rapport LaTeX

# 06/07
- Sécurisation du serveur en HTTPS
- Tentative de réparer le système de websockets qui ne marche plus à cause du HTTPS : les broadcasts ne sont pas envoyés
- Procédure de test chez Switch AAI pour l'authentification : ça ne marche pas

# 07/07
- Rédaction du rapport
- Restauration du serveur websocket : désactivation de la vérification SSL. Pas sécurisé ? Au moins ça marche...
- Avancement sur Shibboleth : ajout d'une directive RewriteRule
  
# 08/07
- Rédaction du rapport

# 09/07
- Réunion avec le prof
- Rédaction du rapport
- Avancement sur shibboleth : création de la ressource de production et tentative de login : ça marche

# 12/07
- Rédaction du rapport
- Adaptation du code pour le login AAI : ça marche ! Il faut encore adapter un peu de code mais cette partie est presque fonctionnelle

# 13/07
- Rédaction du rapport
- Migration des fichiers locaux dans le répertoire /var/www pour pouvoir continuer à développer le frontend en local
- Résolution d'un bug qui provoquait un crash de Laravel : dans redirectTo(), il fallait retourner "/", sinon la route inexistante "login" était retournée par défaut
- Travail sur le login/logout AAI : il faut encore un peu de temps avant d'y arriver

# 14/07
- Rédaction du rapport
- Installation de laravel-shibboleth
- Transmission de l'utilisateur dans une balise meta
- Essais pour l'utilisation du SMTP de l'école : ça ne marche pas encore

# 15/07
- Rédaction du rapport
- Page 404 : template gratuit trouvé sur un site, j'ai pu l'adapter en conséquence
- Résolution du bug de l'assignation qui retirait les mauvais jobs de la liste : '=' au lieu de '==' dans le code...
- Envoi de messages avec le serveur SMTP de l'école : ça marche ! Il fallait juste enlever 'TLS' car il n'y a pas de sécurité

# 16/07
- Rédaction du rapport
- Travail sur la procédure de login et de logout : ajout d'une page de bienvenue

# 19/07
- Travail sur la procédure de login et de logout : template gratuit trouvé sur un site, adapté pour mes besoins. Malheureusement, la solution du WAYF intégré ne jouait pas, sinon je l'aurais utilisé.
- Améliorations du front-end : tout en français, tooltips sur les dates, ordre des éléments de la barre latérale

# 20/07
- Feedback avec un camarade et améliorations apportées au frontend : couleur de fond pour la barre latérale, possibilité de créer une nouvelle demande depuis la barre lattérale (vide) ou depuis la page des travaux disponibles (type de travail pré-rempli), corrections de quelques bugs
- Tentative de mettre un titre : impossible sans casser l'affichage mobile...
- Ajout du sujet pour les emails : tout à l'air en ordre dans la présentation. Il y a toutefois des bizzareries sur mobile et sur Outlook, surtout Outlook
- Bug avec la validation du formulaire : j'ai corrigé les points importants mais il reste encore un peu de travail pour tout faire au propre

# 21/07
- Remise en place du système de limitation des demandes : v-overlay avec un message dedans, tout fonctionne correctement
- Titre de la page : il y a enfin un titre ! Le logo est maintenant en tout petit à côté du bouton pour cacher/afficher la barre latérale, du style Youtube. Tout fonctionne sur la version mobile
- Enlevé le "date de création" dans les paramètres : info inutile
- Refonte de la page de bienvenue : après avoir longuement cherché, j'ai réussi à trouver un template que j'ai adapté. La page est désormais responsive et tout fonctionne comme il faut

# 22/07
- Démarrage du protocole d'essais et essais
- Correction de quelques bugs, amélioration de quelques textes dans le frontend

# 23/07
- Finalisation du protocole d'essais et des essais
- Amélioration de quelques textes dans le frontend
- Rédaction du rapport

# 26/07
- Rédaction du rapport
- Correction d'un oubli dans le frontend : ajout du garde de navigation sur "/all-jobs"
- Amélioration de quelques textes dans le frontend

# 27/07
- Rédaction du rapport

# 28/07
- Rédaction du rapport

# 29/07
- Finalisation et envoi du rapport. C'est la fin de ce journal et de toute une aventure...