<template>
    <div>
        <div class="col-md-4 col-sm-6">
            <div class="single-note add-note" v-bind:class="[newNote.color]">
                <input type="text" placeholder="Type a title ..." v-model="noteTitle">
                <small>Today: {{ todayDate }}</small>
                <hr>
                <textarea placeholder="Type a description ..." v-model="noteText"></textarea>
                <div class="meta">
                    <span @click="toggleTransition(-1)"><i class="fas fa-palette"></i></span>
                    <span @click="insertNote"><i class="fas fa-check"></i></span>
                </div>
                <div class="colors" :class="{openDivs: currentID == -1}">
                    <div @click="noteColor = 'blue'" class="circle blue" :class="{selected: newNote.color == 'blue'}"></div>
                    <div @click="noteColor = 'yellow'" class="circle yellow" :class="{selected: newNote.color == 'yellow'}"></div>
                    <div @click="noteColor = 'red'" class="circle red" :class="{selected: newNote.color == 'red'}"></div>
                    <div @click="noteColor = 'purple'" class="circle purple" :class="{selected: newNote.color == 'purple'}"></div>
                    <div @click="noteColor = 'white'" class="circle whiteCircle" :class="{selected: newNote.color == 'white'}"></div>
                </div>
            </div>
        </div>
        
        <!--Start The Loop-->
        <single-note :all-notes="theNotes"></single-note>
    </div>
</template>

<script>

module.exports = {
    components: {
        'single-note': httpVueLoader('stickynotes/components/singleNote.vue')
    },
    data: function () {
        return {
            theNotes: this.todoFetch(),
            // The Note Props
            noteTitle: '',
            noteColor: 'white',
            noteText: '',

            // Transitions
            opened: false,

            // Temporary IDs
            currentID: -2,
            editId: -1,
            idToCopy: -1,
        }
    },
    computed: {
        // Define The Date
        todayDate: function() {
            var d = new Date();
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var today = d.getDate() + ' ' + months[d.getMonth()] + ', ' + d.getFullYear();

            return today;
        },

        // Check if the note is longer than 106 letters
        longNote: function() {
            if (this.noteText.length > 106) {
                return true;
            } else {
                return false;
            }
        },

        // Collect Note Data
        newNote: function() {
            return {
                id: (this.theNotes.length+1),
                title: this.noteTitle,
                date: this.todayDate,
                text: this.noteText,
                color: this.noteColor,
                long: this.longNote,
                completed: false
            }
        }
    },
    methods: {
        // Toggle The Effect
        toggleTransition: function(id) {
            if (id >= 0) {
                this.currentID = id;
            } else if (id == -1) {
                this.currentID = -1;
            }

            if (this.opened == false) {
                this.opened = true;
            } else {
                this.currentID = -2;
                this.opened = false;
            }
        },
        // To-Do Storage
        todoFetch: function () {
            var notes = JSON.parse(localStorage.getItem('notes') || '[]');
            //console.log(notes);
            return notes;
        },
        todoSave: function(notes) {
            //console.log(JSON.stringify(notes));
            localStorage.setItem('notes', JSON.stringify(notes));
        },
        insertNote: function () {
            if (this.noteTitle !== '' && this.noteText !== '') {
                this.theNotes.push(this.newNote);
                this.todoSave(this.theNotes);

                // Remove!
                this.noteTitle = '';
                this.noteText = '';
                this.noteColor = '#fff';
            }
        }
    }
}
</script>

