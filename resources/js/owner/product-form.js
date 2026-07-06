$(function () {
    ProductForm.init();
});

const ProductForm = {
    index: 0,

    init() {
        this.bindEvents();

        this.addUnit();
    },

    bindEvents() {
        $("#btnAddUnit").on("click", () => {
            this.addUnit();
        });

        $(document).on("click", ".btnRemoveUnit", (e) => {
            this.removeUnit(e);
        });

        $(document).on("change", ".is-base", (e) => {
            this.changeBaseUnit(e);
        });

        $(document).on("change", ".product-unit-select", () => {
            this.refresh();
        });

        $(document).on("change", ".default-sale", (e) => {
            this.changeDefaultSale(e);
        });

        $(document).on("change", ".default-purchase", (e) => {
            this.changeDefaultPurchase(e);
        });
    },

    addUnit() {
        if ($("#btnAddUnit").prop("disabled")) {
            return;
        }

        let template = $("#productUnitTemplate").html();

        template = template.replace(/__INDEX__/g, this.index);

        $("#productUnitWrapper").append(template);

        this.index++;

        this.refresh();
    },

    removeUnit(e) {
        $(e.currentTarget).closest(".product-unit-item").remove();

        this.refresh();
    },

    refresh() {
        this.refreshSortOrder();

        this.refreshHeader();

        this.refreshDeleteButton();

        this.refreshUnitOptions();
    },

    refreshHeader() {
        $("#productUnitWrapper .product-unit-item").each(function (index) {
            const unitName = $(this)
                .find(".product-unit-select option:selected")
                .text();

            let title = `Unit #${index + 1}`;

            if ($(this).find(".product-unit-select").val()) {
                title += ` - <span class="border badge bg-primary-subtle text-primary">${unitName}</span>`;
            }

            $(this).find(".product-unit-title").html(title);
        });
    },

    refreshSortOrder() {
        $("#productUnitWrapper .product-unit-item").each(function (index) {
            $(this)
                .find(".sort-order")
                .val(index + 1);
        });
    },

    refreshDeleteButton() {
        const total = $(".product-unit-item").length;

        if (total === 1) {
            $(".btnRemoveUnit").hide();
        } else {
            $(".btnRemoveUnit").show();
        }
    },

    refreshUnitOptions() {
        const selected = [];

        $(".product-unit-select").each(function () {
            const value = $(this).val();

            if (value) {
                selected.push(value);
            }
        });

        $(".product-unit-select").each(function () {
            const current = $(this).val();

            $(this)
                .find("option")
                .each(function () {
                    const value = $(this).val();

                    if (value === "") {
                        $(this).prop("hidden", false);
                        return;
                    }

                    // option milik dirinya sendiri tetap tampil
                    if (value === current) {
                        $(this).prop("hidden", false);
                    } else {
                        $(this).prop("hidden", selected.includes(value));
                    }
                });
        });

        this.toggleAddButton();
    },

    changeBaseUnit(e) {
        $(".is-base").not(e.currentTarget).prop("checked", false);

        $(".conversion").prop("readonly", false);

        const card = $(e.currentTarget).closest(".product-unit-item");

        if ($(e.currentTarget).is(":checked")) {
            card.find(".conversion").val(1).prop("readonly", true);
        }
    },

    changeDefaultPurchase(e) {
        $(".default-purchase").not(e.currentTarget).prop("checked", false);
    },

    changeDefaultSale(e) {
        $(".default-sale").not(e.currentTarget).prop("checked", false);
    },

    toggleAddButton() {
        const totalUnit = parseInt($("#btnAddUnit").data("total-unit"));

        const usedUnit = new Set();

        $(".product-unit-select").each(function () {
            if ($(this).val()) {
                usedUnit.add($(this).val());
            }
        });

        $("#btnAddUnit").prop("disabled", usedUnit.size >= totalUnit);
    },
};
