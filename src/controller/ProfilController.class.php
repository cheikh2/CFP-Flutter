<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use libs\system\Controller;
use src\model\ProfilRepository;
class ProfilController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

#========Rcupérations des Profils======================
    public function getAllProfil()
    {
        $profils = new ProfilRepository();
        $resultat = $profils->getAllProfil();

        if($resultat != null)
        {
            foreach($resultat as $profil)
            {
                $profil = [
                    "Id" => $profil->getId(),
                    "Nom" => $profil->getNom(),
                ];
                $data['Profils'][] = $profil;
            }
            http_response_code(200);
            echo json_encode($data);
        }
        else
        {
            $data['Warning'] = "Désolé! aucun profil disponible";
            echo json_encode($data);
        }
    }

#==================Recupération d'un Profil==========================
    public function getOneProfil()
    {
        extract($_POST);
        $profil = new ProfilRepository();
        $resultat = $profil->getOneProfil($id);

        if($resultat != null)
        {
                $profil = [
                    "Id" => $resultat->getId(),
                    "Nom" => $resultat->getNom(),
                ];
                $data['Profil'][] = $profil;
            http_response_code(200);
            echo json_encode($data);
        }
        else
        {
            $data['Warning'] = "Désolé! aucun profil disponible";
            echo json_encode($data);
        }
    }
}

?>