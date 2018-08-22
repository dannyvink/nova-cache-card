<template>
    <modal @modal-close="handleClose">
        <div
            class="bg-white rounded-lg shadow-lg overflow-hidden"
            style="width: 460px"
        >
            <div class="p-8">
                <heading :level="2" class="mb-6">{{__('Get Cache Key')}}</heading>
                <p class="text-80">{{__('Provide the cache key you would like to retrieve?')}}</p>
                <input type="text" v-model="cacheKey" placeholder="Cache key..." class="mt-4 p-3 bg-40 rounded-lg outline-none w-full">
            </div>

            <div class="bg-30 px-6 py-3 flex">
                <div class="ml-auto">
                    <button dusk="cancel-get-key-button" type="button" data-testid="cancel-button" @click.prevent="handleClose" class="btn text-80 font-normal h-9 px-3 mr-3 btn-link">{{__('Cancel')}}</button>
                    <button dusk="confirm-get-key-button" ref="confirmButton" data-testid="confirm-button" @click.prevent="handleConfirm" class="btn btn-default btn-primary">{{__('Get')}}</button>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
export default {
    /**
     * Mount the component.
     */
    mounted() {
        this.$refs.confirmButton.focus()
    },

    data() {
        return {
            cacheKey: ''
        }
    },

    methods: {
        handleClose() {
            this.$emit('close');
            this.cacheKey = '';
        },

        handleConfirm() {
            this.$emit('confirm', this.cacheKey);
            this.cacheKey = '';
        },
    },
}
</script>
