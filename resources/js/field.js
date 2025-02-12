if(window.Tagify)
{
    document.addEventListener('DOMContentLoaded', function() {
        const tagifyElements = document.querySelectorAll('[data-tagify="1"]');

        // Debounce function for API calls
        const debounce = (fn, delay) => {
            let timeoutId;
            return (...args) => {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => fn(...args), delay);
            };
        };

        tagifyElements.forEach(element => {
            const maxTags = element.getAttribute('data-tagify-maxTags') || 'Infinity';
            const dataUrl = element.getAttribute('data-tagify-url');
            const enforceWhitelist = element.getAttribute('data-tagify-enforceWhitelist') || false;
            const tagify = new Tagify(element, {
                maxTags: maxTags,
                enforceWhitelist: enforceWhitelist
            });

            if (dataUrl) {
                let controller;
                // Debounced API call handler
                const handleInput = debounce(async (e) => {
                    const value = e.detail.value;
                    if (!value) return;

                    controller?.abort();
                    controller = new AbortController();
                    try {
                        tagify.loading(true);
                        const response = await fetch(
                            `${dataUrl}?search=${encodeURIComponent(value)}&autocomplete=1`,
                            { signal: controller.signal }
                        );
                        if (!response.ok) throw new Error('Network response was not ok');
                        const data = await response.json();
                        tagify.whitelist = [...new Map(
                            [...tagify.whitelist, ...data].map(item => [item.value, item])
                        ).values()];
                        tagify.loading(false).dropdown.show(value);
                    } catch (error) {
                        if (error.name !== 'AbortError') {
                            console.error('Fetch error:', error);
                            tagify.loading(false);
                        }
                    }
                }, 300); // 300ms debounce delay
                tagify.on('input', handleInput);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const tagifyWithDefaultElements = document.querySelectorAll('[data-tagify-with-default="1"]');

        // Debounce function for API calls
        const debounce = (fn, delay) => {
            let timeoutId;
            return (...args) => {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => fn(...args), delay);
            };
        };

        tagifyWithDefaultElements.forEach(element => {
            if (element) {
                const maxTags = element.getAttribute('data-tagify-maxTags') || 'Infinity';
                const dataUrl = element.getAttribute('data-tagify-url');
                const enforceWhitelist = element.getAttribute('data-tagify-enforceWhitelist') || false;
                const dataValue = element.getAttribute('data-tagify-value') || false;
                const tagTextProp = element.getAttribute('data-tagify-tagTextProp') || 'name';
                const dropdown = element.getAttribute('data-tagify-dropdown') || false;
                const whitelist = element.getAttribute('data-tagify-whitelist') || false;

                const tagify = new Tagify(element, {
                    maxTags: maxTags,
                    enforceWhitelist: enforceWhitelist,
                    tagTextProp: tagTextProp,
                    dropdown: dropdown ? JSON.parse(dropdown) : {},
                    whitelist: whitelist ? JSON.parse(whitelist) : [],
                    transformTag: function(tagData, originalData) {
                        if (this.value.length === 0) {
                            tagData.is_default = true;
                        }
                    },
                    templates: {
                        tag: function(tagData) {
                            return `
                                <tag title="${(tagData.title || tagData[this.settings.tagTextProp] || tagData.value)}"
                                    contenteditable='false'
                                    spellcheck='false'
                                    tabIndex="${this.settings.a11y.focusableTags ? 0 : -1}"
                                    class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ""}"
                                    ${this.getAttributes(tagData)}>
                                    <x title='' class="${this.settings.classNames.tagX}" role='button' aria-label='remove tag'></x>
                                    <div>
                                        ${tagData.is_default === true ? `<i class="fas fa-star"></i>` : ''}
                                        <span ${this.settings.mode === 'select' && this.settings.userInput ? "contenteditable='true'" : ''} autocapitalize="false" autocorrect="off" spellcheck='false' class="${this.settings.classNames.tagText}">${tagData[this.settings.tagTextProp] || tagData.value}</span>
                                    </div>
                                </tag>
                            `;
                        }
                    },
                });

                if (dataValue) {
                    const data = JSON.parse(dataValue);
                    tagify.addTags(data);
                }

                if (dataUrl) {
                    let controller;
                    // Debounced API call handler
                    const handleInput = debounce(async (e) => {
                        const value = e.detail.value;
                        if (!value) return;

                        controller?.abort();
                        controller = new AbortController();
                        try {
                            tagify.loading(true);
                            const response = await fetch(
                                `${dataUrl}?search=${encodeURIComponent(value)}&autocomplete=1`,
                                { signal: controller.signal }
                            );
                            if (!response.ok) throw new Error('Network response was not ok');
                            const data = await response.json();
                            tagify.whitelist = [...new Map(
                                [...tagify.whitelist, ...data].map(item => [item.value, item])
                            ).values()];
                            tagify.loading(false).dropdown.show(value);
                        } catch (error) {
                            if (error.name !== 'AbortError') {
                                console.error('Fetch error:', error);
                                tagify.loading(false);
                            }
                        }
                    }, 300); // 300ms debounce delay
                    tagify.on('input', handleInput);
                }

                if (window.DragSort)
                {
                    const dragsort = new DragSort(tagify.DOM.scope, {
                        selector:'.' + tagify.settings.classNames.tag,
                        callbacks: {
                            dragEnd: () => {
                                tagify.updateValueByDOMTags();
                                const tagifyValue = tagify.value.map((tag, index) => ({
                                    ...tag,
                                    is_default: index === 0
                                }));
                                tagify.loadOriginalValues(tagifyValue);
                            }
                        }
                    });
                }
            }
        });
    });
}

if(window.Choices)
{
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('[data-choices="1"]');
        elements.forEach(element => {
            const removeItemButton = element.getAttribute('data-choices-removeItemButton') != 0;
            const maxItemCount = element.getAttribute('data-choices-maxItemCount') || -1;
            const addChoices = element.getAttribute('data-choices-addChoices') != 0;
            const choices = new Choices(element, {
                removeItemButton: removeItemButton,
                maxItemCount: maxItemCount,
                allowHTML: true,
                shouldSort: false,
                addChoices: addChoices
            });
            const dataUrl = element.getAttribute('data-choices-url');
            if (dataUrl) {
                choices.passedElement.element.addEventListener(
                'search', async (event) => {
                    try {
                        var controller;
                        controller && controller.abort();
                        controller = new AbortController();
                        const items = await fetch(`${dataUrl}?search=${event.detail.value}&autocomplete=1`, {signal:controller.signal});
                        const data = await items.json();
                        // Clear existing choices
                        choices.clearChoices();
                        
                        // Set new choices
                        choices.setChoices(data, 'value', 'label', true);
                    } catch (err) {
                        console.error(err);
                    }
                });
            }
        });
    });
}
