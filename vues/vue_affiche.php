 <div class="col-md-3">
                         <div class="card mb-3 box-shadow bg-light">
                             <img class="card-img-top" src="application/jpg/<?php echo str_replace(".pdf", ".jpg", $tab[$i]['fichier']);?>" >
                                 <div class="card-body">
                                     <p class="card-text"><?php echo $tab[$i]['titre'];?> </p>
                                     <small class="text-muted"><?php echo $tab[$i]['dtjournal'];?></small>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">

                                                 <button type="button" class="btn btn-sm btn-outline-primary" onclick="window.open('<?php echo "http://www.saint-junien.fr/wp-content/themes/dt-the7-child/pdf/".$tab[$i]['fichier'];?>')">PDF</button>
                                                 <button class="btn btn-sm btn-outline-danger"  id="visualiser" onclick="get_Modallong(<?php echo $tab[$i]['id'];?>)"> visualiser</button>
                                            </div>

                                        </div>
                                 </div>
                         </div>
</div>

