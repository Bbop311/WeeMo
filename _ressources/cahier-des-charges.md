#### Site de vente de bien immobilier

# Cahier des charges

## 1. Introduction

Ce document présente les attendus du projet de création d'un site de vente de biens immobiliers en ligne. Vous y trouverez une explication du **contexte**, la listes des **besoins** du client, le détail du **périmètre du projet**, une description des **fonctionalités** attendues ainsi qu'un **planning prévisionnel** des étapes successives à la réalisation du dit projet.

## 2. Contexte de création du projet

En 2019, le secteur immobilier a atteint la barre historique avec **85 milliards d'euros** de chiffre d'affaires à Paris. Des entreprises comme Vaneau ont enregistré des hausses de** 10% et plus de leur chiffre d'affaires** dans l'immobilier à Paris. Pour autant, le prix moyen du mètre carré parisien à connu une baisse en 2023 poour repasser sous la barre des 10 000€ le mètre carré.

Courant 2024, les **JO de Paris**, **la loi climat et résilience** incitant à la rénovation des logements pour améliorer leur performance énergétique ainsi qu'une** confirmation à la baisse** du prix du mètre carré, présentent un réel challenge pour toute personne souhaitant vendre son bien. De plus, les analyse de différents acteurs tendent à démontrer une **possible sortie de crise** de l'immobilier parisien courant 2025.

Notre client, conscient de tous ces enjeux et ne voulant surtout pas passer à côté de la reprise possible en 2025, souhaite lancer un site d'agence immobilière en ligne pour proposé un outil pratique aux éventuels vendeurs et acheteurs. Inspiré par le succès de plateformes comme **Se Loger**, **Bien’Ici** et **Proprioo**, il désire se différencier en intégrant des fonctionnalités innovantes basées sur le machine learning. L'objectif est de proposer une expérience utilisateur améliorée grâce à des recommandations personnalisées et une évaluation immédiate du prix de vente d'un bien.

Les motivations principales du client incluent la volonté de **générer des revenus supplémentaires**, **d'investir le marché de l'I.A. immobilière**, et de **sensibiliser le public** à la réduction de l'emprunte carbone.

La cible principale de ce projet comprend les **premiers acheteurs**, des personnes achetant pour la première fois un bien immobilier, souvent des jeunes ménages, et **les familles** à la recherche de biens offrant suffisamment d'espace et de commodités pour répondre à leurs besoins.

En résumé, le lancement de ce site d'agence immobilière en ligne et l'occasion pour notre client de s'imposer dans le **domaine de l'IA immobilière** et d'impulser une **éthique responsable** dans le domaine de l'immobilier.

## 3. Définition du besoin

Le projet doit répondre à plusieurs besoins spécifiques du client, qui sont à la fois économiques, écologiques et technologiques.

### 3.1 Besoins économiques

* **Offrir un service d'évaluation efficace** : Notre client souhaite proposer une plateforme sur laquelle les vendeurs pourront venir proposer leur bien et avoir immédiatement, en temps réel, une première estimation de la valeur de leur bien en fonction de son type, sa localisation et de la surface de celui-ci.

* **Générer des revenus supplémentaires** : En se lançant sur internet, notre client espère diversifier ses sources de revenus et tirer profit de la reprise du marché prévue en 2025.

### 3.2 Besoins écologiques

* **Promouvoir la rénovation énergétique** : Notre client tient à ce que l'aspect énérgétique des biens à vendre soit mis en avant et favorisé sur le site final. Ceci devrait permettre d'influencer le marché sur le long terme.

### 3.3 Besoins technologiques

* **Investir le marché de l'IA immobilière** : Le client souhaite également devenir leader dans les nouvelles technologies liées au marché de l'immobilier. Il faut donc proposer un premier prototype incluant au moins un modèle d'IA entraînée sur de la donnée immobilière.

* **Sécurité maximale** : Mettre en place des mesures de sécurité robustes, telles que l'authentification à deux facteurs, l'identification password-less et le chiffrement des données sensibles, afin de protéger les informations des utilisateurs et de garantir des transactions sécurisées.

# 4. Définition du périmètre du projet

## 4.1 Contraintes technologiques

Pour le développement du site, plusieurs technologies et outils seront utilisés pour garantir une expérience utilisateur optimale et une sécurité maximale. 

Voici un aperçu des technologies employées, sauf contre indication, l'usage de celles-ci est obligatoire :

### Front-end

* **HTML, CSS et JavaScript** : Ces langages de base seront utilisés pour structurer et styliser les pages web.
* **Bootstrap** : Ce framework CSS facilitera la création d'un design responsive et moderne.
* **Figma** : Cet outil graphique sera utilisé pour la création de wireframes, de zonings et de schémas, Figma permettra de visualiser et de planifier l'interface utilisateur.

### Back-end

