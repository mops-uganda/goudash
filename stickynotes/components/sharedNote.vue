<template>
    <div class="col-md-offset-4 col-sm-offset-2 col-md-4 col-sm-8">
        <div class="single-note shared" :class="[sharedNote.color]">
            <h2>{{sharedNote.title}}</h2>
            <small>The Date: {{sharedNote.date}}</small>
            <hr>
            <p v-html="sharedNote.text"></p>
        </div>
    </div>
</template>

<script>
module.exports = {
    computed: {
        sharedNote: function() {
            // Detect Links
            var detectLinks = /((https?:\/\/)(\S+))/g;
            var detectLinksWWW = /(((www\.))(\S+))/g;

            if (this.getParam('note')) {
                var shared = JSON.parse(decodeURIComponent(this.getParam('note')));
                shared.text = shared.text.replace(detectLinks, '<a href="$1" target="_black">$1</a>').replace(detectLinksWWW, '<a href="http://$1" target="_black">$1</a>');
                return shared;
            } else {
                window.location.href = 'index.html';
            }
        }
    },
    methods: {
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
