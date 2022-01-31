<template>
    <div class="alert alert-danger" role="alert">
<!--        this fking shit doesnt return json response fck!!!!1-->
        <ul v-for="error in errors">
            <li v-for="msg in error">{{ msg }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "Alert",
    props: {
        errors: []
    }
}
</script>