* **PHP** : Le langage principal pour le développement côté serveur.
* **Symfony** : Ce framework PHP sera utilisé pour structurer l'application selon le modèle MVC (Modèle-Vue-Contrôleur), facilitant ainsi la maintenance et l'évolution du code.
* **Rubix ML** : Pour intégrer des fonctionnalités de machine learning, Rubix ML sera utilisé pour l'évaluation des prix des biens à vendre.

### Base de données

* **MySQL** : Choisi pour sa robustesse et sa compatibilité avec PHP, MySQL sera le SGBD principal.
* **MongoDB** : Optionnellement, MongoDB pourra être utilisé pour sa flexibilité avec les données non structurées et son évolutivité. Une sérialisation-désérialisation **POO<->MongoDB** serait un très gros point fort.

### Outils de développement

* **Visual Studio Code (VS Code)** : L'IDE principal pour les développeurs, avec des extensions comme Prettier pour le formatage du code, PHP Intelephense pour les fonctionnalités avancées de PHP, et Markdown Preview Enhanced pour la lecture des fichiers Markdown.
* **MAMP** : Utilisé pour l'hébergement local, MAMP permettra de simuler un environnement de production en local.
* **GitHub** : Pour la gestion de versions, GitHub sera utilisé pour suivre les modifications du code et faciliter la collaboration entre les développeurs.

### Tests et CI/CD

* **PHPUnit** : Cet outil sera utilisé pour les tests unitaires en PHP, garantissant ainsi la qualité et la fiabilité du code.
* **GitHub Actions** : Pour l'intégration continue et le déploiement continu (CI/CD), GitHub Actions automatisera les pipelines de génération, de test et de déploiement.

### Sécurité

* **Authentification à deux facteurs ou Authentification pawword-less :** Pour sécuriser les comptes utilisateurs.
* **Chiffrement des données sensibles** : Pour protéger les informations personnelles et financières des utilisateurs.

Ces technologies et outils permettront de développer un site performant, sécurisé et évolutif, répondant aux besoins spécifiques du projet.

## 4.2 Ressources humaines et budget

### Ressources humaines

L'équipe sera formée de cinq développeurs back-end juniors formés au sein de l'école. Ils seront encadrés par un formateur sénior qui les guidera dans leurs développements.

### Ressources budgétaires

Aucun budget supplémentaire ne sera possible pour la réalisation du prototype attendu.

## 4.3 Exigences de sécurité

### Sécurité des données

Le site doit prévoir d'intégrer les technologies nécessaires fin de garantir :
- la **protection des données personnelles** des utilisateurs conformément aux réglementations en vigueur (ex : GDPR).
- la **sauvegarde régulière des données** et un plan de reprise après sinistre en cas de perte de données.

### Authentification et contrôle d'accès

Le site doit prévoir : 

- la mise en place de **mécanismes d'authentification forte** pour les utilisateurs et le personnel autorisé. Soit pas **authentification multifacteur** soit par **authentification passwordless**.
- la **gestion des droits d'accès** pour limiter l'accès aux informations sensibles uniquement aux personnes autorisées.

### Politique de confidentialité et conditions d'utilisation

Le site devra inclure une **politique de confidentialité** détaillée expliquant la collecte et l'utilisation des données des utilisateurs. Ainsi que des **conditions d'utilisation claires** pour les clients concernant les transactions, les retours et les échanges (du lorem ipsum ou texte généré par IA suffira).

# 5 Description fonctionnelle du besoin

Cette section détaille les fonctionnalités attendues du projet et fournies quelques exemple de fonctionnalités supplémentaires que vous pourriez implémenter dans votre prototype.

## 5.1 Fonctionnalités clés

Voici une liste de fonctionnalités possibles pour l'élaboration de votre projet. Certaines sont obligatoires, d'autres purement optionnelles, à vous d'implémenter dans votre prototype les fonctionnalités obligatoires et d'aller piocher dans celles optionnelles selon votre convenance.

### Interface utilisateur :

- **Page d'accueil attrayante et conviviale (obligatoire)** présentant les logements disponibles.
- **Système de recherche avancée (obligatoire)** pour permettre aux utilisateurs de trouver un bien à acheter.
- **Pages produit détaillées (obligatoire)** avec des images de qualité, des descriptions précises et des informations sur le logement en vente.
- **Page de mise en ligne d'un nouveau bien** avec remplissage automatique du champ "prix de vente" par l'IA intégrée au site (le vendeur pourra toujours modifier la somme).

### Gestion des utilisateurs :

- **Système d'inscription et de connexion (obligatoire)** sécurisé pour les utilisateurs.
- **Profils utilisateurs (optionnel)** personnalisés permettant de sauvegarder les préférences et l'historique des annonces consultées/mises en ligne.
- Possibilité pour les utilisateurs de **gérer leurs annonces de vente (optionnel)**.

### Gestion des produits :

- **Interface d'administration (obligatoire)** pour ajouter, modifier ou supprimer des biens.
- **Catégorisation des biens (obligatoire)** par type, arrondissement, superficie, etc.

### Fonctionnalités supplémentaires :

