/**
 * Helper format Rupiah untuk dipakai di semua Alpine component.
 * Simpan file ini di: resources/js/helpers/rupiah.js
 *
 * Cara pakai di component Alpine lain:
 *   import { formatRupiah, parseRupiah } from '../helpers/rupiah';
 *
 *   export default () => ({
 *       formatRupiah,
 *       parseRupiah,
 *       ...
 *   });
 */

/**
 * Format angka murni jadi string berformat Rupiah (tanpa prefix "Rp").
 * Contoh: 1000 -> "1.000"
 *
 * @param {number|string|null|undefined} value
 * @returns {string}
 */
export function formatRupiah(value) {
    if (value === null || value === undefined || value === "") return "";

    const number = Number(value);
    if (isNaN(number)) return "";

    return new Intl.NumberFormat("id-ID").format(number);
}

/**
 * Kebalikan dari formatRupiah(), parse string input (boleh ada titik/Rp/spasi)
 * balik jadi angka murni.
 * Contoh: "Rp 1.000" -> 1000, "1.000" -> 1000
 *
 * @param {string|number|null|undefined} value
 * @returns {number}
 */
export function parseRupiah(value) {
    if (value === null || value === undefined || value === "") return 0;

    const clean = String(value).replace(/\D/g, "");
    return clean ? Number(clean) : 0;
}

/**
 * Format lengkap dengan prefix "Rp".
 * Contoh: 1000 -> "Rp 1.000"
 *
 * @param {number|string|null|undefined} value
 * @returns {string}
 */
export function formatRupiahWithPrefix(value) {
    const formatted = formatRupiah(value);
    return formatted === "" ? "" : "Rp " + formatted;
}
