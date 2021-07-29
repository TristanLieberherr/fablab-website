# Protocole d'essais pour le travail de Bachelor de Tristan Lieberherr intitulé "Gestion centralisée des demandes de travaux pour le FabLab HEIG-VD"
## Le but de ce protocole d'essais est de tester les fonctionnalités du système auxquels les acteurs ont accès.

### Appareils utilisés : 
- PC avec écran 1920 x 1040 px
- PC avec écran 1536 x 824 px
- Smartphone avec écran tactile 360 x 668

Navigateur utilisé : Chrome
Tailles des écrans mesurées avec : https://www.rapidtables.com/web/tools/window-size.html
Protocole écrit et effectué par Tristan Lieberherr, le 23/07/2021

## 1. Authentification et accès au site
Pour se connecter au site, il faut passer par le login Switch AAI.
Pour la phase d'essais, il existe une route qui permet de se connecter directement à un compte seedé, sans passer par AAI :
Il faut passer par "tb21-lieberherr.heig-vd.ch/admin".
Ces essais ont lieu dans l'ordre chronologique.

- [x] **1.1** :
Ouvrir le navigateur web et accéder au site "tb21-lieberherr.heig-vd.ch".
L'utilisateur non authentifié doit arriver sur la page d'accueil (/welcome).

- [x] **1.2** :
Depuis la page d'accueil, cliquer sur le bouton "Se connecter".
L'utilisateur doit être redirigé sur le service de découverte WAYF de Switch AAI.
Sélectionner HES-SO dans la barre déroulante.
L'utilisateur est ensuite redirigé vers la page de login HES-SO.
Entrer les champs pour l'utilisateur et le mot de passe et cliquer sur login.
L'utilisateur doit être redirigé vers la page principale (/app/...).

- [x] **1.3** :
Depuis la page principale, cliquer sur le nom de l'utilisateur en haut à droite.
Un menu apparaît comme seule option "Se déconnecter". Cliquer dessus.
L'utilisateur doit être redirigé vers la page d'accueil (/welcome).
Suivre les directives du point 1.2.
Cette fois, l'utilisateur ne passe plus par la page de login HES-SO après avoir séléctionné l'établissement dans la barre déroulante. Il doit accéder au site sans remettre ses identifiants.

- [x] **1.4** :
Fermer et réouvrir le navigateur pour accéder au site.
Dans la barre d'URL, remplacer "/welcome" par {exemple}.
Exemples utilisés : "/app", "/test", "/daafnafhnaf", "/gasbhfb".
La page ne doit pas changer.
Toujours dans la barre d'URL, concaténer {exemple} après "/welcome" (/welcome{exemple}).
Exemples utilisés : "?app=app", "&test=42", "?id=64&usr=test".
La page ne doit pas changer.
Toujours dans la barre d'URL, concaténer {exemple} après "/welcome" (/welcome{exemple}).
Exemples utilisés : "%532", "%fa", "%usr=43".
La page doit afficher une page "Bad Request" avec l'erreur 400, ou une page avec l'erreur 404.
Dans tous les cas, l'utilisateur ne doit pas être redirigé vers la page principale (/app) sans s'être connecté.

- [x] **1.5** :
Ouvrir d'abord le navigateur en navigation privée et accéder au site.
Dans le .env du backend, mettre APP_ENV=local.
Remplacer dans l'URL "/welcome" par "/laravel-websockets".
Une interface pour visualiser le trafic du serveur websocket va s'afficher.
Prendre le port 6001 et cliquer sur "Connect".
Réouvrir le navigateur (en navigation normale) pour accéder au site et s'y connecter depuis un compte client pour accéder à la page principale.
Dans l'interface du serveur websocket, il doit y avoir des évènements de type "subscribed" et "occupied" aux channels message.channel.{id} et job.channel.{id}. {id} correspond à l'identifiant de l'utilisateur dans la base de données (clé principale).
Fermer la fenêtre de navigation normale. Des évènements de type "vacated" doivent apparaître.

- [x] **1.6** :
Fermer la fenêtre du navigateur normal en gardant celle de navigation privée ouverte.
Réouvrir le navigateur en navigation normale et accéder au site.
Cette fois, remplacer le "/welcome" par "/admin".
Cette route permet de se connecter depuis un compte seedé au lieu de passer par AAI pour pouvoir faire des essais.
Dans la fenêtre qui apparait, saisir "tech1" et "password" pour les identifiants.
Cliquer sur "Connexion". Une page 404 apparait, c'est normal.
Dans l'interface websocket, il doit y avoir des évènements de type "subscribed" et "occupied" aux channels message.channel.{id}, job.channel.{id} et cette fois au job.channel.0, qui est le channel commun aux techniciens.
Fermer la fenêtre de navigation normale. Des évènements de type "vacated" doivent apparaître.

- [x] **1.7** :
Quand l'utilisateur se connecte pour la première fois comme au point 1.2, il est enregistré dans la base de données. Vérifier que ce soit bien le cas.
Vérifier que les champs "notify_email_status", "notify_email_messages" et "notify_email_files" soient à 1.
Vérifier que le champ "is_technician" soit à 0.

