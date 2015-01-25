AwayFromSwag
============

Ce projet a été réalisé par:
- Anthony LOROSCIO
- Loick MAHIEUX
- Thomas MUNOZ
- Floran NARENJI-SHESHKALANI
- Loïc PAULETTO

Divers warnings:
- Les accès de base de données fournis dans la configuration correspondent à une BD hébergée sur un de nos dédiés personnels. Le système de messagerie utilise celle-ci pour les métadonnées des conversations, mais repose sur des fichiers locaux (app/converations/) pour le stockage des messages mêmes. Il est donc normal qu'une exception soit levée si le fichier n'est pas présent (par exemple si vous créez une conversation sur votre copie locale sur site et qu'un autre enseignant tente de l'ouvrir sur une autre machine)


Le site est visible en ligne à l'adresse https://srv0.sknz.info:3735.

WHERE IS THE SWAG ?

#TODO :
    - Framework :
        - Authentification avec niveaux accès + nb connectés (Thomas) 
        - Géneration formulaire (Loick)
        - Gestion modules (Optionnel)
        - Gestion logs (Très optionnel voir inutile)
        - Exceptions (Everybody)
        - PHP-Unit (Everybody) 
        - Caching (Thomas)

    - Base de données :
        - Modéle Merise
        - Derivation PHP/SQL

    - Fonctionnalités projet :
        - Gestion évts exterieur (conf/perso)
        - Annuaire
        - Profil
        - Gestion amis
        - MP
        - Page de liens
        - Page de partenaire
        - Possibilité remonter haut de page.
        - Agenda perso + calendrier
        - Interface admin
            - Back-office
            - Gestion membres
            - Ajout partenaire, défis, ...
        - ...
            -News :
                -dernière sur la PB
                -basé sur evenemnts (proposer une news (+back office))

            -Evenements :
                -Liste evenements :
                    -affichage personnalisé (participation par user)
                    -nombre d'evenements
                -Evenement:
                    -image
                    -créateur
                    -description
                    -adresse
                    -date créa/evenements
                    -Participation financière
                    -nombre de places restantes + totale
                    -statut de la participation
                    -commentaire
                    -boutton "participer" (si pas déjà fait) + annule
                    -Lieu (#Google Maps)
                    -liste des inscrits

            -Défis :
                -jour, semaine, mois (page d'accueil = 3 derniers + 3 populaires)
                -top 5 classement
                -prochain évenements

            -Utilisateurs :
                -personnel :
                    -modifier profil
                        -info personelle (public / privée)
                            -profil :
                                -nom                 oblig
                                -prénom              oblig
                                -pseudo              oblig
                                -date naissance
                                -date inscription
                                -adresse mail
                                -numeros telephone
                                -twitter
                                -skype
                                -facebook
                                -site web perso
                                -bio / descript
                                -métier
                                -mot de passe
                                -avatar gravatar     oblig
                        -notifications
                    -Consulter le profil (via l'avatr)
                    -Messagerie
                    -Calendrier
                    -Liste d'amis  (demande => accepter /refuser,  liste)
                    #Mes défis
                    -Mes évenements
                    -Se déconnecter

            -messagerie :
                -table listant les convers avec un fichier contenant les convers


            -Pour tout :
                -recherche (Défis, Evenements, membres, tout)


      
# DONE
    - Gestion de routes (Thomas)
    - Serialisation XML (Thomas)
    - URL Rewriting (Thomas)
    - Flux RSS (Thomas)
    - Autoloader (Loick)
    - Couplage moteur de template - Twig (Loick)
    - Système POP-UP (Thomas)
    - Input (Loick)
    - Request helpers (Loick)
    - Gestion BD (Loick)
      
