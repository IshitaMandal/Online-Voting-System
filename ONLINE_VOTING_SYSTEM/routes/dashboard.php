<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("location: ../");
}

$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];

if ($_SESSION['userdata']['status'] == 0) {
    $status = '<b style = "color:red">Not Voted</b>';
} else {
    $status = '<b style="color:green">Voted</b>';
}
?>
<html>

<head>
    <title>Online Voting System - Dashboard</title>
</head>

<body>

    <style>
        body {
            text-align: center;
            background: linear-gradient(to top left, #99ff99 0%, #ffff99 100%);
        }

        #backbutton {
            padding: 6px;
            margin: 15px;
            border-radius: 5px;
            font-size: 17px;
            width: 5%;
            background-color: #0984e3;
            color: white;
            float: left;

        }

        #logoutbutton {
            padding: 6px;
            margin: 15px;
            border-radius: 5px;
            font-size: 17px;
            width: 5%;
            background-color: #0984e3;
            color: white;
            float: right;
        }

        #profile {
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
        }

        #Group {
            background-color: white;
            width: 60%;
            padding: 20px;
            float: right;
        }

        #votebutton {
            padding: 6px;
            border-radius: 5px;
            font-size: 15px;
            width: 5%;
            background-color: #0984e3;
            color: white;
        }

        #mainPanel {
            padding: 10px;
            font-size: 20px;
        }

        #voted {
            padding: 6px;
            border-radius: 5px;
            font-size: 15px;
            width: 7%;
            background-color: darkgreen;
            color: white;

        }
    </style>

    <div id="mainSection">
        <center>
            <div id="headerSection">
                <a href="../"><button id="backbutton"> Back</button></a>
                <a href="logout.php"><button id="logoutbutton">Logout</button></a>
                <h1>Online Voting System</h1>
            </div>
        </center>
        <hr>

        <div id="mainPanel">
            <div id="Profile">
                <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center><br><br>
                <b>Name :</b> <?php echo $userdata['name'] ?><br><br>
                <b>Mobile :</b><?php echo $userdata['mobile'] ?><br><br>
                <b>Address :</b><?php echo $userdata['address'] ?><br><br>
                <b>Status :</b><?php echo $status ?><br><br>
            </div>
            <div id="Group">
                <?php
                if ($_SESSION['groupsdata']) {
                    for ($i = 0; $i < count($groupsdata); $i++) {
                ?>
                        <div>
                            <img style="float:right" src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100">
                            <b>Group Name :</b> <?php echo $groupsdata[$i]['name'] ?><br><br>
                            <b>Votes :</b> <?php echo $groupsdata[$i]['votes'] ?><br>
                            <form action="../api/vote.php" method="POST">
                                <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                                <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">

                                <?php
                                if ($_SESSION['userdata']['status'] == 0) {
                                ?>
                                    <input type="submit" name="votebutton" value="Vote" id="votebutton">
                                <?php
                                } else {
                                ?>
                                    <button disabled type="button" name="votebutton" value="Vote" id="voted">Voted</button>
                                <?php
                                }
                                ?>

                            </form>
                        </div>
                        <hr>
                <?php
                    }
                } else {
                }

                ?>
            </div>

        </div>

    </div>


</body>

</html>