- [x] **1.8** :
Quand l'utilisateur est connecté et à accès au site (/app/...), vérifier que les adresses inexistantes soient redirigées sur la page 404.
Dans l'URL, concaténer {exemple} après "/app" (/app{exemple}).
Exemples utilisés : "/qwertz", "/my-jobs/uztrfvb", "/942".
L'utilisateur doit être redirigé vers la page 404 du site. Un bouton "Retour" doit rediriger l'utilisateur vers la page des demandes (/app/my-jobs).

## 2. Overlay de l'interface

- [x] **2.1** :
Se connecter depuis un compte client et un compte technicien, depuis des fenêtres de navigateurs différents. La première page sur laquelle arrive l'utilisateur est la page des demandes en cours (/app/my-jobs). La table est vide au début, elle affiche "Aucune donnée disponible".
La barre latérale est affichée au démarrage. Cliquer plusieurs fois sur l'icône en haut à gauche. La barre doit basculer entre affichée et masquée. La barre doit "comprimer" le contenu de la page.
Cliquer sur le prénom de l'utilisateur en haut à droite. Un menu déroulant avec comme seul élément "Se déconnecter" doit s'afficher.
Cliquer sur le logo HEIG-VD en haut à gauche. Il doit contenir un lien vers "/app/my-jobs". Vérifier qu'il fonctionne.
Cliquer sur la cloche en haut à droite. Elle doit elle aussi contenir un lien vers "/app/my-jobs". Vérifier qu'il fonctionne.
La cloche doit toujours indiquer le nombre de demandes notifiées.

## 3. Interface du client
Ces essais doivent être faits depuis un compte client, depuis un PC.

- [x] **3.1** :
Dans la barre latérale de gauche, il doit y avoir uniquement les éléments suivants (de haut en bas) :
  - Nouvelle demande
  - Travaux réalisables
  - Mes commandes
  - Paramètres

- [x] **3.2** :
Cliquer sur "Nouvelle demande". La page ne change pas. Une fenêtre modale avec comme titre "Formulaire de nouvelle demande" doit apparaître.
Le formulaire comporte les champs "Type de travail", "Fichiers à joindre", "Échéance" et "Commentaires éventuels".
L'ouverture d'un formulaire de cette façon doit comporter des champs vides.
  - Si l'utilisateur clique en dehors de la fenêtre modale, il ne doit rien se passer.
  - Si il clique sur "Annuler", la fenêtre se ferme.
  - Si le type de travail n'est pas encore sélectionné, le champ "Fichiers à joindre" est désactivé.
  
  Cliquer sur "Soumettre" en ayant gardé les champs vides. Les champs "Type de travail" et "Échéance" se mettent en erreur.
  Cliquer sur le champ "Type de travail" et en sélectionner un. Cliquer sur "Soumettre". Les champs "Fichiers à joindre" et "Échéance" doivent se mettre en erreur.

  Pour que le champ des fichiers ne soit plus en erreur, y joindre un ou plusieurs fichiers dont au moins un d'entre eux doit avoir un des bons types. Une limite de 5 MB ne doit pas être dépassée.
  L'utilisateur doit pouvoir ajouter des fichiers en cliquant sur le champ, ou en faisant un drag and drop des fichiers sur le champ.
  - Si au moins un fichier qui comporte le bon type (le type est indiqué) est ajouté, le champ "Fichiers à joindre" n'est plus en erreur.
  - Si aucun des fichiers n'est du bon type, l'erreur presiste.
  - Si les fichiers dépassent 5 MB au total, le champ est en erreur.
  - Si plusieurs fichiers sont présents dans le champ, le bouton en forme de croix à droite permet de vider la sélection du champ.

  Pour que le champ de la date d'échéance ne soit plus en erreur, il faut cliquer dessus et sélectionner une date dans le calendrier.
  L'utilisateur ne doit pas pouvoir sélectionner de dates dans le passé.
  Le champ "Commentaires éventuels" est optionnel : il ne doit jamais être en erreur et peut être laissé vide.
  Tant que des champs sont en erreur, le bouton "Soumettre" ne doit pas envoyer la demande.
  - Si au moins un champ est en erreur, le bouton "Soumettre" ne doit avoir comme effet que de vérifier les champs.
  - Si il n'y a plus d'erreurs, cliquer sur le bouton de soumission doit désactiver ce dernier et le mettre en état de chargement.
  - Si la demande n'a pas été correctement reçue par le serveur, le bouton de soumission doit se réactiver et n'est plus en état de chargement. Une notification doit apparaître en haut à droite de l'écran en indiquant une erreur.
  - Si la demande a été correctement reçue par le serveur, le formulaire doit se fermer et une notification doit apparaître en haut à droite de l'écran en indiquant la réussite de l'envoi.

  Une limite de 10 demandes en parallèle est fixée, pour éviter les abus. Si la limite est atteinte, il ne doit plus être possible de déposer de nouvelles demandes, jusqu'à ce qu'une demande soit terminée et effacée.
  Quand la limite est atteinte, le formulaire doit être désactivé. Un overlay de verrouillage doit être affiché par dessus, en indiquant que la limite est atteinte. Un bouton "Annuler" figure sur cet affichage. Si l'utilisateur clique dessus, le formulaire et l'overlay de verrouillage doivent se fermer. Ce verouillage doit persister tant que la limite est atteinte.
  
  Dans tous les cas, une demande ne doit pas pouvoir être envoyée si il reste des champs en erreur.
  Quand une demande est soumise et reçue, elle doit être ajoutée dans la table de la page "Mes commandes".
  Vérifier qu'elle ait bien été ajoutée dans la base de données, ainsi que ses fichiers et timeline events.

