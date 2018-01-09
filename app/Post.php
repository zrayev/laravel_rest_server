<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model {
    protected $table = 'posts';
    protected $fillable = ['title', 'slug', 'body', 'user_id'];

    /**
     * @return BelongsTo
     */
    public function users() {
        return $this->belongsTo(User::class);
    }
}
