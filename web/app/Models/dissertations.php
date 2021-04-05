<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Dissertation extends Model
{
    use HasFactory;
    use Searchable;

    protected $appends = ['can_save'];

    public function searchableAs()
    {
        return 'etd';
    }

    public function owners() {
        return $this->belongsToMany(User::class, "saved_dissertations");
    }

    public function getCanSaveAttribute() {
        $user = auth()->user();
        if (!$user) {
            return false;
        }

        $check = $this->owners()->where('user_id', $user->id)->first();
        return is_null($check);
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $result = [
            'title' => $array['title'],
            'contributor_author' => $array['contributor_author'],
            'contributor_committeechair' => $array['contributor_committeechair'],
            'contributor_committeemember' => $array['contributor_committeemember'],
        ];


        return $result;
    }

    public function getContributorCommitteechairAttribute($value) {
        if (empty($value)) {
            return null;
        }

        return json_decode($value, true);
    }

    public function getContributorCommitteememberAttribute($value) {
        if (empty($value)) {
            return null;
        }

        return json_decode($value, true);
    }
    
}