- [x] **3.3** :
Cliquer sur "Travaux réalisables". La page doit changer (/job-list). Les quatres types de travaux disponibles doivent être affichés.
  - Si l'utilisateur clique sur une des images, le formulaire de demandes doit s'ouvrir. Le type de travail correspondant doit être pré-rempli.
  - Si l'utilisateur clique sur le titre du type de travail (en bleu comme pour un lien), le formulaire de demandes doit s'ouvrir. Le type de travail correspondant doit être pré-rempli.
  - Si l'utilisateur clique sur le lien "Plus de détails...", le navigateur doit ouvrir un nouvel onglet sur la page web de la machine/fabriquant.
  - Les travaux doivent êtres contenus dans une liste à deux colonnes, si la taille de l'écran le permet.

  Chaque élément de la liste doit contenir une image à gauche et à droite, le type de travail, le nom de la machine, une description et le lien vers la page web de la machine/fabriquant.

- [x] **3.4** :
Cliquer sur "Mes commandes". La page doit changer (/my-jobs). Une table contenant les demandes déposées par l'utilisateur doit apparaître. Si elle est vide, elle doit afficher "Aucune donnée disponible".
Une demande notifiée doit avoir un point d'exclamation en haut à droite de son statut. Le nombre indiqué sur la cloche en haut à droite de l'écran doit toujours correspondre au nombre de demandes notifiées.
La table doit avoir les colonnes suivantes :
  - Travail
  - Date de création
  - Échéance
  - Responsable
  - Statut

  La table doit pouvoir afficher un nombre variable de demandes par page (5, 10, 15, tous) et doit pouvoir changer de page (page du tableau) grâce aux outils de navigation en bas à droite de la table.
  La table doit pouvoir être triée selon une seule colonne à la fois, si l'utilisateur clique sur le nom de la colonne en question.
  La flèche qui doit apparaître indique le sens du tri : ascendant ou descendant.
  Par défaut, la table doit être triée par statut. Le tri doit se faire automatiquement dès qu'une demande est notifiée/dénotifiée.
  - Pour la colonne "Travail", le tri doit être réalisé dans cet ordre : "Fraisage CNC" > "Gravure laser" > "Découpe laser" > "Impression 3D".
  - Pour les colonnes "Date de création" et "Échéance", le tri doit être fait par ordre chronologique.
  - Pour la colonne "Responsable", le tri doit être fait par ordre alphabétique.
  - Pour la colonne "Statut", le tri doit être réalisé en fonction de l'ordre d'avancent : "Nouveau" > "Assigné" > "En cours" > "En pause" > "Terminé". Les demandes notifiés doivent apparaître avant les autres, dans le bon ordre.

  Des tooltips doivent apparaître si l'utilisateur positionne son curseur sur les valeurs de certaines colonnes :
  - Pour les colonnes "Date de création" et "Échéance", le tooltip doit indiquer la date au format JJ/MM/AAAA.
  - Pour la colonne "Responsable", le tooltip doit indiquer le nom complet (prénom + nom) du technicien assigné, si c'est le cas. 

  Si la demande n'est pas encore assignée (statut "Nouveau"), la colonne "Responsable" doit être vide. Sinon, elle contient le nom du technicien.
  Cliquer sur une demande (ligne de la table). Une fenêtre modale présentant les détails de la demande doit s'ouvrir.
  - Si l'utilisateur clique en dehors de la fenêtre modale ou sur l'icône en forme de croix en haut à gauche, elle doit se fermer.
  - Quand l'utilisateur ferme la fenêtre modale des détails, la demande ne doit plus être notifée et elle doit se faire trier.
  - Si la demande n'est pas encore assignée, seuls la table et le stepper sont visibles. Un message indiquant "Le chat et la timeline seront disponibles dès que cette demande aura été assignée à un technicien" doit être affiché en bas au milieu de la fenêtre modale.

  La fenêtre modale doit contenir en premier une table contenant la demande en question. Cette table contient les colonnes suivantes :
  - Travail
  - Identifiant unique
  - Date de création
  - Échéance
  - Responsable
  - Statut
  - Fichiers
  - Commentaire

  La colonne "Fichiers" doit contenir un bouton avec écrit dessus "Afficher". Si l'utilisateur clique dessus, une liste des noms des fichiers associés à la demande doit apparaître.
  - Si l'utilisateur clique sur un nom de fichier, le fichier doit être téléchargé par le navigateur.
  - Si le fichier est de type pdf ou image, un nouvel onglet est ouvert dans le navigateur, qui affiche l'image ou le pdf.
  - Il ne doit pas y avoir plusieurs fois le même nom de fichier. Seules les dernières versions des fichiers sont disponibles.

  Si un commentaire à été ajouté dans le formulaire lors de la création de la demande, la case de la colonne "Commentaire" doit avoir un bouton avec un icône. Sinon, la case affiche "Aucun".
  - Si l'utilisateur clique dessus, une petite fenêtre modale ayant comme titre "Commentaire" doit apparaître. Le commentaire est affiché sous le titre.
  - Si l'utilisateur clique en dehors, la fenêtre de commentaire doit se fermer.

  En dessous de la table, il doit y avoir un stepper. Ce stepper doit indiquer l'état d'avancement du travail. Une étape terminée doit être symbolisée par un symbole vu.
  Voici les conditions que doivent remplir les étapes du stepper pour avoir le vu :
  - Étape 1 : Demande créée : le statut vaut "Nouveau", "Assigné", "En cours", "En pause" ou "Terminé".
  - Étape 2 : Technicien assigné : le statut vaut "Assigné", "En cours", "En pause" ou "Terminé".
  - Étape 3 : Début du travail : le statut vaut "En cours" ou "Terminé".
    - Étape 3 : Problème : le statut vaut "En pause".
  - Étape 4 : Travail terminé : le statut vaut "Terminé".

  En dessous du stepper, à gauche, il doit y avoir la chatbox de messagerie. Elle ne doit être visible que si le travail est assigné à un technicien.
  La chatbox doit contenir un champ de texte avec écrit "Votre message..." en indice. A droite de ce champ de texte doit se trouver un bouton en forme d'avion en papier qui sert de bouton d'envoi.
  - La touche "Enter" doit avoir le même effet que le bouton d'envoi si le champ de texte à le focus.
  - Si l'utilisateur clique sur le bouton et que le message est vide, rien ne doit se passer.
  - Si l'utilisateur clique sur le bouton et qu'il a rempli le champ de texte, le message est envoyé. Il doit apparaître dans la chatbox, du côté droit, en dessous des autres messages.
  - Si le champ de texte n'est pas vide, un bouton en forme de croix doit apparaître à gauche du bouton d'envoi. Si on clique dessus, le texte doit être effacé.
  - Si les messages ne datent pas du même jour, il doit y avoir un délimiteur qui apparaît entre les deux messages de dates différentes. Ce délimiteur doit afficher la date en format JJ/MM/AAAA.
  - Les messages envoyés doivent apparaître à droite, en bleu. Les messages reçus doivent apparaître à gauche, en gris.
  - Les messages doivent êtres affichés par ordre chronologique.

  Les messages ont un système de notification propres à eux même. Un délimiteur doit apparaître en indiquant "Nouveaux messages" entre l'ancien et le nouveau message reçu.
  - Si l'utilisateur n'est pas sur la fenêtre modale de détails lorsqu'il reçoit un message, le délimiteur doit apparaître quand il ouvrira la fenêtre.
  - Si l'utilisateur est sur la fenêtre modale de détails lorsqu'il reçoit un message et qu'il n'en a pas envoyé depuis que la fenêtre est ouverte, le délimiteur doit apparaître.
  - Si l'utilisateur est sur la fenêtre modale de détails lorsqu'il reçoit un message et qu'il en a lui même envoyé depuis que la fenêtre est ouverte, le délimiteur ne doit pas apparaître.

  A droite de la chatbox doit se trouver la timeline. Elle ne doit être visible que si le travail est assigné à un technicien.
  Les évènements de la timeline doivent avoir la date et l'heure de leur apparition, et contenir une description :
  - Création de la demande : ça doit toujours être le premier évènement de la timeline. Il doit apparaître automatiquement lors de la dépose d'une demande.
  - Ajout du fichier "{nomFichier}" Version 1 : indique qu'un fichier a été ajouté pour la première fois. Il doit apparaître quand un nouveau fichier est ajouté par un des deux acteurs.
  - Modification du fichier "{nomFichier}" Version {n} : indique qu'un fichier a été écrasé et mis à jour. Il doit apparaître quand un fichier est écrasé par un des deux acteurs. Le numéro de version moins 1 correspond au nombre de fois qu'il a été écrasé.
  - Changement de statut : {statut} : indique que le status a été changé. Il doit apparaître quand le technicien change le statut de la demande.

  Les évènements de la timeline doivent apparaître par ordre chronologique.
  En bas de la timeline doit se trouver le champ "Fichiers à joindre". Il doit fonctionner exactement comme pour le même champ du formulaire, sauf qu'il n'y a pas de type de fichier requis.
  A droite du champ doit se trouver un bouton en forme de flèche montante qui sert de bouton d'envoi.
  - Si l'utilisateur clique sur le bouton et qu'il n'y a pas de fichiers sélectionnés, rien ne doit se passer.
  - Si l'utilisateur clique sur le bouton et qu'il a rempli la sélection, les fichiers sont envoyés. Les évènements liés aux fichiers doivent apparaître en notifiés dans la timeline. Ils doivent aussi être disponibles depuis la colonne "Fichiers" de la table.
  - Si la sélection n'est pas vide, un bouton en forme de croix doit apparaître à gauche du bouton d'envoi. Si on clique dessus, la sélection doit être effacée.
  - L'utilisateur doit pouvoir envoyer un seul ou plusieurs fichiers à la fois.

  Si la demande possède le statut "Terminé", un long bouton vert doit apparaître tout en haut de la fenêtre modale. Le texte du bouton doit indiquer "Terminer la demande".
  Si l'utilisateur clique dessus, une nouvelle fenêtre modale avec comme titre "Terminer la demande" doit s'ouvrir. Le texte doit indiquer à l'utilisateur que le travail est terminé et qu'il peut désormais en disposer.
  Il doit y avoir un "rating" de 6 étoiles qui doit être vide à l'apparition de la fenêtre.
  - Si l'utilisateur clique sur le rating, il doit pouvoir sélectionner 1 à 6 étoiles.
  - Si l'utilisateur clique en dehors de la fenêtre modale, il ne doit rien se passer.
  - Si l'utilisateur clique sur le bouton "Annuler", la fenêtre modale doit se fermer.
  - Si l'utilisateur n'a pas mis d'étoiles, le bouton "Valider" est désactivé.
  - Si l'utilisateur a mis 1 à 6 étoiles, le bouton "Valider" est activé.

  Quand l'utilisateur clique sur le bouton "Valider", ce dernier doit se mettre en mode chargement tant qu'il n'y a pas eu de réponse du serveur. Si il n'y a pas eu d'erreur, toutes les fenêtres modales doivent se fermer et une notification en haut à droite de l'écran doit apparaître pour indiquer qu'il n'y a pas eu de problème. La demande ne doit plus figurer dans la table des demandes.
  En cas d'erreur, la fenêtre modale reste ouverte et une notification en haut à droite de l'écran doit apparaître pour indiquer qu'il y a eu un problème.

