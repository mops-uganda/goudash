<div id="shopping-list">
    <div class="header">
        <h1>{{ header.toLocaleUpperCase() }}</h1>
        <button v-if="state === 'default'" class="btn btn-primary" @click="changeState('edit')">Add Item</button>
        <button v-else class="btn btn-cancel" @click="changeState('default')">Cancel Adding Item</button>
    </div>
    <div v-if="state === 'edit'" class="add-item-form">
        <input v-model="newItem" type="text" placeholder="Add an item" @keyup.enter="saveItem">
        <p>{{ characterCount }} / 200</p>
        <button class="btn btn-primary" :disabled="newItem.length === 0" @click="saveItem">Save Item</button>
    </div>
    <ul>
        <li v-for="item in items" :class="{strikeout: item.purchased}" @click="togglePurchased(item)">{{ item.label }}</li>
        <li>-------------------------------</li>
        <li v-for="item in reversedItems" :class="{strikeout: item.purchased}" @click="togglePurchased(item)">{{ item.label }}</li>
    </ul>
    <p v-if="items.length === 0">Nice job! You've bought all your items.</p>
</div>
<script src="js/vue.js"></script>
<script>
    var shoppingList = new Vue({
        el: '#shopping-list',
        data: {
            state: 'default',
            header: 'shopping list app',
            newItem: '',
            items: [
                {
                    label: '10 party hats',
                    purchased: false,
                    highPriority: false,
                },
                {
                    label: '2 board games',
                    purchased: true,
                    highPriority: false,
                },
                {
                    label: '20 cups',
                    purchased: false,
                    highPriority: false,
                },
            ]
        },
        computed: {
            reversedItems() {
                return this.items.slice(0).reverse();
            },
            characterCount(){
                return this.newItem.length;
            }
        },
        methods: {
            saveItem: function() {
                this.items.push({
                    label: this.newItem,
                    purchased: false,
                });
                this.newItem = '';
            },
            changeState: function(newState) {
                this.state = newState;
                this.newItem = '';
            },
            togglePurchased: function(item) {
                item.purchased = !item.purchased;
            }
        }
    })
</script>
