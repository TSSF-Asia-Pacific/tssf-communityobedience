<!DOCTYPE html>
<html manifest="cache.appcache">
  <head>
    <meta name="viewport" content="width=450, initial-scale=1">
    <title>tssf Community Obedience</title>
    <style type="text/css">
      <?php include 'css/tssf.css'; ?>

        .principal, .day, .collect {
            display: none;
        }

        #jsmessage {
            border: 1px solid;
            margin: 10px 0px;
            padding:15px 10px 15px 50px;
            background-repeat: no-repeat;
            background-position: 10px center;
            color: #D8000C;
            background-color: #FFBABA;
        }
    </style>
  </head>

  <body>
    <script type="text/javascript"><?php include 'jquery-1.11.1.min.js'; ?></script>
    <script type="text/javascript"><?php include 'moment.min.js'; ?></script>
    <script type="text/javascript">


    function display_todays_obedience()
    {
        // Ensure all divs are hidden
        $("#jsmessage").hide();
        $(".principal").hide();
        $(".collect").hide();
        $(".day").hide();

        // Work out day of month
        datenow = new moment();
        dayofmonth = datenow.format("D");

        if(dayofmonth == 31)
        {
            principalnum = Math.floor(Math.random() * (30 - 1 + 1)) + 1;
        }else{
            principalnum = dayofmonth;
        }
        $("#principal_" + principalnum).show();
        $("#day_" + dayofmonth).show();

        // Work out day of week
        dayofweek = datenow.format("d");
        $("#collect_" + dayofweek).show();
        $('#date').text(datenow.format("dddd D MMMM YYYY"));
        update_display();
    }

    $( document ).ready(display_todays_obedience);

    var nIntervId;
     
    function update_display() {
        // Refresh every 10 minutes
        IntervId = setInterval(display_todays_obedience, 600000);
    }
    </script>
    <div id="jsmessage">If you can read this, you have javascript disabled, please enable javascript to use this site</div>

    <h1>tssf Community Obedience</h1>
    <em>Province of Australia, Papua New Guinea and East Asia
    <br/>for <span id='date'></span></em><br/>
    <p class="rubric">In all provinces of the Third Order this offering of prayer
    should be made daily, either on its own or in the context of Morning or
    Evening Prayer.</p>
    <p class="boilerplate">In the name of the Father,
    <br/>and of the Son,
    <br/>and of the Holy Spirit. <strong>Amen</strong></p>
    <p class="boilerplate">Here and in all your churches throughout the world,
    <br/>we adore you, O Christ, and we bless you,
    <br/>because by your holy cross you have redeemed the world. <strong>Amen</strong></p>

<?php
/* Add the principle for the day of month. */

for($i = 1; $i <= 30; $i++)
{
    echo "<div id='principal_$i' class='principal'>";
    $principlerubric = 'Principle for day ' . $i;
    echo "<p class='rubric'>$principlerubric</p>\n";

    $principlefile = 'boiler/principle' . $i . '.txt';
    echo "<p class='boilerplate'>" . implode("</p>\n<p class='boilerplate'>", file($principlefile)) . "</p>\n";
    echo "</div>\n";
}
?>

<p class="rubric">Daily intercession prayers...</p>

<?php
/* Add the daily intercession prayers for the day of the month */

for ($i = 1; $i <= 31; $i++)
{
    echo "<div id='day_$i' class='day'>";
    $contents = file('tssffiles/day' . $i . '.txt');
    echo implode('<br/>', $contents). "<br/>";
    echo "</div>\n";
}
?>

<p class="boilerplate">God, we give you thanks for the Third Order of the Society of St. Francis. Grant, we pray, that being knit together in community and prayer, we your servants may glorify your holy name after the example of Saint Francis, and win others to your love; through Jesus Christ our Lord. <strong>Amen</strong></p>
<?php
$days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

for ($i = 0; $i <= 6; $i++)
{
    echo "<div id='collect_$i' class='collect'>";
    echo "<p class='rubric'>The collect for " . $days[$i] . "</p>";

    $collectfile = 'boiler/collect' . $i . '.txt';
    echo "<p class='boilerplate'>" . implode("</p><p class='boilerplate'", file($collectfile)) . "</p>";
    echo "</div>\n";
}
?>

<p class="rubric">The offering of prayer may continue with either Morning or Evening Prayer or conclude with either of the following:</p>

<p class="boilerplate">May our blessed Lady pray for us.<br/>May Saint Francis pray for us.<br/>May Saint Clare pray for us.<br/>May all the saints of the Third Order pray for us.<br/>May the holy angels watch over us and befriend us.<br/>May our Lord Jesus give us his blessing and his peace. <strong>Amen</strong></p>
<p class="rubric">or...</p>
<p class="boilerplate">The grace of our Lord Jesus Christ,<br/>the love of God,<br/>and the fellowship of the Holy Spirit<br/>be with us all evermore. <strong>Amen</strong>
  </body>
</html>
