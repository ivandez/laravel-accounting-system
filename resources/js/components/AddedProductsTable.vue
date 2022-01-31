<template>
    <table class="table striped">
        <thead>
        <tr>
            <th scope="col">NOMBRE</th>
            <th scope="col">CANTIDAD</th>
            <th scope="col">OPCIONES</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="element in data" :key="element.id">
            <td>{{ element.name}}</td>
            <td>{{ element.quantity}}</td>
            <td><button type="button" class="btn btn-danger" v-on:click="sendProducId(element.id)">Eliminar</button></td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "AddedProductsTable",
    props: {
        data: [],
    },
    methods: {
        sendProducId(id){
            this.$emit('listenChild' ,id)
        }
    }
}
</script>
