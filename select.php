<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style type="text/css">
    body {
	background-image: url(1511.jpg);
		background-size:cover;
	background-attachment:fixed;
}
    </style>
    
    
    
     <?php		
				 session_start();
	  							  function pre() {
						if($_SESSION['key']>0){
    						$_SESSION['key']-=10;
						}
				}
				function nex() {
						if($_SESSION['key']<$_SESSION['total']-10){
    						$_SESSION['key']+=10;
						}
				}
				 if (isset($_GET['hello1'])) {
    					pre();
  					}
				 if (isset($_GET['hello2'])) {
    					nex();
  				 }
				 
				 
				 
				 
				  if (isset($_GET['story'])) {
    					story();
  					}
				 if (isset($_GET['store'])) {
    					store();
  				 }
				  if (isset($_GET['news'])) {
    					news();
  					}
				 if (isset($_GET['review'])) {
    					review();
  				 } if (isset($_GET['que'])) {
    					que();
  					}
				 function story() {
    					unset($_SESSION['type']);
						$_SESSION['type']="บทความ";
				}
				function store() {
    					unset($_SESSION['type']);
						$_SESSION['type']="ขายของ";
				}
				function news() {
    					unset($_SESSION['type']);
						$_SESSION['type']="ข่าว";
				}
				function review() {
    					unset($_SESSION['type']);
						$_SESSION['type']="รีวิว";
				}
				function que() {
    					unset($_SESSION['type']);
						$_SESSION['type']="คำถาม";
				}
				
			     $connection= new MongoClient();
 				 $db= $connection->weblog;
  				 $collection=$db->forum;
				 $doc=array('doc_type'=>$_SESSION['type']);
 				 $cursor = $collection->find($doc);
				 $_SESSION['total']=$cursor->count();
				 $i=$_SESSION['key'];
				 
				 $j=0;
				 
				 $listtem[]=array();
				 $listIDtem[]=array();
				 $listTypetem[]=array();
				  unset($listtem);
				 unset($listIDtem);
				 unset($listTypetem);
				 foreach($cursor as $log){
					 $listtem[$j]=$log['name'];
					 $listIDtem[$j]=$log['_id'];
					 $listTypetem[$j]=$log['doc_type'];
					 $j++;
				 }
 
				 if(isset($_GET['search'])){
					 $listtem=array();
					 $listIDtem=array();
					 $listTypetem=array();
					  unset($listtem);
				 unset($listIDtem);
				 unset($listTypetem);
						$_SESSION['key']=0;
					 
					 echo '   <script type="text/javascript">
	$(document).ready(function(){
    	$("#p1").empty();
        $("#p2").empty();
        $("#p3").empty();
        $("#p4").empty();
        $("#p5").empty();
        $("#p6").empty();
        $("#p7").empty();
        $("#p8").empty();
        $("#p9").empty();
        $("#p10").empty();
		});
</script>';
				if(isset($_GET['q'])!=''){//Search
				
					$j=0;
 					$q=$_GET['q'];
 					$regex=array('name' => new MongoRegex("/$q/i"),'doc_type'=>$_SESSION['type']);//จะเหมือนกับคำสั่ง LIKE '%$q%'
 					$cursor = $collection->find($regex);//หมายถึง ให้เมธอด fine ค้นหา ตามคีย์เวิร์ดที่เป็นพารามิเตอร์
					$_SESSION['total']=$cursor->count();
					foreach($cursor as $log){
					 $listtem[$j]=$log['name'];
					 //echo $listtem[$j];
					 $listIDtem[$j]=$log['_id'];
					 $listTypetem[$j]=$log['doc_type'];
					 $j++;
				 }
					}
				 }

				 
				 
				 unset($list);
				 unset($listID);
				 unset($listType);
				 $t=0;
				 for($a=$j-1;$a>=0;$a--){
					 $list[$t]=$listtem[$a];
					 $listID[$t]=$listIDtem[$a];
					 $listType[$t]=$listTypetem[$a];
					 $t++;
				 }
				 
				 $i=$_SESSION['key'];
				 
				
					
 	?>
<title>Weblog</title>
</head>
<body>
<div align="center">
  <img  src="31344686_1704141333000568_3657415830821404672_n.png" width="100%" height="200" >
  </div>
 <br>
   <form name="eiei" method="get"> 
  <a href="index.php"  class="btn btn-primary" style="margin-left:560px">Home</a>
  <a href="create.php" class="btn btn-success" style="margin-left:30px" >สร้างกระทู้</a> 
