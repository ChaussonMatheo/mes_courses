# Projet Symfony : Liste de Courses

## Description

Ce projet est un **travail pratique** visant à développer une application web pour la gestion de listes de courses. L'objectif principal est d'apprendre à utiliser le framework Symfony tout en mettant en œuvre des fonctionnalités dynamiques, comme la gestion des listes de courses, et en utilisant **Tailwind CSS** pour un design moderne et réactif.

---

## Fonctionnalités

- **Gestion des zones de magasin :**
  - Création, modification et suppression des zones.
  - Organisation des zones par position dans le magasin.
- **Gestion des produits :**
  - Ajout, modification et suppression des produits.
  - Association des produits à des zones spécifiques.
  - Affichage d'une liste triée par zone et nom.
- **Gestion des listes dynamiques :**
  - Création de listes de courses contenant plusieurs produits.
  - Mise à jour de l'état des produits dans une liste (exemple : "coché" lorsqu'un produit est dans le panier).
  - Suppression ou modification des listes.
- **Design moderne et intuitif :**
  - Utilisation de **Tailwind CSS** pour un design clair, minimaliste et entièrement responsive.
  - Composants personnalisés pour les formulaires, tableaux et cartes.

---

## Objectifs pédagogiques

- Découvrir le framework Symfony et ses outils principaux (ex. : Console, Doctrine).
- Comprendre et mettre en œuvre le modèle MVC (Modèle - Vue - Contrôleur).
- Manipuler des entités et des bases de données relationnelles avec Doctrine.
- Utiliser **Tailwind CSS** pour concevoir une interface utilisateur moderne.

---

## Installation

### Pré-requis

- **PHP** (version 8.1 ou supérieure)
- **Composer** (gestionnaire de dépendances PHP)
- **Symfony CLI**
- **MySQL** ou un autre gestionnaire de base de données compatible
- **Node.js** et **npm** (pour compiler les styles Tailwind CSS)

### Étapes d'installation

## Installation

### Étapes d'installation

1. **Installez les dépendances backend :**
   ```bash
   composer install
   ```

2. **Configurez l'environnement local :**
   - Créez un fichier `.env.local` dans le dossier racine :
     ```env
     APP_ENV=dev
     DATABASE_URL=mysql://<utilisateur>:<mot_de_passe>@127.0.0.1:3306/mescourses
     ```

3. **Créez la base de données et appliquez les migrations :**
   - Créez la base de données :
     ```bash
     php bin/console doctrine:database:create
     ```
   - Appliquez les migrations :
     ```bash
     php bin/console doctrine:migrations:migrate
     ```

4. **Installez Tailwind CSS et compilez les styles :**
   - Installez les dépendances Node.js :
     ```bash
     npm install
     ```
   - Compilez les styles Tailwind CSS en mode développement :
     ```bash
     npm run dev
     ```
   - Pour une compilation en production :
     ```bash
     npm run build
     ```

5. **Chargez des données de démonstration (fixtures) :**
   ```bash
   php bin/console doctrine:fixtures:load
   ```

6. **Lancez le serveur Symfony :**
   ```bash
   symfony server:start
   ```

   Une fois démarré, vous pouvez accéder à l'application via l'URL suivante : [https://127.0.0.1:8000](https://127.0.0.1:8000)
