import "./bootstrap";

import Alpine from "alpinejs";
// product
import Product from "../js/owner/product";

window.Alpine = Alpine;

Alpine.data("productForm", Product);

Alpine.start();
