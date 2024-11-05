if(window.Choices)
{
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('[data-choices="1"]');
        elements.forEach(element => {
            const removeItemButton = element.getAttribute('data-choices-removeItemButton') != 0;
            const maxItemCount = element.getAttribute('data-choices-maxItemCount') || -1;
            const choicesElement = new Choices(element, {
                removeItemButton: removeItemButton,
                maxItemCount: maxItemCount
            });
            const dataUrl = element.getAttribute('data-choices-url');
            if (dataUrl) {
                choicesElement.passedElement.element.addEventListener(
                'search', async (event) => {
                    try {
                        const items = await fetch(`${dataUrl}?search=${event.detail.value}&autocomplete=1`);
                        const data = await items.json();
                        // Clear existing choices
                        choicesElement.clearChoices();
                        
                        // Set new choices
                        choicesElement.setChoices(data, 'value', 'label', true);
                    } catch (err) {
                        console.error(err);
                    }
                });
            }
        });
    });
}