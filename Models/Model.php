<?php

class Model
{
    private $bd; // Connexion à la base de données
    private static $instance = null; // Instance unique de la classe

    /**
     * Constructeur privé
     * 
     * Configure la connexion à la base de données (DSN, utilisateur, mot de passe).
     */
    private function __construct()
    {
        require_once 'identifiants/identifiant.php';

        try {
            // Tentative de connexion à la base de données
            $this->bd = new PDO($dsn, $username, $password);

            // Configure PDO pour afficher des exceptions en cas d'erreur
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Définit l'encodage UTF-8 pour la connexion
            $this->bd->query("SET NAMES 'utf8'");
        } catch (PDOException $e) {
            // Si la connexion échoue, affiche un message d'erreur et termine le script
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    /**
     * Retourne l'instance unique de la classe.
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new Model();
        }
        return self::$instance;
    }

    public function getTypesBrochures(){
        $query = "SELECT * FROM TypesBrochure;";
        $req = $this->bd->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les différents départements
     * 
     * Cette fonction ne prend aucun paramètre.
     * 
     * @return Array
     */
    public function getDepartements(){
        $query = "SELECT * FROM Departement;";
        $req = $this->bd->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les informations d'un utilisateur
     * 
     * Cette fonction prend en paramètre un identifiant et retourne les informations sur celui-ci.
     * 
     * @param int $id
     * @return Array
     */
    public function getUserInfo($id){
        $query = "SELECT * FROM Utilisateur WHERE id_utilisateur = :id;";
        $req = $this->bd->prepare($query);
        $req->bindValue(':id', $id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    
    /**
     * Récupère les demandes pour un enseignant
     * 
     * Cette fonction prend en paramètre un identifiant (celui de l'enseignant) et retourne un tableau contenant les colonnes de la tables et les valeurs associées à l'enseignant.
     * 
     * @param int $id_enseignant
     * @return Array
     */
    public function getDemandeForEns($id_enseignant){
        $query = "SELECT Departement.nom, Demande.nb_pages, Demande.nb_copies, Demande.agrafes, TypesBrochure.nomBrochure, Demande.date_demande, Demande.status FROM Demande JOIN Utilisateur USING (id_utilisateur) JOIN Departement USING (id_departement) JOIN TypesBrochure USING (id_typeBrochure) WHERE id_utilisateur = :id_enseignant;";
        $req = $this->bd->prepare($query);
        $req->bindValue(':id_enseignant', $id_enseignant, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDemandeParStatus($status){
        $query = "SELECT Demande.id_demande, Departement.nom as Dept, Utilisateur.nom, Utilisateur.prenom, Demande.nb_pages, Demande.nb_copies, Demande.agrafes, TypesBrochure.nomBrochure, Demande.date_demande, status FROM Demande JOIN Utilisateur USING(id_utilisateur) JOIN Departement USING(id_departement) JOIN TypesBrochure USING(id_typeBrochure) WHERE status = :status;";
        $req = $this->bd->prepare($query);
        $req->bindValue(':status', $status, PDO::PARAM_STR);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetailsDemandeById($id_demande){
        $query = "SELECT Departement.nom AS Dept, Utilisateur.nom, Utilisateur.prenom, nb_pages, nb_copies, agrafes, TypesBrochure.nomBrochure, date_demande, status, commentaire, fichier FROM Demande JOIN Departement USING(id_departement) JOIN Utilisateur USING(id_utilisateur) JOIN TypesBrochure USING(id_typeBrochure) WHERE id_demande = :id_demande;";
        $req = $this->bd->prepare($query);
        $req->bindValue(':id_demande', $id_demande);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getEtatDemandes() {
        $query = "SELECT status, COUNT(*) as total_demandes FROM Demande GROUP BY status;";
        $req = $this->bd->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatsParDepartement(){
        $query = "SELECT Departement.nom, SUM(Demande.nb_pages) as total_nb_pages, SUM(Demande.nb_copies) as total_nb_copies, COUNT(*) as total_demande FROM Demande JOIN Departement USING(id_departement) GROUP BY Departement.nom;";
        $req = $this->bd->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetailsDepartement($departement_nom){
        $query = "SELECT Departement.nom AS Dept, Utilisateur.nom, Utilisateur.prenom, COUNT(*) as Nb_de_demandes, SUM(nb_pages) AS Total_nb_de_pages, SUM(nb_copies) AS Total_nb_de_copies FROM Demande JOIN Departement USING (id_departement) JOIN Utilisateur USING(id_utilisateur) WHERE Departement.nom = :departement_nom GROUP BY (id_utilisateur);";
        $req = $this->bd->prepare($query);
        $req->bindValue(':departement_nom', $departement_nom, PDO::PARAM_STR);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>