- [x] **3.5** :
Cliquer sur "Paramètres". La page doit changer (/settings). Deux cartes doivent apparaître. La première, en haut, doit contenir des informations du compte :
  - Prénom
  - Nom
  - Addresse mail
  - Demandes en cours

  Le nombre de demandes en cours doit correspondre au nombre de demandes qui figurent dans la table de la page "Mes commandes".
  Sur la deuxième carte doivent apparaître les paramètres de notifications :
  - Notifications par mail
  - Nouveau statut
  - Nouveaux messages
  - Nouveaux fichiers

  A droite de chaque paramètre doit se trouver un switch. Chaque switch sert à activer/désactiver un critère pour l'envoi d'un email de notification.
  Si l'utilisateur clique dessus, la valeur du switch doit changer à l'écran et dans la base de données, et la colonne "notify_email_updated_at" doit prendre la valeur du temps actuel.
  Vérifier que ce soir bien le cas dans la base de données.
  Quand un switch est changé, il doit se mettre en mode chargement tant que la modification n'a pas été faite dans la base de données.
  Si une erreur survient, une notification en haut à droite de l'écran doit apparaître, en indiquant l'erreur. Le switch doit automatiquement se remettre dans son acien état.
  Le switch "Notifications par mail" sert à activer ou désactiver les trois autres switchs.
  - Si le switch "Notifications par mail" est activé par l'utilisateur, les trois autres doivent s'activer.
  - Si le switch "Notifications par mail" est désactivé par l'utilisateur, les trois autres doivent se désactiver.
  - Si au moins un des trois autres switchs sont activés, le switch "Notifications par mail" doit s'activer automatiquement. L'activation automatique ne doit pas modifier les autres switchs.
  - Si aucun des trois autres switchs ne sont activés, le switch "Notifications par mail" doit se désactiver automatiquement. La désactivation automatique ne doit pas modifier les autres switchs.

