<?php

declare (strict_types=1);

namespace App\Model;


/**
 */
class Tag extends Model
{

    protected $table = 'tags';

    protected $guarded = [];

    public function articles(): \Hyperf\Database\Model\Relations\BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_tag', 'tag_id', 'article_id');
    }

}