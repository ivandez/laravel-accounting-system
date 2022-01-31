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
                <alert :errors="errors"/>
            </div>
        </div>

        <div class="d-grid gap-3">

            <div class="row mt-3">
                <div class="col">
                    <label for="amount" class="form-label">Monto: </label>
                    <input type="number" class="form-control" min="1" value="form.monto" v-model="form.monto">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="client" class="form-label">Proveedor (opcional): </label>

                    <select id="client" class="form-select" v-model="form.providerId">
                        <option v-for="provider in providers" :key="provider.id" v-bind:value=provider.id>{{
                                provider.first_name + provider.last_name
                            }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="date" class="form-label">Fecha: </label>
                    <input id="date" class="form-select" type="date" v-model="form.fecha">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-check">
                        <input checked class="form-check-input" type="radio" value="1" id="flexRadioDefault1"
                               v-model="form.pagado">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Pagado
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" id="flexRadioDefault2"
                               v-model="form.pagado">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Por pagar
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="metodo_de_pago" class="form-label">Método de pago: </label>
                    <select id="metodo_de_pago" class="form-select" v-model="form.metodo_de_pago">
                        <option v-for="paymentMethod in paymentMethods" :key="paymentMethod.id"
                                v-bind:value=paymentMethod.id>
                            {{
                                paymentMethod.name
                            }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="comentario" class="form-label">Comentario</label>
                    <textarea class="form-control" id="comentario" rows="3" v-model="form.comentario"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" v-on:click="submitData">Crear Gasto</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

import axios from 'axios'

import {checkIfIdExists} from "../helpers/checkIfIdExists";

import AddedProductsTable from './AddedProductsTable.vue'

import Alert from './Alert.vue'

export default {
    name: "ExpenseCreate",
    components: {
        AddedProductsTable,
        Alert
    },
    data: function () {
        return {
            providers: [],
            paymentMethods: null,
            errors: null,
            showErrorAlert: false,
            noStock: null,
            form: {
                providerId: null,
                comentario: null,
                pagado: null,
                fecha: null,
                monto: null,
                metodo_de_pago: null,
            }
        }
    },
    methods: {
        async getProviders() {
            axios.defaults.baseURL = 'http://localhost/api/';

            try {
                let response = await axios.get('providers');

                this.providers = [...response.data]
            } catch (e) {
                console.error(e)
            }
        },
        async getPaymentMethods() {
            axios.defaults.baseURL = 'http://localhost/api/';

            try {
                let response = await axios.get('payment-methods');

                this.paymentMethods = [...response.data]
            } catch (e) {
                console.error(e)
            }
        },
        async submitData() {
            axios.defaults.baseURL = 'http://localhost/api/';
            console.log(this.form)
            try {
                await axios.post('expenses/store', this.form);

                this.showErrorAlert = false

                window.alert('Gasto creado exitosamente');

                window.location.href = 'http://localhost/gastos';
            } catch (e) {

                if (e.response.data === 'no stock') {
                    // fking shit not work
                    this.showErrorAlert = false
                    this.noStock = 'Uno o más productos no tienen stock'
                } else {
                    this.noStock = null
                    this.errors = Object.values(e.response.data.errors)
                    this.showErrorAlert = true
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
    },
    async mounted() {
        await this.getProviders()
        await this.getPaymentMethods()
        this.form.fecha = this.getActualDate()
    }
}
</script>
