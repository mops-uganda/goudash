<?php
// if (!session_id()) session_start();

require_once 'init.php';


//CONFIGURATION for SmartAdmin UI

//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
    "Home" => APP_URL
);

/*navigation array config

ex:
"dashboard" => array(
    "title" => "Display Title",
    "url" => "http://yoururl.com",
    "url_target" => "_self",
    "icon" => "fa-home",
    "label_htm" => "<span>Add your custom label/badge html here</span>",
    "sub" => array() //contains array of sub items with the same format as the parent
)

*/

$page_nav = array(
    "dashboard" => array(
        "title" => "Dashboard",
        "icon" => "fa-home",
        "url" => "X/dashboard"
    )
);

$intranet = array(
    "title" => "Information Feed",
    "icon" => "fa-sliders",
    "sub" => array(
        "infofeed" => array(
            "title" => "Posts Timeline",
            "icon" => "fa-sliders",
            "url" => "X/infofeed"
        ),
        "event_calendar" => array(
            "title" => "Events Calendar",
            "icon" => "fa-calendar",
            "url" => "cal/index?=".mt_rand(5, 500)
        ),
        "stickynotes" => array(
            "title" => "Sticky Notes",
            "icon" => "fa-slack",
            "url" => "stickynotes/index.html"
        )
    )
);

$hr_analytics = array(
    "title" => "",
    "icon" => "fa-rss txt-color-green ",
    "label_htm" => '<button class="btn btn-sm btn-primary" type="button">HR Analytics</button>',
    "url" => "X/hr_analytics"
);

$establishment_structures = array(
    "title" => "",
    "icon" => "fa-exchange txt-color-purple",
    "label_htm" => '<button class="btn btn-sm btn-success" type="button">Vote Structures</button>',
    "url" => "X/reports?id=600"
);

$statistics = array(
    "title" => "",
    "icon" => "fa-rss txt-color-green ",
    "label_htm" => '<button class="btn btn-sm btn-warning" type="button">General Statistics</button>',
    "url" => "X/statistics"
);

$actions_tracker = array(
    "title" => "",
    "icon" => "fa-rss txt-color-orange ",
    "label_htm" => '<button class="btn btn-sm btn-success " type="button">Actions Tracker</button>',
    "url" => "X/action-tracker"
);

$Strategic_Projects = array(
    "title" => "Strategic Projects",
    "icon" => "fa-balance-scale",
    "sub" => array(
        "strategicprojects" => array(
            "title" => "Strategic Projects",
            "icon" => "fa-slack",
            "url" => "X/projects"
        ),
        "projecttasks" => array(
            "title" => "Project Tasks",
            "icon" => "fa-tasks",
            "url" => "X/ptasks"
        ),
        "projectkeyoutputs" => array(
            "title" => "Project Key Outputs",
            "icon" => "fa-cube",
            "url" => "X/pkeyoutputs"
        ),
        "projectmilestones" => array(
            "title" => "Project Milestones",
            "icon" => "fa-reorder",
            "url" => "X/pmilestones"
        ),
        "projectkpis" => array(
            "title" => "Project KPIs",
            "icon" => "fa-bar-chart-o",
            "url" => "X/pkpis"
        ),
        "projectactivities" => array(
            "title" => "Project Timelines",
            "icon" => "fa-yelp",
            "url" => "X/ptimelines"
        ),
        "govt_projects" => array(
            "title" => "All Govt Projects",
            "icon" => "fa-yelp",
            "url" => "X/govtprojects"
        )

    )
);

$Strategic_Actions = array(
    "title" => "Strategic Actions",
    "icon" => "fa-cube txt-color-blue",
    "sub" => array(
        "actionsdashboard" => array(
            "title" => "Actions Dashboard",
            "icon" => "fa-home",
            "url" => "X/Strategic_Actions?=".mt_rand(5, 500)
        ),
        "strategicmeetings" => array(
            "title" => "Meetings / Events",
            "icon" => "fa-cube",
            "url" => "X/meetings?=".mt_rand(5, 500)
        ),
        "strategicactions" => array(
            "title" => "Actions and Tasks",
            "icon" => "fa-tasks",
            "url" => "X/actions"
        ),
        "strategicactionnotess" => array(
            "title" => "Notes",
            "icon" => "fa-cube",
            "url" => "X/actionnotes"
        ),
        "strategicactiontimelines" => array(
            "title" => "Timelines",
            "icon" => "fa-calendar",
            "url" => "X/meetActivityTimelines"
        )
    )
);

