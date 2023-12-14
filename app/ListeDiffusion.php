<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListeDiffusion extends Model
{
    protected $guarded = [];
    protected $table = 'liste_diffusions';
    protected $with = ['categorieProgramme','programmeTv'];

    public function categorieProgramme()
    {
        return $this->belongsTo(CategorieProgrammeTv::class,'categorie_programme_tv_id');
    }

    public function programmeTv()
    {
        return $this->belongsTo(ProgrammeTv::class,'programme_tv_id');
    }

}
