<?php

namespace Livewire\ComponentConcerns;

use Livewire\LivewireEvent;
use Livewire\Livewire;

trait ReceivesEvents
{
    protected $eventQueue = [];
    protected $dispatchQueue = [];
    protected $listeners = [];

    protected function getListeners() {
        return $this->listeners;
    }

    public function emit($event, ...$params)
    {
        if(!$event instanceof LivewireEvent){
            $event = new LivewireEvent($event, $params);
        }

        return $this->eventQueue[] = $event;
    }

    public function emitUp($event, ...$params)
    {
        $this->emit($event, ...$params)->up();
    }

    public function emitSelf($event, ...$params)
    {
        $this->emit($event, ...$params)->self();
    }

    public function emitTo($name, $event, ...$params)
    {
        $this->emit($event, ...$params)->component($name);
    }

    public function dispatchBrowserEvent($event, $data = null)
    {
        $this->dispatchQueue[] = [
            'event' => $event,
            'data' => $data,
        ];
    }

    public function getEventQueue()
    {
        return collect($this->eventQueue)->map->serialize()->toArray();
    }

    public function getDispatchQueue()
    {
        return $this->dispatchQueue;
    }

    protected function getEventsAndHandlers()
    {
        return collect($this->getListeners())
            ->mapWithKeys(function ($value, $key) {
                $key = is_numeric($key) ? $value : $key;

                return [$key => $value];
            })->toArray();
    }

    public function getEventsBeingListenedFor()
    {
        return array_keys($this->getEventsAndHandlers());
    }

    public function fireEvent($event, $params, $id)
    {
        if($event instanceof LivewireEvent){
            $params = $event->getParams();
            $event = $event->getName();
        }

        $method = $this->getEventsAndHandlers()[$event];

        $this->callMethod($method, $params, function ($returned) use ($event, $id) {
            Livewire::dispatch('action.returned', $this, $event, $returned, $id);
        });
    }
}
