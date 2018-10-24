<template>
    <section>
        <div class="col-md-4 col-sm-6" v-for="(oneNote, i) in allNotes" :key="oneNote.i">
            <div v-if="oneNote.text.includes(searchKey)" class="single-note" v-bind:class="[oneNote.color]">
                <span @click="finishTask(i)" class="notDone"><i :class="{far: !oneNote.completed, fas: oneNote.completed}" class="fa-check-square"></i></span>
                <input v-if="edit && editId == i" type="text" autofocus="true" placeholder="Type a title ..." v-model="oneNote.title">
                <h2 :class="{isDone: oneNote.completed}" v-else>{{oneNote.title}}</h2>
                <small>Last update: {{oneNote.date}}</small>
                <hr>
                <textarea v-if="edit && editId == i" placeholder="Type a description ..." v-model="oneNote.text"></textarea>
                <p v-else :class="{expand: idToExpand == i, isDone: oneNote.completed}" v-html="modifiedText(i)"></p>
                <div class="meta">
                    <span v-if="edit && editId == i" @click="updateNote(i, oneNote)"><i class="fas fa-check"></i></span>
                    <span v-else @click=editNote(i)><i class="fas fa-pencil-alt"></i></span>
                    <span @click="toggleTransition(i)"><i class="fas fa-palette"></i></span>
                    <span @click="deleteNote(i)"><i class="far fa-trash-alt"></i></span>
                    <span v-if="oneNote.long" @click="expandNote(i)"><i class="fas fa-expand"></i></span>
                    <span @click="copyLink(i)"><i class="fas fa-link"></i></span>
                </div>
                <div class="colors" :class="{openDivs: currentID == i}">
                    <div @click="changeColor(i, 'blue')" class="circle blue" :class="{selected: oneNote.color == 'blue'}"></div>
                    <div @click="changeColor(i, 'yellow')" class="circle yellow" :class="{selected: oneNote.color == 'yellow'}"></div>
                    <div @click="changeColor(i, 'red')" class="circle red" :class="{selected: oneNote.color == 'red'}"></div>
                    <div @click="changeColor(i, 'purple')" class="circle purple" :class="{selected: oneNote.color == 'purple'}"></div>
                    <div @click="changeColor(i, 'white')" class="circle whiteCircle" :class="{selected: oneNote.color == 'white'}"></div>
                </div>
                <div class="copied" :class="{openDivs: idToCopy == i}">
                    link is copied !
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    module.exports = {
        props: ['allNotes'],
        data: function() {
            return {
                // Search Key
                searchKey: this.getParam('s'),
                // Temporary IDs
                currentID: -2,
                editId: -1,
                idToCopy: -1,

                // Transitions
                opened: false,

                // Confirm Delete
                confrim: '',
                
                // Edit Mode
                edit: false,
                
                // Expand
                idToExpand: -1,
                expanded: false,
            }
        },
        methods: {
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
            modifiedText: function(id) {
                // Detect Links
                var detectLinks = /((https?:\/\/)(\S+))/g;
                var detectLinksWWW = /(((www\.))(\S+))/g;

                /*
                    Ends with ".com" => /(\S+)\.com/g
                */

                // Detect Hashtags
                var detecthash = /#(\S+)/g;

                if (this.allNotes[id].text.match(detectLinks) || this.allNotes[id].text.match(detecthash)) {
                    return this.allNotes[id].text.replace(detectLinks, '<a href="$1" target="_black">$1</a>').replace(detectLinksWWW, '<a href="http://$1" target="_black">$1</a>').replace(detecthash, '<a href=?s=$1>#$1</a>');
                } else {
                    return this.allNotes[id].text;
                }

            },
            copyLink: function(id) {
                var copiedNote = this.allNotes[id];

                var theNote = JSON.stringify(copiedNote);
                theNote = encodeURIComponent(theNote);
                
                var theLink = location.href.replace('index.html', '').replace(location.search, '') + 'share.html?note=' + theNote;
                this.idToCopy = id;

                setTimeout(function(){
                    this.idToCopy = -1;
                }.bind(this), 1200);

                function copyToClipboard(text){
                    var dummy = document.createElement("input");
                    document.body.appendChild(dummy);
                    dummy.setAttribute('value', text);
                    dummy.select();
                    document.execCommand("copy");
                    document.body.removeChild(dummy);
                }

                //alert(theLink);
                copyToClipboard(theLink);
            },

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
            // Note Processes
            deleteNote: function(id) {
                this.confirm = confirm("Are You Sure You Want To Delete It ?");
                if (this.confirm) {
                    this.allNotes.splice(id, 1);
                    this.todoSave(this.allNotes);
                }
            },
            changeColor: function(id, color) {
                this.allNotes[id].color = color;
                this.todoSave(this.allNotes);
                this.currentID = -2;
                this.opened = false;
            },
            editNote: function(i) {
                this.edit = true;
                this.editId = i;
            },
            updateNote: function(id, note) {
                note.date = this.noteDate;
                if (note.text.length > 106) {
                    note.long = true;
                } else {
                    note.long = false;
                }
                this.allNotes[id] = note;
                this.todoSave(this.allNotes);
                this.editId = -1;
                this.edit = false;
            },
            expandNote: function(id) {
                if (this.expanded == false) {
                    this.idToExpand = id;
                    this.expanded = true;
                } else {
                    this.expanded = false;
                    this.idToExpand = -1;
                }
            },
            finishTask: function(id) {
                if (this.allNotes[id].completed == false) {
                    this.allNotes[id].completed = true;
                } else {
                    this.allNotes[id].completed = false;
                }
                this.todoSave(this.allNotes);
            },
            // Define a function to get link parameter
            getParam: function (query) {
                var param = {};
                var link = window.location.search;
                link = link.replace('?', '');
                var divide = link.split('&').forEach(function(variable){
                var half = variable.split('=');
                param[half[0]] = half[1];
                });
                
                if (param[query]) {
                    return param[query];
                } else {
                    return '';
                }
            }
        }
    }
</script>
