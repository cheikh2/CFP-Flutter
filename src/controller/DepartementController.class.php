<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use libs\system\Controller;
use src\model\DepartementRepository;
class DepartementController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    #===========Recupération tous les départements========
    public function getAllDepartement()
    {
        $departements = new DepartementRepository();
        $resultat = $departements->getAllDepartement();
        if($resultat != null)
        {
            foreach($resultat as $departement)
            {
                $departement = [
                    "Id" => $departement->getId(),
                    "Nom" => $departement->getNom(),
                ];
                $data['Departements'][] = $departement;
            }
            http_response_code(200);
            echo json_encode($data);
        }
        else
        {
            $data['Warning'] = "Désolé! aucun departement disponible";
            echo json_encode($data);
        }
    }

//===========Recupération d'un département==================

    public function departement()
    {
        $departement = new DepartementRepository();
        $resultat = $departement->getOneDepartement($id);

        if($resultat != null)
        {
            foreach($resultat as $departement)
            {
                $departement = [
                    "Id" => $departement->getId(),
                    "Nom" => $departement->getNom(),
                ];
                $data['Departement'][] = $departement;
            }
            http_response_code(200);
            echo json_encode($data);
        }
        else
        {
            $data['Warning'] = "Désolé! aucun département disponible";
            echo json_encode($data);
        }
    }

    #===========Recupération formations d'un departement==========================

    public function formations($id)
    {
        $departements = new DepartementRepository();
        $resultat = $departements->getFormationByDepartement($id);

        if($resultat != null)
        {
            foreach($resultat as $formation)
            {
                $formation = [
                    "Id" => $formation->getId(),
                    "Nom" => $formation->getNom(),
                ];

                $data['Formations'][] = $formation;

            }
            http_response_code(200);
            echo json_encode($data);
        }
        else
        {
            $data['Warning'] = "Pas de formations disponible pour ce departement";
            echo json_encode($data);
        }
    }

}

?>