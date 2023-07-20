# Initialisation

## Récupérer le dépot git et dépendances

    git clone https://github.com/radjaho973/garage-parrot

Déplacer vous dans le dossier racine puis récupérer les dépendances du projet avec Composer


    cd garage-parrot

    composer update

## Mise en place de la BDD
Les instructions suivante assument que vous avez un logiciel Wamp ou Xamp déja configuré et allumé.

créer un fichier `.env.local` à la racine de l'application, c/c le contenu de `.env` à l'intérieur puis modifier les lignes suivantes :

Commenter la ligne 

    DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=15&charset=utf8"

Décommenter 

    # DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"

La base de donnée est accessible via un **nom d'utilisateur** [app] et un **mot de passe** [!ChangeMe!] (optionnel en local) ainsi que **le nom de la base de donnée** elle même [app], vous devez spécifier chacune de ses 3 informations

    DATABASE_URL="mysql://username:password@127.0.0.1:3306/databasename?serverVersion=8.0.32&charset=utf8mb4"

### Doctrine

Pour pouvoir accéder au site utiliser la commande suivante pour créer une base de donnée

    php bin/console doctrine:database:create
Remplisser votre nouvelle bdd avec 

```
 php bin/console doctrine:schema:update --force
```
Vous pouvez déja accéder au site en lançant le serveur symfony via `php -S 127.0.0.1:8000 -t public` mais le site sera vide et aucun user ne sera disponible, pour changez tous cela lancer :

    php bin/console doctrine:fixtures:load
   
    > Careful, database "garage_test" will be purged. Do you want to continue? (yes/no) [no]: 
    > yes


Les fixtures vont généré un USER_ADMIN ainsi que plusieurs employé tous possédant le même mot de passe visible dans AppFixtures.php,
Libre à vous de le modifier une fois connecter sur le backOffice.
Concernant les voiture elle sont généré de façon aléatoire ne soyez donc pas trop étonné de voir des BMW à 2000€.

Enfin pour finaliser le rendu du site faite

    npm install
    npm run watch

