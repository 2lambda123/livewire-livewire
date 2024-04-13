<?php

namespace Livewire\Features\SupportTesting\Tests;

use Livewire\Component;
use Livewire\Livewire;
use PHPUnit\Framework\Assert as PHPUnit;
use PHPUnit\Framework\Attributes\Test;

class TestableLivewireCanBeInvaded extends \Tests\TestCase
{
    #[Test]
    function can_invade_protected_properties()
    {
        $component = Livewire::test(new class extends Component {
            protected string $foo = 'bar';

            function render() {
                return '<div></div>';
            }
        });

        PHPUnit::assertEquals('bar', $component->invade()->foo);
    }

    #[Test]
    function can_invade_protected_functions()
    {
        $component = Livewire::test(new class extends Component {
            protected function foo() : string {
                return 'bar';
            }

            function render() {
                return '<div></div>';
            }
        });

        PHPUnit::assertEquals('bar', $component->invade()->foo());
    }

    #[Test]
    function can_invade_private_properties()
    {
        $component = Livewire::test(new class extends Component {
            private string $foo = 'bar';

            function render() {
                return '<div></div>';
            }
        });

        PHPUnit::assertEquals('bar', $component->invade()->foo);
    }

    #[Test]
    function can_invade_private_functions()
    {
        $component = Livewire::test(new class extends Component {
            private function foo() : string {
                return 'bar';
            }

            function render() {
                return '<div></div>';
            }
        });

        PHPUnit::assertEquals('bar', $component->invade()->foo());
    }
}
