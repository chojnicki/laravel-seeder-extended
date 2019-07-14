<?php

namespace Chojnicki\LaravelSeederExtended;

use Carbon\Carbon;
use DB;

abstract class Seeder extends \Chojnicki\LaravelSeederDebugger\Seeder
{
    public $debug = true; // show debug info at end


    /**
     * Insert multiple models in single query for much faster big databse seeding
     *
     * @param string  $collection - models
     * @param int $chunkSize - max models insert in single query, should be smaller with big rows (like text fields)
     * @param bool $sorted - insert from the olders to newest
     */
    public function insertMultiple($collection, $chunkSize = 1000, $sorted = true)
    {
        $table = $collection->first()->getTable();

        if ($sorted) $collection = $collection->sortBy('created_at');

        foreach ($collection->chunk($chunkSize) as $chunk) { // insert multiple models in single query
            DB::table($table)->insert($chunk->toArray());
        }
    }



    /**
     * Set random timestamp for model
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param int $maxSeconds - maximum difference in seconds to between now and oldest possible date - default 6 months
     * @return Carbon - date if needed for further use
     */
    public function setRandomDate($model, $maxSeconds = 15552000)
    {
        $date = Carbon::now()->subSeconds(mt_rand(1, $maxSeconds));
        $model->setCreatedAt($date->timestamp); // timestamp is faster in huge seeding
        $model->setUpdatedAt($date->timestamp);

        return $date;
    }

}
