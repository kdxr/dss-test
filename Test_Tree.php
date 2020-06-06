<form action="" method="post">

age :  
<select name = 'age'>  
  <option value="Select">Select</option>}  
  <option value="10-19">10-19</option>  
  <option value="20-29">20-29</option>  
  <option value="30-39">30-39</option>  
  <option value="40-49">40-49</option>  
  <option value="50-59">50-59</option>  
  <option value="60-69">60-69</option>  
  <option value="70-79">70-79</option>  
  <option value="80-89">80-89</option>
  <option value="90-99">90-99</option>    
</select><br><br>

menopause : 
<select name = 'menopause'>  
  <option value="Select">Select</option>}  
  <option value="lt40">lt40</option>  
  <option value="ge40">ge40</option>  
  <option value="premeno">premeno</option>  
</select><br><br>


tumor-size : 
<select name = 'tumor-size'>  
  <option value="Select">Select</option>}  
  <option value="0-4">0-4</option>  
  <option value="5-9">5-9</option>  
  <option value="10-14">10-14</option>
  <option value="15-19">15-19</option>  
  <option value="20-24">20-24</option>  
  <option value="25-29">25-29</option>
  <option value="30-34">30-34</option>  
  <option value="35-39">35-39</option>  
  <option value="40-44">40-44</option>
  <option value="45-49">45-49</option>  
  <option value="50-54">50-54</option>  
  <option value="55-59">55-59</option>        
</select><br><br>

inv-nodes :
<select name = 'inv-nodes'>  
  <option value="Select">Select</option>}  
  <option value="0-2">0-2</option>  
  <option value="3-5">3-5</option>  
  <option value="6-8">6-8</option>
  <option value="9-11">9-11</option>  
  <option value="12-14">12-14</option>  
  <option value="15-17">15-17</option>
  <option value="18-20">18-20</option>  
  <option value="21-23">21-23</option>  
  <option value="24-26">24-26</option>
  <option value="27-29">27-29</option>  
  <option value="30-32">30-32</option>  
  <option value="33-35">33-35</option>    
  <option value="36-39">36-39</option>      
</select><br><br>

node-caps : 
<select name = 'node-caps'>  
  <option value="Select">Select</option>}  
  <option value="yes">yes</option>  
  <option value="no">no</option>  
</select><br><br>

deg-malig :
<select name = 'deg-malig'>  
  <option value="Select">Select</option>}  
  <option value="1">1</option>  
  <option value="2">2</option>  
  <option value="3">3</option> 
</select><br><br>

breast :
<select name = 'breast'>  
    <option value="Select">Select</option>}  
    <option value="left">left</option>  
    <option value="right">right</option>  
</select><br><br>

breast-quad :
<select name = 'breast-quad'>  
  <option value="Select">Select</option>}  
  <option value="left_up">left_up</option>  
  <option value="left_low">left_low</option>  
  <option value="right_up">right_up</option>  
  <option value="right_low">right_low</option>  
  <option value="central">central</option>  
</select><br><br>

irradiat : 
<select name = 'irradiat'>  
  <option value="Select">Select</option>}  
  <option value="yes">yes</option>  
  <option value="no">no</option>  
</select><br><br>

  <input type="submit" name="submit"/>

</form>

<?php
if(isset($_POST['submit'])){
$age = $_POST['age'];
$menopause = $_POST['menopause'];
$tumor_size = $_POST['tumor-size'];
$inv_nodes = $_POST['inv-nodes'];
$node_caps = $_POST['node-caps'];
$deg_malig = $_POST['deg-malig'];
$breast = $_POST['breast'];
$breast_quad = $_POST['breast-quad'];
$irradiat = $_POST['irradiat'];

    echo 'ข้อมูลที่คุณป้อนของคุณคือ :'.$age.' '.$menopause.' '.$tumor_size.' '.$inv_nodes.' '.$node_caps.' '.$deg_malig.' '.$breast.' '.$breast_quad.' '.$irradiat.'<br><br>';

    //สร้างไฟล์ CSV
$data = array ('age,menopause,tumor-size,inv-nodes,node-caps,deg-malig,breast,breast-quad,irradiat,Class',
        '10-19,lt40,0-4,0-2,yes,1,left,left_up,yes,no-recurrence-events',
        '20-29,ge40,5-9,3-5,no,2,right,left_low,no,recurrence-events',
        '30-39,premeno,10-14,6-8,yes,3,right,right_up,no,?',
        '40-49,premeno,15-19,9-11,yes,3,right,right_low,no,?',
        '50-59,premeno,20-24,12-14,yes,3,right,central,no,?',
        '60-69,premeno,25-29,15-17,yes,3,right,left_up,no,?',
        '70-79,premeno,30-34,18-20,yes,3,right,left_up,no,?',
        '80-89,premeno,35-39,21-23,yes,3,right,left_up,no,?',
        '90-99,premeno,40-44,24-26,yes,3,right,left_up,no,?',
        '70-79,premeno,45-49,27-29,yes,3,right,left_up,no,?',
        '80-89,premeno,50-54,30-32,yes,3,right,left_up,no,?',
        '90-99,premeno,55-59,33-35,yes,3,right,left_up,no,?',
        '90-99,premeno,55-59,36-39,yes,3,right,left_up,no,?',
        $age.','.$menopause.','.$tumor_size.','.$inv_nodes.','.$node_caps.','.$deg_malig.','.$breast.','.$breast_quad.','.$irradiat.',?');
$fp = fopen('Tree.csv', 'w');
    foreach($data as $line){
        $val = explode(",",$line);
        fputcsv($fp, $val);
    }
    fclose($fp);

    //แปลง CSV เป็น arff
    $cmd = 'java -classpath "weka.jar" weka.core.converters.CSVLoader Tree.csv > Tree_Unseen.arff ';
    exec($cmd,$output);

    //แปลงข้อมูลให้เป็น Nominal
    $cmd2 = 'java -classpath "weka.jar" weka.filters.unsupervised.attribute.NumericToNominal -i Tree_Unseen.arff -o Tree_Unseen_Nomial.arff ';
    exec($cmd2,$output);

    //ทำ Model
    $cmd3 = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -x 20 -t "breast-cancer.arff" -d Tree.model';
    exec($cmd3,$output);

    //โหลด Model มาใช้
    $cmd4 = 'java -classpath "weka.jar" weka.classifiers.trees.J48 -l "Tree.model" -T Tree_Unseen_Nomial.arff -p 10';
    exec($cmd4,$output1);

    //แสดงผล
    $show = $output1[sizeof($output1)-2];
    echo $show."<br>";

    echo "ผลลัพธ์ที่ได้จากการทำนายคือ : ".substr($show,23,-5);

    $sum = substr($show,43);
    $test = $sum * 100;
    echo " คิดเป็น ".$test."%";


  }
?>