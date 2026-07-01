<?php

namespace Database\Seeders;

use App\Models\Petition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PetitionSeeder extends Seeder
{
    public function run(): void
    {
        Petition::updateOrCreate(
            ['slug' => 'retour-cvk-sur-canal-plus'],
            [
                'uuid' => (string) Str::uuid(),
                'organization_name' => 'CVK',
                'title' => 'Pour le retour de CVK sur CANAL+',
                'subtitle' => 'Soutenons ensemble le retour de CVK dans les offres CANAL+.',
                'description' => "CVK occupe une place importante pour de nombreux telespectateurs attaches a ses programmes, a son identite familiale et a sa contribution au paysage audiovisuel.\n\nA travers cette petition officielle, nous exprimons de maniere respectueuse et collective notre souhait de voir CVK revenir sur CANAL+ afin de permettre a son public de retrouver ses contenus.\n\nCette initiative rassemble les voix des telespectateurs, familles, partenaires et sympathisants qui souhaitent soutenir cette demande avec dignite et transparence.",
                'target_text' => 'CANAL+ et les parties concernees par la diffusion de CVK',
                'goal_signatures' => 10000,
                'is_active' => true,
                'starts_at' => now(),
                'ends_at' => null,
            ],
        );
    }
}
