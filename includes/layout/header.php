<html>
<head>
    <title><?= isset($title)?$title:""; ?></title>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/reset.css"/>
</head>
<body>
    <header id="header">
        <form action="index.php" method="GET"> 
            <nav id="nav">
                <?php if(isset($_GET['page'])): ?>

                    <?php if($_GET['page'] == "HOME"):?>
                        <input name="page" type="submit" value="HOME" class="selected"/>
                    <?php else: ?>
                        <input name="page" type="submit" value="HOME"/>
                    <?php endif; ?>


                    <?php if($_GET['page'] == "ABOUT"):?>
                        <input name="page" type="submit" value="ABOUT" class="selected"/>
                    <?php else: ?>
                        <input name="page" type="submit" value="ABOUT"/>
                    <?php endif; ?>


                    <?php if($_GET['page'] == "DATABASE"):?>
                        <input name="page" type="submit" value="DATABASE" class="selected"/>
                    <?php else: ?>
                        <input name="page" type="submit" value="DATABASE"/>
                    <?php endif; ?>

                <?php else: ?>
                    <input name="page" type="submit" value="HOME"/>
                    <input name="page" type="submit" value="ABOUT"/>
                    <input name="page" type="submit" value="DATABASE" class="selected"/>
                <?php endif; ?>

            </ul>
        </nav>
    </form>
    <div id="logo">
        <img src="img/logo.png">
    </div>
</header>