<?php require_once 'inc/init.php'; ?>

<div class="form-group">
    <label>Select2 Plugin (multi-select)</label>
    <select multiple style="width:100%" class="select2">
        <optgroup label="Alaskan/Hawaiian Time Zone">
            <option value="AK">Alaska</option>
            <option value="HI">Hawaii</option>
        </optgroup>
        <optgroup label="Pacific Time Zone">
            <option value="CA">California</option>
            <option value="NV" selected="selected">Nevada</option>
            <option value="OR">Oregon</option>
            <option value="WA">Washington</option>
        </optgroup>
        <optgroup label="Mountain Time Zone">
            <option value="AZ">Arizona</option>
            <option value="CO">Colorado</option>
            <option value="ID">Idaho</option>
            <option value="MT" selected="selected">Montana</option><option value="NE">Nebraska</option>
            <option value="NM">New Mexico</option>
            <option value="ND">North Dakota</option>
            <option value="UT">Utah</option>
            <option value="WY">Wyoming</option>
        </optgroup>
        <optgroup label="Central Time Zone">
            <option value="AL">Alabama</option>
            <option value="AR">Arkansas</option>
            <option value="IL">Illinois</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="OK">Oklahoma</option>
            <option value="SD">South Dakota</option>
            <option value="TX">Texas</option>
            <option value="TN">Tennessee</option>
            <option value="WI">Wisconsin</option>
        </optgroup>
        <optgroup label="Eastern Time Zone">
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="IN">Indiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI" selected="selected">Michigan</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="OH">Ohio</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WV">West Virginia</option>
        </optgroup>
    </select>

    <div class="note">
        <strong>Usage:</strong> &lt;select multiple style=&quot;width:100%&quot; class=&quot;select2&quot; &gt;...&lt;/select&gt;
    </div>
</div>

