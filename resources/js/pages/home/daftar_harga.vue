<script setup>
import { Head } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    game: Array,
    denom: Array,
    product: Array
})
const loop = 0
const kategori = ref("")
const brand = ref("")

const filteredProduct = ref([])
const filteredDenom = ref([])

watch(kategori, (val) => {
    if (!val) {
        filteredProduct.value = props.product
    } else {
        filteredProduct.value = props.product.filter(p => p.game_id == val)
    }
})
watch(brand, (val) => {
    if (!val) {
        filteredDenom.value = props.denom
    } else {
        filteredDenom.value = props.denom.filter(p => p.product_id == val)
    }
})
function number_format(number, decimals = 0, dec_point = ',', thousands_sep = '.') {
    number = (number + "").replace(/[^0-9+\-Ee.]/g, "");
    let n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = thousands_sep,
        dec = dec_point,
        s = "",
        toFixedFix = function (n, prec) {
            let k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}
</script>
<template>

    <Head :title="`Daftar Harga`" />
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="title-head text-left mb-3 mt-3">
                Daftar Harga
            </div>
            <div class="cards shadow mb-2">
                <div class="nowrap-left floating-label-content mb-2">
                    <select class="form-select form-control floating-select" id="kategori" v-model="kategori">
                        <option selected value="">—Kategori Game—</option>
                        <option v-for="g in game" :value="g.id" v-html="g.name"></option>
                    </select>
                </div>

                <div class="nowrap-left floating-label-content mb-2">
                    <select class="form-select form-control floating-select" id="brand" name="brand" v-model="brand">
                        <option value="">—Game VIP—</option>
                        <option v-for="b in filteredProduct" :value="b.id" v-html="b.name"></option>
                    </select>
                </div>

                <div class="mt-3 cards-title">
                    <hr>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered cards-title mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" rowspan="2" style="vertical-align:middle">#</th>
                                <th class="text-center" colspan="2" style="vertical-align:middle">INFORMATION
                                </th>
                                <th class="text-center" rowspan="2" style="vertical-align:middle">Status</th>
                            </tr>
                            <tr>
                                <th class="text-center">Durasi</th>
                                <th class="text-center">Harga</th>
                            </tr>
                        </thead>
                        <tbody id="pricelist">
                            <tr v-if="filteredDenom.length === 0 && kategori == ''">
                                <td colspan="5" class="text-center">Silakan Pilih Kategori.</td>
                            </tr>
                            <tr v-else-if="filteredDenom.length > 0 && kategori !== ''"
                                v-for="(filter, index) in filteredDenom" :key="filter.id">
                                <td class="text-center">{{ index + 1 }}.</td>
                                <td class="text-center">
                                    {{ filter.name }}
                                </td>
                                <td class="text-center">
                                    Rp {{ number_format(filter.price, 0, ',', '.') }}
                                </td>
                                <td class="text-center"
                                    :class="filter.status == 'active' ? 'text-success' : 'text-danger'">
                                    <i class="bi"
                                        :class="filter.status == 'active' ? 'bi-check-circle' : 'bi-x-circle'"></i>
                                </td>
                            </tr>

                            <tr v-else>
                                <td colspan="5" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                </div>
            </div>
        </div>
    </div>
    <div class="h-40"></div>
    <div class="h-40"></div>
    <div class="h-40"></div>
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