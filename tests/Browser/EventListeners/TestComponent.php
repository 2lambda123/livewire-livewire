<?php

namespace Tests\Browser\EventListeners;

use Livewire\Component;

class TestComponent extends Component
{
    public $lastEvent = '';
    public $eventCount = 0;
    public $eventsToListenFor = [
        1 => 'foo',
        2 => 'bar',
        3 => 'baz',
    ];

    public function handle($event)
    {
        $this->lastEvent = $event;
        ++$this->eventCount;
    }

    public function delete($id)
    {
        unset($this->eventsToListenFor[$id]);
    }

    public function add($id, $event)
    {
        $this->eventsToListenFor[$id] = $event;
    }

    protected function getListeners()
    {
        return collect($this->eventsToListenFor)
                ->flip()
                ->map(function($item) { return 'handle'; });
    }

    public function render()
    {
        return <<<'BLADE'
    <div>
        <button dusk="foo" wire:click="$emit('foo', 'foo')">Foo</button>
        <button dusk="bar" wire:click="$emit('bar', 'bar')">Bar</button>
        <button dusk="baz" wire:click="$emit('baz', 'baz')">Baz</button>
        <button dusk="goo" wire:click="$emit('goo', 'goo')">Goo</button><br />

        <span dusk="eventCount">{{$eventCount}}</span><br />
        <span dusk="lastEvent">{{$lastEvent}}</span><br />

        <button dusk="removeBar" wire:click="delete(2)">Remove bar handler</button><br />
        <button dusk="addGoo" wire:click="add(4, 'goo')">Add goo handler</button>
    </div>
BLADE;

    }
}
