<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location:../");
    }

    $userdata = $_SESSION["userdata"];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">Not voted</b>';
    }
    else{
        $status = '<b style="color:green">Voted</b>';


    }
?>

<html>
<head>
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>

   <style>
      #backbtn{
       padding: 5px;
       font-size: 15px;
       border-radius: 5px;
       background-color: blue;
       color: white;
       float: left;
       margin: 10px;
      }

      #logoutbtn{
        padding: 5px;
        font-size: 15px;
        border-radius: 5px;
        background-color: blue;
        color: white;
        float:right;
      }

      #Profile{
        background-color:white;
        width: 30%;
        padding: 10px;
        float: left;
      }

      #Group{
         background-color:white;
         width: 60%;
         padding: 10px;
         float: right;
      }

      #votebtn{
        padding: 5px;
       font-size: 15px;
       border-radius: 5px;
       background-color: blue;
       color: white;
       float: left;
      }

      #mainSection{
        padding: 10px;
      }

      #voted{
         padding: 5px;
       font-size: 15px;
       border-radius: 5px;
       background-color: blue;
       color: green;
       float: left;

      }

      .group-card {
        width: 200px;
        border: 1px solid #ccc;
        border-radius:10px;
        padding: 15px;
        margin: 15px;
        background:#fff;
        display: inline-block;
        text-align:right;
        vertical-align: top;
      }
      
      .group-card img {
        width:100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 10px;
        text-align:center;
      }

    


   </style>
   <div id="mainsection">
    <div id="headerSection">
    <a id="backbtn" href="../">Back</a>
    <a id="logoutbtn" href="logout.php">Logout</a>
    <h1>Online Voting System</h1>
    </div>
     <hr>
     
     
     <div id="mainpanel">

     <div id="Profile">
    <center> <img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center>
        <b>Name:</b> <?php echo $userdata['name'] ?><br><br>
        <b>Mobile:</b> <?php echo $userdata['mobile'] ?><br><br>
        <b>Address:</b> <?php echo $userdata['address'] ?><br><br>
        <b>Status:</b> <?php echo $userdata['status'] ?><br><br>

    </div>

    <div id="Group">
        <?php
        if($_SESSION['groupsdata']){
            for($i=0; $i<count($groupsdata); $i++){
                ?>
                <div   class="group-card">
                    <img  style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>"height="100" width="100">
                    <b>Group Name:</b> <?php echo $groupsdata[$i]['name']?><br><br>
                    <b>votes:</b> <?php echo $groupsdata[$i]['votes']?><br><br>
                    <form action="../api/vote.php"  method="POST">
                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']  ?>">
                        <?php
                            if($_SESSION['userdata']['status'] ==0){
                                ?>
                                    <input type="submit" name="votebtn" value="vote" id="votebtn">
                                <?php
                            }
                            else{
                                 ?>
                                    <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
                                <?php

                            }

                        ?>

                        
            </form>
            </div>
              <hr>
                <?php
            }
        } ?>
    
    

    </div>
    </div>

</body>
</html>