## 4. Interface du technicien
Ces essais doivent être faits depuis un compte technicien, depuis un PC.

- [x] **4.1** :
Dans la barre latérale de gauche, il doit y avoir uniquement les éléments suivants (de haut en bas) :
  - Travaux réalisables
  - Mes commandes
  - Commandes clients
  - Paramètres

- [x] **4.2** :
Cliquer sur "Travaux réalisables". La page doit changer (/job-list). Les quatres types de travaux disponibles doivent être affichés.
L'interface doit être exactement identique que pour le client, à deux différences près :
  - Si l'utilisateur clique sur une des images, il ne doit rien se passer.
  - Si l'utilisateur clique sur le titre du type de travail (en bleu comme pour un lien), il ne doit rien se passer.

  L'utilisateur ne doit en aucun cas avoir accès au formulaire.

- [x] **4.3** :
Cliquer sur "Mes commandes". La page doit changer (/my-jobs). Une table contenant les demandes assignées par l'utilisateur doit apparaître. Si elle est vide, elle doit afficher "Aucune donnée disponible".
L'interface de la table doit être identique que pour le client, à une différence près : le tri par défaut doit être fait par statut, mais dans l'ordre inverse que pour le client (les demandes au statut "Assigné" sont en tête du tableau).
Cliquer sur une demande (ligne de la table). Une fenêtre modale présentant les détails de la demande doit s'ouvrir. L'interface de la fenêtre modale des détails doit être identique que pour le client, à quelques différences près.
La colonne "Statut" doit contenir un bouton avec écrit dessus le statut actuel, uniquement si le statut actuel ne vaut pas "Terminé", dans quel cas il ne doit pas y avoir de bouton. Si l'utilisateur clique dessus, une fenêtre modale avec comme titre "Changer le statut" doit s'ouvrir.
Cette fenêtre modale doit contenir un sélecteur avec initialement écrit dessus "Nouveau statut...". En dessous, un texte doit afficher la description du statut sélectionné, avec comme texte initial "Description du statut...".
  - Si l'utilisateur clique en dehors de la fenêtre modale, il ne doit rien se passer.
  - Si l'utilisateur clique sur le bouton "Annuler", la fenêtre modale doit se fermer.
  - Si l'utilisateur n'a pas sélectionné de nouveau statut, le bouton "Modifier" doit être désactivé.
  - Si l'utilisateur a sélectionné un nouveau statut, le bouton "Modifier" doit s'activer.

  En fonction du statut actuel, la liste des statuts du sélecteur doit s'adapter en conséquence :
  - Assigné : "En cours", "En pause" et "Terminé".
  - En cours : "En pause" et "Terminé".
  - En pause : "En cours" et "Terminé".

  Quand l'utilisateur clique sur le bouton "Modifier", ce dernier doit se mettre en mode chargement tant qu'il n'y a pas eu de réponse du serveur. Si il n'y a pas eu d'erreur, la fenêtre modale doit se fermer et une notification en haut à droite de l'écran doit apparaître pour indiquer qu'il n'y a pas eu de problème. Le statut doit avoir changé dans le tableau et un nouvel évènement de type "statut" doit apparaître dans la timeline.
  En cas d'erreur, la fenêtre modale reste ouverte et une notification en haut à droite de l'écran doit apparaître pour indiquer qu'il y a eu un problème.

