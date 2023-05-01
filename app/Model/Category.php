<?php

declare (strict_types=1);

namespace App\Model;

/**
 */
class Category extends Model
{

    protected $table = 'categories';

    protected $guarded = [];

    protected $casts = [
        'is_directory' => 'boolean',
        'is_recommend' => 'boolean'
    ];

    public function parent(): \Hyperf\Database\Model\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function children(): \Hyperf\Database\Model\Relations\HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function articles(): \Hyperf\Database\Model\Relations\BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_category', 'category_id', 'article_id');
    }

    // 获取所有祖先类目的 ID 值
    public function getPathIdsAttribute(): array
    {
        return array_filter(explode('-', trim($this->path, '-')));
    }

    // 获取所有父分类
    public function getAncestorsAttribute(): \Hyperf\Database\Model\Collection|array
    {
        return Category::query()
            ->whereIn('id', $this->path_ids)
            ->orderBy('level')
            ->get();
    }

    // 获取以 - 为分隔的所有祖先类目名称以及当前类目的名称
    public function getFullNameAttribute()
    {
        return $this->ancestors->pluck('name')->push($this->name)->implode(' - ');
    }

}