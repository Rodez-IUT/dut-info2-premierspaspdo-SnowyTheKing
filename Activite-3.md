Activité 3
3.

La chaîne de caractères suivante:

		a%' or 1 = 1 ; -- 
		
transforme la requête SQL voulue au départ.
En effet, le premier apostrophe permet de fermer la chaîne de caractères liée au LIKE,
et le point virgule suivi des deux tirets permet de mettre la fin du code SQL en commentaire.
Ainsi, seul le LIKE sera traité, et la suite du WHERE ne le sera pas.