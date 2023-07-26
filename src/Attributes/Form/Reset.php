<?php

namespace Livewire\Attributes\Form;

use Attribute;
use Livewire\Features\SupportFormObjects\Reset as BaseReset;

#[Attribute(Attribute::IS_REPEATABLE)]
class Reset extends BaseReset
{
    public function __construct(
        public $reset = true
    ) {
        //
    }
}
