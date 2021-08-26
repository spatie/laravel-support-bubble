<script>
    function bootstrapSupportBubble(element) {
        element.style.display = 'flex';

        const container = element.querySelector('.spatie-support-bubble__container');
        const formContainer = element.querySelector('.spatie-support-bubble__form');
        const responseContainer = element.querySelector('.spatie-support-bubble__response');
        const errorMessage = element.querySelector('.spatie-support-bubble__error');

        element.querySelector('.spatie-support-bubble__button button')
            .addEventListener('click', () => {
                responseContainer.style.display = 'none';
                formContainer.style.display = 'block';

                const opening = container.style.display === 'none';

                if (opening) {
                    container.style.display = 'flex';

                    setTimeout(() => {
                        container.classList.remove('translate-x-full', 'opacity-0');
                        container.classList.add('translate-x-0', 'opacity-100');
                    }, 10);
                } else {
                    container.classList.remove('translate-x-0', 'opacity-100');
                    container.classList.add('translate-x-full', 'opacity-0');

                    setTimeout(() => {
                        container.style.display = 'none';
                    }, 160);
                }
            });

        element.querySelector('.spatie-support-bubble__form form')
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
