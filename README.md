# tpsymfony
démarrage de docker
créer la base de donnée: tp_symfo, une fois la bd créer importer le ficher se trouvant à la racine et à pour nom tp_symfo.sql puis executer
créer un fichier .env avec l'url suivant : DATABASE_URL="mysql://user:mdp@127.0.0.1:3306/tp_symfo?serverVersion=3.7&charset=utf8mb4"
remplacer user par votre nom d'utilisateur et mdp par votre mot de passe

installer le projet avec la commande suivante: npm i
démarrage de symfony avec la commande suivante : symfony serve
démarrage du projet avec la commande suivante: npm run watch
