import { defineStore } from 'pinia';

const baseUrl = `https://pet-shop.buckhill.com.hr/api/v1`;

export const useUserStore = defineStore('userStore', {
    state: () => ({}),
    actions: {
        async getUserData(token) {
            const headers = {
                headers: {
                    Accept: 'application/json',
                    Authorization: `Bearer ${token}`,
                },
            };

            return await axios
                .get(`${baseUrl}/user/`, headers)
                .then((response) => response)
                .catch((error) => {
                    this.errors = error.response.data;
                });
        },
    },
});