- **Système de messagerie interne (optionnel)** pour faciliter la communication entre acheteurs et vendeurs.
- **Outil de notation et de commentaires (optionnel)** pour évaluer la fiabilité des vendeurs et des biens vendus.
- **Intégration de fonctionnalités sociales (optionnel)** pour partager des biens en vente et des avis sur les réseaux sociaux.

## 5.2 Algorithmes de machine learning (obligatoire)

Votre prototype devra impérativement exploiter un modèle de machine-learning de type **Gradient Boost** entrainé à évaluer la valeur d'un bien en fonction de son type, sa superficie, son arrondissement...

Les algoryhtmes et modèles vous seront fournis et vous pourrez les utiliser directement dans le développement de votre prototype, même si, améliorer ceux-ci avec vos propre entraînements et réglages reste possible, ce n'est pas l'objectif premier.

# 6 Plan d'action

Organisez-vous pour suivre (en l'adaptant si besoin) le plan d'action suivant afin de vous permettre de créer l'ensemble de votre prototype dans les temps.

Nul besoin de créer des dizaines de pages, dans un tel prototype, entre cinq et huit pages parfaitement fonctionnelles suffisent largement.

## 6.1 Analyse de marché et validation du concept (1/2 j.)

Lors de cette étape préparatoire au projet, l'équipe devra mener des recherches sur internet (chacun de son côté), en se rendant sur les sites de la concurrence et en prenant des notes sur ce qui est bien fait et ce qui l'est moins. Cette étape rapide (première matinée) permet de se mettre dans le bain et de commencer à s'approprier le sujet.

## 6.2 Design rapide d'un prototype (1/2 j.)

Cette étape rapide permet de faire quelques croquis très simplistes du future site. L'équipe se concentrera surtout sur les fonctionnalités, surtout pas sur l'esthétique qui n'a aucune importante pour ce prototype. À l'issue de cette phase, l'équipe se réunira pour créer un croqui final des pages à réaliser en gardant les meilleurs idées de chacun.

## 6.3 Développement front-end (2 j.)

Le développement d'un front-end doit se faire assez rapidement, même si il n'est pas finalisé. Dans ce but, l'équipe utiliser le framework CSS Bootstrap afin de gagner du temps, de disposer d'une grille responsive et d'avoir un design (celui de défaut de boostrap) suffisement propre pour une présentation du prototype au client. Il n'est pas question de passer des heures à choisir des couleurs, l'équipe n'étant constituée que de développeurs back-end, et non de designers, cela n'aurait aucun sens et serait probablement contre productif.

## 6.4 Développement back-end (7 j.)

Le plus gros du développement du projet va se trouver ici. Il s'agit de créer l'architecture globale du site en utilisant le framework Symfony et d'y intégrer les fonctionnalités attendues, le HTML précédement créé ainsi que le modèle de ML entraîné pour produire ses prédictions.

L'équipe devra se répartir les tâches en fonction des affinités et des capacités de chacun mais également du temps restant et des objectifs à remplir.

## 6.5 Tests unitaires (1 j.)

Il faudrait implémenter des tests unitaires avec PHP-unit, au moins sur les parties les plus sensibles du prototype comme la création de compte, l'ajout de données en BDD et l'intégration du modèle de ML.

## 6.6 Mise en production du prototype (1 j.)

Si possible, le prototype devra être mis en ligne en utilisant l'intégration continue et GitHub Actions. Cette opération ne necessitant pas que toute l'équipe soit mobilisée, une ou deux personnes pourront s'en occuper pendant que les autres finalisent le projet.

# 7. Conclusion

Ce cahier des charges est déjà suffisement détaillé pour vous permettre de créer un prototype d'application convaincant tout en étant raisonable.

Si toutefois votre équipe était vraiment trop forte et vous trouviez ce cachier des charges trop facile, une piste d'amélioration serait de trouver une autre source d'information, beaucoup plus détaillée, et de réentraîner un algo de ML - toujours le même - mais avec de nouvelles données.

Nous n'avons ici, pas grand-chose à exploiter : surface, terrain, type, code postal. Ces donnée sont limitées et un bien dépend d'autres paramètre comme l'étage, le parking, l'acscenseur, la proximité de gares... Si vous trouviez une source de données offrant toutes ces infos, cela pourrait présenter un vrai bonus.

Une piste pourrait-être d'utiliser les données de site existants comme **seloger.com**, malheureusement, on ne peut pas écrire d'aspirateur pour de tels sites, il faudra enregistrer les pages HTML une à une dans un dossier puis écrire un script qui lira ces pages pour en extraire les données... C'est faisable. Sachant que, ce site par exemple, ne présente que 25 biens par page et qu'il faudra entre 3000 et 5000 biens pour entraîner votre modèle, cela veut dire télécharger manuellement entre 120 et 200 pages... C'est vraiment vaisable en s'y mettant à plusieurs. 

Bien sûr, si vous trouvez un API ou autre source de donnée, c'est encore mieux.