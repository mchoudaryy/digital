<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function fun_generateImpression($data)
{
        include("../config.php");
       
    echo "Total Sheets in this xls file: ".count($data->sheets)."<br /><br />";
    ?>
    <table width='100%' border='1px solid lightgrey' cellspacing='0' colspacing='0'>
        <tr align='center' style="font-weight: bold;">
            <td>Month-year</td>
            <td>Banner Size</td>
            <td>Country</td>
            <td>Impression</td>
            <td>CPM Rate</td>
            <td>Total</td>
        </tr>
    <?php
    
    for($i=0;$i<count($data->sheets);$i++) // *********( LOOP TO GET ALL SHEETS STARTS )********* 
    {    
        if(count($data->sheets[$i][cells])>0) // *********( CHECKING SHEET NOT EMPTY STARTS )********* 
        {
            echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count($data->sheets[$i][cells])."<br />";
            for($j=1;$j<=count($data->sheets[$i][cells]);$j++) // *********  (  LOOP TO GET EACH ROW OF SHEET STARTS )********* 
            {
                ?>
                    <tr valign='top' align='center'>
                        <td>
<?php                       echo $data->sheets[$i][cells][$j][1]; //DISPLAYING THE FIRST COLUMN OF THE SHEET ?>
                        </td>
                        <td>
<?php                       
                    //*****( IMPRESSION GENERATOR STARTS ) ******
                            $arr_bannerSizes = explode(",",$data->sheets[$i][cells][$j][2]);
                             $arr_countries = explode(",",$data->sheets[$i][cells][$j][3]);
?>                        
                            <table width='100%' border='1px solid lightgrey' cellspacing='0' colspacing='0'>
                                <tr valign='top' align='center'>
                                    <td>
                                        <?php 
                                            $_POST['month_number'.$i.$j] = date('m',strtotime($data->sheets[$i][cells][$j][1])); // GETTING THE MONTH NUMBER BY PASSING DATE FROM FIRST COLUMN OF SHEET
                                            $_POST['year'.$i.$j] = date('Y',strtotime($data->sheets[$i][cells][$j][1])); // GETTING THE YEAR BY PASSING DATE FROM FIRST COLUMN OF SHEET
                                            
                                           // echo $data->sheets[$i][cells][$j][1]."<br >";
                                            //echo date('Y-M-D',strtotime($data->sheets[$i][cells][$j][1]))."<br>";
                                            
                                            $_POST['totaldays'.$i.$j] =  date('t', mktime(0, 0, 0, $_POST['month_number'.$i.$j], 1, $_POST['year'.$i.$j])); // GETTING THE TOTAL DAYS OF A GIVEN MONTH/YEAR
                                       ?>
                                         <table>
                                        <?php
                                       if($_POST['totaldays'.$i.$j])
                                       {
                                        ?>
                                            <tr style='background-color:lightgrey;'>
                                                <td>Country </td>
                                                <td>Banner </td>
                                                <td>Day</td>
                                                <td>Impressions</td>
                                            </tr>
                                         <?php
                                    $_POST['impressions'.$i.$j] = str_replace( ',', '', $data->sheets[$i][cells][$j][4]); //IF THERE ARE ANY ' , ' THEY WILL GET REMOVED
                                         $arr_Impressionvalue = random_distributer_by_days($_POST['impressions'.$i.$j], $_POST['totaldays'.$i.$j]*count($arr_bannerSizes)*count($arr_countries));
                                            if(count($arr_Impressionvalue))
                                            {
                                                $days = 1;
                                                $int_countryFlag = 1;
                                                $Impressionvalue = 0;
                                                $int_bannerId = 0;
                                                $int_countryId = 0;
                                                $int_loopId = 1;
                                                foreach ($arr_Impressionvalue as $Impressionvalue) 
                                                {
                             ?>
                                                   <tr>
                                                    <td>
                                                        <?php echo $arr_bannerSizes[$int_bannerId]; //DISPLAY BANNER SIZES ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $arr_countries[$int_countryId]; //DISPLAY BANNER SIZES ?>
                                                    </td>
                                                   <td><?php echo $days; ?></td>
                             <?php
                                                    if($int_loopId == (count($arr_Impressionvalue)))
                                                    {
                                                       $_POST['final_totalimpressions'.$i.$j] = $_POST['total_dis_impressions'.$i.$j]+$Impressionvalue;
                                                       if($_POST['final_totalimpressions'.$i.$j] != $_POST['impressions'.$i.$j] )
                                                       {
                                                            $_POST['difference_bit'.$i.$j] = $_POST['final_totalimpressions'.$i.$j]-$_POST['impressions'.$i.$j];
                                                            $Impressionvalue = $Impressionvalue-($_POST['difference_bit'.$i.$j]);
                                                       }
                                                    }
                             ?>
                                                   <td><?php echo $Impressionvalue; ?></td>
                                                   </tr>
                             <?php 
                             $sql_insert = "INSERT INTO impressions (date,type_size,total_imp,cpm_rate,value,country) "
                                                . "VALUES('".$_POST['year'.$i.$j]."-".$_POST['month_number'.$i.$j]."-".$days."','".$arr_bannerSizes[$int_bannerId]."',"
                                                . "'".$Impressionvalue."','".$data->sheets[$i][cells][$j][5]."','"
                                                . "".$Impressionvalue*$data->sheets[$i][cells][$j][5]."','".$arr_countries[$int_countryId]."')";
//                                echo $sql_insert;
                                mysql_query($sql_insert,$con);
                            
                                                    $_POST['total_dis_impressions'.$i.$j] += $Impressionvalue;
                                                   if($_POST['totaldays'.$i.$j] == $days)
                                                   {
                                                       $days = 0;
                                                       $int_bannerId++;
                                                   }
                                                   if($int_countryFlag == ($_POST['totaldays'.$i.$j]*count($arr_bannerSizes)))
                                                   {
                                                       echo "countryflag-".$int_countryFlag;
                                                       $int_countryFlag = 0;
                                                       $int_bannerId = 0;
                                                       $int_countryId++;
                                                   }
                                                   $int_countryFlag++;
                                                   $days++;
                                                   $int_loopId++; //THIS ID IS USED TO CHECK THE LAST IMPRESSION AND MAKE CHANGES TO SATISFY THE TOTAL IMPRESSION
                                                }
                                                ?>
                                                    <tr>
                                                        <td><b>Total </b></td>
                                                        <td><b><?php echo  $_POST['total_dis_impressions'.$i.$j]; ?></b></td>
                                                    </tr>
<?php
                                            }
                                       }
                                        ?>
                                       
                                        </table>
                                    </td>
                                </tr>
                           </table>
<?php
                    
                    //*****( IMPRESSION GENERATOR ENDS ) ******
?>
                        </td>
                        <td>
<?php                       echo $data->sheets[$i][cells][$j][3]; //DISPLAYING THE THIRD COLUMN OF THE SHEET ?>
                        </td>
                        <td>
<?php                       echo $data->sheets[$i][cells][$j][4]; //DISPLAYING THE FOURTH COLUMN OF THE SHEET?>
                        </td>
                        <td>
<?php                       echo $data->sheets[$i][cells][$j][5]; //DISPLAYING THE FIFTH COLUMN OF THE SHEET?>
                        </td>
                        <td>
<?php                       echo $data->sheets[$i][cells][$j][6]; //DISPLAYING THE SIXTH COLUMN OF THE SHEET?>
                        </td>
                    </tr>
<?php                    
            }// *********  (  LOOP TO GET EACH ROW OF SHEET ENDS )********* 
        }// *********( CHECKING SHEET NOT EMPTY ENDS )********* 
    }// *********( LOOP TO GET ALL SHEETS ENDS )********* 
?>
   </table>
<?php

}
function random_distributer_by_days($total, $days) {
    $per_day = $total/$days;
    $min = ($per_day * 80)/100;
    $max = ($per_day * 120)/100;
    $random_values = array();
    for ($i = 0; $i < $days; $i++) {
        $random_values[] = randomFloat($min,$max);
    }
//     echo "val sum ".array_sum($random_values) .'</br>';
    $multiplying_factor = $total / array_sum($random_values);
//    foreach($random_values as $value) {
//        echo "val". $value .'</br>';
//    }
    $return_value = array();
    for ($i = 0; $i < $days; $i++) {
        $return_value[] = round($multiplying_factor * $random_values[$i]);
    }
    return $return_value;
}
function randomFloat($min , $max ) {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}