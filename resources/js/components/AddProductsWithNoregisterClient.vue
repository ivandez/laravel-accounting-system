<template>
    <div class="container">
        <div class="row my-3" v-if="noStock">
            <div class="alert alert-danger" role="alert">
                <ul>
                    <li>{{ noStock }}</li>
                </ul>
            </div>
        </div>

        <div class="row my-3" v-if="showErrorAlert">
            <div class="col">
                <alert :errors="errors" />
            </div>
        </div>

        <div class="d-grid gap-3">
            <!--    SELECT PRODUCTS TO ADD-->
            <div class="row my-3">
                <label for="date" class="form-label">Productos: </label>
                <div class="col">
                    <select
                        class="form-select"
                        aria-label="Default select example"
                        v-model="productId"
                    >
                        <option
                            v-for="product in products"
                            :key="product.id"
                            v-bind:value="product.id"
                        >
                            {{
                                product.name +
                                " (Cantidad disponible: " +
                                product.quantity +
                                ")"
                            }}
                        </option>
                    </select>
                </div>
                <div class="col">
                    <!--                    //TODO: validar que no pueda introducr el zero-->
                    <input
                        type="number"
                        class="form-control"
                        min="1"
                        value="form.quantity"
                        v-model="quantity"
                    />
                </div>
                <div class="col">
                    <button
                        type="button"
                        class="btn btn-primary"
                        v-on:click="addProduct"
                    >
                        Agregar
                    </button>
                </div>
            </div>

            <!--        ADDED PRODUCTS TABLE-->
            <div class="row">
                <div class="col">
                    <added-products-table
                        :data="form.productos"
                        :total="total"
                        @listenChild="handleRemove"
                    ></added-products-table>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="client" class="form-label">Cliente: </label>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputName">Nombres</label>
                    <input
                        required
                        type="text"
                        class="form-control"
                        id="exampleInputName"
                        aria-describedby="nameHelp"
                        name="nombres"
                        v-model="form.nombre_cliente"
                    />
                </div>

                <div class="form-group mb-3">
                    <label for="apellidos">Apellidos (opcional):</label>
                    <input
                        type="text"
                        class="form-control"
                        id="apellidos"
                        aria-describedby="nameHelp"
                        name="apellidos"
                        v-model="form.apellido_cliente"
                    />
                </div>

                <div class="form-group mb-3">
                    <label for="exampleInputPhoneNumber"
                        >Número de teléfono (opcional)</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        id="exampleInputPhoneNumber"
                        name="telefono"
                        v-model="form.telefono_cliente"
                    />
                </div>

                <div class="form-group mb-3">
                    <label for="apellidos">Documento (opcional):</label>
                    <div class="row">
                        <div class="col">
                            <select
                                class="form-select"
                                aria-label="Default select example"
                                name="tipo_de_documento"
                                v-model="form.tipo_documento_cliente"
                            >
                                <option value="1">V-</option>
                                <option value="2">J-</option>
                            </select>
                        </div>
                        <div class="col">
                            <input
                                type="number"
                                min="1"
                                class="form-control"
                                placeholder="Ejemplo: 999999999"
                                name="documento"
                                id="documento"
                                v-model="form.cedula_cliente"
                            />
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"
                        >Comentario (opcional):</label
                    >
                    <textarea
                        class="form-control"
                        id="exampleFormControlTextarea1"
                        rows="3"
                        name="comentario"
                        v-model="form.comentario_cliente"
                    ></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="date" class="form-label">Fecha: </label>
                    <input
                        id="date"
                        class="form-select"
                        type="date"
                        v-model="form.fecha"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-check">
                        <input
                            checked
                            class="form-check-input"
                            type="radio"
                            value="1"
                            id="flexRadioDefault1"
                            v-model="form.pagado"
                        />
                        <label class="form-check-label" for="flexRadioDefault1">
                            Pagado
                        </label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="radio"
                            value="0"
                            id="flexRadioDefault2"
                            v-model="form.pagado"
                        />
                        <label class="form-check-label" for="flexRadioDefault2">
                            Por pagar
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="metodo_de_pago" class="form-label"
                        >Método de pago:
                    </label>
                    <select
                        id="metodo_de_pago"
                        class="form-select"
                        v-model="form.metodo_de_pago"
                    >
                        <option
                            v-for="paymentMethod in paymentMethods"
                            :key="paymentMethod.id"
                            v-bind:value="paymentMethod.id"
                        >
                            {{ paymentMethod.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="comentario" class="form-label"
                        >Comentario</label
                    >
                    <textarea
                        class="form-control"
                        id="comentario"
                        rows="3"
                        v-model="form.comentario"
                    ></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button
                        type="button"
                        class="btn btn-primary"
                        v-on:click="submitData"
                    >
                        Crear Venta
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

import { checkIfIdExists } from "../helpers/checkIfIdExists";

import AddedProductsTable from "./AddedProductsTable.vue";

import Alert from "./Alert.vue";

export default {
    name: "AddProducts",
    components: {
        AddedProductsTable,
        Alert,
    },
    data: function () {
        return {
            // These are the product fetched from API
            products: [{}],
            // This is the product ID selected in form
            productId: 0,
            quantity: 1,
            // This is the data of the product
            clients: [],
            paymentMethods: null,
            errors: null,
            showErrorAlert: false,
            noStock: null,
            form: {
                // These are the products added to the Sale
                productos: [],
                comentario: null,
                pagado: null,
                fecha: null,
                metodo_de_pago: null,
                nombre_cliente: null,
                apellido_cliente: null,
                telefono_cliente: null,
                tipo_documento_cliente: 1,
                cedula_cliente: null,
                comentario_cliente: null,
            },
            total: 0,
        };
    },
    methods: {
        async getProducts() {
            axios.defaults.baseURL = "http://localhost/api/";

            try {
                let response = await axios.get("products");
                console.log(response);
                this.products = [...response.data];

                return response;
            } catch (e) {
                console.error(e);
            }
        },
        async getClients() {
            axios.defaults.baseURL = "http://localhost/api/";

            try {
                let response = await axios.get("clients");
                this.clients = [...response.data];
            } catch (e) {
                console.error(e);
            }
        },
        async getPaymentMethods() {
            axios.defaults.baseURL = "http://localhost/api/";

            try {
                let response = await axios.get("payment-methods");

                this.paymentMethods = [...response.data];
            } catch (e) {
                console.error(e);
            }
        },
        addProduct() {
            const product = this.products.find(
                (product) => product.id == this.productId
            );

            if (this.productId === 0 || this.quantity == 0) {
                return;
            }

            if (checkIfIdExists(this.productId, this.form.productos)) {
                console.log("el producto ya existe");
                return;
            }

            const newProduct = {
                id: product.id,
                name: product.name,
                quantity: this.quantity,
                product_price: product.unit_price,
            };
            // crear la logica aqui
            this.form.productos.push(newProduct);

            this.sumTotal(newProduct);
        },
        handleRemove(id) {
            const filteredProducts = this.form.productos.filter(
                (product) => product.id !== id
            );
            const theFuckingProduct = this.form.productos.find(
                (product) => product.id == id
            );
            this.form.productos = [...filteredProducts];
            this.restaTotal(theFuckingProduct);
        },
        async submitData() {
            axios.defaults.baseURL = "http://localhost/api/";
            console.log(this.form);
            try {
                const rest = await axios.post(
                    "sales/store-no-client",
                    this.form
                );

                this.showErrorAlert = false;

                window.alert("Venta creada exitosamente");

                window.location.href = "http://localhost/ventas";
            } catch (e) {
                if (e.response.data === "no stock") {
                    // fking shit not work
                    this.showErrorAlert = false;
                    this.noStock = "Uno o más productos no tienen stock";
                } else {
                    this.noStock = null;
                    this.errors = Object.values(e.response.data.errors);
                    this.showErrorAlert = true;
                }
            }
        },
        getActualDate() {
            let today = new Date();

            let actualDate =
                today.getFullYear() +
                "-" +
                (today.getMonth() + 1) +
                "-" +
                today.getDate();

            return actualDate;
        },
        sumTotal(newProduct) {
            this.total +=
                Number(newProduct.product_price) * newProduct.quantity;
        },
        restaTotal(theFuckingProduct) {
            this.total -=
                Number(theFuckingProduct.product_price) *
                theFuckingProduct.quantity;
        },
    },
    async mounted() {
        await this.getProducts().then((response) => {
            if (response.data.length == 0) {
                window.alert(
                    "No hay productos en el inventario, por favor agrega un producto"
                );

                window.location.href = "http://localhost/productos";
            }
        });
        await this.getClients();
        await this.getPaymentMethods();
        this.form.fecha = this.getActualDate();
    },
};
</script>
