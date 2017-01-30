<?php


//Les objets repository permettent de récupérer des enregistrements en base de données
//Toutes les requpetes select sont donc sensées s'y trouver

class ClientRepository
{

	//Récupère la liste de tous les commandes en base de données
	public function getAll($pdo) {

		//Effectuer la requête en bdd pour récupérer l'ensemble des commandes enregistrés en bdd
		$resultats = $pdo->query('SELECT p.civilite, p.nom, p.prenom, com.id, com.ref, com.date_cmd, com.date_expedition, s.libelle FROM personne p INNER JOIN commande c ON p.id = c.id INNER JOIN commande com ON c.id=com.commande_id INNER JOIN statut s ON com.statut_id=s.id');

		$resultats->setFetchMode(PDO::FETCH_OBJ);

		//Boucler sur tous les enregistrements récupérés grâce à votre requête SELECT
		//et pour chaque enregistrement :
		// 1 -  instancier un objet commande
		// 2 -  hydrater ses attributs avec les valeurs récupérées en bdd
		// 3 - pour chaque objet commande instanciés et hydratés, les ajouter dans un tableau
		// 4 - retourner ensuite ce tableau avec l'instruction return

		$listeClients = array();

		while($obj = $resultats->fetch()){	

			$commande = new Client();
			$commande->setId($obj->id);
			$commande->setCivilite($obj->civilite);
			$commande->setNom($obj->nom);
			$commande->setPrenom($obj->prenom);
			$commande->setDateNaissance($obj->date_naissance);
			$commande->setAdresse($obj->adresse);
			$commande->setCp($obj->code_postal);
			$commande->setVille($obj->ville);
			$commande->setBic($obj->bic);
			$commande->setIban($obj->iban);

			$listeClients[] = $commande;

		}

		return $listeClients;
	}

}