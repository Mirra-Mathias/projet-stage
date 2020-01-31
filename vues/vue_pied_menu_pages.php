<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <a class="page-link" aria-label="Previous" onclick="includeGET('page=<?php echo  $_GET['page']-20; ?>')">
            <span aria-hidden="true">&laquo;&laquo;</span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="page-link" aria-label="Previous" onclick="includeGET('page=<?php echo  $_GET['page']-10; ?>')">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
        </a>

        <?php


        if($total/$_GET['nb']<8) {
            for ($i = 1; $i <= float_page($total/$_GET['nb']); $i++) {
                if ($i == $_GET['page']) {
                    ?>
                    <li class="page-item active"><a class="page-link active"
                                                    onclick="includeGET('page=<?php echo $_GET['page']; ?>')"><?php echo $_GET['page']; ?>
                        <span class="sr-only">(current)</span></a></li><?php
                } else {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             onclick="includeGET('page=<?php echo $i; ?>')"><?php echo $i; ?></a>
                    </li><?php
                }
            }
        }

        else if($total/$_GET['nb']-3<$_GET['page']) {
            for ($i =  float_page($total/$_GET['nb']-7); $i<= float_page($total/$_GET['nb']); $i++){
                if($i == $_GET['page']){
                    ?><li class="page-item active" ><a class="page-link active" onclick="includeGET('page=<?php echo  $_GET['page']; ?>')"><?php echo $_GET['page']; ?> <span class="sr-only">(current)</span></a></li><?php
                }else{
                    ?><li class="page-item" ><a class="page-link" onclick="includeGET('page=<?php echo  $i; ?>')"><?php echo $i; ?></a></li><?php
                }
            }


        }elseif($_GET['page']<4){
            for ($i = 1; $i<8; $i++){
                if($i == $_GET['page']){
                    ?><li class="page-item active" ><a class="page-link active" onclick="includeGET('page=<?php echo  $_GET['page']; ?>')"><?php echo $_GET['page']; ?> <span class="sr-only">(current)</span></a></li><?php
                }else{
                    ?><li class="page-item" ><a class="page-link" onclick="includeGET('page=<?php echo  $i; ?>')"><?php echo $i; ?></a></li><?php
                }
            }
        }
        elseif($_GET['page']> 3){
            for ($i = $_GET['page']-3; $i<$_GET['page']; $i++){
                ?><li class="page-item" ><a class="page-link" onclick="includeGET('page=<?php echo  $i; ?>')"><?php echo $i; ?></a></li><?php
            }

            ?><li class="page-item active" ><a class="page-link active" onclick="includeGET('page=<?php echo  $_GET['page']; ?>')"><?php echo $_GET['page']; ?> <span class="sr-only">(current)</span></a></li><?php

            for ($i = $_GET['page']+1; $i<$_GET['page']+4; $i++){
                ?><li class="page-item" ><a class="page-link" onclick="includeGET('page=<?php echo  $i; ?>')"><?php echo $i; ?></a></li><?php
            }

        }


        ?>

        <li class="page-item">
            <a class="page-link" aria-label="Next" onclick="includeGET('page=<?php echo  $_GET['page']+10; ?>')">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" aria-label="Next" onclick="includeGET('page=<?php echo  $_GET['page']+20; ?>')">

                <span aria-hidden="true">&raquo;&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>