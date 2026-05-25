;(function () {
    function applyDarkMode(checked) {
        if (checked) {
            document.documentElement.classList.add('dark')
            document.querySelector('html').style.colorScheme = 'dark'
            localStorage.setItem('dark-mode', true)
            document.dispatchEvent(new CustomEvent('darkMode', { detail: { mode: 'on' } }))
        } else {
            document.documentElement.classList.remove('dark')
            document.querySelector('html').style.colorScheme = 'light'
            localStorage.setItem('dark-mode', false)
            document.dispatchEvent(new CustomEvent('darkMode', { detail: { mode: 'off' } }))
        }
    }

    function syncSwitchesFromStorage() {
        const enabled = localStorage.getItem('dark-mode') === 'true'
        // Sync all switches on the page to the stored value
        document.querySelectorAll('.light-switch').forEach((el) => {
            el.checked = enabled
        })
        // Ensure the html element reflects the stored theme (important after navigation)
        if (enabled) {
            document.documentElement.classList.add('dark')
            document.querySelector('html').style.colorScheme = 'dark'
        } else {
            document.documentElement.classList.remove('dark')
            document.querySelector('html').style.colorScheme = 'light'
        }
    }

    // Use delegated listener so new switches added after navigation just work
    document.addEventListener('change', (e) => {
        const switchEl = e.target && e.target.closest ? e.target.closest('.light-switch') : null
        if (!switchEl) return
        const checked = switchEl.checked
        // Mirror state to all other switches
        document.querySelectorAll('.light-switch').forEach((el) => {
            if (el !== switchEl) el.checked = checked
        })
        applyDarkMode(checked)
    })

    // Initial sync on page load
    document.addEventListener('DOMContentLoaded', () => {
        syncSwitchesFromStorage()
    })

    // Re-sync after Livewire wire:navigate finishes swapping the DOM
    document.addEventListener('livewire:navigated', () => {
        syncSwitchesFromStorage()
    })

    // set current year in footer
    const yearEle = document.querySelector('#footer-year')
    if (yearEle) {
        yearEle.innerHTML = new Date().getFullYear() + '.'
    }

    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', (initialOpenState = false) => ({
            open: initialOpenState,

            toggle() {
                this.open = !this.open
            },
        }))

        Alpine.data('modal', (initialOpenState = false) => ({
            open: initialOpenState,

            toggle() {
                this.open = !this.open
            },
        }))

        // Magic: $tooltip
        Alpine.magic('tooltip', (el) => (message, placement) => {
            let instance = tippy(el, {
                content: message,
                trigger: 'manual',
                placement: placement || undefined,
                allowHTML: true,
            })

            instance.show()
        })

        Alpine.directive('dynamictooltip', (el, { expression }, { evaluate }) => {
            let string = evaluate(expression)
            tippy(el, {
                content: string.charAt(0).toUpperCase() + string.slice(1),
            })
        })

        // Directive: x-tooltip
        Alpine.directive('tooltip', (el, { expression }) => {
            tippy(el, {
                content: expression,
                placement: el.getAttribute('data-placement') || undefined,
                allowHTML: true,
                delay: el.getAttribute('data-delay') || 0,
                animation: el.getAttribute('data-animation') || 'fade',
                theme: el.getAttribute('data-theme') || '',
            })
        })

        // Magic: $popovers
        Alpine.magic('popovers', (el) => (message, placement) => {
            let instance = tippy(el, {
                content: message,
                placement: placement || undefined,
                interactive: true,
                allowHTML: true,
                // hideOnClick: el.getAttribute("data-dismissable") ? true : "toggle",
                delay: el.getAttribute('data-delay') || 0,
                animation: el.getAttribute('data-animation') || 'fade',
                theme: el.getAttribute('data-theme') || '',
                trigger: el.getAttribute('data-trigger') || 'click',
            })

            instance.show()
        })
    })
})()