- [x] **4.4** :
Cliquer sur "Commandes clients". La page doit changer (/all-jobs). Une table contenant les demandes non-assignées des clients doit apparaître. Si elle est vide, elle doit afficher "Aucune donnée disponible".
Juste en dessus de cette table doit se trouver un bouton avec écrit dessus "Assigner". La table doit avoir les colonnes suivantes :
  - Travail
  - Date de création
  - Échéance
  - Client
  - Commentaire

  La table doit pouvoir afficher un nombre variable de demandes par page, tout comme celle des demandes assignées. Le tri doit aussi se faire de la même manière.
  Par défaut, la table doit être triée par date de création (les plus anciennes d'abord). Si une demande est ajoutée par un client alors que l'utilisateur se trouve sur cette page, la nouvelle demande apparaît en haut du tableau.
  Des tooltips doivent apparaître si l'utilisateur positionne son curseur sur les valeurs de certaines colonnes :
  - Pour les colonnes "Date de création" et "Échéance", le tooltip doit indiquer la date au format JJ/MM/AAAA.
  - Pour la colonne "Client", le tooltip doit indiquer le nom complet (prénom + nom) du client.

  La colonne "Commentaire" doit fonctionner de la même manière que sur la fenêtre modale des détails d'une demande, à savoir un icône qui ouvre une nouvelle petite fenêtre modale.
  A la différence de la table des demandes assignées, celle-ci doit avoir une checkbox devant le type de travail.
  L'utilisateur doit pouvoir cocher et décocher les checkbox.
  - Si aucune des checkbox n'est cochée, le bouton "Assigner" doit être désactivé.
  - Si au moins une des checkbox est cochée, le bouton "Assigner" doit s'activer.

  Quand l'utilisateur clique sur le bouton "Assigner", une fenêtre modale de confirmation doit s'ouvrir. Le texte doit indiquer le nombre de demandes cochées.
  - Si l'utilisateur clique en dehors de la fenêtre de confirmation, elle doit se fermer.
  - Si l'utilisateur clique sur le bouton "Annuler", la fenêtre de confirmation doit se fermer.
  
  Quand l'utilisateur clique sur le bouton "Valider", ce dernier doit se mettre en mode chargement tant qu'il n'y a pas eu de réponse du serveur. Si il n'y a pas eu d'erreur, toutes les demandes cochées doivent disparaître de la table et doivent se retrouver dans la table des demandes assignées sous "Mes commandes" et une notification en haut à droite de l'écran doit apparaître pour indiquer qu'il n'y a pas eu de problème. La fenêtre modale doit se fermer. En cas d'erreur, une notification en haut à droite de l'écran doit apparaître pour indiquer qu'il y a eu un problème.

- [x] **4.5** :
Cliquer sur "Paramètres". La page doit changer (/settings). L'interface doit être totalement identique que pour le client.

## 5. Version mobile
Pour ces essais, il faut utiliser un Smartphone ou utiliser l'émulateur dans Chrome. Je recommande d'utiliser le Smartphone car c'est un cas réel d'utilisation.
Le mieux est de faire tous les essais en même temps que sur PC, et de porter une attention aux points mentionnés.

- [x] **5.1** :
Accéder au site. La page d'accueil doit être de la bonne taille en portrait et en paysage. Il ne faut pas que le contenu soit écrasé.
Se connecter via AAI. Une fois arrivé sur la page principale, vérifier que la barre du haut est affichée correctement :
  - Le bouton de gauche pour montrer/masquer la barre latérale doit fonctionner. La barre latérale doit recouvrir une partie de la page et non pas la comprimer.
  - La barre latérale doit avoir une scrollbar tactile.
  - En mode portrait, le titre doit s'aligner verticalement. Il ne doit pas déborder sur les côtés.
  - En mode portrait, la cloche doit être au dessus du prénom. Ces deux éléments doivent rester alignés verticalement, sans déborder.
  - En mode portrait, le bouton pour montrer/masquer la barre latérale ainsi que le logo HEIG ne doivent pas déborder. Ils doivent rester alignés horizontalement.
  - Les liens/boutons doivent fonctionner : logo, prénom, cloche et éléments de la barre latérale. Il ne faut pas provoquer de missclick si les éléments sont trop proches les uns des autres.
  
- [x] **5.2** :
Ouvrir le formulaire de demande. Le fonctionnement doit être identique que sur PC. Tous les éléments doivent être visibles à l'écran.
  - Le calendrier doit s'afficher de sorte à ce que l'on puisse sélectionner toutes les dates possibles.
  - Le sélecteur doit avoir la place de se dérouler.
  - L'indice sur les champs doit être visible, surtout pour les fichiers à joindre.
  - Pour les fichiers à joindre de la timeline, il faut que le texte du champ soit bien visible jusqu'à 5 fichiers sélectionnés. Au delà, le cas n'est pas réaliste et il risque d'y avoir des problèmes d'affichage sur le petit écran.

- [x] **5.3** :
Accéder à la page "Travaux réalisables". Les travaux doivent garder la même forme : 
  - Image bien à gauche.
  - Type de travail, nom de la machine, description et lien doivent être alignés comme sur PC, à droite.
  - En client, cliquer sur l'image ou le type de travail doit ouvrir le formulaire pré-rempli.
  - Les travaux doivent êtres contenus dans une liste à une colonne.
  
- [x] **5.4** :
Accéder à la page "Mes commandes". C'est cette page qui change le plus avec l'interace mobile. En portrait, la table doit basculer en affichage mobile. 
  - Tout en haut, elle doit avoir un sélecteur qui permet de choisir le tri.
  - Si un mode de tri est sélectionné, un chip doit apparaître dans le sélecteur. Cliquer une fois dessus doit changer l'ordre de tri. Cliquer encore une fois dessus doit le faire disparaître.
  - Il ne doit pas y avoir plus qu'un critère de tri à la fois.
  - Les tooltips ne doivent pas fonctionner.
  - Cliquer sur une demande doit ouvrir la fenêtre modale des détails.

  La fenêtre modale des détails s'adapte pour les petits écrans. La petite table, le stepper, la chatbox et la timeline ne figurent plus sur la même fenêtre. Au lieu de ça, c'est un carousel qui est utilisé pour chaque composant.
  En swipant de droite à gauche, l'ordre des vues doit être le suivant : table > timeline > stepper > chatbox > table > ...
  L'utilisateur doit pouvoir changer de vue en swipant à gauche et à droite. Si le travail n'est pas assigné, la chatbox et la timeline de doivent pas apparaître.
  Critères à vérifier pour la vue du tableau :
    - Quand la fenêtre modale des détails s'ouvre, la première fenêtre du carousel doit être celle du tableau. Une scrollbar doit apparaître si le contenu est trop grand (paysage).
    - Si la demande est en statut "Terminé", le bouton "Terminer la demande" doit toujours apparaître tout en haut de la table.
    - Les boutons pour afficher les fichiers et les commentaires doivent fonctionner correctement.
    - Les mêmes informations que sur PC doivent figurer sur la vue.

  Critères à vérifier pour la timeline :
  - Le champ pour déposer les fichiers doit se trouver en bas. En dessus, il doit se trouver la timeline. Tout en haut doit se trouver le titre.
  - Dans la timeline, il doit y avoir une scrollbar. En scrollant, le champ pour déposer les fichiers doit rester fixe, ainsi que le titre.
  - Pour les fichiers à joindre, il faut que le texte du champ soit bien visible jusqu'à 5 fichiers sélectionnés. Au delà, le cas n'est pas réaliste et il risque d'y avoir des problèmes d'affichage sur le petit écran.
  - Le texte des évènements de la timeline ne doit pas déborder de l'écran. Tout les évènements doivent être visibles.

  Critères à vérifier pour la vue du stepper :
    - Le stepper doit pouvoir s'afficher verticalement.
    - Si il n'y a pas la place pour tout afficher, une scrollbar doit apparaître.

  Critères à vérifier pour la vue de la chatbox :
  - Le champ pour envoyer un message doit se trouver en bas. En dessus, il doit se trouver l'historique des messages. Tout en haut doit se trouver le titre.
  - Dans l'historique des messages, il doit y avoir une scrollbar. En scrollant, le champ d'envoi doit rester fixe, ainsi que le titre.
  - Le texte des messages ne doit pas déborder.

- [x] **5.5** :
Accéder à la page "Paramètres". Cette page doit ressembler à la version PC. Vérifier que les switchs sont alignés horizontalement avec leur titre.
Vérifier aussi que les informations de la première carte soient affichées.
 
## 6. Interactions en temps réel
Ces essais doivent êtres faits avec deux PC différents, ou bien un seul avec deux fenêtres, en navigation privée et normale. Je recommande d'utiliser deux PC, car les deux écrans sont toujours visibles au même moment

- [x] **6.1** :
Se connecter avec un compte client et un compte technicien. Marche à suivre :
 1. Le technicien doit être sur la page "Commandes clients", qui doit être vide.
 2. Le client dépose 4 nouvelles demandes, une de chaque type. Au fur et à mesure que les demandes sont déposées, le tableau du technicien doit se remplir et afficher les demandes du client.
 3. Le client peut ouvrir et fermer la fenêtre modale des détails de chaque demande pour se débarasser des icônes de notification (!). Il ouvre la même fenêtre sur la demande qui va être assignée.
 4. Le technicien s'assigne la demande. La demande doit disparaître de la table et doit se retrouver dans la table des demandes assignées sur la page "Mes commandes".
 5. Pour le client, au moment oû la demande est assignée, la chatbox et la timeline doivent apparaître en temps réel. Un nouveau statut est ajouté dans la timeline, pour les deux acteurs.
 6. Vérifier que l'échange de messages fonctionne.
 7. Vérifier que l'ajout de fichiers fonctionne. Les nouveaux fichiers doivent apparaître en temps réel dans la liste déroulante des fichiers et des évènements de la timeline doivent être ajoutés.
 8. Le technicien fait changer le statut de la demande. Le stepper doit changer en temps réel et et des évènements de la timeline doivent être ajoutés.
 9. Quand un statut change, le vérifier qu'il change aussi dans la colonne "Statut" du premier tableau, en ayant la fenêtre des détails fermée. Le tri doit s'opérer dans la table à chaque changement.
 10. Quand le technicien impose le statut "Terminé", le bouton "Terminer la demande" doit apparaître en temps réel chez le client.
 11. Quand le client supprime la demande, sa fenêtre modale des détails ainsi que celle du technicien doivent se fermer. La demande ne doit plus figurer sur aucune des tables.

Il est important de vérifier que l'interface change en temps réel. Si la demande est effacée par le client, la fenêtre des détails doit se fermer chez les deux acteurs.
Il faut s'assurer que les demandes soient bien notifiées quand il y a des changements.

- [x] **6.2** :
Se connecter avec deux comptes techniciens différents. Il faut avoir quelques demandes non assignées pour ces essais. Marche à suivre :
 1. Les techniciens doivent être sur la page "Commandes clients", qui doit contenir des demandes.
 2. Les techniciens cochent la même demande puis cliquent sur "Assigner". Seul l'un des deux clique sur Valider. La fenêtre de validation doit se fermer chez les deux. La demande doit disparaître de la table chez les deux.
 3. Le premier technicien coche deux demandes et clique sur "Assigner". Le second n'en coche qu'une des deux et se l'assigne. Le premier technicien doit voir que la valeur est passée de 2 à 1 dans le texte de la fenêtre de validation.

Il est important de vérifier que la table est synchronisée chez tous les techniciens. Si deux techniciens veulent s'assigner la même demande, c'est le plus rapide qui gagne. La fenêtre modale de validation doit s'adapter en temps réel à ces changements. Si toutes les demandes cochées sont retirées, la fenêtre de validation doit se fermer.

## 7. Emails de notification
Pour ne pas à avoir attendre, le mieux est de choisir 30 secondes de délai pour l'envoi des messages. La route "/api/email/{id}" sert à forcer l'envoi d'un mail différé à l'utilisateur {id}.

- [x] **7.1** :
Se connecter avec un compte client et un compte technicien. Marche à suivre :
 1. S'assurer que les paramètres mail du client soient tous activés. Le client reste sur cette page et ne doit pas aller ouvrir les détails de ses demandes.
 2. Le technicien prend une demande du client et lui envoie 3 messages, ajoute 1 fichier et change le statut de la demande. Le client doit reçevoir un mail indiquant les mêmes changements.
 3. Refaire la même procédure que ci-dessus, sauf que cette fois le client doit ouvrir et fermer la fenêtre des détails de la demande avant le délai de 30 secondes. Aucun mail ne doit être reçu du client.
 4. Refaire la même procédure mais en ayant désactivé les paramètres de notification du client, avant puis après les modifications. Aucun mail ne doit être reçu du client.
 5. Vérifier que si plusieurs demandes changent, toutes ces demandes doivent apparaître dans le mail, et chaque demande doit indiquer quels éléments ont changés.

Il est important de vérifier que les éléments qui apparaîssent dans le mail correspondent bien aux éléments notifiés dans l'interface. Vérifier dans la fenêtre des détails après avoir reçu le mail.
Le système fonctionne de la même manière pour alerter le technicien. Vérifier que ce soit le cas.
Quand un mail est envoyé, tous les éléments notifiés de toutes les demandes sont pris en compte. Vérifier que ce soit le cas.

- [x] **7.2** :
Se connecter avec un compte client et un compte technicien. Marche à suivre :
  1. Désactiver tous les paramètres de notification du client.
  2. Le technicien prend une demande du client et lui envoie 1 message, ajoute 1 fichier et change le statut de la demande. Aucun mail ne doit être reçu du client.
  3. Le client active seulement les notifications pour les nouveaux statuts et les nouveaux fichiers.
  4. Le technicien prend une demande du client et ajoute 1 message. Aucun mail ne doit être reçu du client.
  5. Le client active les notifications pour les nouveaux messages.
  6. Le technicien prend une demande du client et ajoute 1 message. Le client doit reçevoir un mail indiquant tous les changements.

  Cette procédure peut être répétée en changeant le paramètre testé :
  - Le client active seulement les notifications pour les nouveaux statuts et les nouveaux messages, pour tester les fichiers.
  - Le client active seulement les notifications pour les nouveaux fichiers et les nouveaux messages, pour tester les statuts.

  Il est important de vérifier que les conditions d'envoi sont bien respectées. Si l'utilisateur ne désire pas être averti par mail des nouveaux messages, les changements de statuts et l'ajout de fichiers ne doivent pas envoyer de mail, etc.