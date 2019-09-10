<template>
    <div class="col">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" v-model="name">
        </div>
        <div class="form-group ">
            <label>Ingredients</label>
            <div class="form-inline" v-for="(ingredient, i) in ingredients">
                <input type="text" class="form-control" v-model="ingredients[i].amount.quantity">
                <select class="form-control" v-model="ingredients[i].amount.unit">
                    <option v-for="unit in units" :value="unit" v-text="unit"></option>
                </select>
                <input type="text" class="form-control" v-model="ingredients[i].ingredient">
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
        props: {
            'recipe': {
                type: Object,
                default: {}
            }
        },
        created: function () {
            if (Object.keys(this.recipe).length !== 0) {
                //show name
                this.name = this.recipe.name;
                //show ingredients
                this.recipe.ingredients.forEach((ingredient) => {
                    this.ingredients.push({
                        amount: {
                            quantity: ingredient.amount,
                            unit: ingredient.amount_unit
                        },
                        ingredient: ingredient.food.name
                    });
                });
                //show instructions
                this.recipe.instructions.forEach((instruction) => {
                    this.instructions.push(instruction.instruction);
                });
                this.update = true;
            }
        },
        data() {
            return {
                units: ['oz', 'tsp', 'tbsp', 'cup(s)', 'lb(s)', 'whole'],
                ingredients: [],
                name: '',
                newAmount: '',
                newUnit: '',
                newIngredient: '',
                instructions: [],
                newInstruction: '',
                update: false
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
                if (this.update) {
                    axios.put('/recipes/'+this.recipe.slug, {
                        name: this.name,
                        ingredients: this.ingredients,
                        instructions: this.instructions
                    })
                    .then(function (response) {
                      console.log(response);
                    })
                } else {
                    axios.post('/recipes', {
                        name: this.name,
                        ingredients: this.ingredients,
                        instructions: this.instructions
                    })
                    .then(function (response) {
                      console.log(response);
                      this.update = true;
                    })
                }
            }
        }
    }
</script>