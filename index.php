<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 21-6-2016
 * Time: 10:15
 */

//Insert db functions
require_once "database/db_functions.php";
$db_functions = new DB_functions();
$db_process = $db_functions->griffieList();

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Icon for FF, Chrome, Opera -->
    <link rel="icon" type="image/png" href="images/Icon_people.png" sizes="16x16">
    <link rel="icon" type="image/png" href="images/Icon_people.png" sizes="32x32">

    <!-- Icon for IE -->
    <link rel="icon" type="image/x-icon" href="images/Icon_people.png" >
    <link rel="shortcut icon" type="image/x-icon" href="images/Icon_people.png"/>

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="style/css.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/style/bootstrap.min.css">

    <!-- Extra fonts -->
    <link href='./fonts/font-awesome.min.css' rel='stylesheet'/>

    <!-- Google maps api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZJfE_Tj_HySFXXamSQw5WG2RZ6SHotJ0&libraries=geometry"></script>

    <!-- Scripts -->
    <script src="scripts/jquery-1.12.3.min.js"></script>
    <script src="scripts/jquery-ui.min.js"></script>
    <script src="scripts/main.js"></script>
    <script src="bootstrap/scripts/bootstrap.min.js"></script>

    <title>Concept</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
</head>
<body>
<div id="map"></div>

