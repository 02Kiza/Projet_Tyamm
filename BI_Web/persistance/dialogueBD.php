<?php
require_once 'connexion.php';
class DialogueBD
{

    public static function getAllGrandClients()
    {
        try {
            $conn = Connexion::getConnexion();

            $sql = "SELECT GrandClientID, NomGrandClient FROM grandclients";
            $sth = $conn->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }


        public static function getTop10ApplicationsByGrandClient($grandClientID)
    {
        try {
            $conn = Connexion::getConnexion();
            $sql = "SELECT ap.nomAppli, lf.prix 
                    FROM ligne_facturation lf
                    JOIN clients cl ON lf.CentreActiviteID = cl.CentreActiviteID
                    JOIN application ap ON lf.IRT = ap.IRT
                    WHERE cl.GrandClientID = :grandClientID
                    GROUP BY ap.nomAppli
                    ORDER BY lf.prix DESC
                    LIMIT 10";
            $sth = $conn->prepare($sql);
            $sth->bindParam(':grandClientID', $grandClientID, PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }



    public function getTop10ApplicationsParGrandClient()
    {
        try {
            $conn = Connexion::getConnexion();
            var_dump($conn);
            $sql = "SELECT gc.NomGrandClient, ap.nomAppli, lf.prix ,  SUM(lf.prix) AS total_prix 
                    FROM ligne_facturation lf
                    JOIN clients cl ON lf.CentreActiviteID = cl.CentreActiviteID
                    JOIN grandclients gc ON cl.GrandClientID = gc.GrandClientID
                    JOIN application ap ON lf.IRT = ap.IRT
                    GROUP BY gc.NomGrandClient, ap.nomAppli
                    ORDER BY total_prix DESC
                    LIMIT 10";
            $sth = $conn->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getTop10ApplicationsClient1()
    {
        try {
            $conn = Connexion::getConnexion();
            var_dump($conn);
            $sql = "SELECT gc.NomGrandClient, ap.nomAppli, lf.prix 
                    FROM ligne_facturation lf
                    WHERE gc.NomGrandClient = 3
                    JOIN clients cl ON lf.CentreActiviteID = cl.CentreActiviteID
                    JOIN grandclients gc ON cl.GrandClientID = gc.GrandClientIDf
                    JOIN application ap ON lf.IRT = ap.IRT
                    GROUP BY gc.NomGrandClient, ap.nomAppli
                    ORDER BY lf.prix
                    LIMIT 10";
            $sth = $conn->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getEvolutionVolumesProduits()
    {
        try {
            $conn = Connexion::getConnexion();
                    $sql = "SELECT pr.NOM_PRODUIT, lf.mois, lf.prix, lf.volume
                            FROM ligne_facturation lf
                            JOIN produit pr ON lf.produitID = pr.produitID
                            WHERE pr.NOM_PRODUIT = 'PRODUIT1_1' OR pr.NOM_PRODUIT = 'PRODUIT1_4'
                            AND lf.mois BETWEEN '2021-01-01' AND '2022-04-30'
                            GROUP BY pr.NOM_PRODUIT, lf.mois
                            ORDER BY pr.NOM_PRODUIT, lf.mois";
            $sth = $conn->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}





