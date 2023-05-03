<?php

namespace App\Model\Builder;

trait ArticleBuilder
{
    public function scopeSelectWithoutContent($query)
    {
        return $query->select(
            'id', 'subtitle', 'title', 'slug',
            'image', 'created_at', 'is_recommend', 'is_published'
        );
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}