&ensp;&ensp;&ensp; 
<a href="userhome.php?set=true" class="btn btn-info">User Home</a> &ensp;&ensp;&ensp;
<a href="alert.php" type="button" class="btn btn-primary"> แจ้งเตือน <span class="badge badge-light"><?php echo  $_SESSION['num'] ?></span> <span class="sr-only"></span></a>
&ensp;&ensp;&ensp;
<a href="profile.php" class="btn btn-light">Profile </a>
&ensp;&ensp;&ensp;
<a href="login.php" class="btn btn-dark">Logout </a>
 
 
  <br>
  <br>
  <br>
  <br>
  <h2 class="btn-light" style="padding:10px;border-radius:10px;border-style:solid;border-color:#000;margin-left:200px;margin-right:200px"><?php echo "ประเภท : ".$_SESSION['type']?></h2>
  <br>
  <br>
  <center >
  <label  for="q"></label><b style="color:#F00;">ค้นหาข้อมูล</b>
  <input type="text" name="q" id="q"  />
  <input type="submit" class="btn btn-light" name="search" id="search" value="ค้นหา" />
  </center> &ensp;&ensp;&ensp; &ensp;&ensp;&ensp; &ensp;&ensp;&ensp; &ensp;&ensp;&ensp; &ensp;&ensp;&ensp; &ensp;&ensp;
</P>
  <table width="1344" border="0">
  
    <tr>
      <td width="251">
      &ensp;<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script></td>
      <td width="744" valign="top">&ensp; &ensp;&ensp;&ensp; &ensp;&ensp;&ensp;
       <div id="p1" class="alert alert-primary" role="alert"><a href="look.php?set= <?php echo $listID[$i]."\"";?>><?php if(isset($list[$i])) {echo "  <".$listType[$i].">  ".$list[$i];} ?></a></div>
        <div id="p2" class="alert alert-secondary" role="alert"> <a href="look.php?set= <?php echo $listID[$i+1]."\"";?>><?php if(isset($list[$i+1])){echo "  <".$listType[$i+1].">  ".$list[$i+1];} ?></a></div>
        <div id="p3" class="alert alert-success" role="alert"><a href="look.php?set= <?php echo $listID[$i+2]."\"";?>><?php if(isset($list[$i+2])){echo "  <".$listType[$i+2].">  ".$list[$i+2];} ?></a></div>
        <div id="p4" class="alert alert-danger" role="alert"> <a href="look.php?set= <?php echo $listID[$i+3]."\"";?>><?php if(isset($list[$i+3])) {echo "  <".$listType[$i+3].">  ".$list[$i+3];} ?></a></div>
        <div id="p5" class="alert alert-warning" role="alert"> <a href="look.php?set= <?php echo $listID[$i+4]."\"";?>><?php if(isset($list[$i+4])) {echo "  <".$listType[$i+4].">  ".$list[$i+4];} ?></a></div>
        <div id="p6" class="alert alert-info" role="alert"> <a href="look.php?set= <?php echo $listID[$i+5]."\"";?>><?php if(isset($list[$i+5])) {echo "  <".$listType[$i+5].">  ".$list[$i+5];} ?> </a></div>
        <div id="p7" class="alert alert-light" role="alert"> <a href="look.php?set= <?php echo $listID[$i+6]."\"";?>><?php if(isset($list[$i+6])) {echo "  <".$listType[$i+6].">  ".$list[$i+6];} ?></a></div>
        <div id="p8" class="alert alert-dark" role="alert"> <a href="look.php?set= <?php echo $listID[$i+7]."\"";?>><?php if(isset($list[$i+7])) {echo "  <".$listType[$i+7].">  ".$list[$i+7];} ?></a></div>
        <div id="p9" class="alert alert-secondary" role="alert"> <a href="look.php?set= <?php echo $listID[$i+8]."\"";?>><?php if(isset($list[$i+8])) {echo "  <".$listType[$i+8].">  ".$list[$i+8];} ?></a></div>
      	<div id="p10" class="alert alert-success" role="alert"> <a href="look.php?set= <?php echo $listID[$i+9]."\"";?>><?php if(isset($list[$i+9])) {echo "  <".$listType[$i+9].">  ".$list[$i+9];} ?></a></div>
        </div>
        <table width="200" border="0" align="right">
          <tr>
            <td>
  <a href="select.php?hello1=true"  class="btn btn-primary" >ก่อนหน้า</a>
  <a href="select.php?hello2=true"  class="btn btn-primary" >ถัดไป</a>
  </form>
</nav></td>
          </tr>
        </table>
        <p>&nbsp;</p></td>
      <td width="70" valign="top"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
      <th width="261" valign="top">&ensp;       
       <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    	
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script></th>
    </tr>
  </table>
  <table width="200" border="0" align="right">
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table> 
  </div>
  <script>
  $(document).ready(function(){
    	if(document.eiei.getElementById("#p1").value==""){
			$("#p1").remove();
		}
		if(document.eiei.getElementById("#p2").value==""){
			$("#p2").remove();
		}
		if(document.eiei.getElementById("#p3").value==""){
			$("#p3").remove();
		}
		if(document.eiei.getElementById("#p4").value==""){
			$("#p4").remove();
		}
		if(document.eiei.getElementById("#p5").value==""){
			$("#p5").remove();
		}
		if(document.eiei.getElementById("#p6").value==""){
			$("#p6").remove();
		}
		if(document.eiei.getElementById("#p7").value==""){
			$("#p7").remove();
		}
		if(document.eiei.getElementById("#p8").value==""){
			$("#p8").remove();
		}
		if(document.eiei.getElementById("#p9").value==""){
			$("#p9").remove();
		}
		if(document.eiei.getElementById("#p10").value==""){
			$("#p10").remove();
		}
		});
  </script>
  </body>
</html>