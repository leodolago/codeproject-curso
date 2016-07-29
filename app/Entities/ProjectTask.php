<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{

    protected $fillable = [
        'id',
        'name',
        'project_id',
        'start_date',
        'due_date',
        'status',
        'created_at',
        'updated_at',
    ];

    public function project(){
        return $this->belongsTo(ProjectTask::class);
    }

}
