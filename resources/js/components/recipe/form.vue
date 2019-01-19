<template>
    <div>
        <input type="text" id="title" v-modal="title">
        <ul>
            <li v-for="ingredient in ingredients" v-text="ingredient"></li>
        </ul>
        <input type="text" id="ingredient" v-model="newIngredient"><button @click="addIngredient">+</button>

    </div>
</template>
<script>
    export default {
        data() {
            return {
                ingredients: [],
                title: '',
                newIngredient: ''
            }
        },
        methods: {
            addIngredient() {
                this.ingredients.push(this.newIngredient);
                this.newIngredient = '';
            }
        }
    }
</script>