$Strategic_Data = array(
    "title" => "Strategic Data",
    "icon" => "fa-bar-chart-o",
    "sub" => array(
        "Strategic_Data" => array(
            "title" => "Data Dashboard",
            "icon" => "fa-home txt-color-blue",
            "url" => "X/Strategic_Data"
        ),
        "demographics" => array(
            "title" => "Demographics",
            "icon" => "fa-male",
            "url" => "X/reports?id=500&select=1&SelectBy=reportCategory&reportCategory=Demographics"
        ),
        "socioeconomics" => array(
            "title" => "Socio-Ecomonics",
            "icon" => "fa-exchange",
            "url" => "X/socioeconomics"
        ),
        "health" => array(
            "title" => "Health Data",
            "icon" => "fa-hospital-o",
            "url" => "X/healthdata"
        ),
        "education" => array(
            "title" => "Education Data",
            "icon" => "fa-book",
            "url" => "X/educationdata"
        ),
        "infrastructure" => array(
            "title" => "Infrastructure",
            "icon" => "fa-truck",
            "url" => "X/infrastructuredata"
        ),
        "Disasterrefugees" => array(
            "title" => "Disaster / Refugees",
            "icon" => "fa-warning",
            "url" => "X/disasterprep"
        ),
        "production" => array(
            "title" => "Production",
            "icon" => "fa-gears",
            "url" => "X/production"
        ),
        "agriculture" => array(
            "title" => "Agriculture",
            "icon" => "fa-leaf",
            "url" => "X/agric"
        )
    )
);

$Govt_Performance = array(
    "title" => "Performance",
    "icon" => "fa-bars txt-color-green",
    "sub" => array(
        "govtperformancereport" => array(
            "title" => "",
            "label_htm" => '<button class="btn btn-sm btn-success" type="button">Performance Report</button>',
            "icon" => "fa-plus-square txt-color-green",
            "url" => "X/performancereport"
        ),
        "plans" => array(
            "title" => "Annual Plans",
            "icon" => "fa-angle-down",
            "sub" => array(
                "budget-plans" => array(
                    "title" => "Budget",
                    "icon" => "fa-circle-o-notch",
                    "url" => "X/budget.php"
                ),
                "Outputs" => array(
                    "title" => "Key Outputs",
                    "icon" => "fa-circle-o-notch",
                    "url" => "X/outputs",
                ),
                "PKIs" => array(
                    "title" => "KPIs",
                    "icon" => "fa-circle-o-notch",
                    "url" => "X/kpis",
                )
            )
        ),
        "performance" => array(
            "title" => "Performance",
            "icon" => "fa-angle-down",
            "sub" => array(
                "GAPRDashboard" => array(
                    "title" => "Budget Perf.",
                    "icon" => "fa-sliders",
                    "url" => "X/gapr"
                ),
                "SectorOutcomes" => array(
                    "title" => "Sector Outcomes",
                    "icon" => "fa-sliders",
                    "url" => "X/datatables",
                ),
                "KeyOutputs" => array(
                    "title" => "Key Outputs Perf.",
                    "icon" => "fa-sliders",
                    "url" => "X/outputs_perf",
                ),
                "PKIs" => array(
                    "title" => "PKI Performance",
                    "icon" => "fa-sliders",
                    "url" => "X/kpis_perf",
                )
            )
        )
    )
);

$inspection_performance = array(
    "title" => "Inspection Tool",
    "icon" => "fa-check-square-o txt-color-green",
    "sub" => array(
        "actionsdashboard" => array(
            "title" => "Inspect Dashboard",
            "icon" => "fa-home",
            "url" => "inspect/home"
        )
    )
);
$Inspection_Tool = array(
    "title" => "Inspection Tool",
    "icon" => "fa-tasks txt-color-green",
    "url" => "inspect/inspect?=".mt_rand(5, 500)
);
$Political_Verification = array(
    "title" => "Political Verification",
    "icon" => "fa-tasks txt-color-green",
    "url" => "inspect/verify?=".mt_rand(5, 500)
);
$Joint_Inspection = array(
    "title" => "Joint Inspection Team",
    "icon" => "fa-tasks txt-color-green",
    "url" => "inspect/jointinspect?=".mt_rand(5, 500)
);
$performance_questions = array(
    "title" => "Performance Questions",
    "icon" => "fa-cube",
    "url" => "inspect/performance_questions"
);
$manual = array(
    "title" => "Inspection Manual",
    "icon" => "fa-calendar",
    "url" => "inspect/manual"
);

if ($user->hasPermission('Inspect.mdalg')) array_push($inspection_performance['sub'], $Inspection_Tool);
if ($user->hasPermission('inspect.political')) array_push($inspection_performance['sub'], $Political_Verification);
if ($user->hasPermission('inspect.joint')) array_push($inspection_performance['sub'], $Joint_Inspection);
array_push($inspection_performance['sub'], $performance_questions);
array_push($inspection_performance['sub'], $manual);



