<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dashboard extends Model
{
    public static function getSummaryCategory($tahun)
    {
        $sql = "";
        if ($tahun) {
            $sql = "WHERE DATE LIKE '%$tahun%'";
        }
        $data = DB::select("SELECT
                    category,
                    COUNT(*) AS total_category
                FROM t_news
                {$sql}
                GROUP BY category
                ORDER BY total_category DESC
                LIMIT 10;");
        return $data;
    }
    public static function getSummaryWritter($tahun)
    {
        $sql = "";
        if ($tahun) {
            $sql = "WHERE DATE LIKE '%$tahun%'";
        }

        $data = DB::select("SELECT
                    writer,
                    COUNT(*) AS total_writer
                FROM t_news
                {$sql}
                GROUP BY writer
                ORDER BY total_writer DESC
                LIMIT 10;");
        return $data;
    }
    public static function getSummaryDate()
    {
        $data = DB::select('SELECT
                    DATE,
                    COUNT(*) AS total_date
                FROM t_news
                GROUP BY DATE
                ORDER BY total_date DESC
                LIMIT 10;');
        return $data;
    }
}
