<? include('includes/app_top.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?=$conf->SITE_TITLE?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="<?=$conf->DIR_CSS?>style.css"/>
        <?
        $views=array('pages','idea','getin');
        if(in_array($_GET['view'],$views))
            $view=$_GET['view'];
        else
            $view='pages';
        ?>
    </head>
    <body>
        <div id="create_new">
            <a class="close" href="javascript:void(0)" onclick="closeNew()">X</a>
            <div class="title">New Idea</div>
            <div class="form">
                <form action="javascript:void(0)" onsubmit="createIdea()">
                    <div class="f_title">Title</div>
                    <input type="text" id="title"/>
                    <div class="f_title">Description &uArr;<sup>optional</sup></div>
                    <textarea id="description" rows="5" cols="5"></textarea>
                    <input type="submit" value="Suggest It"/>
                </form>
            </div>
        </div>
        <div id="blackout"></div>
        <div id="content">
            <a href="<?=$conf->HTTP_SERVER_BASE?>"><img src="<?=$conf->DIR_IMG?>logo.jpg" alt="logo"/></a>
            <br clear="all"/>
            <div class="title fleft"><b>Improvements</b> Forum</div>
            <div class="get_in">
                <? if (!$session->check()) { ?>
                <a href="<?=$conf->LOGIN_URL?>">Log in</a> or <a href="<?=$conf->SIGNUP_URL?>">Sign up</a>
                    <? }else { ?>
                <a href="javascript:void(0)" onclick="logout()">Log out</a>
                    <? } ?>
            </div>
            <br clear="all"/>
            <div id="container">

                <?
                //here we put the stuff!
                include($view.'.php');
                ?>
            </div>
            <div id="footer">
                &copy;
                <?=date('Y')?> <a href="http://ajaxmasters.com">ajaxmasters.com</a>
            </div>
        </div>
        <!--scripts place yeeee-->
        <?
        if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
            ?>
        <script type="text/javascript">
            var HTTP_SERVER_BASE='<?=$conf->HTTP_SERVER_BASE?>';
        </script>
            <?
        }else {
            ?>
        <script type="text/javascript">
            var test=document.location.href.indexOf('www.');
            if (test != -1)
                var HTTP_SERVER_BASE='<?=$conf->HTTP_SERVER_BASE_JAVA?>';
            else
                var HTTP_SERVER_BASE='<?=$conf->HTTP_SERVER_BASE?>';
        </script>
            <?
        }
        ?>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="<?=$conf->DIR_JS?>jquery.string.js"></script>
        <script type="text/javascript" src="<?=$conf->DIR_JS?>script.js"></script>
        <!--end of scripts place-->
    </body>
</html>