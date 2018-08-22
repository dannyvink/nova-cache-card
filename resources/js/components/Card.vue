<template>
    <card class="flex items-center justify-center">
        <div class="flex-1 pl-8 pr-3">
            <h1 class="text-3xl text-80 font-light">
                {{ card.defaultDriver }} Cache
            </h1>
            <div class="mt-3" v-if="cacheSize.length">
                Cache Size: <code>{{ cacheSize }}</code>
            </div>
        </div>
        <div class="flex-2 pr-8 pl-3 text-right">
            <div class="flex flex-col">
                <button class="btn btn-default btn-primary" v-on:click="isGetModalOpen = true">
                    Get
                </button>
                <button class="btn btn-default btn-warning my-2" v-on:click="isForgetModalOpen = true">
                    Forget
                </button>
                <button class="btn btn-default btn-danger" v-on:click="isFlushModalOpen = true">
                    Flush
                </button>
            </div>
        </div>
        <portal to="modals">
            <transition name="fade">
                <get-cache-key-modal
                    v-if="isGetModalOpen"
                    @confirm="onGet"
                    @close="isGetModalOpen = false"
                />
                <forget-cache-key-modal
                    v-if="isForgetModalOpen"
                    @confirm="onForget"
                    @close="isForgetModalOpen = false"
                />
                <confirm-flush-cache-modal
                    v-if="isFlushModalOpen"
                    @confirm="onFlush()"
                    @close="isFlushModalOpen = false"
                />
                <view-cache-key-modal
                    v-if="isViewModalOpen"
                    :value="cacheValue"
                    :cacheKey="cacheKey"
                    @confirm="onViewClose()"
                />
            </transition>
        </portal>
    </card>
</template>

<script>
export default {
    props: ['card'],
    data() {
        return {
            isFlushModalOpen: false,
            isForgetModalOpen: false,
            isGetModalOpen: false,
            isViewModalOpen: false,
            cacheKey: '',
            cacheValue: '',
            cacheSize: this.card.cacheSize,
        }
    },
    methods: {
        onFlush() {
            Nova.request().post('/nova-vendor/cache-card/flush').then(response => {
                if (!response.data.success) {
                    this.toastFlushCacheFailed();
                } else {
                    this.toastFlushCacheSuccess();
                }
                this.cacheSize = response.data.size;
            });
            this.isFlushModalOpen = false;
        },
        onForget(cacheKey) {
            Nova.request().post('/nova-vendor/cache-card/cache', { cacheKey }).then(response => {
                if (!response.data.success) {
                    this.toastInvalidCacheKey(response.data.key);
                } else {
                    this.toastForgotCacheKey(response.data.key);
                }
                this.cacheSize = response.data.size;
            });
            this.isForgetModalOpen = false;
        },
        onGet(cacheKey) {
            Nova.request().get('/nova-vendor/cache-card/cache?cacheKey=' + cacheKey).then(response => {
                if (!response.data.success) {
                    this.toastInvalidCacheKey(response.data.key);
                } else {
                    this.cacheValue = response.data.value;
                    this.cacheKey = response.data.key;
                    this.isViewModalOpen = true;
                }
                this.cacheSize = response.data.size;
            });
            this.isGetModalOpen = false;
        },
        onViewClose() {
            this.isViewModalOpen = false;
            this.cacheKey = '';
            this.cacheValue = '';
        },
        toastFlushCacheSuccess() {
            this.$toasted.show(
                this.__('Successfully flushed the cache!'),
                { type: 'success' }
            );
        },
        toastFlushCacheFailed() {
            this.$toasted.show(
                this.__('There was an issue flushing the cache!'),
                { type: 'error' }
            );
        },
        toastForgotCacheKey(key) {
            this.$toasted.show(
                this.__('Successfully forgot the cache value associated with key: <strong class="ml-2">:key</strong>', { key }),
                { type: 'success' }
            );
        },
        toastInvalidCacheKey(key) {
            this.$toasted.show(
                this.__('There is nothing cached for key: <strong class="ml-2">:key</strong>', { key }),
                { type: 'info' }
            );
        },
    }
}
</script>
