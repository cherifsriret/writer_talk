<?php
namespace App\Http\Traits;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;


trait WithUuid
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function initializeHasUuid()
    {
        $this->incrementing = false;
        $this->keyType = 'string';
    }
}


?>
