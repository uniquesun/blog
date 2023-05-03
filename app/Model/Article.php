<?php

declare (strict_types=1);

namespace App\Model;


use App\Model\Builder\ArticleBuilder;

/**
 * @property int $id
 * @property string $subtitle
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Article extends Model
{
    use ArticleBuilder;

    protected $table = 'article';

    protected $guarded = [];

    protected $casts = [
        'is_published' => 'boolean',
        'is_recommend' => 'boolean'
    ];

    public function tags(): \Hyperf\Database\Model\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }

    public function categories(): \Hyperf\Database\Model\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'article_category', 'article_id', 'category_id');
    }


}