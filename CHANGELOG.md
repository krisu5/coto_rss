coto_rss
===

## ToDo

* pouvoir encoder les caractères spéciaux non encodés sans double-coder ceux déjà encodés (certains RSS mélangent les deux, par exemple titre avec "&" seul et contenu avec "&amp")

## Historique des révisions

* rev.19 removed content-type rss (since it makes browsers to download page instead of showing it)
* rev.18 added option to curl to allow get from websites with bad cert
* rev.17 remplacement du JS par un placeholder dans le formulaire
* rev.16 ajout de mb_convert_encoding pour dégager les caractères codés sur plusieurs bits tronqués en plein milieu.
* rev.15 remplacement de file_get_contents par cURL
* rev.14 remplacement des commandes pour virer tout ce qui avait avant <?xml par stristr
* rev.13 viré un OK avant certains flux o_O
* rev.12 commenté la rev.10 en attendant de mieux (même les caractères déjà encodés étaient réencodés)
* rev.11 ajout effacement de plusieures lignes avant <?xml
* rev.10 changement & grace a preg_replace
* rev.09 ajout caractère &
* rev.08 ajout style
* rev.07 nettoyage du code, html5 valide
* rev.06 mise en forme page + ajout exemple dans le champ rss du formulaire
* rev.05 ajout formulaire
* rev.04 ajout page si pas de RSS en entrée
* rev.03 ajout suppression du caractère SUB
* rev.02 ajout suppression des caractères BS et SI
* rev.01 fichier initial (supprime les caractères ETX)
