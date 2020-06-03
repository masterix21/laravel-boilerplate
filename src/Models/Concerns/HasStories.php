<?php
namespace Masterix21\LaravelBoilerplate\Models\Concerns;

use Illuminate\Support\Str;
use Masterix21\LaravelBoilerplate\Models\Story;
use Masterix21\LaravelBoilerplate\Models\StoryStatus;
use Masterix21\LaravelBoilerplate\Models\User;

trait HasStories
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function stories()
    {
        return $this->morphMany(Story::class, 'model')->orderBy('created_at');
    }

    /**
     * @return mixed
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    /**
     * @return mixed
     */
    public function storyStatus()
    {
        return $this->belongsTo(StoryStatus::class, 'story_status_id');
    }

    private function fireEventWithStory($event, Story $story)
    {
        $namespace = str_replace('App\\Models\\', "App\\Events\\", Str::plural(get_class($this)));
        $eventClass = $namespace .'\\'. $event;

        event(new $eventClass($this, $story));
    }

    /**
     * @param Story $story
     */
    public function changeAssignee(Story $story) : void
    {
        $this->assignee_id = $story->assignee_id;
        $this->save();

        $this->fireEventWithStory('AssigneeChanged', $story);
    }

    /**
     * @param Story $story
     */
    public function changeStatus(Story $story) : void
    {
        $this->story_status_id = $story->status_id;
        $this->save();

        $this->fireEventWithStory('StatusChanged', $story);
    }

    /**
     * @param Story $story
     */
    public function storyReply(Story $story) : void
    {
        $this->fireEventWithStory('StoryReplied', $story);
    }
}
