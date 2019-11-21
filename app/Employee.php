<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'last_name',
        'first_name',
        'patronymic',
        'date_of_birth',
        'department_id',
        'job_position',
        'type',
        'monthly_rate',
        'hours',
        'hourly_rate'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function getTypeName(){
        if($this->type == 1)
            return 'с месячной оплатой';
        elseif($this->type == 0)
            return 'с почасовой оплатой';
    }

    public function getMonthlyPayment(){
        if($this->type == 1)
            return $this->monthly_rate;
        elseif ($this->type == 0)
            return $this->hours * $this->hourly_rate;
    }
}
