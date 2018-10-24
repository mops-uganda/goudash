<?php
require_once("inc/init.php");
$Financial_Year = '2015/2016';
?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h4 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
            Government Performance Report
        </h4>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h5> GDP <span class="txt-color-blue">$25.53 Bn</span></h5>
                <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                    1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
                </div>
            </li>
            <li class="sparks-info">
                <h5> GDP Growth <span class="txt-color-purple"><i class="fa fa-arrow-circle-up"></i>&nbsp;3.7%</span></h5>
                <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
                    110,150,300,130,400,240,220,310,220,300, 270, 210
                </div>
            </li>
            <li class="sparks-info">
                <h5> Population <span class="txt-color-greenDark"><i class="fa fa-user"></i>&nbsp;41.49 Mn</span></h5>
                <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
                    110,150,300,130,400,240,220,310,220,300, 270, 210
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-0" data-widget-editbutton="false" data-widget-sortable="false" data-widget-deletebutton="false">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

                -->
                <header>
                    <span class="widget-icon"> <i class="fa fa-lg fa-calendar"></i> </span>
                    <h2>Table of Contents </h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="widget-body-toolbar bg-color-white">

                            <form class="form-inline" role="form">

                                <div class="row">

                                    <div class="col-sm-12 col-md-10">

                                        <div class="form-group">
                                            <label class="sr-only">Days</label>
                                            <select class="form-control input-sm">
                                                <option>2013/2014</option>
                                                <option>2014/2015</option>
                                                <option selected>2015/2016</option>
                                                <option>2016/2017</option>
                                                <option>2017/2018</option>
                                                <option>2018/2019</option>
                                                <option>2019/2020</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-2 text-align-right">

                                        <button type="submit" class="btn btn-warning btn-xs">
                                            <i class="fa fa-plus"></i> Select
                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="tree">
                            <ul>
                                <li>
                                    <span><i class="fa fa-lg fa-rss"></i> 1: Executive Summary</span>
                                    <ul>
                                        <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 0.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=0.1&Report_Title=State of the National Economy">State of the National Economy </a></li>
                                        <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 0.2:</span> - <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=0.2&Report_Title=Overview of the NDP-II Objectives and Key Results">Overview of the NDP-II Objectives and Key Results </a></li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 1.0: Results at Sector Level </span> Summary of Performance of each sector of Government
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.1&Report_Title=Results at Sector Level - Accountability">Accountability </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.2&Report_Title=Results at Sector Level - Agriculture">Agriculture </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.3&Report_Title=Results at Sector Level - Education">Education </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.4&Report_Title=Results at Sector Level - Energy and Mineral Development">Energy and Mineral Development </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.5:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.5&Report_Title=Results at Sector Level - Health">Health </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.6:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.6&Report_Title=Results at Sector Level - Information Communication and Technology">Information Communication and Technology </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.7:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.7&Report_Title=Results at Sector Level - Justice, Law and Order Sector">Justice, Law and Order Sector </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.8:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.8&Report_Title=Results at Sector Level - Land Housing and Urban Development">Land Housing and Urban Development </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.9:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.9&Report_Title=Results at Sector Level - Legislature">Legislature </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.10:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.10&Report_Title=Results at Sector Level - Public Administration">Public Administration </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.11:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.11&Report_Title=Results at Sector Level - Public Sector Management">Public Sector Management </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.12:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.12&Report_Title=Results at Sector Level - Security">Security </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.13:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.13&Report_Title=Results at Sector Level - Social Development Sector">Social Development Sector </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.14:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.14&Report_Title=Results at Sector Level - Tourism, Trade and Industry">Tourism, Trade and Industry </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.15:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.15&Report_Title=Results at Sector Level - Water and Environment">Water and Environment </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 1.16:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=1.16&Report_Title=Results at Sector Level - Works and Transport Sector">Works and Transport Sector </a></li>

                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <span><i class="fa fa-lg fa-rss"></i> 2: State of the Economy</span>
                                    <ul>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 2.1: Performance of the Economy</span> Performance of the domestic economy
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 2.1.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=2.1.1&Report_Title=Real Economic Growth">Real Economic Growth  <span class="txt-color-blueDark">  : - GDP Growth Rates ( Traded goods and Non Traded goods)</span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 2.1.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=2.1.2&Report_Title=Domestic Inflation">Domestic Inflation <span class="txt-color-blueDark">  : - Inflation Developments and Inflation Outlook</span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 2.1.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=2.1.3&Report_Title=Monetary and Financial Sector">Monetary and Financial Sector <span class="txt-color-blueDark"> : - Monetary Policy Operations / Interbank Market Rates / Interest Rates /	Banks Credit to Private Sector</span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 2.1.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=2.1.4&Report_Title=Fiscal Developments and Outlook">Fiscal Developments and Outlook <span class="txt-color-blueDark"> : - Government Expenditure and Revenue / Domestic and External Debt / Fiscal Outlook</span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 2.1.5:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=2.1.5&Report_Title=Balance of Payments and Exchange Rates">Balance of Payments and Exchange Rates </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 2.1.6:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=2.1.6&Report_Title=Conclusion">Conclusion </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 2.2:	NDP II Theme and Objectives</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 2.2.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=2.2.1&Report_Title=Overview of the NDPII Objectives">Overview of the NDPII Objectives</a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 2.2.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=2.2.2&Report_Title=Progress against key NDPII Goal and Objectives">Progress against key NDPII Goal and Objectives <span class="txt-color-blueDark"> : - Progress on NDPII Goal</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <span><i class="fa fa-lg fa-rss"></i> 3: Human Development</span>
                                    <ul>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 3.1: Health Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.1.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=3.1.1&Report_Title=Sector Objectives">Sector Objectives <span class="txt-color-blueDark">  : - Promotion of a healthy productive life of her population for economic development</span> </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.1.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=3.1.2&Report_Title=Overview of the Sector’s Performance">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.1.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=3.1.3&Report_Title=Sector Performance in Key Results Areas">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.1.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=3.1.4&Report_Title=Emerging Sector Issues and Recommendations">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 3.2: Education Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.2.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=3.2.1&Report_Title=Sector Objectives">Sector Objectives <span class="txt-color-blueDark">  : - Education is critical in enhancing the quality of labour productivity and its contribution to economic development</span> </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.2.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=3.2.2&Report_Title=Overview of the Sector’s Performance">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.2.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=3.2.3&Report_Title=Sector Performance in Key Results Areas">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.2.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=3.2.4&Report_Title=Emerging Sector Issues and Recommendations">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 3.3: Social Development Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.3.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Improvement of standards of living, equity and social cohesion</span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.3.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.3.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.3.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 3.4: Water and Environment Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.4.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Water and Environment impact the quality of life of people, and overall production and productivity of the population</span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.4.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.4.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 3.4.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <span><i class="fa fa-lg fa-rss"></i> 4: Economic Infrastructure and Competitiveness</span>
                                    <ul>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 4.1: Energy and Mineral Development Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.1.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Rational, sustainable exploitation and utilization of energy and mineral resources for social and economic development</span> </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.1.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.1.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.1.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 4.2: Works and Transport Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.2.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Adequate, Safe and Well Maintained Works and Transport Infrastructure and Services for Social Economic Development of the Country</span> </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.2.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.2.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.2.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 4.3: Information and Communication Technology Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.3.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Knowledge-based Uganda enabled by a vibrant ICT</span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.3.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.3.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.3.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 4.4: Tourism, Trade and Industry Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.4.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Sustainable Tourism, Competitive Trade, and World Class Industrial Products, and Services</span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.4.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.4.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 4.4.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <span><i class="fa fa-lg fa-rss"></i> 5: Rural Development</span>
                                    <ul>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 5.1: Agriculture Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 5.1.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Increase rural incomes and livelihoods and to improve household food and nutrition security</span> </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 5.1.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 5.1.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 5.1.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 5.2: Lands, Housing And Urban Development Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 5.2.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Uganda’s land resources are used productively and sustainably for security of livelihoods and poverty eradication</span> </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 5.2.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 5.2.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 5.2.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <span><i class="fa fa-lg fa-rss"></i> 6: Security, Justice And Governance</span>
                                    <ul>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 6.1: Accountability Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.1.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - To achieve a transparent, responsive and accountable public sector that delivers value for money services in a timely manner</span> </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.1.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.1.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.1.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 6.2: Justice, Law and Order Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.2.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Deepening and broadening access to Justice Law and Order Sector (JLOS) services </span> </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.2.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.2.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.2.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 6.3: Legislature Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.3.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Improve attendance and participation in plenary sittings and committee meetings, strengthen the oversight role of Parliament </span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.3.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.3.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.3.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 6.4: Public Administration Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.4.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Facilitate the President in fulfilling his constitutional mandate; promoting and managing international relations </span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.4.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.4.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.4.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 6.5: Public Sector Management</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.5.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Development and control of public service delivery systems through the promotion of sound principles, structures and procedures </span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.5.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.5.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.5.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 6.6: Security Sector</span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.6.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Objectives <span class="txt-color-blueDark">  : - Preserve and defend the sovereignty and territorial integrity of Uganda </span></a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.6.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview of the Sector’s Performance </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.6.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Sector Performance in Key Results Areas </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 6.6.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Sector Issues and Recommendations </a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    <span><i class="fa fa-lg fa-rss"></i> 7: Performance of Local Governments on Key Service Delivery Sectors</span>
                                    <ul>
                                        <li style="display:none">
                                            <span class="label label-success"><i class="fa fa-lg fa-plus-circle"></i> 7.1: Synthesis of the District Local Government Performance </span>
                                            <ul>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.1.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Summary Results on Assessed Districts </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.1.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Production and Marketing Sector </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.1.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Health Sector </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.1.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Education Sector </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.1.5:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Roads & Engineering Sector </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.1.6:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Water Sector </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.1.7:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Natural Resources Sector </a></li>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.1.8:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Community Based Services Sector </a></li>
                                            </ul>
                                        </li>
                                        <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State"> Performance the District Local Governments </a></li>
                                        <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.3:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State"> Synthesis of the Municipal Council Local Government Performance </a></li>
                                        <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 7.4:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State"> Performance of Municipal Council Local Governments </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <span><i class="fa fa-lg fa-rss"></i> 8: Implementation of Cabinet Actions </span>
                                    <ul>
                                        <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 8.1:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Overview </a><span class="txt-color-blueDark"> : - % On Track/Achieved , % Slow Progress</span></li>
                                        <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> 8.2:</span> &ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=yyy&Report_Title=State">Emerging Issues and Recommendations </a></li>
                                    </ul>
                                </li>


                            </ul>
                        </div>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->

    </div>

    <!-- end row -->

    <!-- row -->

    <div class="row">

    </div>

    <!-- end row -->

</section>
<!-- end widget grid -->

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

    // PAGE RELATED SCRIPTS
    // pagefunction

    var pagefunction = function() {

        if($(".tree > ul")&&!mytreebranch){var mytreebranch=$(".tree").find("li:has(ul)").addClass("parent_li").attr("role","treeitem").find(" > span").attr("title","Collapse this branch");$(".tree > ul").attr("role","tree").find("ul").attr("role","group"),mytreebranch.on("click",function(a){var b=$(this).parent("li.parent_li").find(" > ul > li");b.is(":visible")?(b.hide("fast"),$(this).attr("title","Expand this branch").find(" > i").addClass("icon-plus-sign").removeClass("icon-minus-sign")):(b.show("fast"),$(this).attr("title","Collapse this branch").find(" > i").addClass("icon-minus-sign").removeClass("icon-plus-sign")),a.stopPropagation()})}

    };

    // end pagefunction

    // run pagefunction on load

    pagefunction();

</script>
