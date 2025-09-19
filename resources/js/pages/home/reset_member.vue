<script setup>

import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const product_id = ref(null)
const loading = ref(false)
const props = defineProps({
    product: Array,
})

const submit = async () => {
    loading.value = true
    if (!product.value) {
        toastify["error"]?.("Whoops!", "Pilih Product terlebih dahulu");
        return
    }
    if (!license.value) {
        toastify["error"]?.("Whoops!", "Masukkan license terlebih dahulu");
        return
    }
    try {
        const res = await axios.post(route('api.reset-license'), { product_id: product_id.value, license: license.value })
        if (res.data.status) {
            toastify["success"]?.("Gotcha!", res.data.message);
            license.value = ''
        } else {
            toastify["error"]?.("Whoops!", res.data.message);
        }
    } catch (e) {
        toastify['error']?.("Whoops!", "Terjadi Kesalahan, silahkan coba beberapa saat lagi")
    } finally {
        loading.value = false
    }
}
</script>
<template>

    <Head :title="`Reset License / Key`" />
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="title-head text-left mb-3 mt-3">
                Reset License
            </div>
            <div class="cards shadow mb-2">
                <form @submit.prevent="submit">
                    <div class="nowrap-left floating-label-content mb-2">
                        <select class="form-select form-control floating-select" id="product" v-model="product_id">
                            <option selected :value="null">Pilih Product</option>
                            <option v-for="p in product" :value="p.id" v-html="p.name"></option>
                        </select>
                    </div>
                    <div class="floating-label-content">
                        <input type="text" class="form-control games-input floating-input" v-model="license"
                            name="license" id="license" placeholder="Masukkan license" required="">
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary mt-3">
                            <span v-if="loading" class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                            <span v-else>Reset</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.product-card, .cards, .custom-card {
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08), 0 1.5px 4px rgba(0,0,0,0.04);
    transition: box-shadow 0.3s, transform 0.3s;
    background: #fff;
}
.product-card:hover, .cards:hover, .custom-card:hover {
    box-shadow: 0 8px 32px rgba(0,0,0,0.14), 0 3px 8px rgba(0,0,0,0.08);
    transform: translateY(-4px) scale(1.02);
}
.modern-btn, .btn-primary {
    background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
    color: #fff;
    border: none;
    border-radius: 999px;
    padding: 0.75em 2em;
    font-weight: 600;
    letter-spacing: 0.03em;
    box-shadow: 0 2px 8px rgba(99,102,241,0.12);
    transition: background 0.3s, box-shadow 0.3s, transform 0.2s;
}
.modern-btn:hover, .btn-primary:hover {
    background: linear-gradient(90deg, #60a5fa 0%, #6366f1 100%);
    box-shadow: 0 4px 16px rgba(99,102,241,0.18);
    transform: scale(1.04);
}
.modern-badge, .badge {
    display: inline-block;
    background: #f472b6;
    color: #fff;
    border-radius: 999px;
    padding: 0.25em 1em;
    font-size: 0.85em;
    font-weight: 500;
    margin-right: 0.5em;
    letter-spacing: 0.02em;
}
.modern-badge.discount {
    background: #34d399;
}
.modern-badge.hot {
    background: #f59e42;
}
.input-modern, .form-control {
    border-radius: 12px;
    border: 1.5px solid #e5e7eb;
    padding: 0.7em 1em;
    font-size: 1em;
    transition: border 0.2s, box-shadow 0.2s;
}
.input-modern:focus, .form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 2px #6366f133;
}
.product-thumbnail-container img, .custom-image {
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.10);
    transition: box-shadow 0.3s;
}
.product-thumbnail-container img:hover, .custom-image:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.18);
}
.desc, .title-card, .game, .vendor {
    font-family: 'Inter', 'Poppins', 'Roboto', Arial, sans-serif;
}
.desc {
    color: #374151;
    font-size: 1.05em;
}
.title-card {
    font-size: 1.15em;
    font-weight: 700;
    color: #6366f1;
}
.game {
    font-weight: 600;
    color: #6366f1;
}
.vendor {
    color: #6b7280;
    font-size: 0.95em;
}
.shadow {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,0.10), 0 1px 2px -1px rgba(0,0,0,0.10);
}
.modern-transition {
    transition: all 0.25s cubic-bezier(.4,0,.2,1);
}
.modern-card-section {
    padding: 1.5em 2em;
    border-radius: 18px;
    background: #f9fafb;
    margin-bottom: 1.5em;
}
.modern-section-title {
    font-size: 1.25em;
    font-weight: 700;
    color: #6366f1;
    margin-bottom: 0.75em;
}
.modern-rating {
    color: #f59e42;
    font-size: 1.2em;
    margin-right: 0.25em;
}
.modern-divider {
    border: none;
    border-top: 1.5px solid #e5e7eb;
    margin: 1.5em 0;
}
.modern-bg {
    background: linear-gradient(120deg, #f1f5f9 0%, #e0e7ff 100%);
}
</style>