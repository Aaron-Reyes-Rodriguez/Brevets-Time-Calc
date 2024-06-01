<html>
    <head>
        <title>ACP TIMES</title>
    </head>

    <body>
        <h1>List of ACP times (Scroll to right to see all)</h1>
        <h2>listAll</h2>
        <div class="row">
        <div class="col-md-12"> 
        <table class="control_time_table">
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listAll');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
         </tr>
        </table>
        <h2>listAll?top=0</h2>
        <div class="row">
        <div class="col-md-12"> 
        <table class="control_time_table">
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listAll?top=0');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
         </tr>
        </table>
        <h2>listAll?top=3</h2>
        <div class="row">
        <div class="col-md-12"> 
        <table class="control_time_table">
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listAll?top=3');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
         </tr>
        </table>
    </body>
    <!--Open only-->
    <body>
        <h2>listOpenOnly</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listOpenOnly');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                    </td>";
               }
            }
            ?>
            </tr>
        </table>

        <h2>listOpenOnly?top=0</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listOpenOnly?top=0');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                    </td>";
               }
            }
            ?>
            </tr>
        </table>
        <h2>listOpenOnly?top=3</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listOpenOnly?top=3');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                    </td>";
               }
            }
            ?>
            </tr>
        </table>
        </body>
        <!--Close only-->
        <body> 
        <h2>listCloseOnly</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listCloseOnly');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
        </tr>
        </table>
        <h2>listCloseOnly?top=0</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listCloseOnly?top=0');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
        </tr>
        </table>
        <h2>listCloseOnly?top=3</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listCloseOnly?top=3');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
        </tr>
        </table>
    </body>
    <body> 
        <!--ALL CSV--> 
        <h2>listAll/csv</h2>  
            <?php
            $json = file_get_contents('http://brevet_api/listAll/csv');
            $obj = json_decode($json);
            $obj = nl2br($obj);
            echo "<h4>".$obj."<h4>";  
            ?>
         <h2>listAll/csv?top=0</h2>  
            <?php
            $json = file_get_contents('http://brevet_api/listAll/csv?top=0');
            $obj = json_decode($json);
            $obj = nl2br($obj);
            echo "<h4>".$obj."<h4>";  
            ?>
         <h2>listAll/csv?top=3</h2>  
            <?php
            $json = file_get_contents('http://brevet_api/listAll/csv?top=3');
            $obj = json_decode($json);
            $obj = nl2br($obj);
            echo "<h4>".$obj."<h4>";  
            ?>
        <!--Open ONLY CSV-->
        <h2>listOpenOnly/csv</h2>  
            <?php
            $json = file_get_contents('http://brevet_api/listOpenOnly/csv');
            $obj = json_decode($json);
            $obj = nl2br($obj);
            echo "<h4>".$obj."<h4>";
            ?>
         <h2>listOpenOnly/csv?top=0</h2>  
            <?php
            $json = file_get_contents('http://brevet_api/listOpenOnly/csv?top=0');
            $obj = json_decode($json);
            $obj = nl2br($obj);
            echo "<h4>".$obj."<h4>";  
            ?>
        <h2>listOpenOnly/csv?top=3</h2>  
            <?php
            $json = file_get_contents('http://brevet_api/listOpenOnly/csv?top=3');
            $obj = json_decode($json);
            $obj = nl2br($obj);
            echo "<h4>".$obj."<h4>";  
            ?>
        <!--CLOSE ONLY CSV-->
        <h2>listCloseOnly/csv</h2>  
            <?php
            $json = file_get_contents('http://brevet_api/listCloseOnly/csv');
            $obj = json_decode($json);
            $obj = nl2br($obj);
            echo "<h4>".$obj."<h4>";
            ?>   
        <h2>listCloseOnly/csv?top=0</h2>  
            <?php
            $json = file_get_contents('http://brevet_api/listCloseOnly/csv?top=0');
            $obj = json_decode($json);
            $obj = nl2br($obj);
            echo "<h4>".$obj."<h4>";
            ?>
        <h2>listCloseOnly/csv?top=6</h2>  
            <?php
            $json = file_get_contents('http://brevet_api/listCloseOnly/csv?top=6');
            $obj = json_decode($json);
            $obj = nl2br($obj);
            echo "<h4>".$obj."<h4>";
            ?>
        </body>
        <body>
        <h2>listAll/json</h2>
        <div class="row">
        <div class="col-md-12"> 
        <table class="control_time_table">
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listAll/json');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
         </tr>
        </table>
        <h2>listAll/json?top=0</h2>
        <div class="row">
        <div class="col-md-12"> 
        <table class="control_time_table">
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listAll/json?top=0');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
         </tr>
        </table>
        <h2>listAll/json?top=3</h2>
        <div class="row">
        <div class="col-md-12"> 
        <table class="control_time_table">
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listAll/json?top=3');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
         </tr>
        </table>
    </body>
    <!--Open only-->
    <body>
        <h2>listOpenOnly/json</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listOpenOnly/json');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                    </td>";
               }
            }
            ?>
            </tr>
        </table>

        <h2>listOpenOnly/json?top=0</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listOpenOnly/json?top=0');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                    </td>";
               }
            }
            ?>
            </tr>
        </table>
        <h2>listOpenOnly/json?top=5</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listOpenOnly/json?top=5');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Open = {$c['open']}</li>
                    </td>";
               }
            }
            ?>
            </tr>
        </table>
        </body>
        <!--Close only-->
        <body> 
        <h2>listCloseOnly/json</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listCloseOnly/json');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
        </tr>
        </table>
        <h2>listCloseOnly/json?top=0</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listCloseOnly/json?top=0');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
        </tr>
        </table>
        <h2>listCloseOnly/json?top=4</h2>
        <div>
        <div> 
        <table>
        <tr>
        <th style="text-align: center;">Brevet</th>
        <th style="text-align: center;">Start date</th>
        <th style="text-align: center;">Start time</th>
        <th style="text-align: center;">Controls</th>
            </tr>
            <?php
            $json = file_get_contents('http://brevet_api/listCloseOnly/json?top=4');
            $obj = json_decode($json, TRUE);
            $value = $obj['brevets'];
            foreach ($value as $v) { 
               
               echo "<tr><td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['distance']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_date']} </td>
                    <td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'> {$v['begin_time']} </td>";
               //echo "<h3> Controls:</h3>";
               foreach($v['controls'] as $c) {
               echo "<td nowrap style='padding: 10px; font-size: large; border: 1px solid black;'>
                        <li>Close = {$c['close']}</li> 
                    </td>";
               }
            }
            ?>
        </tr>
        </table>
    </body>
</html>