<div class="container-fluid">
    <div class="col-md-9 doc-container">

        <!--Position for mobile sidebar-->
        <div class="row mob-sidebar"></div>

        <!--Used for sorting documents-->
        <div class="row doc-content"></div>


        <?php foreach ($db_process as $process_block){
            //If process without location
            if(empty($process_block["location"])){
                //Sort by first specified tag
                $sortedType = explode("," , $process_block["type"]);
                echo '
                    <div class="row doc-row" id="'.$process_block["id"].'" date="'.$process_block["date"].'" tags="'.$process_block["searchtags"].'" type="'.$sortedType[0].'" time="'.$process_block["period"].'">
                        <div class="col-md-10 col-xs-10 doc-block">

                            <div class="col-md-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img class="pull-left icon-document" src="" alt="icon document">
                                    </div>
                                    <div class="col-md-9 doc-title">
                                        <h1>'.$process_block["title"].'</h1>
                                    </div>
                                </div>
                                <p class="document-content">'.$process_block["summary"].'</p>
                                <button class="btn btn-primary btn-more" type="submit">Lees meer</button>
                            </div>
                        </div>
                    </div>
                ';
            }
            //Else with location
            else if(!empty($process_block["location"])){
                //Sort by first specified tag
                $sortedType = explode("," , $process_block["type"]);
               echo'
                    <div class="row doc-row" id="'.$process_block["id"].'"  date="'.$process_block["date"].'"  location="'.$process_block["location"].'"  tags="'.$process_block["searchtags"].'"  type="'.$sortedType[0].'"  time="'.$process_block["period"].'" >
                        <div class="col-md-12 col-xs-12 doc-block loc-block">

                            <div class="col-md-10 col-xs-10">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img class="pull-left icon-document" src="" alt="icon document">
                                    </div>
                                    <div class="col-md-9 doc-title">
                                        <h1>'.$process_block["title"].'</h1>
                                    </div>
                                </div>

                        <p class="document-content">'.$process_block["summary"].'</p>
                        <button class="btn btn-primary btn-more" type="submit">Lees meer</button>
                    </div>
                    <div class="col-md-2 col-xs-2 icon-block">
                        <a href="#"><img class="pull-right img-responsive loc-icon" src="" alt="icon document"></a>
                    </div>

                        </div>
                    </div>
               ';
            }
        }
        ?>


    </div>

    <!--SIDEBAR BEGIN-->
    <div class="col-md-3 cont-sidebar">
        <div class="col-md-12 side-bar no-padding">

            <div class="search-block">
                <span class="text-center"><h4>Filter</h4></span>

                <!--Tags search bar-->
                <form id="tags-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control input-tags" placeholder="Zoekwoorden" name="srch-term" id="srch-tag">
                        <div class="input-group-btn">
                            <button class="btn btn-default btn-tags" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>

                <!--Location search bar-->
                <form id="location-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control input-loc" placeholder="Adres" name="srch-term" id="srch-loc">
                        <div class="input-group-btn">
                            <button class="btn btn-default btn-loc" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Let op! Zoekwoorden overschrijft alle anderen filters.
            </div>


            <!--Document type filters-->
            <div class="doc-type-block">
                <span class="text-center"><h4>Type besluitvorming</h4></span>
                <form id="type-form" role="filter">
                    <div class="row">
                        <div class="col-md-1 col-xs-1">
                            <input id="checkbox-physical" type="checkbox" name="physical" value="Physical" checked>
                        </div>
                        <div class="col-md-1 col-xs-2 ic-img">
                            <img src="images/Icon_hammer.png" alt="Icon physical">
                        </div>
                        <div class="col-md-5 col-xs-6">
                            <p>= Fysiek</p>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <i class="fa fa-info" aria-hidden="true" title="Besluitvormingen met betrekking tot de bouw (zichtbare veranderingen in de stad."></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1 col-xs-1">
                            <input id="checkbox-social" type="checkbox" name="social" value="Social" checked>
                        </div>
                        <div class="col-md-1 col-xs-2 ic-img">
                            <img src="images/Icon_people.png" alt="Icon social">
                        </div>
                        <div class="col-md-5 col-xs-6">
                            <p>= Sociaal</p>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <i class="fa fa-info" aria-hidden="true" title="Besluitvormingen zoals speelterreinen, verenigingsleven en vrijwilligerswerk." ></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-1 col-xs-1">
                            <input id="checkbox-money" type="checkbox" name="money" value="Money" checked>
                        </div>
                        <div class="col-md-1 ic-img col-xs-2">
                            <img src="images/Icon_money.png" alt="Icon money">
                        </div>
                        <div class="col-md-5 col-xs-6">
                            <p>= Bestuur & middelen</p>
                        </div>
                        <div class="col-md-1 col-xs-1">
                            <i class="fa fa-info" aria-hidden="true" title="Besluitvormingen over hoeveel geld ergens naar toe gaat."></i>
                        </div>
                    </div>

                </form>
            </div>

            <!--Sidebar button mobile-->
            <div class="toggle-button">
                <!--<button></button>-->
                <p class="rotate filter-txt text-center">Filter</p>
            </div>

            <!--Document time filters-->
            <div class="doc-time-block">
                <span class="text-center"><h4>Tijdsindicatie</h4></span>
                <form id="time-form" role="filter">
                    <div class="input-time">
                        <input id="checkbox-low" type="checkbox" name="low" value="<1" checked>  <img class="icon-time" src="images/Circle_green.png" alt="Icon physical"> = <1 jaar
</div>
                    <div class="input-time">
                        <input id="checkbox-mid" type="checkbox" name="mid" value="1-5" checked> <img class="icon-time" src="images/Circle_orange.png" alt="Icon social"> = 1 tot 5 jaar
</div>
                    <div class="input-time">
                        <input id="checkbox-high" type="checkbox" name="high" value="5+" checked>  <img class="icon-time" src="images/Circle_red.png" alt="Icon money"> = 5+ jaar
    </div>
                </form>
            </div>

            <!--Marker filter slider-->
            <div class="slider-block">
                <span class="text-center"><h4>Afstand</h4></span>
                <span id="range-value" class="text-center"><h5>50km</h5></span>
                <form id="marker-form" role="filter">
                    <div data-role="rangeslider">
                        <input type="range" name="marker-range" id="marker-range" value="50" min="0" max="100">
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!--SIDEBAR END-->
</div>
</body>
</html>