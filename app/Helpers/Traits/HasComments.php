<?php

namespace App\Helpers\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;


trait HasComments
{
    /**
     * @return string
     */
    public function commentableModel(): string
    {
        return config('commentable.model');
    }

    /**
     * @return mixed
     */
    public function comments(): MorphMany
    {
        return $this->morphMany($this->commentableModel(), 'commentable');
    }

    /**
     * @param $data
     * @param Model      $creator
     * @param Model|null $parent
     *
     * @return static
     */
    public function comment($data, Model $creator, Model $parent = null): Comment
    {
        $commentableModel = $this->commentableModel();

        $comment = (new $commentableModel())->createComment($this, $data, $creator);

        if (!empty($parent)) {
            $parent->appendNode($comment);
        }

        return $comment;
    }

    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateComment($id, $data, Model $parent = null)
    {
        $commentableModel = $this->commentableModel();

        $comment = (new $commentableModel())->updateComment($id, $data);

        if (!empty($parent)) {
            $parent->appendNode($comment);
        }

        return $comment;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteComment($id): bool
    {
        $commentableModel = $this->commentableModel();

        return (bool) (new $commentableModel())->deleteComment($id);
    }

    /**
     * @return mixed
     */
    public function commentCount(): int
    {
        return $this->comments->count();
    }
}
