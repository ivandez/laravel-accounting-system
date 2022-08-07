<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="validationTooltip04">Tag</label>
                <select class="custom-select" id="tags" v-model="tagId">
                    <option
                        v-for="tag in tags"
                        :key="tag.id"
                        v-bind:value="tag.id"
                    >
                        {{ tag.name }}
                    </option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationTooltip05">Opción</label>
                <button
                    type="button"
                    class="btn btn-primary form-control"
                    v-on:click="addTag"
                >
                    Agregar
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nombre del tag</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="tag in form.tags" :key="tag.id">
                            <th scope="row">{{ tag.name }}</th>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    v-on:click="handleRemove(tag.id)"
                                >
                                    ELIMINAR
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            tags: [],
            tagId: null,
            form: {
                tags: [],
                orden: "asc",
            },
        };
    },
    methods: {
        addTag() {
            if (this.tagId === null) {
                return;
            }
            const tag = this.tags.find((tag) => tag.id == this.tagId);

            const alreadyExists = this.form.tags.find(
                (formTag) => formTag.id == tag.id
            );
            if (alreadyExists) {
                return;
            }
            this.form.tags.push(tag);
        },
        handleRemove(id) {
            const filteredTags = this.form.tags.filter((tag) => tag.id !== id);
            this.form.tags = [...filteredTags];
        },
        async getTags() {
            axios.defaults.baseURL = "http://localhost/api/";

            try {
                let response = await axios.get("tags");
                this.tags = [...response.data];
            } catch (e) {
                console.error(e);
            }
        },
        async submitData() {
            axios.defaults.baseURL = "http://localhost/api/";

            try {
                const res = await axios.post(
                    "reporte-productos",
                    {
                        orden: "desc",
                        tags: [2],
                    }
                    // {
                    //     responseType: "arraybuffer",
                    // }
                );
                console.log(
                    "🚀 ~ file: AddProducts.vue ~ line 301 ~ submitData ~ res",
                    res
                );

                // const url = window.URL.createObjectURL(new Blob([res.data]));
                // const a = document.createElement("a");
                // a.href = url;
                // const filename = `file.xlsx`;
                // a.setAttribute("download", filename);
                // document.body.appendChild(a);
                // a.click();
                // a.remove();
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
    },
    async mounted() {
        await this.getTags();
    },
};
</script>
