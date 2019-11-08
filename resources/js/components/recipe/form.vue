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
                <button v-if="!showDetails" @click="show">></button>
                <input input type="text" class="form-control" id="ingredient" v-model="newAmount" v-if="showDetails" :placeholder="placeholders.amount">
                <select class="form-control" v-model="newUnit" v-if="showDetails">
                    <option value="" disabled selected>Unit</option>
                    <option v-for="unit in units" :value="unit" v-text="unit"></option>
                </select>
                <input type="text" class="form-control" id="ingredient" v-model="newIngredient" :placeholder="placeholders.ingredient">
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
                update: false,
                showDetails: false,
                placeholders: {
                    amount: 'Amount',
                    ingredient: '1/4 cup water of earth'
                }
            }
        },
        methods: {
            addIngredient() {
                console.log(this.newUnit);
                if (this.newAmount === '') {
                    let explode = this.newIngredient.split(' ');
                    this.newAmount = explode.splice(0,1)[0];

                    //figure out units
                    console.log(explode[0]);
                    console.log(!this.units.includes(explode[0]));
                    if (!this.units.includes(explode[0])) {
                        switch (explode[0]) {
                            case 'cup':
                            case 'cups':
                                explode[0] = 'cup(s)'
                            break;
                            case 'lb':
                            case 'lbs':
                                explode[0] = 'lb(s)'
                            break;
                            default:
                                this.units.push(explode[0])
                            break;
                        }
                        console.log(explode);
                    }
                    this.newUnit = explode.splice(0,1)[0];
                    this.newIngredient = explode.join(' ');
                }
                if (this.newUnit === '') {
                    this.newUnit = 'whole';
                }
                console.log(this.newUnit);
                this.ingredients.push({
                    amount: {
                        quantity: this.newAmount,
                        unit: this.newUnit
                    },
                    ingredient: this.newIngredient
                });
                this.newAmount = '';
                this.newUnit = '';
                this.newIngredient = '';
            },
            addInstruction() {
                this.instructions.push(this.newInstruction);
                this.newInstruction = '';
            },
            saveRecipe() {
                //make sure there isn't a hanging ingredient
                if (this.newIngredient !== '') {
                    this.addIngredient();
                }
                //make sure there isn't a hanging instruction
                if (this.newInstruction !== '') {
                    this.addInstruction();
                }
                if (this.update) {
                    axios.put('/recipes/'+this.recipe.slug, {
                        name: this.name,
                        ingredients: this.ingredients,
                        instructions: this.instructions
                    })
                    .then((response) => {
                      console.log(response);
                    })
                } else {
                    axios.post('/recipes', {
                        name: this.name,
                        ingredients: this.ingredients,
                        instructions: this.instructions
                    })
                    .then((response) => {
                      console.log(response);
                      console.log('t');
                      this.update = true;
                      window.location.href = '/recipes/' /*+ response.slug*/;
                    })
                }
            },
            show() {
                this.showDetails = true;
                this.placeholders.ingredient = 'Ingredient';
            }
        }
    }
</script>