<script type="text/javascript">
    /* DO NOT REMOVE : GLOBAL FUNCTIONS!
     *
     * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
     *
     * // activate tooltips
     * $("[rel=tooltip]").tooltip();
     *
     * // activate popovers
     * $("[rel=popover]").popover();
     *
     * // activate popovers with hover states
     * $("[rel=popover-hover]").popover({ trigger: "hover" });
     *
     * // activate inline charts
     * runAllCharts();
     *
     * // setup widgets
     * setup_widgets_desktop();
     *
     * // run form elements
     * runAllForms();
     *
     ********************************
     *
     * pageSetUp() is needed whenever you load a page.
     * It initializes and checks for all basic elements of the page
     * and makes rendering easier.
     *
     */

    pageSetUp();

    /*
     * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
     * eg alert("my home function");
     *
     * var pagefunction = function() {
     *   ...
     * }
     * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
     *
     * TO LOAD A SCRIPT:
     * var pagefunction = function (){
     *  loadScript(".../plugin.js", run_after_loaded);
     * }
     *
     * OR
     *
     * loadScript(".../plugin.js", run_after_loaded);
     */

    // pagefunction

    var pagefunction = function() {

        /*
         * X-Ediable
         */

        loadScript("js/plugin/x-editable/moment.min.js", loadMockJax);

        function loadMockJax() {
            loadScript("js/plugin/x-editable/jquery.mockjax.min.js", loadXeditable);
        }

        function loadXeditable() {
            loadScript("js/plugin/x-editable/x-editable.min.js", loadTypeHead);
        }

        function loadTypeHead() {
            loadScript("js/plugin/typeahead/typeahead.min.js", loadTypeaheadjs);
        }

        function loadTypeaheadjs() {
            loadScript("js/plugin/typeahead/typeaheadjs.min.js", runXEditDemo);
        }

        function runXEditDemo() {

            (function (e) {
                "use strict";
                var t = function (e) {
                    this.init("address", e, t.defaults)
                };
                e.fn.editableutils.inherit(t, e.fn.editabletypes.abstractinput);
                e.extend(t.prototype, {
                    render: function () {
                        this.$input = this.$tpl.find("input")
                    },
                    value2html: function (t, n) {
                        if (!t) {
                            e(n).empty();
                            return
                        }
                        var r = e("<div>").text(t.city).html() + ", " + e("<div>").text(t.street).html() +
                            " st., bld. " + e("<div>").text(t.building).html();
                        e(n).html(r)
                    },
                    html2value: function (e) {
                        return null
                    },
                    value2str: function (e) {
                        var t = "";
                        if (e)
                            for (var n in e)
                                t = t + n + ":" + e[n] + ";";
                        return t
                    },
                    str2value: function (e) {
                        return e
                    },
                    value2input: function (e) {
                        if (!e)
                            return;
                        this.$input.filter('[name="city"]').val(e.city);
                        this.$input.filter('[name="street"]').val(e.street);
                        this.$input.filter('[name="building"]').val(e.building)
                    },
                    input2value: function () {
                        return {
                            city: this.$input.filter('[name="city"]').val(),
                            street: this.$input.filter('[name="street"]').val(),
                            building: this.$input.filter('[name="building"]').val()
                        }
                    },
                    activate: function () {
                        this.$input.filter('[name="city"]').focus()
                    },
                    autosubmit: function () {
                        this.$input.keydown(function (t) {
                            t.which === 13 && e(this).closest("form").submit()
                        })
                    }
                });
                t.defaults = e.extend({}, e.fn.editabletypes.abstractinput.defaults, {
                    tpl: '<div class="editable-address"><label><span>City: </span><input type="text" name="city" class="form-control"></label></div><div class="editable-address"><label><span>Street: </span><input type="text" name="street" class="form-control"></label></div><div class="editable-address"><label><span>Building: </span><input type="text" name="building" class="form-control"></label></div>',
                    inputclass: ""
                });
                e.fn.editabletypes.address = t
            })(window.jQuery);

            //ajax mocks
            $.mockjaxSettings.responseTime = 500;

            $.mockjax({
                url: '/post',
                response: function (settings) {
                    log(settings, this);
                }
            });

            $.mockjax({
                url: '/error',
                status: 400,
                statusText: 'Bad Request',
                response: function (settings) {
                    this.responseText = 'Please input correct value';
                    log(settings, this);
                }
            });

            $.mockjax({
                url: '/status',
                status: 500,
                response: function (settings) {
                    this.responseText = 'Internal Server Error';
                    log(settings, this);
                }
            });

            $.mockjax({
                url: '/groups',
                response: function (settings) {
                    this.responseText = [{
                        value: 0,
                        text: 'Guest'
                    }, {
                        value: 1,
                        text: 'Service'
                    }, {
                        value: 2,
                        text: 'Customer'
                    }, {
                        value: 3,
                        text: 'Operator'
                    }, {
                        value: 4,
                        text: 'Support'
                    }, {
                        value: 5,
                        text: 'Admin'
                    }];
                    log(settings, this);
                }
            });

            //TODO: add this div to page
            function log(settings, response) {
                var s = [],
                    str;
                s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
                for (var a in settings.data) {
                    if (settings.data[a] && typeof settings.data[a] === 'object') {
                        str = [];
                        for (var j in settings.data[a]) {
                            str.push(j + ': "' + settings.data[a][j] + '"');
                        }
                        str = '{ ' + str.join(', ') + ' }';
                    } else {
                        str = '"' + settings.data[a] + '"';
                    }
                    s.push(a + ' = ' + str);
                }
                s.push('RESPONSE: status = ' + response.status);

                if (response.responseText) {
                    if ($.isArray(response.responseText)) {
                        s.push('[');
                        $.each(response.responseText, function (i, v) {
                            s.push('{value: ' + v.value + ', text: "' + v.text + '"}');
                        });
                        s.push(']');
                    } else {
                        s.push($.trim(response.responseText));
                    }
                }
                s.push('--------------------------------------\n');
                $('#console').val(s.join('\n') + $('#console').val());
            }

            /*
             * X-EDITABLES
             */

            $('#inline').on('change', function (e) {
                if ($(this).prop('checked')) {
                    window.location.href = '?mode=inline#ajax/plugins.html';
                } else {
                    window.location.href = '?#ajax/plugins.html';
                }
            });

            if (window.location.href.indexOf("?mode=inline") > -1) {
                $('#inline').prop('checked', true);
                $.fn.editable.defaults.mode = 'inline';
            } else {
                $('#inline').prop('checked', false);
                $.fn.editable.defaults.mode = 'popup';
            }

            //defaults
            $.fn.editable.defaults.url = '/post';
            //$.fn.editable.defaults.mode = 'inline'; use this to edit inline

            //enable / disable
            $('#enable').click(function () {
                $('#user .editable').editable('toggleDisabled');
            });

            //editables
            $('#username').editable({
                url: '/post',
                type: 'text',
                pk: 1,
                name: 'username',
                title: 'Enter username'
            });

            $('#firstname').editable({
                validate: function (value) {
                    if ($.trim(value) == '')
                        return 'This field is required';
                }
            });

            $('#sex').editable({
                prepend: "not selected",
                source: [{
                    value: 1,
                    text: 'Male'
                }, {
                    value: 2,
                    text: 'Female'
                }],
                display: function (value, sourceData) {
                    var colors = {
                        "": "gray",
                        1: "green",
                        2: "blue"
                    }, elem = $.grep(sourceData, function (o) {
                        return o.value == value;
                    });

                    if (elem.length) {
                        $(this).text(elem[0].text).css("color", colors[value]);
                    } else {
                        $(this).empty();
                    }
                }
            });

            $('#status').editable();

            $('#group').editable({
                showbuttons: false
            });

            $('#vacation').editable({
                datepicker: {
                    todayBtn: 'linked'
                }
            });

            $('#dob').editable();

            $('#event').editable({
                placement: 'right',
                combodate: {
                    firstItem: 'name'
                }
            });

            $('#meeting_start').editable({
                format: 'yyyy-mm-dd hh:ii',
                viewformat: 'dd/mm/yyyy hh:ii',
                validate: function (v) {
                    if (v && v.getDate() == 10)
                        return 'Day cant be 10!';
                },
                datetimepicker: {
                    todayBtn: 'linked',
                    weekStart: 1
                }
            });

            $('#comments').editable({
                showbuttons: 'bottom'
            });

            $('#note').editable();
            $('#pencil').click(function (e) {
                e.stopPropagation();
                e.preventDefault();
                $('#note').editable('toggle');
            });

            $('#state').editable({
                source: ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut",
                    "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas",
                    "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota",
                    "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey",
                    "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon",
                    "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas",
                    "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"
                ]
            });

            $('#state2').editable({
                value: 'California',
                typeahead: {
                    name: 'state',
                    local: ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut",
                        "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa",
                        "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan",
                        "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire",
                        "New Jersey", "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio",
                        "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota",
                        "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia",
                        "Wisconsin", "Wyoming"
                    ]
                }
            });

            $('#fruits').editable({
                pk: 1,
                limit: 3,
                source: [{
                    value: 1,
                    text: 'banana'
                }, {
                    value: 2,
                    text: 'peach'
                }, {
                    value: 3,
                    text: 'apple'
                }, {
                    value: 4,
                    text: 'watermelon'
                }, {
                    value: 5,
                    text: 'orange'
                }]
            });

            $('#tags').editable({
                inputclass: 'input-large',
                select2: {
                    tags: ['html', 'javascript', 'css', 'ajax'],
                    tokenSeparators: [",", " "]
                }
            });

            var countries = [];
            $.each({
                "BD": "Bangladesh",
                "BE": "Belgium",
                "BF": "Burkina Faso",
                "BG": "Bulgaria",
                "BA": "Bosnia and Herzegovina",
                "BB": "Barbados",
                "WF": "Wallis and Futuna",
                "BL": "Saint Bartelemey",
                "BM": "Bermuda",
                "BN": "Brunei Darussalam",
                "BO": "Bolivia",
                "BH": "Bahrain",
                "BI": "Burundi",
                "BJ": "Benin",
                "BT": "Bhutan",
                "JM": "Jamaica",
                "BV": "Bouvet Island",
                "BW": "Botswana",
                "WS": "Samoa",
                "BR": "Brazil",
                "BS": "Bahamas",
                "JE": "Jersey",
                "BY": "Belarus",
                "O1": "Other Country",
                "LV": "Latvia",
                "RW": "Rwanda",
                "RS": "Serbia",
                "TL": "Timor-Leste",
                "RE": "Reunion",
                "LU": "Luxembourg",
                "TJ": "Tajikistan",
                "RO": "Romania",
                "PG": "Papua New Guinea",
                "GW": "Guinea-Bissau",
                "GU": "Guam",
                "GT": "Guatemala",
                "GS": "South Georgia and the South Sandwich Islands",
                "GR": "Greece",
                "GQ": "Equatorial Guinea",
                "GP": "Guadeloupe",
                "JP": "Japan",
                "GY": "Guyana",
                "GG": "Guernsey",
                "GF": "French Guiana",
                "GE": "Georgia",
                "GD": "Grenada",
                "GB": "United Kingdom",
                "GA": "Gabon",
                "SV": "El Salvador",
                "GN": "Guinea",
                "GM": "Gambia",
                "GL": "Greenland",
                "GI": "Gibraltar",
                "GH": "Ghana",
                "OM": "Oman",
                "TN": "Tunisia",
                "JO": "Jordan",
                "HR": "Croatia",
                "HT": "Haiti",
                "HU": "Hungary",
                "HK": "Hong Kong",
                "HN": "Honduras",
                "HM": "Heard Island and McDonald Islands",
                "VE": "Venezuela",
                "PR": "Puerto Rico",
                "PS": "Palestinian Territory",
                "PW": "Palau",
                "PT": "Portugal",
                "SJ": "Svalbard and Jan Mayen",
                "PY": "Paraguay",
                "IQ": "Iraq",
                "PA": "Panama",
                "PF": "French Polynesia",
                "BZ": "Belize",
                "PE": "Peru",
                "PK": "Pakistan",
                "PH": "Philippines",
                "PN": "Pitcairn",
                "TM": "Turkmenistan",
                "PL": "Poland",
                "PM": "Saint Pierre and Miquelon",
                "ZM": "Zambia",
                "EH": "Western Sahara",
                "RU": "Russian Federation",
                "EE": "Estonia",
                "EG": "Egypt",
                "TK": "Tokelau",
                "ZA": "South Africa",
                "EC": "Ecuador",
                "IT": "Italy",
                "VN": "Vietnam",
                "SB": "Solomon Islands",
                "EU": "Europe",
                "ET": "Ethiopia",
                "SO": "Somalia",
                "ZW": "Zimbabwe",
                "SA": "Saudi Arabia",
                "ES": "Spain",
                "ER": "Eritrea",
                "ME": "Montenegro",
                "MD": "Moldova, Republic of",
                "MG": "Madagascar",
                "MF": "Saint Martin",
                "MA": "Morocco",
                "MC": "Monaco",
                "UZ": "Uzbekistan",
                "MM": "Myanmar",
                "ML": "Mali",
                "MO": "Macao",
                "MN": "Mongolia",
                "MH": "Marshall Islands",
                "MK": "Macedonia",
                "MU": "Mauritius",
                "MT": "Malta",
                "MW": "Malawi",
                "MV": "Maldives",
                "MQ": "Martinique",
                "MP": "Northern Mariana Islands",
                "MS": "Montserrat",
                "MR": "Mauritania",
                "IM": "Isle of Man",
                "UG": "Uganda",
                "TZ": "Tanzania, United Republic of",
                "MY": "Malaysia",
                "MX": "Mexico",
                "IL": "Israel",
                "FR": "France",
                "IO": "British Indian Ocean Territory",
                "FX": "France, Metropolitan",
                "SH": "Saint Helena",
                "FI": "Finland",
                "FJ": "Fiji",
                "FK": "Falkland Islands (Malvinas)",
                "FM": "Micronesia, Federated States of",
                "FO": "Faroe Islands",
                "NI": "Nicaragua",
                "NL": "Netherlands",
                "NO": "Norway",
                "NA": "Namibia",
                "VU": "Vanuatu",
                "NC": "New Caledonia",
                "NE": "Niger",
                "NF": "Norfolk Island",
                "NG": "Nigeria",
                "NZ": "New Zealand",
                "NP": "Nepal",
                "NR": "Nauru",
                "NU": "Niue",
                "CK": "Cook Islands",
                "CI": "Cote d'Ivoire",
                "CH": "Switzerland",
                "CO": "Colombia",
                "CN": "China",
                "CM": "Cameroon",
                "CL": "Chile",
                "CC": "Cocos (Keeling) Islands",
                "CA": "Canada",
                "CG": "Congo",
                "CF": "Central African Republic",
                "CD": "Congo, The Democratic Republic of the",
                "CZ": "Czech Republic",
                "CY": "Cyprus",
                "CX": "Christmas Island",
                "CR": "Costa Rica",
                "CV": "Cape Verde",
                "CU": "Cuba",
                "SZ": "Swaziland",
                "SY": "Syrian Arab Republic",
                "KG": "Kyrgyzstan",
                "KE": "Kenya",
                "SR": "Suriname",
                "KI": "Kiribati",
                "KH": "Cambodia",
                "KN": "Saint Kitts and Nevis",
                "KM": "Comoros",
                "ST": "Sao Tome and Principe",
                "SK": "Slovakia",
                "KR": "Korea, Republic of",
                "SI": "Slovenia",
                "KP": "Korea, Democratic People's Republic of",
                "KW": "Kuwait",
                "SN": "Senegal",
                "SM": "San Marino",
                "SL": "Sierra Leone",
                "SC": "Seychelles",
                "KZ": "Kazakhstan",
                "KY": "Cayman Islands",
                "SG": "Singapore",
                "SE": "Sweden",
                "SD": "Sudan",
                "DO": "Dominican Republic",
                "DM": "Dominica",
                "DJ": "Djibouti",
                "DK": "Denmark",
                "VG": "Virgin Islands, British",
                "DE": "Germany",
                "YE": "Yemen",
                "DZ": "Algeria",
                "US": "United States",
                "UY": "Uruguay",
                "YT": "Mayotte",
                "UM": "United States Minor Outlying Islands",
                "LB": "Lebanon",
                "LC": "Saint Lucia",
                "LA": "Lao People's Democratic Republic",
                "TV": "Tuvalu",
                "TW": "Taiwan",
                "TT": "Trinidad and Tobago",
                "TR": "Turkey",
                "LK": "Sri Lanka",
                "LI": "Liechtenstein",
                "A1": "Anonymous Proxy",
                "TO": "Tonga",
                "LT": "Lithuania",
                "A2": "Satellite Provider",
                "LR": "Liberia",
                "LS": "Lesotho",
                "TH": "Thailand",
                "TF": "French Southern Territories",
                "TG": "Togo",
                "TD": "Chad",
                "TC": "Turks and Caicos Islands",
                "LY": "Libyan Arab Jamahiriya",
                "VA": "Holy See (Vatican City State)",
                "VC": "Saint Vincent and the Grenadines",
                "AE": "United Arab Emirates",
                "AD": "Andorra",
                "AG": "Antigua and Barbuda",
                "AF": "Afghanistan",
                "AI": "Anguilla",
                "VI": "Virgin Islands, U.S.",
                "IS": "Iceland",
                "IR": "Iran, Islamic Republic of",
                "AM": "Armenia",
                "AL": "Albania",
                "AO": "Angola",
                "AN": "Netherlands Antilles",
                "AQ": "Antarctica",
                "AP": "Asia/Pacific Region",
                "AS": "American Samoa",
                "AR": "Argentina",
                "AU": "Australia",
                "AT": "Austria",
                "AW": "Aruba",
                "IN": "India",
                "AX": "Aland Islands",
                "AZ": "Azerbaijan",
                "IE": "Ireland",
                "ID": "Indonesia",
                "UA": "Ukraine",
                "QA": "Qatar",
                "MZ": "Mozambique"
            }, function (k, v) {
                countries.push({
                    id: k,
                    text: v
                });
            });

            $('#country').editable({
                source: countries,
                select2: {
                    width: 200
                }
            });

            $('#address').editable({
                url: '/post',
                value: {
                    city: "Moscow",
                    street: "Lenina",
                    building: "12"
                },
                validate: function (value) {
                    if (value.city == '')
                        return 'city is required!';
                },
                display: function (value) {
                    if (!value) {
                        $(this).empty();
                        return;
                    }
                    var html = '<b>' + $('<div>').text(value.city).html() + '</b>, ' + $('<div>').text(value.street)
                        .html() + ' st., bld. ' + $('<div>').text(value.building).html();
                    $(this).html(html);
                }
            });

            $('#user .editable').on('hidden', function (e, reason) {
                if (reason === 'save' || reason === 'nochange') {
                    var $next = $(this).closest('tr').next().find('.editable');
                    if ($('#autoopen').is(':checked')) {
                        setTimeout(function () {
                            $next.editable('show');
                        }, 300);
                    } else {
                        $next.focus();
                    }
                }
            });

        }


    };

    // end pagefunction

    // destroy generated instances
    // pagedestroy is called automatically before loading a new page
    // only usable in AJAX version!


    // end destroy

    // run pagefunction

    pagefunction();

</script>
