<template>
    <div>
        <input type="text" id="title" v-model="title">
        <ul>
            <li v-for="ingredient in ingredients">{{ingredient.amount}} {{ingredient.ingredient}}</li>
        </ul>
        <input input type="text" id="ingredient" v-model="newAmount">
        <input type="text" id="ingredient" v-model="newIngredient">
        <button @click="addIngredient">+</button>
        <div>
            <p v-for="instruction in instructions" v-text="instruction"></p>
            <textarea v-model="newInstruction"></textarea>
            <button @click="addInstruction">+</button>
        </div>
        <button @click="saveRecipe">Save</button>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                ingredients: [],
                title: '',
                newAmount: '',
                newIngredient: '',
                instructions: [],
                newInstruction: ''
            }
        },
        methods: {
            addIngredient() {
                this.ingredients.push({
                    amount: this.newAmount,
                    ingredient: this.newIngredient
                });
                this.newAmount = '';
                this.newIngredient = '';
            },
            addInstruction() {
                this.instructions.push(this.newInstruction);
                this.newInstruction = '';
            },
            saveRecipe() {
                axios.post('/recipes', {
                    title: this.title,
                    ingredients: this.ingredients,
                    instructions: this.instructions
                })
                .then(function (response) {
                  console.log(response);
                })
            }
        }
    }
</script>