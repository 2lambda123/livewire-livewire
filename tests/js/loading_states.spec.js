import { wait } from 'dom-testing-library'
import { mount, mountAndReturn, mountAndError } from './utils'
const timeout = ms => new Promise(resolve => setTimeout(resolve, ms))

test('show element while loading and hide after', async () => {
    mountAndReturn(
        `<button wire:click="onClick"></button><span style="display: none" wire:loading></span>`,
        `<button wire:click="onClick"></button><span style="display: none" wire:loading></span>`,
        [], async () => {
            // Make the loading last for 50ms.
            await timeout(50)
        }
    )

    expect(document.querySelector('span').style.display).toEqual('none')

    document.querySelector('button').click()

    await wait(async () => {
        expect(document.querySelector('span').style.display).toEqual('inline-block')

        await wait(async () => {
            expect(document.querySelector('span').style.display).toEqual('none')
        })
    })
})

test('loading element is hidden after Livewire receives error from backend', async () => {
    mountAndError(
        `<button wire:click="onClick"></button><span style="display: none" wire:loading></span>`,
        async () => {
            // Make the loading last for 50ms.
            await timeout(50)
        }
    )

    expect(document.querySelector('span').style.display).toEqual('none')

    document.querySelector('button').click()

    await wait(async () => {
        expect(document.querySelector('span').style.display).toEqual('inline-block')

        await wait(async () => {
            expect(document.querySelector('span').style.display).toEqual('none')
        })
    })
})

test('show element while targeted element is loading', async () => {
    mount(
`<button wire:ref="foo" wire:click="onClick"></button>
<span style="display: none" wire:loading wire:target="foo"></span>
<h1 style="display: none" wire:loading wire:target="bar"></h1>`
    )

    document.querySelector('button').click()

    await wait(() => {
        expect(document.querySelector('span').style.display).toEqual('inline-block')
        expect(document.querySelector('h1').style.display).toEqual('none')
    })
})

test('loading element can have multiple targets', async () => {
    mount(
`<button wire:ref="foo" wire:click="onClick"></button>
<a wire:ref="bar" wire:click="onClick"></a>
<span style="display: none" wire:loading wire:target="foo, bar"></span>`
    )

    document.querySelector('a').click()

    await wait( () => {
        expect(document.querySelector('span').style.display).toEqual('inline-block')
    })
})

test('add element class while loading', async () => {
    mount('<button wire:click="onClick"></button><span wire:loading.class="foo-class"></span>')

    document.querySelector('button').click()

    await wait(() => {
        expect(document.querySelector('span').classList.contains('foo-class')).toBeTruthy()
    })
})

test('add element class with spaces while loading', async () => {
    mount('<button wire:click="onClick"></button><span wire:loading.class="foo bar"></span>')

    document.querySelector('button').click()

    await wait(() => {
        expect(document.querySelector('span').classList.contains('foo')).toBeTruthy()
        expect(document.querySelector('span').classList.contains('bar')).toBeTruthy()
    })
})

test('remove element class while loading', async () => {
    mount('<button wire:click="onClick"></button><span class="hidden" wire:loading.class.remove="hidden"></span>')

    document.querySelector('button').click()

    await wait(() => {
        expect(document.querySelector('span').classList.contains('hidden')).toBeFalsy()
    })
})

test('add element attribute while loading', async () => {
    mount('<button wire:click="onClick"></button><span wire:loading.attr="disabled"></span>')

    document.querySelector('button').click()

    await wait(() => {
        expect(document.querySelector('span').hasAttribute('disabled')).toBeTruthy()
    })
})

test('remove element attribute while loading', async () => {
    mount('<button wire:click="onClick"></button><span wire:loading.attr.remove="disabled" disabled="true"></span>')

    document.querySelector('button').click()

    await wait(() => {
        expect(document.querySelector('span').hasAttribute('disabled')).toBeFalsy()
    })
})


test('add element class while loading with a minimum time', async () => {

    mountAndReturn(
        `<button wire:click="onClick"></button><span style="display: none" wire:loading.min.100ms></span>`,
        `<button wire:click="onClick"></button><span style="display: none" wire:loading.min.100ms></span>`,
        [], async () => {
            // Make the loading last for 50ms.
            await timeout(50)
        }
    )

    expect(document.querySelector('span').style.display).toEqual('none')

    document.querySelector('button').click()

    await wait(async () => {
        expect(document.querySelector('span').style.display).toEqual('inline-block')

        await wait(async () => {
            expect(document.querySelector('span').style.display).toEqual('inline-block')
        })
    })

    //now try where response is after min
    //does not fail by default but should fail if .min does not reset at end
    mountAndReturn(
        `<button wire:click="onClick"></button><span style="display: none" wire:loading.min.100ms></span>`,
        `<button wire:click="onClick"></button><span style="display: none" wire:loading.min.100ms></span>`,
        [], async () => {
            // Make the loading last for 200ms.
            await timeout(200)
        }
    )

    expect(document.querySelector('span').style.display).toEqual('none')

    document.querySelector('button').click()

    await wait(async () => {
        expect(document.querySelector('span').style.display).toEqual('inline-block')

        await wait(async () => {
            //request returned slowly - so should return as normal
            expect(document.querySelector('span').style.display).toEqual('none')
        })
    })
})


test('only shows loading after delay is reached', async () => {

    //test loading shows on a long running request
    mountAndReturn(
        `<button wire:click="onClick"></button><span style="display: none" wire:loading.after.100ms></span>`,
        `<button wire:click="onClick"></button><span style="display: none" wire:loading.after.100ms></span>`,
        [], async () => {
            // Make the loading last for 200ms.
            await timeout(200)
        }
    )

    expect(document.querySelector('span').style.display).toEqual('none')

    document.querySelector('button').click()

    await wait(async () => {
        //before the after timer has run 0ms
        expect(document.querySelector('span').style.display).toEqual('none')

        //test for 100ms
        // ...

        await wait(async () => {
            //after 200ms
            expect(document.querySelector('span').style.display).toEqual('inline-block')
        })
    })

    //test loading never shows with a short request
        //test loading shows on a long running request
        mountAndReturn(
            `<button wire:click="onClick"></button><span style="display: none" wire:loading.after.100ms></span>`,
            `<button wire:click="onClick"></button><span style="display: none" wire:loading.after.100ms></span>`,
            [], async () => {
                // Make the loading last for 200ms.
                await timeout(50)
            }
        )
    
        expect(document.querySelector('span').style.display).toEqual('none')
    
        document.querySelector('button').click()
    
        await wait(async () => {
            //before the after timer has run 0ms
            expect(document.querySelector('span').style.display).toEqual('none')

            await wait(async () => {
                //after 50ms
                expect(document.querySelector('span').style.display).toEqual('none')
            })
        })
})