$General_Information = array(
    "title" => "General Information",
    "icon" => "fa-desktop",
    "sub" => array(
        "listOfAllVotes" => array(
            "title" => "List of all Votes",
            "url" => "X/reports?id=555"
        ),
        "SectorsAndThematicAreas" => array(
            "title" => "Sectors / Thematic Areas",
            "url" => "X/SectorsAndThematicAreas"
        ),
        "MinistriesDeptsAgencies" => array(
            "title" => "Ministries and Agencies",
            "url" => "X/MinistriesDeptsAgencies"
        ),
        "GovernmentDepartments" => array(
            "title" => "Government Programmes",
            "url" => "X/GovernmentProgrammes"
        ),
        "ProgrammesProjects" => array(
            "title" => "Departments / Projects",
            "url" => "X/ProgrammesProjects"
        ),
        "KeyDepartmentOutputs" => array(
            "title" => "Key Department Outputs",
            "url" => "X/KeyDepartmentOutputs"
        ),
        "KeyPerformanceIndicators" => array(
            "title" => "Key Perf. Indicators",
            "url" => "X/KeyPerformanceIndicators"
        ),
        "GeneralInformation" => array(
            "title" => "All General Information",
            "icon" => "fa-bar-chart-o txt-color-blue",
            "url" => "X/reports?id=500&select=1&SelectBy=reportCategory&reportCategory=General Information"
        )
    )
);

$reports = array(
    "title" => "Reports",
    "icon" => "fa-exchange txt-color-purple",
    "label_htm" => "  <span class='label label-success'>All reports</span>",
    "url" => "X/reports"
);

$User_Settings = array(
    "title" => "User Settings",
    "icon" => "fa-cogs",
    "sub" => array(
        "User_Profile" => array(
            "title" => "User Profile",
            "icon" => "fa fa-user",
            "url_target" => "_top",
            "url" => "http://" . $_SERVER['HTTP_HOST'] . "" . $_SERVER['REQUEST_URI'] . "securex/public",
        ),
        "my_permissions" => array(
            "title" => "My User Permissions",
            "icon" => "fa fa-user",
            "url" => "X/mypermissions?=".mt_rand(5, 500),
        ),
        "DashboardSkins" => array(
            "title" => "Dashboard Skins",
            "icon" => "fa fa-picture-o",
            "url" => "X/skins"
        ),
    )
);

$general_setting_array = array(
    "title" => "General Settings",
    "icon" => "fa fa-cogs txt-color-red",
    "sub" => array(
        "Departments" => array(
            "title" => "Departments",
            "icon" => "fa fa-cogs txt-color-red",
            "url" => "X/departments",
        ),
        "Officers" => array(
            "title" => "Officers",
            "icon" => "fa fa-cogs txt-color-red",
            "url" => "X/officers",
        ),
        "Offices" => array(
            "title" => "Offices",
            "icon" => "fa fa-cogs txt-color-red",
            "url" => "X/offices",
        )
    )
);

$setting_array = array(
    "title" => "Advanced Settings",
    "icon" => "fa fa-cogs txt-color-red",
    "sub" => array(
        "Report_Settings" => array(
            "title" => "Report Settings",
            "icon" => "fa fa-cogs txt-color-red",
            "url" => "X/xreports",
        ),
        "Performance_Reports_TOC" => array(
            "title" => "Perf Reports TOC",
            "icon" => "fa fa-cogs txt-color-red",
            "url" => "X/xperformance_report_tor"
        ),
        "User_Permissions" => array(
            "title" => "User Permissions",
            "icon" => "fa fa-shield txt-color-red",
            "url" => "X/userpermissions?=".mt_rand(5, 500),
        )
    )
);

array_push($page_nav, $intranet);
if ($user->hasPermission('hr_analytics.view')) array_push($page_nav, $hr_analytics);
if ($user->hasPermission('hr_analytics.view')) array_push($page_nav, $establishment_structures);
if ($user->hasPermission('statistics.view')) array_push($page_nav, $statistics);
if ($user->hasPermission('actions.tracker')) array_push($page_nav, $actions_tracker);
if ($user->hasPermission('Strategic_Projects')) array_push($page_nav, $Strategic_Projects);
if ($user->hasPermission('Strategic_Actions')) array_push($page_nav, $Strategic_Actions);
if ($user->hasPermission('Inspect.Basic')) array_push($page_nav, $inspection_performance);
if ($user->hasPermission('Strategic_Data')) array_push($page_nav, $Strategic_Data);
if ($user->hasPermission('performance')) array_push($page_nav, $Govt_Performance);
if ($user->General_Information) array_push($page_nav, $General_Information);
if ($user->Reports) array_push($page_nav, $reports);
array_push($page_nav, $User_Settings);
if ($user->userlevel == 10) array_push($page_nav, $general_setting_array);
if ($user->userlevel == 10) array_push($page_nav, $setting_array);

//configuration variables
$page_title = "";
$page_css = array();
$no_main_header = false; //set true for lock.php and login.php
$page_body_prop = array(); //optional properties for <body>
$page_html_prop = array(); //optional properties for <html>
?>