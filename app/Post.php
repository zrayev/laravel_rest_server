<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model {
    protected $table = 'posts';
    protected $guarded = ['slug, user_id'];
    protected $fillable = ['title', 'body'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function users() {
        return $this->belongsTo(User::class);
    }

}
