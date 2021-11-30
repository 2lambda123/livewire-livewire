<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Exceptions\CannotRegisterPublicPropertyWithoutExtendingThePropertyHandlerException;
use Livewire\LivewireProperty;
use Livewire\Livewire;

class PublicPropertyManagerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        if (version_compare(PHP_VERSION, '7.4', '<')) {
            $this->markTestSkipped('Skip public property tests if the version is below PHP 7.4');
        }

        require_once __DIR__.'/PublicPropertyManagerStubs.php';
    }

    /** @test */
    public function it_will_throw_an_exception_if_registering_a_class_not_implementing_the_property_handler_class()
    {
        $this->expectException(CannotRegisterPublicPropertyWithoutExtendingThePropertyHandlerException::class);

        $resolver = new class() {};

        LivewireProperty::register('className', $resolver);
    }

    /** @test */
    public function a_registered_custom_public_property_will_be_registered()
    {
         LivewireProperty::register(
            CustomPublicClass::class,
            CustomResolverClass::class
        );

        $this->assertCount(1, LivewireProperty::all());
    }

    /** @test */
    public function multiple_custom_public_property_can_be_registered_at_once()
    {
        LivewireProperty::register([
            CustomPublicClass::class => CustomResolverClass::class,
            CustomPublicClass2::class => CustomResolverClass::class,
        ]);

        $this->assertCount(2, LivewireProperty::all());
    }

    /** @test */
    public function a_custom_public_property_can_be_overwritten()
    {
        LivewireProperty::register(CustomPublicClass::class, CustomResolverClass::class);

        $this->assertEquals(CustomResolverClass::class, LivewireProperty::get(CustomPublicClass::class));
        $this->assertCount(1, LivewireProperty::all());

        LivewireProperty::register(CustomPublicClass::class, CustomResolverClass2::class);

        $this->assertEquals(CustomResolverClass2::class, LivewireProperty::get(CustomPublicClass::class));
        $this->assertCount(1, LivewireProperty::all());
    }

    /** @test */
    public function a_custom_public_property_can_detect_subclasses()
    {
        $this->assertFalse(LivewireProperty::has(TestUser::class));

        LivewireProperty::register(Model::class, CustomResolverClass::class);

        // Returns true as it `is_a` subclass of Model - and get would return ModelResolver
        $this->assertTrue(LivewireProperty::has(TestUser::class));
        $this->assertEquals(CustomResolverClass::class, LivewireProperty::get(TestUser::class));

        // But if we also had this registered after ModelResolver
        LivewireProperty::register(TestUser::class, CustomResolverClass2::class);

        // Returns true as it `is_a` class of User - and get would return UserResolver if registered after ModelResolver
        $this->assertTrue(LivewireProperty::has(TestUser::class));
        $this->assertEquals(CustomResolverClass2::class, LivewireProperty::get(TestUser::class));
    }

    /** @test */
    public function a_custom_property_can_be_registered_and_can_pass_validation()
    {
        LivewireProperty::register(CustomPublicClass::class, CustomResolverClass::class);

        $custom = new CustomPublicClass($message = Str::random());

        Livewire::test(ComponentWithCustomPublicProperty::class, ['wireable' => $custom])
            ->assertSee($message)
            ->call('$refresh')
            ->assertSee($message)
            ->call('runValidation')
            ->assertHasNoErrors(['wireable.message'])
            ->call('removeWireable')
            ->assertDontSee($message);
    }

    /** @test */
    public function it_can_have_a_single_validation_error()
    {
        LivewireProperty::register(CustomPublicClass::class, CustomResolverClass::class);

        $custom = new CustomPublicClass($message = '');

        Livewire::test(ComponentWithCustomPublicProperty::class, ['wireable' => $custom])
            ->assertSee($message)
            ->call('runValidation')
            ->assertHasErrors(['wireable.message' => 'required']);
    }
}
