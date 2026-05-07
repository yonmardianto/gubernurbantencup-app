<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    /**
     * Return weight class options filtered by upstream filter params.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getKelasBeratBadanFilter(Request $request)
    {
        // 1. Receive comma-separated values from each upstream filter
        $filterGender = $request->input('filter_gender');
        $filterKategori = $request->input('filter_kategori');
        $filterLevel = $request->input('filter_level');
        $filterKategoriTanding = $request->input('filter_kategori_tanding');

        // 2. Guard: all four params must be present and non-empty
        if (
            empty($filterGender) ||
            empty($filterKategori) ||
            empty($filterLevel) ||
            empty($filterKategoriTanding)
        ) {
            return response()->json([], 200);
        }

        // 3. Explode comma-separated strings into arrays
        $genderArr = array_filter(array_map('trim', explode(',', $filterGender)));
        $kategoriArr = array_filter(array_map('trim', explode(',', $filterKategori)));
        $levelArr = array_filter(array_map('trim', explode(',', $filterLevel)));
        $kategoriTandingArr = array_filter(array_map('trim', explode(',', $filterKategoriTanding)));

        // 4. Build parameterized query
        $genderPlaceholders = implode(',', array_fill(0, count($genderArr), '?'));
        $kategoriPlaceholders = implode(',', array_fill(0, count($kategoriArr), '?'));
        $levelPlaceholders = implode(',', array_fill(0, count($levelArr), '?'));
        $kategoriTandingPlaceholders = implode(',', array_fill(0, count($kategoriTandingArr), '?'));

        $sql = "
            SELECT 
                CONCAT(gender, '-', kategori, '-', `level`, '-', weight) AS `name`, 
                weight AS `value`
            FROM kelas 
            WHERE kategori_tanding IN ({$kategoriTandingPlaceholders})
              AND gender           IN ({$genderPlaceholders})
              AND kategori         IN ({$kategoriPlaceholders})
              AND `level`          IN ({$levelPlaceholders})
            ORDER BY id ASC
        ";

        $bindings = array_merge(
            array_values($kategoriTandingArr),
            array_values($genderArr),
            array_values($kategoriArr),
            array_values($levelArr)
        );

        $results = DB::select($sql, $bindings);

        // 5. Return [{name, value}, ...]
        return response()->json($results, 200);
    }
}
