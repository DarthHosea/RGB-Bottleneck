 <!-- Modal For Deleting -->
 <div class="modal fade modal-black" id="exampleModal<?php echo $post_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Potvrda brisanja</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                     <i class="tim-icons icon-simple-remove"></i>
                 </button>
             </div>
             <div class="modal-body">
                 Jeste li sigurni da želite obrisati ovu objavu?
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                 <a href="admin-posts.php?delete=<?php echo $post_id ?>"><button type="button" class="btn btn-primary">Izbriši</button></a>


             </div>
         </div>
     </div>
 </div>
 <!-- Modal For Editing -->
 <div class="modal fade modal-black" id="exampleModal1<?php echo $post_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg " role="document" style="vertical-align: top;">
         <div class=" modal-content">
             <div class=" modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Promjene u objavi</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                     <i class="tim-icons icon-simple-remove"></i>
                 </button>
             </div>
             <div class="modal-body">

                 <div class="card-body">
                     <form>


                         <div class="form-group">
                             <label for="exampleInputEmail1">Naslov objave</label>
                             <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $post_title ?>">

                         </div>
                         <div class="form-group">
                             <label for="exampleInputPassword1">Sadržaj objave</label>
                             <textarea name="post_content" class="form-control" id="post_content" rows="7" required oninvalid="this.setCustomValidity('Unesite sadržaj objave!')" oninput="this.setCustomValidity('')"><?php echo $post_content ?></textarea>

                         </div>
                         <div class="form-group">
                             <label for="inputState">Proizvođač: &nbsp;</label>
                             <div class="form-check form-check-radio form-check-inline">
                                 <label class="form-check-label">
                                     <?php
                                        if ($manufacturer == 'AMD') {
                                        ?>
                                         <input class="form-check-input" type="radio" name="manufacturer" id="inlineRadio1" value="AMD" checked> AMD
                                         <span class="form-check-sign"></span>

                                     <?php
                                        } else {
                                        ?>
                                         <input class="form-check-input" type="radio" name="manufacturer" id="inlineRadio1" value="AMD"> AMD
                                         <span class="form-check-sign"></span>

                                     <?php
                                        }
                                        ?>

                                 </label>
                             </div>
                             <div class="form-check form-check-radio form-check-inline">
                                 <label class="form-check-label">
                                     <?php
                                        if ($manufacturer == 'Nvidia') {
                                        ?>
                                         <input class="form-check-input" type="radio" name="manufacturer" id="inlineRadio2" value="Nvidia" checked> Nvidia
                                         <span class="form-check-sign"></span>
                                     <?php
                                        } else {
                                        ?>
                                         <input class="form-check-input" type="radio" name="manufacturer" id="inlineRadio2" value="Nvidia"> Nvidia
                                         <span class="form-check-sign"></span>
                                     <?php
                                        }
                                        ?>
                                 </label>
                             </div>
                             <div class="form-check form-check-radio form-check-inline">
                                 <label class="form-check-label">
                                     <?php
                                        if ($manufacturer == 'Intel') {
                                        ?>
                                         <input class="form-check-input" type="radio" name="manufacturer" id="inlineRadio3" value="Intel" checked> Intel
                                         <span class="form-check-sign"></span>
                                     <?php
                                        } else {
                                        ?>
                                         <input class="form-check-input" type="radio" name="manufacturer" id="inlineRadio3" value="Intel"> Intel
                                         <span class="form-check-sign"></span>
                                     <?php
                                        }
                                        ?>
                                 </label>
                             </div>
                         </div>
                         <div class="form-group">

                             <?php
                                $sqlCatName = "SELECT * FROM categories WHERE cat_id = ?";
                                $stmtCatName = $conn->prepare($sqlCatName);
                                $stmtCatName->bind_param("i", $post_category_id);
                                $stmtCatName->execute();
                                $catName = $stmtCatName->get_result(); // get the mysqli result

                                while ($row1 = mysqli_fetch_assoc($catName)) {

                                    $cat_title = $row1["cat_title"];
                                    $cat_id = $row1["cat_id"];
                                }

                                ?>
                             <label for="inputState">Kategorija ( Trenutna kategorija: <?php echo $cat_title ?>)</label>
                             <select id="inputState" class="form-control" name="category">

                                 <?php
                                    $sql1 = "SELECT * FROM categories"; // SQL with parameters
                                    $stmt1 = $conn->prepare($sql1);

                                    $stmt1->execute();
                                    $result1 = $stmt1->get_result(); // get the mysqli result
                                    $user1 = $result1->fetch_assoc(); // fetch data 
                                    while ($row1 = mysqli_fetch_assoc($result1)) {

                                        $cat_title = $row1["cat_title"];
                                        $cat_id = $row1["cat_id"];

                                    ?>

                                     <option value=<?php echo $cat_id  ?>><?php echo $cat_title ?></option>

                                 <?php
                                    }

                                    ?>



                             </select>
                         </div>
                         <div class="form-group ">
                             <label for="inputState">Status</label>
                             <select id="inputState" class="form-control" name="category">
                                 <?php
                                    if ($post_status == 'Forbidden') {
                                    ?>
                                     <option value="Forbidden">Zabranjen</option>
                                     <option value="Posted">Objavljen</option>


                                 <?php
                                    } else {
                                    ?>
                                     <option value="Posted">Objavljen</option>
                                     <option value="Forbidden">Zabranjen</option>


                                 <?php
                                    }


                                    ?>

                             </select>
                         </div>
                     </form>
                 </div>

             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
                 <a href="admin-posts.php?delete=<?php echo $post_id ?>"><button type="button" class="btn btn-primary">Spremi promjene</button></a>


             </div>
         </div>
     </div>
 </div>