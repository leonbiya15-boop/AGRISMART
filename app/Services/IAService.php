<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IAService
{
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function analyserPhotoMaladie(string $cheminPhoto): array
    {
        try {
            $cheminComplet = storage_path('app/public/' . $cheminPhoto);

            // Vérifier que l'image existe
            if (!file_exists($cheminComplet)) {
                Log::error('Image introuvable pour le diagnostic Gemini', [
                    'chemin' => $cheminComplet
                ]);

                return [
                    'maladie_detectee' => false,
                    'nom_maladie' => null,
                    'niveau_confiance' => 0
                ];
            }

            $imageData = base64_encode(file_get_contents($cheminComplet));

            $response = Http::timeout(30)->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $this->apiKey,
                [
                    'contents' => [[
                        'parts' => [
                            [
                                'text' => 'Tu es un expert en agronomie. Analyse cette photo de plante et détermine si une maladie est visible.

Réponds UNIQUEMENT avec un objet JSON valide, sans texte autour.

Format exact :
{
    "maladie_detectee": true ou false,
    "nom_maladie": "nom ou null",
    "niveau_confiance": nombre entre 0 et 100
}'
                            ],
                            [
                                'inline_data' => [
                                    'mime_type' => 'image/jpeg',
                                    'data' => $imageData,
                                ]
                            ]
                        ]
                    ]]
                ]
            );

            // Vérifier la réponse de Gemini
            if (!$response->successful()) {
                Log::error('Erreur Gemini', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'maladie_detectee' => false,
                    'nom_maladie' => null,
                    'niveau_confiance' => 0
                ];
            }

            $texte = $response->json('candidates.0.content.parts.0.text');

            $texte = trim(
                str_replace(
                    ['```json', '```'],
                    '',
                    $texte ?? ''
                )
            );

            $resultat = json_decode($texte, true);

            if (!is_array($resultat)) {
                Log::error('Réponse Gemini invalide', [
                    'reponse' => $texte
                ]);

                return [
                    'maladie_detectee' => false,
                    'nom_maladie' => null,
                    'niveau_confiance' => 0
                ];
            }

            return $resultat;

        } catch (\Exception $e) {

            Log::error('Exception lors de l’analyse Gemini', [
                'message' => $e->getMessage(),
                'fichier' => $cheminPhoto
            ]);

            return [
                'maladie_detectee' => false,
                'nom_maladie' => null,
                'niveau_confiance' => 0
            ];
        }
    }

    public function proposerRotation(string $historiqueCultures): array
    {
        try {
            $response = Http::timeout(15)->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $this->apiKey,
                [
                    'contents' => [[
                        'parts' => [[
                            'text' => "Tu es un expert en agronomie. Voici l'historique des cultures d'une parcelle : {$historiqueCultures}. Propose UNE culture adaptée pour la prochaine rotation, en tenant compte de la rotation des cultures.

Réponds UNIQUEMENT avec un objet JSON valide, sans texte autour.

Format :
{
    \"culture_proposee\": \"nom de la culture\",
    \"raison\": \"courte explication\"
}"
                        ]]
                    ]]
                ]
            );

            if (!$response->successful()) {

                Log::error('Erreur Gemini lors de la proposition de rotation', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return [
                    'culture_proposee' => null,
                    'raison' => null
                ];
            }

            $texte = $response->json('candidates.0.content.parts.0.text');

            $texte = trim(
                str_replace(
                    ['```json', '```'],
                    '',
                    $texte ?? ''
                )
            );

            $resultat = json_decode($texte, true);

            return $resultat ?? [
                'culture_proposee' => null,
                'raison' => null
            ];

        } catch (\Exception $e) {

            Log::error('Exception lors de la proposition de rotation Gemini', [
                'message' => $e->getMessage()
            ]);

            return [
                'culture_proposee' => null,
                'raison' => null
            ];
        }
    }
}