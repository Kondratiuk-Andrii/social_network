import { usePage } from '@inertiajs/vue3';
import { acceptHMRUpdate, defineStore } from 'pinia';
import { Ref, ref, watch } from 'vue';
import { IUser } from '@/stores/user/types';

export const useUserStore = defineStore(
    'User',
    () => {
        const user = ref<IUser | null>(null);
        const isAuthenticated: Ref<boolean> = ref(false);

        watch(
            () => usePage().props.auth.user,
            (newUser) => {
                if (!newUser) {
                    user.value = null;
                    isAuthenticated.value = false;
                } else {
                    user.value = { ...newUser };
                    isAuthenticated.value = true;
                }
            }
        );

        return {
            user,
            isAuthenticated,
        };
    },
    {
        persist: {
            paths: ['user', 'isAuthenticated'],
            key: 'user',
        },
    }
);

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useUserStore, import.meta.hot));
}
