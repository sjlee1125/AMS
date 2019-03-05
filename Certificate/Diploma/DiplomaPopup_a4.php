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
      width: 21cm;
      min-height: 29.7cm;
      padding: 2cm;
      margin: 0 auto;
      border: 1px solid #95989A;
      }
      .subpage {
      /*background:#F7F7F7;   */
      height: 257mm;
      position: relative;
      }

      @page {
      size: A4;
      margin: 0;
      }
      @media print {
      html, body {
      width: 210mm;
      height: 297mm;
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
            <div class="subpage" >
              <div style="width:100%;position: absolute;top: 0;left: 0; ">
                  <div id="topmenu" style="text-align: center;width: 100%;">
                      <span style="display: block;font-weight: bold;font-size: 210%;">Midwest University</span>
                      <span style="display: block;font-size: 100%;">851 Parr Road, Wentzville, 63385,MO</span>
                      <span style="display: block;font-size: 100%;">Tel : 314 - 295 - 0209, http://midwest.edu</span>
                      
                  </div>
                  <div style="width:100%;text-align: right;margin-top: 10mm">
                    <?php $today = date("F j, Y"); echo "Date Issued : ".$today;  ?>
                  </div>
                  <div style="width:100%;text-align: center;margin-top: 5mm;font-size: 150%">
                    CERTIFICATE OF GRADUATION
                  </div>
                  
                  <div id="information" style="margin:auto;text-align:left;width: 60%;height:90mm;margin-top: 3mm">
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
                      <span style="display: block;font-size: 120%;padding-top: 4px;">
                         <?php
                          echo "Full Name : ".$FirstName." ".$LastName;
                        ?>
                      </span>
                      <span style="display: block;font-size: 120%;padding-top: 4px;">
                         <?php
                          echo "StudentNumber : ".$StudentNumber;
                         ?>
                      </span>
                      <span style="display: block;font-size: 120%;padding-top: 4px;">
                         <?php
                          echo "Major : ".$MajorName;
                         ?>
                      </span>
                      <span style="display: block;font-size: 120%;padding-top: 4px;">
                        <?php
                          echo "Level : ".$Level;
                        ?>
                      </span>
                  </div>
                  <div style="width:100%;font-weight:bold;text-align: right;padding-right:20mm;margin-top: 30mm;font-size: 200%">
                    Signature
                  </div>
                  <div style="width:100%;font-weight:bold;text-align: right;margin-top: 5mm;font-size: 100%">
                    Associate Vice President for Academic Affair
                  </div>
                  
                  
              </div> 
              <img style="opacity:0.6;position: absolute;top: 100mm;left: 50mm;width: 70mm; z-index:1" src="../../MainLogo.png"></img>    
              </div>       
        </div>
    </div>
  </body>
</html>