<!DOCTYPE html>
<html>
  <head>
    <?php include "../../dbconnect.php" ?> <!-- Major를 불러오기위해서 php통신 필요 -->
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <style>
      body {
      margin: 0;
      padding: 0;
      }
      * {
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      }
      .page {
      width: 21.6cm;
      min-height: 28cm;
      padding: 1cm;
      margin: 0 auto;
      background:#107CBF;
      }
      .subpage {
      background:#F7F7F7;   
      height: 277mm;
      position: relative;
      }

      @page {
      size: A4;
      margin: 0;
      }
      @media print {
      html, body {
      width: 216mm;
      height: 280mm;
      }
      .page {
      margin: 0;
      border: initial;
      width: initial;
      min-height: initial;
      box-shadow: initial;
      background: initial;
      page-break-after: always;
      }

      
      }
    </style>
  </head>
  <body>
    <div>
        <div class="page">
            <div class="subpage">
              <div style="width:100%;position: absolute;top: 0;left: 0; ">
                  <div id="topmenu" style="text-align: center;width: 100%;">
                      <span style="display: block;font-size: 140%;">Midwest University</span>
                      <span style="display: block;font-weight: bold;font-size: 130%;">Office of Academic Affairs</span>
                      <span style="display: block;font-size: 100%;">851 Parr Road, Wentzville, 63385,MO</span>
                      <span style="display: block;font-size: 100%;">Tel : 314 - 295 - 0209, http://midwest.edu</span>
                      <span style="display: block;font-weight: bold;font-size: 130%;">Official Transcript of Academic Record</span>
                  </div>
                  <div id="information" style="margin:auto;text-align:center;width: 90%;height:30mm;border: 1px solid #95989A;margin-top: 3mm">
                      <?php  
                        $Student_idx=$_POST["Student"];
                  
                        $sql="select student.*, MajorName from student join major on student.Major =major.idx where student.idx='".$Student_idx."'";
                        $result=$conn->query($sql);
                        
                        $StudentNumber="";
                        $FirstName="";
                        $LastName="";
                        $MajorName="";
                        $Level="";

                        if($result->num_rows>0){
                          while($row=$result->fetch_assoc()){
                            $StudentNumber=$row["StudentNumber"];
                            $FirstName=$row["FirstName"];
                            $LastName=$row["LastName"];
                            $MajorName=$row["MajorName"];
                            $Level=$row["Level"];
                          }
                        }else{
                          echo "0 result";
                        }
                        
                      ?>
                      <div style="text-align: left;padding: 3mm">
                          <span style="display: block;font-size: 100%;padding-top: 2px;">
                            <?php
                              echo "* Name : ".$FirstName." ".$LastName;
                            ?>
                          </span>
                          <span style="display: block;font-size: 100%;padding-top: 2px;">
                            <?php
                              echo "* StudentNumber : ".$StudentNumber;
                            ?>
                          </span>
                          <span style="display: block;font-size: 100%;padding-top: 2px;">
                            <?php
                              echo "* Major : ".$MajorName;
                            ?>
                          </span>
                          <span style="display: block;font-size: 100%;padding-top: 2px;">
                            <?php
                              echo "* Level : ".$Level;
                            ?>
                          </span>
                      </div>
                      
                  </div>
                  <div id="big_box" style="width: 90%;height:170mm;border: 1px solid #95989A;margin: auto;">
                    <table frame="below" class="inner_table" style="width: 100%">
                        <thead>
                          <tr>
                            <th>Semester</th>
                            <th>Subject Name</th>
                            <th>Credit</th>
                            <th>Grade</th>
                            <td></td>
                          </tr>
                        </thead>
                        <tbody id="upper_table_contents">
                          <?php 
                            $sql="select Semester from semester_student where Student='".$Student_idx."'";
                            $result=$conn->query($sql);
                            

                            $TOTAL_GRADE=NULL;
                            $TOTAL_CREDIT=NULL;
                            $TOTAL_ROW_NUM=NULL;

                            if($result->num_rows>0){
                              while($row=$result->fetch_assoc()){
                                
                                $inner_sql="select semester.SemesterName,subject.Name,subject.Credit,students_lecture.Grade from students_lecture join semester on semester.idx=students_lecture.Semester join subject on subject.idx=students_lecture.Subject where students_lecture.Semester=".$row["Semester"]." and students_lecture.Student=".$Student_idx;
                                
                                $inner_result=$conn->query($inner_sql);
                                

                                $SEMESTER_GRADE=NULL;
                                $SEMESTER_CREDIT=NULL;
                                $SEMESTER_ROW_NUM=mysqli_num_rows($inner_result);

                                $TOTAL_ROW_NUM+=$SEMESTER_ROW_NUM;

                                if ($inner_result->num_rows>0) {
                                  
                                  $i=0;

                                  while ($inner_row=$inner_result->fetch_assoc()) {
                                    if($i==0){
                                      echo "<tr><th>".$inner_row['SemesterName']."</th><th>".$inner_row["Name"]."</th><th>".$inner_row["Credit"]."</th><th>".$inner_row["Grade"]."</th></tr>";
                                      $i++;
                                    }else{
                                      echo "<tr><th></th><th>".$inner_row["Name"]."</th><th>".$inner_row["Credit"]."</th><th>".$inner_row["Grade"]."</th></tr>";
                                    }

                                    $SEMESTER_CREDIT+=$inner_row["Credit"];
                                    $TOTAL_CREDIT+=$inner_row["Credit"];

                                    if ($inner_row["Grade"]=="null") {
                                      $SEMESTER_GRADE+=0.0;
                                    }else{
                                      $SEMESTER_GRADE+=transfer_grade($inner_row["Grade"]); 
                                      $TOTAL_GRADE+=transfer_grade($inner_row["Grade"]);
                                    }
                                    
                                  }
                                  echo "<tr><th></th><th>Semester Credit : ".$SEMESTER_CREDIT." &nbsp;&nbsp;Semester Grade : ".transfer_dot($SEMESTER_GRADE/$SEMESTER_ROW_NUM)."</th><th></th><th></th></tr>";
                                }
                              }
                              echo "<tr><th></th><th></th><th></th><th></th></tr>";
                              echo "<tr><th></th><th>Total Credit : ".$TOTAL_CREDIT." &nbsp;&nbsp;Total Grade : ".transfer_dot($TOTAL_GRADE/$TOTAL_ROW_NUM)."</th><th></th><th></th></tr>";

                            }else{
                              echo "0 result";
                            }
                          ?>
                        </tbody>
                      </table>
                  </div>
                  <div id="small_box" style="width: 90%;height:30mm;border: 1px solid #95989A;margin: auto;">
                    
                  </div>
              </div> 
              <img style="position: absolute;top: 5mm;left: 5mm;width: 35mm; z-index:1" src="../../MainLogo.png"></img>    
            </div>
            
        </div>
    </div>
  </body>
  <?php
  function transfer_grade($grade){
    switch ($grade){
      case "A":
        return 4.0;
      case "A-":
        return 3.75;
      case "B+":
        return 3.25;
      case "B":
        return 3.0;
      case "B-":
        return 2.75;
      case "C+":
        return 2.25;
      case "C":
        return 2.0;
      case "C-":
        return 1.75;
      case "D":
        return 1.0; 
      case "F":
        return 0.0;
    }
  }

  function transfer_dot($value){
    $value=(int)($value*100);
    $value=((double)$value)/100;
    return $value;
  }
?>
</html>