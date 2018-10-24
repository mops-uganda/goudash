// Use Strict Mode
"use strict";

(function stickyNotes() {

    /*
    ---------------------------
        Functions
    ---------------------------
    */

    // Define a function to get link parameter
    function getParam(query) {
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

    // Vue Instances
    var header = new Vue({
        el: '#header',
        data: {
            isHashtag: getParam('s')
        }
    });


    var addNote = new Vue({
        el: '#notes',
        components: {
            'sticky-notes': httpVueLoader('stickynotes/components/multiNotes.vue'),
            'shared-note': httpVueLoader('stickynotes/components/sharedNote.vue')
        }
    });    

})();
