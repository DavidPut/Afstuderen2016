<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 21-6-2016
 * Time: 11:49
 */
//Insert db functions
require_once "database/db_functions.php";
$db_functions = new DB_functions();

//Process
$db_process_byId = $db_functions->griffieItem($_GET["id"]);
//Decisions
$db_decisions = $db_functions->griffieBVList($_GET["id"]);
//Calendar
$db_calendar = $db_functions->selectCalendar($_GET["id"]);
//Contact
$db_contact = $db_functions->selectContact($_GET["id"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Icon for FF, Chrome, Opera -->
    <link rel="icon" type="image/png" href="images/Icon_people.png" sizes="16x16">
    <link rel="icon" type="image/png" href="images/Icon_people.png" sizes="32x32">

    <!-- Icon for IE -->
    <link rel="icon" type="image/x-icon" href="images/Icon_people.png">
    <link rel="shortcut icon" type="image/x-icon" href="images/Icon_people.png"/>

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="style/css.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/style/bootstrap.min.css">

    <!-- Extra fonts -->
    <link href='./fonts/font-awesome.min.css' rel='stylesheet'/>

    <!-- Scripts -->
    <script src="scripts/jquery-1.12.3.min.js"></script>
    <script src="scripts/jquery-ui.min.js"></script>
    <script src="scripts/dossier.js"></script>
    <script src="bootstrap/scripts/bootstrap.min.js"></script>

    <!-- Calendar plugin -->
    <link href='plugins/fullcalendar-2.7.2/fullcalendar.css' rel='stylesheet'/>
    <link href='plugins/fullcalendar-2.7.2/fullcalendar.print.css' rel='stylesheet' media='print'/>
    <script src='plugins/fullcalendar-2.7.2/lib/moment.min.js'></script>
    <script src='plugins/fullcalendar-2.7.2/fullcalendar.min.js'></script>
    <script src='plugins/fullcalendar-2.7.2/lang/nl.js'></script>

    <!-- Moments library, to get current date -->
    <script src="plugins/moments/moment.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Dossier</title>
</head>
<body>

<div class="container-fluid">

    <a class="btn btn-primary btn-more" href="./index.php">Terug</a>

    <!--Position for mobile sidebar-->
    <div class="row mob-sidebar"></div>

    <!--Dossier title block-->
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-9 col-xs-12 title-block">
                <div class="col-md-3 col-xs-5">
                    <h5><?php echo $db_process_byId["date"]; ?></h5>
                </div>
                <div class="col-md-9 col-xs-7">
                    <h4><b><?php echo $db_process_byId["title"]; ?></b></h4>
                </div>
            </div>
        </div>

        <!--Used for sorting documents-->
        <div class="row doc-content"></div>

        <!--DOCUMENTS BEGIN-->


        <?php if(!empty($db_decisions)) {
            foreach ($db_decisions as $decision_block) {
                echo '

            <div class="row dos-doc" id="' . $_GET["id"] . '" date="' . $decision_block["date"] . '">
            <div class="col-md-9 content-block">

                <div class="row toggle-row">
                    <div class="col-md-1">
                        <i class="dos-toggle glyphicon glyphicon glyphicon-plus pull-left"></i>
                    </div>
                </div>

                <div class="row titleDate-row">
                    <div class="col-md-11">
                        <div class="col-md-3 col-xs-5">
                            <h5>' . $decision_block["date"] . '</h5>
                        </div>
                        <div class="col-md-9 col-xs-6">
                            <h4><b>' . $decision_block["title"] . '</b></h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 dos-content">
                    <!--Decisions in bullet points-->
                    <ul class="decided-short">
                        <li>In sit amet massa massa. Suspendisse at eleifend sem.</li>
                        <li>Vivamus sit amet arcu nec dui hendrerit consequat.</li>
                        <li>Nam auctor feugiat lectus, sit amet luctus erat bibendum non.</li>
                    </ul>
                    <!--Detailed text-->
                    <p>' . $decision_block["summary"] . '</p>

                    <hr>
                    <!--RIS files-->
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Originele besluitvorming bestanden:</h4>
                        </div>
                    </div>

                    <div class="ris-files">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="' . $decision_block["url"] . '" target="_blank">' . $decision_block["title"] . '</a>
                            </div>
                            <div class="col-md-4">
                                <p>of</p>
                            </div>
                            <div class="col-md-4">
                                <a href="' . $decision_block["url"] . '" target="_blank">
                                    <img border="0" alt="PDF icon" src="./images/PDF-icon.png" width="32" height="32">
                                </a>
                            </div>
                        </div>

                        <hr>
                        <!--Politic arguments-->
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Politieke partijen:</h4>
                            </div>
                        </div>

                         ';

                //Get opinions by id
                $db_opinion = $db_functions->decisionOpinion($decision_block["id"]);

                echo '
                        <!-- Politic view positive -->
                         <div class="col-md-4 politic-block">
                         <span class="politic-icon fa fa-check"></span>
                         ';

                //If opinion exist
                if ($db_opinion) {

                    //Loop through opinions
                    foreach ($db_opinion as $process_opinion) {

                        //Select user by uid
                        $db_user = $db_functions->selectUser($process_opinion["uid"]);

                        //If vote is 1 -> positive
                        if ($process_opinion["vote"] == 1) {
                            echo '
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>' . $db_user[0]["name"] . ' (' . $db_user[0]["partij"] . ')</b> ' . $process_opinion["opinion"] . ' </p>
                                    </div>
                                </div>
                             ';
                        }
                    }
                }

                echo '
                         </div>

                         <!-- Politic view negative -->
                         <div class="col-md-4 politic-block">
                         <span class="politic-icon fa fa-times"></span>
                         ';

                //If opinion exist
                if ($db_opinion) {
                    //Loop through opinions
                    foreach ($db_opinion as $process_opinion) {

                        //Select user by uid
                        $db_user = $db_functions->selectUser($process_opinion["uid"]);

                        //If vote is 2 -> negative
                        if ($process_opinion["vote"] == 2) {
                            echo '
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><b>' . $db_user[0]["name"] . ' (' . $db_user[0]["partij"] . ')</b> ' . $process_opinion["opinion"] . ' </p>
                                                </div>
                                            </div>
                                         ';
                        }
                    }
                }

                echo '
                         </div>

                         <!-- Politic view unknown -->
                         <div class="col-md-4 politic-block">
                         <span class="fa fa-question" aria-hidden="true"></span>
                         ';

                //If opinion exist
                if ($db_opinion) {
                    foreach ($db_opinion as $process_opinion) {

                        //Select user by uid
                        $db_user = $db_functions->selectUser($process_opinion["uid"]);

                        //If vote is 3 -> unknown
                        if ($process_opinion["vote"] == 3) {
                            echo '
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><b>' . $db_user[0]["name"] . ' (' . $db_user[0]["partij"] . ')</b> ' . $process_opinion["opinion"] . ' </p>
                                    </div>
                                </div>
                             ';
                        }
                    }
                }
                echo '
                         </div>
                    </div>
                </div>
            </div>
        </div>';

            }
        }
        ?>
        <!--DOCUMENTS END-->
    </div>

    <!--SIDEBAR BEGIN-->

    <!--Plugin abbo-->
    <div class="col-md-3 side-bar no-padding pull-right">
        <div class="abbo-block">
            <div class="row">
                <div class="col-md-4 col-xs-4">
                    <h4>Abonneren </h4>
                </div>
                <div class="col-md-3 col-xs-3">
                    <h4><i class="fa fa-info" aria-hidden="true"
                           title="U abonneert zich hiermee op het volledige dossier. Bij aanpassingen of updates wordt u op de hoogte gehouden."></i>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form id="abbo-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control input-abbo" placeholder="Email" name="srch-term"
                                   id="abbo">

                            <div class="input-group-btn">
                                <button class="btn btn-default btn-abbo" type="submit"><i
                                        class="glyphicon glyphicon-save"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Plugin contact-->
        <div class="contact-block">
            <div class="row">
                <div class="col-md-12">
                    <h4>Contactgegevens</h4>
                </div>
            <?php
            if(!empty($db_contact)) {
                //Loop through contact data
                foreach ($db_contact as $contact) {
                    echo '
                    <div class="col-md-2 col-xs-2">
                        <img class="img-responsive" src="./images/Profile.png" alt="Contact photo">
                    </div>
                    <div class="col-md-10 col-xs-10">
                        <p class="contact"' . $contact["name"] . '
                         ';
                    //If there is an email
                    if ($contact["email"] != "") {
                        echo "<br>" . $contact["email"];
                    }
                    //If there is an phone number
                    if ($contact["phone"] != "") {
                        echo "<br>" . $contact["phone"];
                    }
                    echo '</div> ';
                }
            }
            ?>
            </div>
        </div>

        <!--Plugin toggle button-->
        <div class="toggle-button">
            <p class="rotate plugin-txt text-center">Plugins</p>
            <!--<button></button>-->
        </div>

        <!--Plugin meetings-->
        <div class="meeting-block">
            <div class="row">
                <div class="col-md-12">
                    <h4>Vergaderingen</h4>
                </div>
                <div class="col-md-12">
                    <div id='calendar'></div>
                    <div id='calendar-info'></div>
                </div>
            </div>
        </div>
    </div>

    <!--SIDEBAR END-->
</div>
</div>
</body>
</html>

<script>var cal_values = <?php echo json_encode($db_calendar); ?>;</script>




