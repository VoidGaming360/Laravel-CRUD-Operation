<?php
namespace App\Traits;
use Illuminate\Support\Str;
trait Uuids
{
   /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $keyNames = $model->getKeyName();

            if (is_array($keyNames)) {
                foreach ($keyNames as $keyName) {
                    if (empty($model->{$keyName})) {
                        $model->{$keyName} = Str::uuid()->toString();
                    }
                }
            } else {
                if (empty($model->{$keyNames})) {
                    $model->{$keyNames} = Str::uuid()->toString();
                }
            }
        });
    }
   /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }
   /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}