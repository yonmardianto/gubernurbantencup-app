<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';

    protected $guarded = [];

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function getKelas(string $kategori, string $level, string $tanding, string $gender)
    {
        try {
            $sql = "
                SELECT
                    CONCAT(weight, ' ', 'KG') AS `name`,
                    weight AS `value`
                FROM kelas
                WHERE kategori_tanding = ?
                  AND gender = ?
                  AND kategori = ?
                  AND `level` = ?
                ORDER BY id ASC
            ";

            $results = \DB::select($sql, [$tanding, $gender, $kategori, $level]);

            return $results;
        } catch (\Exception $e) {
            return [];
        }
    }
}
