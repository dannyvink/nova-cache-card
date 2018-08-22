Nova.booting((Vue, router) => {
    Vue.component('get-cache-key-modal', require('./components/GetCacheKeyModal'));
    Vue.component('forget-cache-key-modal', require('./components/ForgetCacheKeyModal'));
    Vue.component('confirm-flush-cache-modal', require('./components/ConfirmFlushCacheModal'));
    Vue.component('view-cache-key-modal', require('./components/ViewCacheKeyModal'));
    Vue.component('cache-card', require('./components/Card'));
})
