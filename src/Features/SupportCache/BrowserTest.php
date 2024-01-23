<?php

namespace Livewire\Features\SupportCache;

use Livewire\Attributes\Cache;
use Tests\BrowserTestCase;
use Livewire\Component;
use Livewire\Livewire;

class BrowserTest extends BrowserTestCase
{
    /** @test */
    public function can_persist_a_property_to_the_cache()
    {
        Livewire::visit(new class extends Component {
            #[Cache]
            public $count = 0;

            public function increment()
            {
                $this->count++;
            }

            public function render() { return <<<'HTML'
            <div>
                <button dusk="button" wire:click="increment">+</button>
                <span dusk="count">{{ $count }}</span>
            </div>
            HTML; }
        })
            ->assertSeeIn('@count', '0')
            ->waitForLivewire()->click('@button')
            ->assertSeeIn('@count', '1')
            ->refresh()
            ->assertSeeIn('@count', '1')
            ->waitForLivewire()->click('@button')
            ->assertSeeIn('@count', '2')
            ;
    }
}
