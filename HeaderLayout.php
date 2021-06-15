
<?php
include 'class.user.php';
if(!isset($_SESSION)) session_start();
if (isset($_SESSION['user_session'])) {
    $user_id = $_SESSION['user_session'];
    $auth_user = new USER();
    $stmt = $auth_user->runQuery("SELECT * FROM client WHERE IDclient=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $auth_user->User_connecte($user_id);
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
}
include 'raccourciPanier.php';
$conn=ConnexionBD::getInstance();
?>
<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <title>Bienvenu Sur Notre Shop</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="web/css/slider.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="web/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="web/js/move-top.js"></script>
    <script type="text/javascript" src="web/js/easing.js"></script>
    <script type="text/javascript" src="web/js/startstop-slider.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="headertop_desc">
            <div class="call">
                <p><span>Need help?</span> call us <span class="number">+216 26 211 344</span></span></p>
            </div>
            <div class="account_desc">
                <ul>
                    <?php
                    if(isset($_SESSION['user_session']))
                    {
                        ?>
                        <label class="h5">welcome : <?php print($userRow['username']); ?></label>
                        <li><a href="/EspaceClient/services/profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Profile</a></li>

                        <li><a href="/EspaceClient/services/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</a></li>
                        <?php
                    }

                    else
                    {
                        ?>
                        <li><a href="/EspaceClient/services/sign-up.php">Sign Up</a></li>
                        <li><a href="/EspaceClient/services/profile.php">Sign In</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="header_top">
            <div class="logo">
            </div>
            <?php
            afficherPanier();

            ?>
            <script type="text/javascript">
                function DropDown(el) {
                    this.dd = el;
                    this.initEvents();
                }
                DropDown.prototype = {
                    initEvents : function() {
                        var obj = this;

                        obj.dd.on('click', function(event){
                            $(this).toggleClass('active');
                            event.stopPropagation();
                        });
                    }
                }
                $(function() {

                    var dd = new DropDown( $('#dd') );

                    $(document).click(function() {
                        // all dropdowns
                        $('.wrapper-dropdown-2').removeClass('active');
                    });

                });
            </script>
            <div class="clear"></div>
        </div>
        <div class="header_bottom">
            <div class="menu">
                <ul>
                    <li ><a href="index.php">Home</a></li>
                    <li ><a href="about.php">About us</a></li>
                    <li ><a href="delivery.php">Delivery</a></li>
                    <li ><a href="news.php">News</a></li>
                    <li ><a href="contact.php">Reclamation</a></li>
                    <div class="clear"></div>
                </ul>
            </div>

            <div class="search_box">
                <form action="search.php" method="get" >
                    <input type="text" id="keywordSearch"  name="keyword" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'search';}" ><input  type="submit" id="keywordSearch" onclick="search()" value="">
                </form>
            </div>
            <div class="clear"></div>
        </div>
    </div>
