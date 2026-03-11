<?php
// Erika KAMDOM FOTSO 3A FISE
// TP Fil Rouge / Application de gestion de Ticket
// Service de traitement du formulaire de création de projet

class ProjectService {
    public $nom;
    public $client;
    public $contrat;
    public $taux;
    public $periode;
    public $collaborateurs;
    public $description;

    // Constructeur : récupère et sécurise les données du formulaire
    function __construct($data) {
        $this->nom            = htmlspecialchars($data["nom-projet"] ?? "");
        $this->client         = htmlspecialchars($data["client"] ?? "");
        $this->contrat        = htmlspecialchars($data["contrat"] ?? "");
        $this->taux           = htmlspecialchars($data["taux"] ?? "");
        $this->periode        = htmlspecialchars($data["periode"] ?? "");
        $this->collaborateurs = htmlspecialchars($data["collaborateurs"] ?? "");
        $this->description    = htmlspecialchars($data["description-projet"] ?? "");
    }

    // Retourne un tableau structuré avec les données du projet
    public function set_new_project() {
        return [
            "nom"            => $this->nom,
            "client"         => $this->client,
            "contrat"        => $this->contrat,
            "taux"           => $this->taux,
            "periode"        => $this->periode,
            "collaborateurs" => $this->collaborateurs,
            "description"    => $this->description,
        ];
    }
}