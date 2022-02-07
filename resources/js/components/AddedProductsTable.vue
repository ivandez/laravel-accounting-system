<template>
    <table class="table striped">
        <caption>Monto total de la venta: ${{ this.total }}</caption>
        <thead>
        <tr>
            <th scope="col">NOMBRE</th>
            <th scope="col">CANTIDAD</th>
            <th scope="col">Precio por unidad</th>
            <th scope="col">OPCIONES</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="element in data" :key="element.id">
            <td>{{ element.name}}</td>
            <td>{{ element.quantity}}</td>
            <td>{{ element.product_price }}</td>
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
    data: function (){
        return {
            total: 0
        }
    },
    methods: {
        sendProducId(id){
            this.$emit('listenChild' ,id)
        },
        sumTotal(){

            this.data.forEach(x => {
                this.total += Number(x.product_price);
            });
        }
    },
    beforeUpdate(){
        console.log('hijo actualizado')
        this.sumTotal()
    }
}
</script>
