<!-- HEADER  -->
<?php require_once 'header.php'; ?>

<!-- BODY -->
<body>
    <!--  CONTENT -->
    <?php
        
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            require_once strtolower($page).'.php';
        }else{
            require_once 'database.php';
        }
    ?>

</body>
<!-- FOOTER -->
<?php require_once 'footer.php'; ?>