<?php
            if(isset($_SESSION['uname']))
            {
                echo '<br><button type="button" name="makeclaim" id="makeclaim" class="btn mt-2 btn-success">Make Claim(s)</button>';
               }   ?>
                <div id="claims" style="display: none">
                    <h4 class="text-center p-2 mt-2" >Submit Claims</h4>
                    <form action="document.php" method="post" class="p-2">
                        <input type="hidden" name="document" value="<?php echo $searchstring;?>">
                        <div class="form-group">
                            <label class="small_text" for="claim1">Claim #1 by <em><?php echo $_SESSION['nickname'] .' ' . $_SESSION['lname']?></em></label>
                            <input type="text" name="claim[]" id="claim1" class="form-control rounded-0" placeholder="Enter your claim here.." required>
                        </div>
                        <div class="form-group">
                            <label class="small_text" for="reproduce1">Can you reproduce this claim?</label>
                            <select name="reproduce[]" id="reproduce1">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="Partially">Partially</option>
                            </select>

                        </div>
                        <strong>Proof or experiments:</strong>
                        <div class="form-group">
                            <label class="small_text" for="sourcecode1">Source code</label>
                            <input name="sourcecode[]" id="sourcecode1" class="form-control rounded-0" >
                        </div>
                        <div class="form-group">
                            <label class="small_text" for="datasets1">Datasets</label>
                            <input name="datasets[]" id="datasets1" class="form-control rounded-0" >
                        </div>
                        <div class="form-group">
                            <label class="small_text" for="results1">Experiments and results</label>
                            <input name="results[]" id="results1" class="form-control rounded-0" >
                        </div>
                        <div id="dynamic_field"></div>
                        <div class="form-group">
                            <button type="button" name="add" id="add" class="btn btn-primary rounded-0" ><i class="icon_plus_alt mr-1"></i> Add another claim</button>
                            <button type="submit" name="claims" id="claims" class="btn btn-success rounded-0" ><i class="icon_floppy mr-1"></i> Submit</button>
                        </div>
                    </form>
                </div>
            

            <?php
