<?php

namespace App\History\Traits;

use App\History\ColumnChange;
use App\Models\Histories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait Historyable{

    public static function bootHistoryable(){
        static::updated(function (Model $model) {
            collect($model->getChangedColumns($model))->each(function ($change) use ($model){
                $model->saveChange($change);
            });
        });
    }
    public function saveChange(ColumnChange $change){
        $this->history()->create([
            'changed_column' => $change->column,
            'changed_value_from' => $change->from,
            'changed_value_to' => $change->to
        ]);
    }
    protected function getChangedColumns(Model $model){
        return collect(
            array_diff(
                Arr::except($model->getChangedColumns(),$this->ignoreHistoryColumns()),
               $original = $model->getOriginal()
            )
        )->map(function ($change,$column) use ($original){
            return new ColumnChange($column,Arr::get($original,$column),$change);
        });
    }
    public function history(){
        return $this->morphMany(Histories::class,'historyable')->latest();
    }
    public function ignoreHistoryColumns(){
        return [
            'update_at',
        ];
    }
}