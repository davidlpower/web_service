<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>
            Current Sitting Room Data
        </title>
        <script type="text/javascript" src="/assets/jquery-1.8.3.js"></script>
    </head>
    <body style="font-family: Arial;border: 0 none;">
        <div id="container" style="width: 900px; margin: 0 auto;">
            <div id="table_title"><h1>List of Graphs</h1></div>
            Select Device: <select id="device" name="device">
                <?php
                foreach ($device as $key => $value) {
                    echo '<option value="' . $value['id'] . '">' . $value['nickname'] . '</option>';
                }
                ?>
            </select>

            <ul>
                <li><a href="/graph/record/">Full Record</a></li>
                <li>Daily Breakdown <a href="/graph/daily/">Bar</a> | <a href="/graph/dailyTimeLine/">Time Line</a></li>
                <li><a href="/graph/weekly/">Weekly Breakdown</a></li>
                <li><a href="/graph/monthly/">Monthly Breakdown</a></li>
            </ul>
        </div>
    </body>

</html>

<script>
    

        
        $('#device').change(function() {
            var device_id = this.val();
            $('body a').each(function(){
                console.log(this)
            })
        });
    

</script>