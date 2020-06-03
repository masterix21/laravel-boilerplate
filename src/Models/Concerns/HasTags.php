<?php
namespace Masterix21\LaravelBoilerplate\Models\Concerns;

use Masterix21\LaravelBoilerplate\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTags
{
    public static function bootHasTags()
    {
        static::deleting(static function ($model) {
            $model->tags()->delete();
        });
    }

    /**
     * Get all model tags
     *
     * @return MorphMany
     */
    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }

    /**
     * Retag the model deleting old tags and applying new ones.
     *
     * @param $tags
     * @param null $group
     */
    public function retag($tags, $group = null)
    {
        $this->tags()->when($group, function ($query) use ($group) {
            $query->where('group', $group);
        })->delete();

        $tags = collect($tags)->map(function ($tag) use ($group) {
            if (! is_string($tag)) {
                $tag = data_get($tag, 'value');
            }

            return (new Tag)->fill([
                'taggable_id' => $this->id,
                'taggable_type' => get_class($this),
                'group' => $group,
                'value' => $tag,
            ]);
        });

        $this->tags()->saveMany($tags);
    }
}
