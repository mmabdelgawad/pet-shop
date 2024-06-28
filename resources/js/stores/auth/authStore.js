import { defineStore } from 'pinia';
import { useUserStore } from './userStore.js';
import { router } from '../../router/router.js';

const baseUrl = `https://pet-shop.buckhill.com.hr/api/v1`;

export const useAuthStore = defineStore('authStore', {
    id: 'auth',
    state: () => ({
        user: localStorage.getItem('user') ?? {},
        errors: {},
    }),
    actions: {
        clearErrors() {
            this.errors = {};
        },

        async login(data) {
            await axios
                .post(
                    `${baseUrl}/user/login`,
                    {
                        email: data.value.email,
                        password: data.value.password,
                    },
                    {
                        Accept: 'application/json',
                    }
                )
                .then((response) => {
                    if (response.status === 200 && response.data.success) {
                        // get user data
                        const userStore = useUserStore();

                        userStore
                            .getUserData(response.data.data.token)
                            .then((response) => {
                                if (
                                    response.status === 200 &&
                                    response.data.success
                                ) {
                                    localStorage.setItem(
                                        'user',
                                        JSON.stringify(response.data.data)
                                    );
                                    this.user = response.data.data;
                                }
                            });

                        router.push({ name: 'home' });
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data;
                });
        },
        logout() {
            localStorage.removeItem('user');
            this.user = {};
            router.push({ name: 'home' });
        },
    },
    getters: {
        getUser(state) {
            return state.user;
        },
        loggedIn(state) {
            return Object.keys(state.user).length !== 0;
        },
        hasError(state) {
            return state.errors.success === 0;
        },
        errorMessage(state) {
            return state.errors.error;
        },
    },
});
