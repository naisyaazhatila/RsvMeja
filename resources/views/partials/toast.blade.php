<div
    x-data="{
        notifications: [],
        nextId: 0,
        show(message, type = 'success') {
            const id = this.nextId++;
            this.notifications.push({ id, message, type, show: true });

            // Auto dismiss after 4 seconds
            setTimeout(() => {
                this.remove(id);
            }, 4000);
        },
        remove(id) {
            const index = this.notifications.findIndex(n => n.id === id);
            if (index !== -1) {
                this.notifications[index].show = false;
                // Remove from array after animation completes
                setTimeout(() => {
                    this.notifications = this.notifications.filter(n => n.id !== id);
                }, 300);
            }
        },
        getTypeClasses(type) {
            const classes = {
                'success': 'bg-green-50 border-green-500 text-green-900',
                'error': 'bg-red-50 border-red-500 text-red-900',
                'warning': 'bg-yellow-50 border-yellow-500 text-yellow-900',
                'info': 'bg-blue-50 border-blue-500 text-blue-900'
            };
            return classes[type] || classes['info'];
        },
        getIconClasses(type) {
            const classes = {
                'success': 'text-green-500',
                'error': 'text-red-500',
                'warning': 'text-yellow-500',
                'info': 'text-blue-500'
            };
            return classes[type] || classes['info'];
        }
    }"
    @alert.window="show($event.detail.message, $event.detail.type)"
    class="fixed top-24 right-4 z-50 space-y-3 max-w-md w-full pointer-events-none"
    aria-live="assertive"
>
    <template x-for="notification in notifications" :key="notification.id">
        <div
            x-show="notification.show"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            :class="getTypeClasses(notification.type)"
            class="pointer-events-auto w-full rounded-lg border-l-4 shadow-lg p-4"
            role="alert"
        >
            <div class="flex items-start">
                <!-- Icon -->
                <div class="flex-shrink-0" :class="getIconClasses(notification.type)">
                    <!-- Success Icon -->
                    <template x-if="notification.type === 'success'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>

                    <!-- Error Icon -->
                    <template x-if="notification.type === 'error'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>

                    <!-- Warning Icon -->
                    <template x-if="notification.type === 'warning'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </template>

                    <!-- Info Icon -->
                    <template x-if="notification.type === 'info'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                </div>

                <!-- Message -->
                <div class="ml-3 flex-1 pt-0.5">
                    <p class="text-sm font-medium" x-text="notification.message"></p>
                </div>

                <!-- Close Button -->
                <div class="ml-4 flex-shrink-0 flex">
                    <button
                        @click="remove(notification.id)"
                        :class="getIconClasses(notification.type)"
                        class="inline-flex rounded-md hover:opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2"
                        :class="{
                            'focus:ring-green-500': notification.type === 'success',
                            'focus:ring-red-500': notification.type === 'error',
                            'focus:ring-yellow-500': notification.type === 'warning',
                            'focus:ring-blue-500': notification.type === 'info'
                        }"
                    >
                        <span class="sr-only">Tutup</span>
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>
