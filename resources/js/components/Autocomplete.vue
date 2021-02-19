<template>
    <div class="autocomplete">
        <form @submit.prevent>
            <label :for="id">{{ label }}</label>
            <div class="autocomplete-input">
                <input autocomplete="off" class="form-control" :id="id" type="text" v-model="displayValue" 
                    @input="onChange"
                    @keydown.down="onArrowDown" 
                    @keydown.up="onArrowUp" 
                    @keydown.enter="onEnter" 
                    :placeholder="placeholder"
                    />
                <span class="clear-input oi oi-md"  data-glyph="circle-x" title="icon name" aria-hidden="true" @click="onClearInput"></span>
            </div>
            <div class="position-relative">
                <ul v-show="isOpen" class="autocomplete-results list-group">
                    <li
                        v-for="(value, i) in values"
                        :key="i" 
                        @click="onClick(value)"
                        class="list-group-item"
                        :class="{ 'active': i === arrowCounter }"
                    >{{ value.name }}</li>
                </ul>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        items: {
            type: Array,
            required: false,
            default: function() { return []; }
        },
        label: {
            type: String,
            required: false
        },
        id: {
            type: String,
            required: true
        },
        isAsync : {
            type: Boolean,
            required: false,
            default: false
        },
        placeholder: {
            type: String,
            required: false,
        }
    },
    data() {
        return {
            displayValue: '',
            values: [],
            isOpen: false,
            isLoading: false,
            arrowCounter: -1,
        }
    },
    methods: {
        onChange() {
            if (this.isAsync) {
                this.isLoading = true;
            } else {
                this.filterResults();
                this.isOpen = true;
            }

            this.$emit('change', this.displayValue);
        },
        dispatchValue(value) {
            this.isOpen = false;
            this.arrowCounter = -1;
            this.$emit('selected', value);
        },
        filterResults() {
            this.values = this.items.filter(function(item) {
                return item.toLowerCase().indexOf(this.search.toLowerCase()) > -1; 
            });
        },
        onArrowDown() {
            this.arrowCounter++;
            this.arrowCounter = Math.min(this.arrowCounter, this.values.length);
        },
        onArrowUp() {
            this.arrowCounter--
            this.arrowCounter = Math.max(this.arrowCounter, 0);
        },
        onClick(value) {
            this.displayValue = value.name;
            this.dispatchValue(value.id);
        },
        onEnter() {
            this.displayValue = this.values[this.arrowCounter].name;
            let value = this.values[this.arrowCounter].id;
            this.dispatchValue(value);   
        },
        onClearInput() {
            this.displayValue = '',
            this.isOpen = false;
        }
    },
    watch: {
        items: function (values) {
            if (this.isAsync) {
                this.values = values;
                this.isOpen = true;
                this.isLoading = false;
            }
        }
    }
};
</script>