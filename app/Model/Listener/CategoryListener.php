<?php

namespace App\Model\Listener;

use App\Model\Category;
use Hyperf\Database\Model\Events\Event;
use Hyperf\Database\Model\Events\Saving;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class CategoryListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            Saving::class,
        ];
    }

    public function process(object $event)
    {
        if ($event instanceof Event) {
            $model = $event->getModel();

            if ($model instanceof  Category){
                if (!$model->parent_id) {
                    $model->level = 0;
                    $model->path = '-';
                } else {
                    $model->level = $model->parent->level + 1;
                    $model->path = $model->parent->path . $model->parent_id . '-';
                }
            }

        }
    }
}