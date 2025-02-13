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
        $query = "SELECT Demande.id_demande, Departement.nom, Demande.nb_pages, Demande.nb_copies, Demande.agrafes, TypesBrochure.nomBrochure, Demande.date_demande, Demande.statut FROM Demande JOIN Utilisateur USING (id_utilisateur) JOIN Departement USING (id_departement) JOIN TypesBrochure USING (id_typeBrochure) WHERE id_utilisateur = :id_enseignant ORDER BY CASE WHEN statut = 'Terminée' THEN 1 WHEN statut = 'En cours' THEN 2 ELSE 3 END;";
        $req = $this->bd->prepare($query);
        $req->bindValue(':id_enseignant', $id_enseignant, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les demandes qui ne sont pas terminée
     * 
     * Cette fonction prend aucun paramètre et retourne un tableau contenant les colonnes de la tables et les valeurs associées aux demandes non terminées.
     * 
     * @return Array
     */
    public function getDemandeNonTerminee(){
        $query = "SELECT Demande.id_demande, Departement.nom as Dept, Utilisateur.nom, Utilisateur.prenom, Demande.nb_pages, Demande.nb_copies, Demande.agrafes, TypesBrochure.nomBrochure, Demande.date_demande, statut FROM Demande JOIN Utilisateur USING(id_utilisateur) JOIN Departement USING(id_departement) JOIN TypesBrochure USING(id_typeBrochure) WHERE statut != 'Terminée' ORDER BY CASE WHEN statut = 'En cours' THEN 1 WHEN statut = 'Non traitée' THEN 2 END, id_demande DESC;";
        $req = $this->bd->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les demandes qui sont terminée
     * 
     * Cette fonction prend aucun paramètre et retourne un tableau contenant les colonnes de la tables et les valeurs associées aux demandes terminées.
     * 
     * @return Array
     */
    public function getDemandeTerminee(){
        $query = "SELECT Demande.id_demande, Departement.nom as Dept, Utilisateur.nom, Utilisateur.prenom, Demande.nb_pages, Demande.nb_copies, Demande.agrafes, TypesBrochure.nomBrochure, Demande.date_demande, statut FROM Demande JOIN Utilisateur USING(id_utilisateur) JOIN Departement USING(id_departement) JOIN TypesBrochure USING(id_typeBrochure) WHERE statut = 'Terminée' ORDER BY id_demande DESC;";
        $req = $this->bd->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les détails d'une demande grâce à son id
     * 
     * Cette fonction prend l'identifiant de la demande et retourne un tableau contenant les colonnes de la tables et les valeurs associées aux demandes non terminées.
     * 
     * @param int $id_demande
     * @return Array
     */
    public function getDetailsDemandeById($id_demande){
        //$query = "SELECT Departement.nom AS Dept, Utilisateur.nom, Utilisateur.prenom, nb_pages, nb_copies, agrafes, TypesBrochure.nomBrochure, date_demande, statut, commentaire, fichier FROM Demande JOIN Departement USING(id_departement) JOIN Utilisateur USING(id_utilisateur) JOIN TypesBrochure USING(id_typeBrochure) WHERE id_demande = :id_demande;";

        $query = "SELECT Departement.nom AS Dept, Utilisateur.nom, Utilisateur.prenom, nb_pages, nb_copies, format_feuille, agrafes, nb_pages_par_copies, TypesBrochure.nomBrochure, couverture_couleur, page_fin_couleur, type_finition, type_perforation, date_demande, statut, commentaire, fichier  FROM Demande JOIN Utilisateur USING(id_utilisateur) JOIN Departement USING (id_departement) JOIN TypesBrochure USING(id_typeBrochure) WHERE id_demande=:id_demande";
        $req = $this->bd->prepare($query);
        $req->bindValue(':id_demande', $id_demande);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère l'état des demandes en fonction de l'année (global si aucune année en param)
     * 
     * Cette fonction prend en paramètre l'année et retourne un tableau contenant les colonnes de la tables et les valeurs associées à l'état des demandes pour l'année séléctionnée.
     * 
     * @param int $annee
     * @return Array
     */
    public function getEtatDemandes($annee) {
        if($annee == 0){
            //$query = "SELECT statut, COUNT(*) as total_demandes FROM Demande GROUP BY statut;";
            $query = "SELECT COUNT(CASE WHEN statut = 'En cours' THEN 1 END) AS 'En cours', COUNT(CASE  WHEN statut = 'Terminée' THEN 1 END) AS 'Terminée', COUNT(CASE WHEN statut = 'Non traitée' THEN 1 END) AS 'Non traitée' FROM Demande;";
            $req = $this->bd->prepare($query);
        }
        else{
            $query = "SELECT statut, COUNT(*) as total_demandes FROM Demande WHERE YEAR(date_demande) = :annee GROUP BY statut;";
            $req = $this->bd->prepare($query);
            $req->bindValue(":annee", $annee, PDO::PARAM_INT);
        }
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère les statistiques par département pour une année choisi (global si aucune année choisi)
     * 
     * Cette fonction prend en paramètre une année et retourne un tableau contenant les colonnes de la table et les valeurs associées aux statistiques des départements pour l'année choisi.
     * 
     * @param int $annee
     * @return Array
     */
    public function getStatsParDepartement($annee){
        if($annee == 0){
            $query = "SELECT Departement.nom, SUM(Demande.nb_pages) as total_nb_pages, SUM(Demande.nb_copies) as total_nb_copies, COUNT(*) as total_demande FROM Demande JOIN Departement USING(id_departement) GROUP BY Departement.nom;";
            $req = $this->bd->prepare($query);
        }
        else{
            $query = "SELECT Departement.nom, SUM(Demande.nb_pages) as total_nb_pages, SUM(Demande.nb_copies) as total_nb_copies, COUNT(*) as total_demande FROM Demande JOIN Departement USING(id_departement) WHERE YEAR(date_demande) = :annee GROUP BY Departement.nom;";
            $req = $this->bd->prepare($query);
            $req->bindValue(":annee", $annee, PDO::PARAM_INT);
        }
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

    public function getIdDept($departement_nom){
        $query = "SELECT id_departement AS id FROM Departement WHERE nom = :departement_nom;";
        $req = $this->bd->prepare($query);
        $req->bindValue(":departement_nom", $departement_nom, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getIdTypeBrochure($type_brochure){
        $query = "SELECT id_typeBrochure AS id FROM TypesBrochure WHERE nomBrochure = :type_brochure;";
        $req = $this->bd->prepare($query);
        $req->bindValue(":type_brochure", $type_brochure, PDO::PARAM_STR);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function uploadFileToDatabase($file){
        $rep_cible = "uploads/";
        $fichier_cible = $rep_cible . basename($_FILES["fichier"]["name"]);
        $uploadOui = 1;
        if($_FILES["fichier"]["size"] > 209715200){
            return "Impossible";
        }
        
    }

    public function addNewDemande($infos) {
        $id_dept = $this->getIdDept($infos["departement"]);
        $id_typeBrochure = $this->getIdTypeBrochure($infos["typeBrochure"]);
    
        if (!$id_dept || !$id_typeBrochure) {
            $this->action_error("Erreur lors de la récupération du département ou du type de brochure");
            return;
        }
    
        $id_dept = $id_dept["id"];
        $id_typeBrochure = $id_typeBrochure["id"];
    
        if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] == 0) {
            $uploadDir = 'Uploads/';
    
            $fileName = time() . '_' . basename($_FILES['fichier']['name']);
            $uploadFilePath = $uploadDir . $fileName;
    
            if (move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadFilePath)) {
                $filePathToStore = $uploadFilePath;
            } else {
                $this->action_error("Erreur lors de l'upload du fichier");
                return;
            }
        } else {
            $this->action_error("Aucun fichier n'a été uploadé");
            return;
        }
    
        $query = "INSERT INTO Demande (examen, nb_pages, nb_copies, format_feuille, agrafes, nb_pages_par_copies, date_demande, couverture_couleur, page_fin_couleur, type_finition, type_perforation, statut, commentaire, fichier, id_utilisateur, id_departement, id_typeBrochure)
        VALUES (:examen, :nb_pages, :nb_copies, :format_feuille, :agrafes, :nb_pages_par_copies, :date_demande, :couverture_couleur, :page_fin_couleur, :type_finition, :type_perforation, 'Non traitée', :commentaire, :fichier, :id_utilisateur, :id_departement, :id_typeBrochure);";    
    
        $req = $this->bd->prepare($query);
    
        $req->bindValue(":examen", $infos["examen"], PDO::PARAM_BOOL);
        $req->bindValue(":nb_pages", $infos["nb_pages"], PDO::PARAM_INT);
        $req->bindValue(":nb_copies", $infos["nb_copies"], PDO::PARAM_INT);
        $req->bindValue(":format_feuille", $infos["format_feuille"], PDO::PARAM_STR);
        $req->bindValue(":agrafes", $infos["agrafes"], PDO::PARAM_BOOL);
        $req->bindValue(":nb_pages_par_copies", $infos["nb_pages_par_copies"], PDO::PARAM_INT);
        $req->bindValue(":date_demande", $infos["date_demande"], PDO::PARAM_STR);
        $req->bindValue(":couverture_couleur", $infos["couverture_couleur"], PDO::PARAM_STR);
        $req->bindValue(":page_fin_couleur", $infos["page_fin_couleur"], PDO::PARAM_STR);
        $req->bindValue(":type_finition", $infos["type_finition"], PDO::PARAM_STR);
        $req->bindValue(":type_perforation", $infos["type_perforation"], PDO::PARAM_STR);
        $req->bindValue(":commentaire", $infos["commentaire"], PDO::PARAM_STR);

        // chemin du fichier
        $req->bindValue(":fichier", $filePathToStore, PDO::PARAM_STR);
        $req->bindValue(":id_utilisateur", $infos["utilisateur"], PDO::PARAM_INT);
        $req->bindValue(":id_departement", $id_dept, PDO::PARAM_INT);
        $req->bindValue(":id_typeBrochure", $id_typeBrochure, PDO::PARAM_INT);
    
        try {
            $req->execute();
        } catch (PDOException $e) {
            $this->action_error("Erreur SQL : " . $e->getMessage());
            return;
        }
        
    }
    
    
    public function updateUserInfo($nom, $prenom, $email, $id){

        $query="UPDATE Utilisateur SET nom = :nom, prenom = :prenom, email = :email WHERE id_utilisateur = :id";
        $req = $this->bd->prepare($query);
        $req->bindValue(":nom", $nom, PDO::PARAM_STR);
        $req->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $req->bindValue(":email", $email, PDO::PARAM_STR);
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }

    public function updateStatut($id_demande, $statut){
        $query = "UPDATE Demande SET statut = :statut WHERE id_demande = :id_demande;";
        $req = $this->bd->prepare($query);
        $req->bindValue(":statut", $statut, PDO::PARAM_STR);
        $req->bindValue(":id_demande", $id_demande, PDO::PARAM_INT);
        $req->execute();
    }
        

}

    

?>