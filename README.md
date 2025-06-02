# Shifumi en ligne<!-- omit in toc -->

## Sommaire <!-- omit in toc -->

- [Pré-requis](#pré-requis)
- [Objectif](#objectif)
- [Installation](#installation)
- [Comment rendre le projet](#comment-rendre-le-projet)
- [Fonctionnalités](#fonctionnalités)
  - [Duplication de code /2](#duplication-de-code-2)
  - [Page /game.php /2](#page-gamephp-2)
  - [Page /result.php /8](#page-resultphp-8)
    - [Sécuriser la page /2](#sécuriser-la-page-2)
    - [Calculer le résultat et l'afficher /2](#calculer-le-résultat-et-lafficher-2)
    - [Enregistrer la partie /4](#enregistrer-la-partie-4)
  - [Page /history.php /8](#page-historyphp-8)
    - [Récupérer les données /3](#récupérer-les-données-3)
    - [Afficher les données /3](#afficher-les-données-3)
    - [Nouvelle sauvegarde /2](#nouvelle-sauvegarde-2)
- [BONUS](#bonus)
  - [Pagination des données /6](#pagination-des-données-6)
  - [Fichier de configuration /2](#fichier-de-configuration-2)
  - [Nettoyage du code /2](#nettoyage-du-code-2)
  - [Futurs développements /4](#futurs-développements-4)

## Pré-requis

Vous devez avoir PHP d'installé sur votre machine. Vous devez savoir écrire des algorithmes en PHP (variables, conditions, boucles), comment intéragir avec l'utilisateur.ice dans le terminal et comment écrire et lire des fichiers.

Vous devez également avoir une AMP-stack (wamp, xampp, lamp) d'installé sur votre machine pour pouvoir manipuler une base de données MySQL et exécuter votre application sur un serveur web Apache.

## Objectif

Au vu du succès de votre jeu de shifumi dans le terminal, vous décidez de faire un portage du jeu sur navigateur. Pour cela, vous reprendrez une partie des algorithmes utilisés pour le terminal et les adapterez pour pouvoir les utiliser sur un site web. Vous passerez également d'un stockage de données par fichiers vers une base de données MySQL.

Les interfaces ainsi que la base de données vous sont déjà fournies.

Vous devez appliquer au mieux les bonnes pratiques de développement suivantes :

- utilisation de fonctions courtes et typées
- séparation des différents domaines de l'application dans des fichiers dédiés
- fonctions et variables avec des noms clairs et facilitant la compréhension

## Installation

Pour installer ce projet, ne créez pas de nouveau repository manuellement. Allez sur la page d'accueil de ce repository, puis cliquez sur ce bouton pour le forker:

![fork button](assets/fork.png)

Github va automatiquement vous créer un nouveau repository sur votre compte, avec le code de celui-ci.

Ouvrez le fichier `/mysql/shifumi.sql` et copiez son contenu.

Connectez-vous à votre serveur de base de données depuis le terminal. Collez le contenu du fichier précédemment copié. Vérifiez que la base de données s'est correctement créée en exécutant par exemple :

```sql
SHOW TABLES;
```

```sql
DESC games;
```


## Comment rendre le projet

- envoyer le lien de votre repository avec votre code
- OU faire une pull request de votre repository vers celui-ci

## Fonctionnalités

### Duplication de code /2

Les balises `nav`, `footer` `head` et leur contenu sont dupliqués à chaque page. Trouver un moyen de régler ce problème.

### Page /game.php /2

Utiliser le formulaire pour récupérer le choix de l'utilisateur.ice.

### Page /result.php /8

#### Sécuriser la page /2

Trouver un moyen simple et rapide pour empêcher la navigation vers cette page si l'utilisateur.ice ne vient pas de la page `/game.php`

#### Calculer le résultat et l'afficher /2

Utiliser et adapter les algorithmes fournis pour calculer le résultat de la partie, et afficher un message customisé sur la page en fonction de ce résultat.

#### Enregistrer la partie /4

Enregistrer le résultat de la page dans la base de données.

### Page /history.php /8

#### Récupérer les données /3

Récupérer les résultats des parties précédentes depuis la base de données.

#### Afficher les données /3

Utiliser les données récupérées pour les afficher dans le tableau fourni dans l'interface.

#### Nouvelle sauvegarde /2

Trouver un moyen pour supprimer les données de la base (sans supprimer la base ni les tables) pour avoir un nouvel historique.

## BONUS

### Pagination des données /6

Sur la page historique, permettre à l'utilisateur.ice de customiser l'affichage de ses parties précédentes via une pagination. On pourra décider du nombre de parties à afficher et quelle page on veut consulter.

### Fichier de configuration /2

Trouver un moyen d'enregistrer les infos de connexion à la base de données dans un fichier de configuration, et pas dans du code.
Indices : fichiers .json, .env, .yml

### Nettoyage du code /2

Supprimer toutes les fonctions et tous les fichiers qui ne sont plus utilisés par l'application web.

### Futurs développements /4

Soient 2 utilisateur.ices, que l'on appellera Alice et Bob. À ce jour, rien n'empêche Alice sur votre application de consulter les résultats des parties jouées par Bob, puisque toutes les parties sont mélangées dans la base de données. Rien ne permet de les différencier.

Proposer des étapes à suivre et les changements à faire (dans le code ou dans la base de données) pour corriger ce problème.
