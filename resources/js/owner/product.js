import { formatRupiah, parseRupiah } from "../helper/rupiah";

export default (masterUnits = [], oldUnits = []) => ({
    masterUnits,
    maxUnits: masterUnits.length,

    units: [],

    formatRupiah,
    parseRupiah,

    init() {
        if (oldUnits.length > 0) {
            this.units = oldUnits.map((item, index) => ({
                unit_id: item.unit_id ?? "",
                conversion: Number(item.conversion ?? 1),
                barcode: item.barcode ?? "",
                purchase_price: Number(item.purchase_price ?? 0),
                selling_price: Number(item.selling_price ?? 0),

                is_base: Boolean(item.is_base),
                is_default_purchase: Boolean(item.is_default_purchase),
                is_default_sale: Boolean(item.is_default_sale),
                is_active: item.is_active != 0,

                sort_order: index + 1,
            }));
        } else {
            this.addUnit();
        }
    },

    addUnit() {
        if (this.units.length >= this.maxUnits) {
            return;
        }

        this.units.push({
            unit_id: "",
            conversion: 1,
            barcode: "",
            purchase_price: 0,
            selling_price: 0,

            is_base: false,
            is_default_purchase: false,
            is_default_sale: false,
            is_active: true,

            sort_order: this.units.length + 1,
        });
    },

    removeUnit(index) {
        this.units.splice(index, 1);

        this.refresh();
    },

    unitName(id) {
        const unit = this.masterUnits.find((x) => x.id == id);
        return unit ? unit.name : "";
    },

    canSelectUnit(unitId, currentValue) {
        // if (unitId == currentValue) return true;
        // return !this.units.some((item) => item.unit_id == unitId);
        return true;
    },

    setBase(index) {
        this.units.forEach((item, i) => {
            if (i !== index) {
                item.is_base = false;
            }
        });

        if (this.units[index].is_base) {
            this.units[index].conversion = 1;
        }
    },

    setDefaultPurchase(index) {
        this.units.forEach((item, i) => {
            if (i !== index) {
                item.is_default_purchase = false;
            }
        });
    },

    setDefaultSale(index) {
        this.units.forEach((item, i) => {
            if (i !== index) {
                item.is_default_sale = false;
            }
        });
    },

    refresh() {
        this.units.forEach((item, index) => {
            item.sort_order = index + 1;
        });
    },
});
