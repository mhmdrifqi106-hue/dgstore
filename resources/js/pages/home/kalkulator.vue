<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref, toDisplayString } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps({
    app: String
})
const type = ref("")

const totalMatch = ref(0)
const totalWinrate = ref(0)
const targetWinrate = ref(0)
const kalkulasiWinrate = ref("")

const pointMagicWheel = ref(0)
const hasilDiamondMwheel = ref("")

const pointBintang = ref(0)
const hasilZodiac = ref("")

function rumus(TotalMatch, TotalWr, MauWr) {
    let tWin = TotalMatch * (TotalWr / 100);
    let tLose = TotalMatch - tWin;
    let sisaWr = 100 - MauWr;
    let wrResult = 100 / sisaWr;
    let seratusPersen = tLose * wrResult;
    let final = seratusPersen - TotalMatch;
    return Math.round(final);
}

const hitungwinrate = async () => {
    try {
        if (targetWinrate.value == "100") {
            toastify['error']?.('Whoops!', 'Kamu tidak dapat mencapai 100% win rate!')
            kalkulasiWinrate.value = `Jangan Ngaco ya! wkwk`;
            return;
        }
        const result = rumus(totalMatch.value, totalWinrate.value, targetWinrate.value)

        kalkulasiWinrate.value = `Kamu memerlukan sekitar <b>${result}</b> win tanpa lose untuk mendapatkan win rate <b>${targetWinrate.value}%</b>`
        toastify["success"]?.("Gotcha!", "Berhasil menghitung winrate") // 🔥 pakai success, bukan error
    } catch (error) {
        toastify["error"]?.("Whoops!", "Terjadi kesalahan! silahkan ulangi beberapa saat lagi.")
    }
}
const hitungmwheel = async () => {
    let points = parseInt(pointMagicWheel.value);
    let requiredDiamonds;
    if (points < 196) {
        let remainingPoints = 200 - points;
        let spinsNeeded = Math.ceil(remainingPoints / 5);
        requiredDiamonds = spinsNeeded * 270;
        toastify["success"]?.("Gotcha!", "Berhasil menghitung jumlah Diamond.");
    } else {
        if (points > 199) {
            toastify["error"]?.("Whoops!", "Point tidak boleh melebihi 199.");
        }
        let remainingPoints = 200 - points;
        requiredDiamonds = remainingPoints * 60;
    }
    hasilDiamondMwheel.value = requiredDiamonds
}

const hitungZodiac = async () => {
    let points = parseInt(pointBintang.value);
    let requiredDiamonds;
    if (points < 90) {
        requiredDiamonds = Math.ceil((2000 - points * 20) * 850 / 1000);
        toastify["success"]?.("Gotcha!", "Berhasil menghitung jumlah Diamond.");
    } else {
        if (points > 99) {
            toastify["error"]?.("Whoops!", "Point Zodiac tidak boleh melebihi 99.");
        }
        requiredDiamonds = Math.ceil(2000 - points * 20);
    }
    hasilZodiac.value = requiredDiamonds;
}

</script>
<template>

    <Head
        :title="`Kalkulator ${type == 'winrate' ? 'winrate' : (type == 'mwheel' ? 'Magic Wheel' : (type == '' ? null : 'Zodiac'))}`" />
    <div :style="{ minHeight: '100vh', display: 'flex', justifyContent: 'center', alignItems: 'center' }">
        <div class="container">
            <Link class="btn-back inline-flex items-center justify-center" :href="route('home.index')"
                style="outline: none;">
            <i class="bi bi-x"></i>
            </Link>
            <div class="row justify-center">
                <div class="col-lg-4 col-md-6 col-12" v-if="type == ''">
                    <div class="login-card">
                        <span class="head">Kalkulator</span>
                        <button type="button" @click="type = 'winrate'" class="btnYellowPrimary md w-100">Win
                            Rate</button>
                        <button type="button" @click="type = 'mwheel'" class="btnYellowPrimary md w-100">Magic
                            Wheel</button>
                        <button type="button" @click="type = 'zodiac'" class="btnYellowPrimary md w-100">Zodiac</button>
                    </div>
                </div>
                <div class="col-md-10" v-else-if="type == 'winrate'">
                    <div class="title-head text-left mb-3 mt-3">Hitung Win Rate</div>
                    <div class="cards shadow mb-4">
                        <div class="nowrap-left floating-label-content">
                            <form @submit.prevent="hitungwinrate">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-white form-label">Total Match</label>
                                        <input type="number" class="form-control games-input floating-input"
                                            id="TotalMatch" v-model="totalMatch" placeholder="Masukkan Total Match">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-white form-label">Total Win Rate</label>
                                        <input type="number" v-model="totalWinrate"
                                            class="form-control games-input floating-input" id="TotalWr"
                                            placeholder="Total Win Rate Kamu (%)">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="text-white form-label">Target Win Rate</label>
                                        <input type="number" v-model="targetWinrate"
                                            class="form-control games-input floating-input" id="MauWr"
                                            placeholder="Total Target Win Rate (%)">
                                        <button id="hasil" type="submit"
                                            class="btnYellowPrimary mt-3 w-100">Hitung</button>
                                    </div>
                                    <label class="text-white form-label" v-html="kalkulasiWinrate"></label>
                                    <a href="javascript:void(0)" @click="type = ''">Kembali </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-10" v-else-if="type == 'mwheel'">
                    <div class="title-head text-left mb-3 mt-3">Hitung Magic Wheel</div>
                    <div class="cards shadow mb-4">
                        <div class="nowrap-left floating-label-content">
                            <form @submit.prevent="hitungmwheel">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label text-white">Point :</label>
                                        <input type="number" class="form-control games-input floating-input" id="point"
                                            min="0" placeholder="Point Magic Wheel" v-model="pointMagicWheel"
                                            data-gtm-form-interact-field-id="0">
                                        <button type="submit" class="btnYellowPrimary mt-3 w-100">Hitung</button>
                                    </div>
                                    <span class="text-white">Jumlah diamond yang dibutuhkan: <span id="jumlah">{{
                                        hasilDiamondMwheel }}</span></span>
                                    <a href="javascript:void(0)" @click="type = ''">Kembali </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-10" v-else>
                    <div class="title-head text-left mb-3 mt-3">Hitung Zodiac</div>
                    <div class="cards shadow mb-4">
                        <div class="nowrap-left floating-label-content">
                            <div class="row">
                                <form @submit.prevent="hitungZodiac">
                                    <div class="col-md-12 mb-3">
                                        <label class="text-white form-label">Point Bintang Kamu</label>
                                        <input type="number" class="form-control games-input floating-input" id="point"
                                            min="0" placeholder="Point Bintang kamu" v-model="pointBintang" />
                                        <span class="text-white">Jumlah diamonds yang dibutuhkan :
                                            <span>{{ hasilZodiac }}</span></span>
                                        <button type="submit" class="btnYellowPrimary mt-3 w-100">Hitung</button>
                                        <a href="javascript:void(0)" @click="type = ''">Kembali </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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