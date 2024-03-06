<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header("location:php_pages/login.php");
	}elseif ($_SESSION['usertype'] == 'user') {
		header("location:php_pages/login.php");
	}

?>
<!DOCTYPE html>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<html>
<head>
<style>
body{
    background:#eee;
      font-family: Verdana;
}
.main-box.no-header {
    padding-top: 20px;
}
.main-box {
    background: #FFFFFF;
    -webkit-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -moz-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -o-box-shadow: 1px 1px 2px 0 #CCCCCC;
    -ms-box-shadow: 1px 1px 2px 0 #CCCCCC;
    box-shadow: 1px 1px 2px 0 #CCCCCC;
    margin-bottom: 16px;
    -webikt-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.table a.table-link.danger {
    color: #e74c3c;
}
.label {
    border-radius: 3px;
    font-size: 0.875em;
    font-weight: 600;
}
.user-list tbody td .user-subhead {
    font-size: 0.875em;
    font-style: italic;
}
.user-list tbody td .user-link {
    display: block;
    font-size: 1.25em;
    padding-top: 3px;
    margin-left: 60px;
}
a {
    color: #3498db;
    outline: none!important;
}
.user-list tbody td>img {
    position: relative;
    max-width: 50px;
    float: left;
    margin-right: 15px;
}

.table thead tr th {
    text-transform: uppercase;
    font-size: 0.875em;
}
.table thead tr th {
    border-bottom: 2px solid #e7ebee;
}
.table tbody tr td:first-child {
    font-size: 1.125em;
    font-weight: 300;
}
.table tbody tr td {
    font-size: 0.875em;
    vertical-align: middle;
    border-top: 1px solid #e7ebee;
    padding: 12px 8px;
}
a:hover{
text-decoration:none;
}
</style>
<link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="topnav">
    <a  href="Analytics.php">Analytics</a>
    <a  href="UserList.php">Users</a>
    <a href="Content.php">Content</a>
    <a href="#about">Settings</a>
    <a class="active" href="ApiTutorial.php">API</a>
    <div class="logout" style="float:right;">
		<a class=" color--yellow" href="php_pages/logout.php">Logout</a>
		</div>
  </div>
  <div class="topnav" style="background-color: #1ba96f;">
    <a  href="ApiTutorial.php">Overview</a>
    <a href="Events.php">Events</a>

  </div>

<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<hr>
<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table user-list">
                            <thead>
                                <tr>
                                                <th>&nbsp;</th>

                                <th><span>Function</span></th>
                                <th><span>Values</span></th>
                                <th ><span>Description</span></th>


                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                  <td class="text-center"><span class="label label-default">Set</span></td>
                                    <td><a href="http://54.88.122.65/kidsPlatform/backend/AddAnalyticsEvent.php?UserID=1&EventValue=sad&EventType=1&EventName=asd" >AddAnalyticsEvent<span class="user-subhead"></a></td>
                                    <td style="width: 30%;">UserID,EventValue,EventType,EventName,Platform</td>
                                    <td>Main call to add analytics event</td>
                                </tr>

                                <tr>
                                  <td class="text-center"><span class="label label-default">Get</span></td>
                                    <td><a href="http://54.88.122.65/kidsPlatform/backend/getContentData.php?All=1" >getContentData<span class="user-subhead"></a></td>
                                    <td style="width: 30%;">All,games,audiobooks,files,user_likes,Universe</td>
                                    <td>Gets info for selected type</td>
                                </tr>

                                <tr>
                                  <td class="text-center"><span class="label label-default">Get</span></td>
                                    <td><a href="http://54.88.122.65/kidsPlatform/backend/getLogin.php?username=admin&password=81dc9bdb52d04dc20036dbd8313ed055" >getLogin<span class="user-subhead"></a></td>
                                    <td style="width: 30%;">username, password (encrypted)</td>
                                    <td>Returns userdata if correct password</td>
                                </tr>

                                <tr>
                                  <td class="text-center"><span class="label label-default">Set</span></td>
                                    <td><a href="http://54.88.122.65/kidsPlatform/backend/getRegister.php?name=asdasd&username=asd&password=qwe&verifypass=qwe&email=asd@gmail.com&age=2020-05-15&usertype=user" >getRegister<span class="user-subhead"></a></td>
                                    <td style="width: 30%;">name, password, verifypass, email, age, usertype</td>
                                    <td>Creates a user on the platform</td>
                                </tr>

                                <tr>
                                  <td class="text-center"><span class="label label-default">Get</span></td>
                                    <td><a href="http://54.88.122.65/kidsPlatform/backend/getLike.php?username=14" >getLike<span class="user-subhead"></a></td>
                                    <td style="width: 30%;">username</td>
                                    <td>Get likes for user</td>
                                </tr>
                                <tr>
                                  <td class="text-center"><span class="label label-default">Set</span></td>
                                    <td><a href="http://54.88.122.65/kidsPlatform/backend/setLike.php?toadd=1&user_id=14&unique_id=Content_37" >setLike<span class="user-subhead"></a></td>
                                    <td style="width: 30%;">toadd ,user_id, unique_id </td>
                                    <td>Sets the content for the user to be liked</td>
                                </tr>

                                <tr>
                                  <td class="text-center"><span class="label label-default">Get</span></td>
                                    <td><a href="http://54.88.122.65/kidsPlatform/backend/getFeaturedItems.php" >getFeaturedItems<span class="user-subhead"></a></td>
                                    <td style="width: 30%;"> </td>
                                    <td>Get's the featured content for the platform</td>
                                </tr>




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




            <div class="main-box no-header clearfix">
                <div class="main-box-body clearfix">
                    <div class="table-responsive" style="margin-left:20px;">
                      <h1>How to use:<br></h1>


                    1. Download Unity plugin from <a href="asd">here</a><br>
                    2. Import and call EUKIDS.instance.Init() on startup.<br>
                    3. When importing the EUKIDS SDK analytics is automatically added.<br>
                    4. Here are the standar events tracked:<br>
                    <p><div style="font-size: 20px; margin-left:30px;">AppStarted <br>AppActivated<br> AppQuit<br> OpenOtherApp<br> OpenVideo<br> OpenAudioBook<br> OpenPlayStory<br> CloseOtherApp<br> CloseVideo<br> CloseAudioBook<br> ClosePlayStory<br> StartTrial<br> StartSubscribe</div> </p>
                    5. Add EU kids login to app


                    </div>
                </div>
            </div>





        </div>
    </div>

</div>






</body>
