<script setup>
import { useAuthStore } from '../../stores/auth/authStore.js';

const authStore = useAuthStore();
</script>

<template>
    <div>
        <nav class="bg-theme-green-color">
            <div
                class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
            >
                <a
                    href="/"
                    class="flex items-center space-x-3 rtl:space-x-reverse"
                >
                    <svg
                        class="h-8"
                        viewBox="0 0 31 29"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M21.1344 0.0242155C19.3129 -0.249441 17.3833 1.82713 16.8276 4.69247C16.2718 7.54172 17.2752 10.0851 19.0968 10.3749C20.9029 10.6646 22.8479 8.58805 23.4191 5.72271C23.9903 2.87346 22.956 0.330067 21.1344 0.0242155ZM10.0971 0.0242155C8.26013 0.330067 7.2413 2.87346 7.78159 5.72271C8.36819 8.58805 10.2978 10.6646 12.1193 10.3749C13.9563 10.0851 14.9597 7.54172 14.3885 4.69247C13.8328 1.82713 11.9032 -0.249441 10.0971 0.0242155ZM29.3931 7.42904C27.6333 6.64026 25.2406 8.07294 23.9903 10.568C22.8171 13.1114 23.2184 15.7836 24.9628 16.5724C26.7071 17.3612 29.0844 15.9446 30.3039 13.4173C31.5234 10.89 31.0912 8.20172 29.3931 7.42904ZM1.60685 7.42904C-0.091198 8.20172 -0.52343 10.89 0.696079 13.4173C1.91559 15.9446 4.29286 17.3612 6.03723 16.5724C7.78159 15.7836 8.18294 13.1114 7.00974 10.568C5.75936 8.07294 3.36665 6.64026 1.60685 7.42904ZM4.1848 24.7821C4.12306 26.2952 5.23451 27.9694 6.56207 28.5972C9.32527 29.9172 12.5979 27.1806 15.6698 27.1806C18.7417 27.1806 22.0452 30.0298 24.7621 28.5972C26.3058 27.8084 27.3709 25.7157 27.1702 23.9772C26.8924 21.5787 24.1292 20.2909 22.4929 18.5363C20.3163 16.2665 18.7726 12.0007 15.6698 12.0007C12.5824 12.0007 10.9461 16.2021 8.86217 18.5363C7.14868 20.5002 4.29286 22.1582 4.1848 24.7821Z"
                            fill="white"
                        />
                    </svg>
                    <span
                        class="self-center text-lg whitespace-nowrap text-white"
                        >petson.</span
                    >
                </a>
                <div
                    class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse"
                >
                    <div
                        class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse items-center"
                    >
                        <button
                            type="button"
                            class="text-white bg-theme-green-color font-medium rounded-md text-sm px-4 py-2 text-center border border-white mr-1 flex"
                        >
                            <svg
                                width="20"
                                height="20"
                                viewBox="0 0 22 22"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g clip-path="url(#clip0_9358_2545)">
                                    <path
                                        d="M6.41699 16.4997C5.40866 16.4997 4.59283 17.3247 4.59283 18.333C4.59283 19.3413 5.40866 20.1663 6.41699 20.1663C7.42533 20.1663 8.25033 19.3413 8.25033 18.333C8.25033 17.3247 7.42533 16.4997 6.41699 16.4997ZM0.916992 1.83301V3.66634H2.75033L6.05033 10.6238L4.81283 12.8697C4.66616 13.1263 4.58366 13.4288 4.58366 13.7497C4.58366 14.758 5.40866 15.583 6.41699 15.583H17.417V13.7497H6.80199C6.67366 13.7497 6.57283 13.6488 6.57283 13.5205L6.60033 13.4105L7.42533 11.9163H14.2545C14.942 11.9163 15.547 11.5405 15.8587 10.9722L19.1403 5.02301C19.2137 4.89467 19.2503 4.73884 19.2503 4.58301C19.2503 4.07884 18.8378 3.66634 18.3337 3.66634H4.77616L3.91449 1.83301H0.916992ZM15.5837 16.4997C14.5753 16.4997 13.7595 17.3247 13.7595 18.333C13.7595 19.3413 14.5753 20.1663 15.5837 20.1663C16.592 20.1663 17.417 19.3413 17.417 18.333C17.417 17.3247 16.592 16.4997 15.5837 16.4997Z"
                                        fill="white"
                                    />
                                </g>
                                <defs>
                                    <clipPath id="clip0_9358_2545">
                                        <rect
                                            width="22"
                                            height="22"
                                            fill="white"
                                        />
                                    </clipPath>
                                </defs>
                            </svg>
                            Cart (0)
                        </button>
                        <a
                            v-show="!authStore.loggedIn"
                            href="/user/auth/login"
                            type="button"
                            class="text-white bg-theme-green-color font-medium rounded-md text-sm px-4 py-2 text-center border border-white flex"
                        >
                            Login
                        </a>
                        <a
                            v-show="authStore.loggedIn"
                            href="/user/auth/logout"
                            type="button"
                            class="text-white bg-theme-green-color font-medium rounded-md text-sm px-4 py-2 text-center border border-white flex"
                        >
                            Logout
                        </a>
                    </div>
                    <button
                        data-collapse-toggle="navbar-cta"
                        type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-cta"
                        aria-expanded="false"
                    >
                        <span class="sr-only">Open main menu</span>
                        <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 17 14"
                        >
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15"
                            />
                        </svg>
                    </button>
                </div>
                <div
                    class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                    id="navbar-cta"
                >
                    <ul
                        class="flex flex-col font-medium p-4 md:p-0 mt-4 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0"
                    >
                        <li>
                            <a
                                href="#"
                                class="block py-2 px-3 md:p-0 text-white md:hover:text-blue-700"
                                aria-current="page"
                                >PRODUCTS</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="block py-2 px-3 md:p-0 text-white md:hover:text-blue-700"
                                >PROMOTIONS</a
                            >
                        </li>
                        <li>
                            <a
                                href="#"
                                class="block py-2 px-3 md:p-0 text-white md:hover:text-blue-700"
                                >BLOG</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<style scoped></style>
