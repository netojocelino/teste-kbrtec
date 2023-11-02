const http = (() => ({
    get: async (url, body = {}) => {
        body['_method'] = 'DELETE';
        body['_token'] = document.querySelector('meta[name="csrf-token"]').content;
        body['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;

        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })

        const result = await response.json()
        if (response.status < 200 || response.status >= 300) {
            throw new Error(result.error)
        }

        return result
    },
}))()
