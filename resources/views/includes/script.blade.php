<script>
    function bootstrapSupportBubble(element) {
        element.style.display = 'flex';

        const container = element.querySelector('.spatie-support-bubble__container');
        const formContainer = element.querySelector('.spatie-support-bubble__form');
        const submitButton = element.querySelector('button[type=submit]');
        const responseContainer = element.querySelector('.spatie-support-bubble__response');
        const errorMessage = element.querySelector('.spatie-support-bubble__error');

        let fullTranslateClass = 'translate-x-full';
        let zeroTranslateClass = 'translate-x-0';

        @if(config('support-bubble.direction') === 'right-to-left')
            fullTranslateClass = "-"+fullTranslate;
            zeroTranslateClass = "-"+zeroTranslate;
        @endif

        element
            .querySelector('.spatie-support-bubble__button button')
            .addEventListener('click', () => {
                const opening = container.classList.contains('opacity-0');

                if (opening) {
                    responseContainer.style.display = 'none';
                    formContainer.style.display = 'block';

                    container.classList.remove(fullTranslateClass, 'opacity-0');
                    container.classList.add(zeroTranslateClass, 'opacity-100');
                } else {
                    container.classList.remove(zeroTranslateClass, 'opacity-100');
                    container.classList.add(fullTranslateClass, 'opacity-0');
                }
            });

        const attachmentKeyField = element.querySelector('input[name=attachment_key]');
        const attachmentNameField = element.querySelector('input[name=attachment_name]');

        element
            .querySelector('input[type=file]')
            .addEventListener('change', (event) => {
                const file = event.target.files[0];
                const fileName = file.name;

                submitButton.disabled = true;

                const formData = new FormData();
                formData.append('attachment', file);

                fetch('/support-bubble/attach', {
                    method: 'post',
                    headers: {Accept: 'application/json'},
                    body: formData,
                })
                    .then(response => {
                        if (response.status !== 200) throw response;

                        return response.json();
                    })
                    .then(attachment => {
                        errorMessage.style.display = 'none';

                        attachmentKeyField.value = attachment.key;
                        attachmentNameField.value = attachment.name;
                    })
                    .catch(async errorResponse => {
                        console.error(errorResponse);

                        const response = await errorResponse.json();

                        errorMessage.style.display = 'block';
                        errorMessage.innerHTML = response.message || 'Something went wrong.';
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                    });
            });

        element
            .querySelector('.spatie-support-bubble__form form')
            .addEventListener('submit', (event) => {
                event.preventDefault();
                const formData = new FormData(event.target)
                const formProps = Object.fromEntries(formData);

                fetch(event.target.action, {
                    headers: {'Content-Type': 'application/json', Accept: 'application/json'},
                    body: JSON.stringify(formProps),
                    method: "post"
                })
                    .then(response => {
                        if (response.status !== 200) throw response;

                        event.target.reset();

                        return response.text();
                    })
                    .then(html => {
                        responseContainer.innerHTML = html;
                        responseContainer.style.display = 'flex';
                        formContainer.style.display = 'none';
                        errorMessage.style.display = 'none';
                    })
                    .catch(async errorResponse => {
                        console.error(errorResponse);

                        const response = await errorResponse.json();

                        errorMessage.style.display = 'block';
                        errorMessage.innerHTML = response.message || 'Something went wrong.';
                    });
            });
    }

    window.addEventListener('load', () => {
        document
            .querySelectorAll('.spatie-support-bubble')
            .forEach(form => bootstrapSupportBubble(form));
    });
</script>
