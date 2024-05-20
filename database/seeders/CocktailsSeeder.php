<?php

namespace Database\Seeders;

use App\Models\Cocktail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CocktailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cocktails = [];

        // Loop per ottenere i cocktails
        for ($i = 0; $i < 20; $i++) {
            $cocktail_url = 'https://www.thecocktaildb.com/api/json/v1/1/random.php';
            $coctailContent = $this->getCocktailData($cocktail_url);

            if ($coctailContent) {
                $cocktailEncode = json_decode($coctailContent, true);
                if ($cocktailEncode && !empty($cocktailEncode['drinks'])) {
                    array_push($cocktails, $cocktailEncode['drinks'][0]);
                }
            }
        }

        foreach ($cocktails as $cocktail) {
            $ingredients = [];
            $measures = [];

            foreach ($cocktail as $key => $value) {
                if (strpos($key, 'strIngredient') === 0 && $value) {
                    array_push($ingredients, $value);
                }

                if (strpos($key, 'strMeasure') === 0 && $value) {
                    array_push($measures, $value);
                }
            }

            Cocktail::create([
                'name' => $cocktail['strDrink'],
                'slug' => Str::slug($cocktail['strDrink'], '-'),
                'category' => $cocktail['strCategory'],
                'alcholic' => $cocktail['strAlcoholic'],
                'glass' => $cocktail['strGlass'],
                'instructions' => $cocktail['strInstructions'],
                'thumb' => $cocktail['strDrinkThumb'],
                'ingredients' => json_encode($ingredients),
                'measures' => json_encode($measures),
            ]);
        }
    }

    /**
     * Recupera i dati dei cocktail usando cURL.
     */
    private function getCocktailData($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Imposta un timeout di 10 secondi

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            // Gestione dell'errore
            error_log('Errore cURL: ' . curl_error($ch));
            return null;
        }

        curl_close($ch);
        return $result;
    }
}
