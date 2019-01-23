<template>
    <div class="col">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" v-model="name">
        </div>
        <div class="form-group ">
            <label>Ingredients</label>
            <div class="form-inline" v-for="ingredient in ingredients">
                <input type="text" class="form-control" :value="ingredient.amount.quantity">
                <select class="form-control">
                    <option v-for="unit in units" :value="unit" v-text="unit" :selected="unit === ingredient.amount.unit"></option>
                </select>
                <input type="text" class="form-control" :value="ingredient.ingredient">
            </div>
            <div class="form-inline">
                <input input type="text" class="form-control" id="ingredient" v-model="newAmount">
                <select class="form-control" v-model="newUnit">
                    <option v-for="unit in units" :value="unit" v-text="unit"></option>
                </select>
                <input type="text" class="form-control" id="ingredient" v-model="newIngredient">
            </div>
            <button class="col-sm btn btn-secondary" @click="addIngredient">+</button>
        </div>
        <div>
            <label>Instructions</label>
            <textarea class="form-control" v-for="instruction in instructions" v-text="instruction"></textarea>
            <div>
                <textarea class="form-control" v-model="newInstruction"></textarea>
                <button class="col-sm btn btn-secondary" @click="addInstruction">+</button>
            </div>
        </div>
        <button class="btn btn-primary" @click="saveRecipe">Save</button>
    </div>
</template>
<script>
    import { VueNestable, VueNestableHandle } from 'vue-nestable';

    export default {
        components: {
            VueNestable,
            VueNestableHandle
        },
        data() {
            return {
                units: ['oz', 'tsp', 'tbsp', 'cup(s)'],
                ingredients: [],
                name: '',
                newAmount: '',
                newUnit: '',
                newIngredient: '',
                instructions: [],
                newInstruction: ''
            }
        },
        methods: {
            addIngredient() {
                this.ingredients.push({
                    amount: {
                        quantity: this.newAmount,
                        unit: this.newUnit
                    },
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
                    name: this.name,
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