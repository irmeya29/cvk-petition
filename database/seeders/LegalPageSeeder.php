<?php

namespace Database\Seeders;

use App\Models\LegalPage;
use Illuminate\Database\Seeder;

class LegalPageSeeder extends Seeder
{
    public function run(): void
    {
        LegalPage::updateOrCreate(
            ['slug' => 'conditions-utilisation'],
            [
                'title' => "Conditions d'utilisation",
                'content' => "En signant cette petition, vous confirmez que les informations fournies sont exactes et que vous soutenez librement l'initiative relative au retour de CVK sur CANAL+.\n\nChaque personne ne peut signer qu'une seule fois avec la meme adresse e-mail.\n\nCVK se reserve le droit de supprimer toute signature manifestement frauduleuse, abusive, incomplete ou contraire a l'objet de la petition.\n\nCette petition a pour objectif de recueillir un soutien public et respectueux. Elle ne constitue pas une action de denigrement, de pression illegitime ou de communication hostile envers une organisation tierce.",
            ],
        );

        LegalPage::updateOrCreate(
            ['slug' => 'politique-utilisation-donnees'],
            [
                'title' => "Politique d'utilisation des donnees",
                'content' => "Les donnees collectees dans le cadre de cette petition sont : le prenom, le nom, l'adresse e-mail, le choix d'affichage du nom, la date de signature, l'adresse IP et certaines informations techniques liees au navigateur.\n\nCes donnees sont utilisees uniquement pour enregistrer les signatures, eviter les doublons, verifier l'integrite de la petition et presenter le nombre de soutiens obtenus.\n\nL'adresse e-mail n'est pas affichee publiquement. Si vous choisissez de ne pas afficher votre nom, votre identite ne sera pas visible dans la liste publique des signatures.\n\nCVK ne vend pas les donnees collectees dans le cadre de cette petition.\n\nPour toute demande liee a vos donnees, vous pouvez contacter CVK par les canaux officiels de l'organisation.",
            ],
        );
    }
}
