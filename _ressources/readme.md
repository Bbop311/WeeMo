# A propos des ressources

## paris_valeur_fonciere.sql

Importez ce fichier dans votre base de donnée *"dvf"* préalablement créée sur phpMyAdmin. Il contient environ 26 000 lignes de logements vendus à Paris en 2023.

Ces données vous serviront si vous souhaitez essayer d'entraîner votre propre version de l'algorithme de M.L. qui vous est fourni.

## valeursfoncieres-2023.csv

La source de données brutes utilisée provient du ministère de l'économie ([Demandes de valeurs foncières](https://www.data.gouv.fr/fr/organizations/ministere-de-leconomie-des-finances-et-de-la-souverainete-industrielle-et-numerique/#/datasets)). Le fichier CSV fourni est brute, il contient beaucoup d'erreurs et de données à filtrer. 

Vous pourriez, en théorie, filtrer ces données pour entraîner une nouvelle version de votre *I.A.* à trouver les prix de logement sur toute la France. Malheureusement, cela veut dire connaître d'abord les prix minimum et maximum du mètre carré pour chaque ville de France pour éliminer les aberration statistiques ou du fait d'erreurs de saisie. On trouve, en effet, dans la BDD, des appartements à 1 euro le mètre carré, et d'autres à 65 millions. Ce sont évidemment des abberations qu'il faut supprimer avant d'entraîner une IA.

> Pour Paris, par exemple, il a fallut se référer à la page suivante [seloger.com](https://www.seloger.com/prix-de-l-immo/vente/ile-de-france/paris.htm) pour connaître les prix minimum et maximum du mètre carré, puis calculer le prix du mètre carré de tous les logements présents en BDD pour supprimer ceux à moins de 6000€ et ceux à plus de 16000€.

Il faut aussi supprimer les données délirantes, comme les appartement à 1 euro, ou les maisons de 1 mètre carré de surface. 

C'est le travail du backeux de détecter et de supprimer ou corriger de telles erreurs dans les données.

> Vous pourriez, toutefois, assez facilement, entraîner une *I.A.* sur les plus grosses villes de France en vous limitant, par exemple, au vingt villes les plus importantes.
